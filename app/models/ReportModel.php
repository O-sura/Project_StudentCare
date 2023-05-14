<?php

class ReportModel{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //total user count within a period
    public function totalUserCount($start_date,$end_date){
        $this->db->query("SELECT COUNT(*) as count from users WHERE registeredAt BETWEEN :startDate AND :endDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    //function for getting user count by category
    public function userCountByRole($start_date,$end_date){
        $this->db->query("SELECT user_role, COUNT(*) as count from users WHERE user_role != \"admin\" AND registeredAt BETWEEN :startDate AND :endDate GROUP BY user_role;");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->getAllRes();
        return $res;
    }

    //community posts
    public function postCount($start_date,$end_date){
        $this->db->query("SELECT * from posts WHERE  posted_at BETWEEN :startDate AND :endDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    public function totalStudentCount(){
        $this->db->query("SELECT COUNT(*) as count from users WHERE user_role = \"student\" ");
        $res = $this->db->getAllRes();
        return $res;
    }

    //community engagement
    public function authorCount($start_date,$end_date){
        $this->db->query("SELECT DISTINCT author FROM posts WHERE posted_at BETWEEN :startDate AND :endDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res1 = $this->db->getAllRes();

        $this->db->query("SELECT DISTINCT author FROM comments  WHERE added_date BETWEEN :startDate AND :endDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res2 = $this->db->getAllRes();

        
        
        if($res1 && $res2){
            //merging two arrays together and finding only the unique author who have made either a comment or a post
            $mergedAuthors = array_merge($res1,$res2);
            $uniqueAuthors = array_unique(array_column($mergedAuthors, 'author'));
            $total_engaged =  count($uniqueAuthors);
            $total_students = $this->totalStudentCount()[0]->count;
            $engaged_percent = ($total_engaged/$total_students)*100;
            return $engaged_percent;
        }
    }

    //comment count
    public function commentCount($start_date,$end_date){
        $this->db->query("SELECT * from comments WHERE  added_date BETWEEN :startDate AND :endDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    //post reportings
    public function postReportCount($start_date,$end_date){
        $this->db->query("SELECT * from post_reported WHERE  reported_at BETWEEN :startDate AND :endDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    //total_counselling_sessions
    public function totalCSessions($start_date,$end_date){
        $this->db->query("SELECT appointments.studentID,users.fullname,appointments.appointmentDate,
        CASE appointmentStatus 
            WHEN 0 THEN 'Pending' 
            WHEN 1 THEN 'Completed' 
            WHEN 2 THEN 'Requested to Cancel' 
            WHEN 3 THEN 'Cancelled' 
        END AS status FROM appointments INNER JOIN users ON users.userID = appointments.studentID WHERE appointmentDate BETWEEN :startDate AND :endDate;");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->getAllRes();
        return $res;
    }

    //counselling sessions(grouped by status)
    public function sessionsByStatus($start_date,$end_date){
        $this->db->query("SELECT 
        CASE appointmentStatus 
            WHEN 0 THEN 'Pending' 
            WHEN 1 THEN 'Completed' 
            WHEN 2 THEN 'Requested to Cancel' 
            WHEN 3 THEN 'Cancelled' 
        END AS status ,COUNT(*) as count
        FROM appointments
        WHERE appointmentDate BETWEEN :startDate AND :endDate
        GROUP BY appointmentStatus;");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->getAllRes();
        return $res;
    }

    //counselors grouped by specialization
    public function counselors_by_specialization(){
        $this->db->query("SELECT COUNT(DISTINCT userID) AS count, specialization FROM counsellor GROUP BY specialization;");
        $res = $this->db->getAllRes();
        return $res;
    }

    //counselor-stu-engagement
    public function counselor_stu_engagement(){
        $this->db->query("SELECT 
        COUNT(DISTINCT counsellor.counsellorID) AS all_counselors, 
        COUNT(DISTINCT counselor_alloc.counselor_id) AS allocated_counselors, 
        (COUNT(DISTINCT counselor_alloc.counselor_id)/COUNT(DISTINCT counsellor.counsellorID))*100 AS counselor_student_engagement 
      FROM 
        counsellor 
        LEFT JOIN counselor_alloc ON counsellor.counsellorID = counselor_alloc.counselor_id;");
        
        $res = $this->db->getRes();
        return $res;
    }

    //counselor-ann-engagement
    public function counselor_ann_engagement(){
        $this->db->query("SELECT COUNT(DISTINCT ann_post.userID) AS announcement_posted_counselors, COUNT(DISTINCT counsellor.userID) AS all_counselers, (COUNT(DISTINCT ann_post.userID)/COUNT(DISTINCT counsellor.userID))*100 AS counselor_announcement_engagement FROM counsellor LEFT JOIN ann_post ON ann_post.userID = counsellor.userID;");
        $res = $this->db->getRes();
        return $res;
    }
    
    // student-listings engagement
    public function student_listing_engagement($start_date,$end_date){   //get number of reviews added in a given period

            $this->db->query("SELECT * FROM listing_feedback WHERE date_added BETWEEN :startDate AND :endDate");
            $this->db->bind(':startDate', $start_date);
            $this->db->bind(':endDate', $end_date);
            $results = $this->db->rowCount();

            return $results;

    }

    public function student_review_engagement($start_date,$end_date){   //get number of students engaged in voting helpful for revires in a given period
            $this->db->query("SELECT * FROM review_helpful WHERE helpful_vote_added BETWEEN :startDate AND :endDate");
            $this->db->bind(':startDate', $start_date);
            $this->db->bind(':endDate', $end_date);
            $results = $this->db->rowCount();

            return $results;

    }

    // student-mobile app engagement
    public function mobile_app_interaction ($startDate,$endDate)
    {
        $this->db->query("SELECT DISTINCT task_user AS user_id
	FROM task
	WHERE(date_added BETWEEN :startDate AND :endDate)
	UNION
	SELECT DISTINCT user_id
	FROM event
	WHERE (date_added BETWEEN :startDate AND :endDate)");

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->rowCount();

        return $results;
    }

    //get listing details by category count and average rating
    public function listing_overview($start_date,$end_date){
        $this->db->query("SELECT category, COUNT(*) AS listing_count, AVG(rating) AS average_rating FROM listing WHERE added_date BETWEEN :startDate AND :endDate GROUP BY category ORDER BY category;");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $results = $this->db->getAllRes();

        return $results;
    }
    //
    public function listing_by_location($start_date,$end_date){
        $this->db->query("SELECT location, COUNT(*) AS count, (COUNT(*) / (SELECT COUNT(*) FROM listing)) * 100 AS percentage FROM listing WHERE added_date BETWEEN :startDate AND :endDate GROUP BY location;");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $results = $this->db->getAllRes();

        return $results;
    }

    //Single Facility Provider Data Queries
    public function listing_performance($usr)
    {
        $this->db->query("SELECT
    	l.listing_id,
    	l.topic,
    	l.category,
    	l.rating,
    	l.address,
    	COUNT(lf.review_id) AS num_feedbacks,
   	SUM(CASE WHEN lf.star_rating >= 3 THEN 1 ELSE 0 END) AS num_bad_reviews,
    	SUM(CASE WHEN lf.star_rating < 3 THEN 1 ELSE 0 END) AS num_good_reviews
	FROM
    	listing AS l
    	LEFT JOIN listing_feedback AS lf ON l.listing_id = lf.listing_id
	WHERE
    	l.fpID = :userID
	GROUP BY
    	l.listing_id,
    	l.topic,
    	l.category,
    	l.rating,
    	l.address");

        $this->db->bind(':userID', $usr);
        $results = $this->db->getAllRes();

        return $results;
    }

    //Listing Overview Report

    //listing performance
    public function listing_performance_report($startDate,$endDate)
    {
        $this->db->query("SELECT
    	l.listing_id,
    	l.topic,
    	l.category,
    	AVG(lf.star_rating) AS rating,
    	l.address,
    	COUNT(lf.review_id) AS num_feedbacks,
    	SUM(CASE WHEN lf.star_rating >= 3 THEN 1 ELSE 0 END) AS num_bad_reviews,
    	SUM(CASE WHEN lf.star_rating < 3 THEN 1 ELSE 0 END) AS num_good_reviews
	FROM
    	listing AS l
    	LEFT JOIN listing_feedback AS lf ON l.listing_id = lf.listing_id
	WHERE
    	lf.date_added >= :startDate
    	AND lf.date_added <= :endDate
	GROUP BY
    	l.listing_id,
    	l.topic,
    	l.category,
    	l.address
	");

        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->getAllRes();

        return $results;
    }

    //geographic analysis report
    public function geographic_analysis_report($startDate,$endDate)
	{
   	 $this->db->query("SELECT
    	l.location,
    	COUNT(l.listing_id) AS num_listings,
    	AVG(lf.star_rating) AS avg_rating,
    	AVG(num_feedbacks) AS avg_num_feedbacks
	FROM
    	listing AS l
    	LEFT JOIN (
        SELECT
            listing_id,
            star_rating,
            COUNT(review_id) AS num_feedbacks
        FROM
            listing_feedback
        WHERE
            date_added >= :startDate
            AND date_added <= :endDate
        GROUP BY
            listing_id, star_rating
    		) AS lf ON l.listing_id = lf.listing_id
	GROUP BY
    	l.location
	");
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
   	$results = $this->db->getAllRes();

    	return $results;
	}

    //user activity report
    public function user_activity_report($startDate, $endDate)
    {
        $this->db->query("SELECT
   	 l.fpID AS userid,
    	COUNT(DISTINCT l.listing_id) AS num_listings_added,
    	COUNT(m.messageID) AS num_messages_sent
	FROM
	listing AS l
	LEFT JOIN messages AS m ON l.fpID = m.senderID
	WHERE
    	l.added_date >= :startDate
    	AND l.added_date <= :endDate
	GROUP BY
    	l.fpID
	");

	$this->db->bind(':startDate', $startDate);
	$this->db->bind(':endDate', $endDate);
        $results = $this->db->getAllRes();

        return $results;
    }


    //Counselor summary report queries
    //student count and student details associated with a specific counselor
    public function student_count($userID,$count){
        $this->db->query('SELECT DISTINCT appointments.studentID, users.fullname
        FROM appointments 
        INNER JOIN users ON users.userID = appointments.studentID 
        WHERE appointments.counsellorID = :userID');
        $this->db->bind(':userID', $userID);
        if($count == 1){
            $res = $this->db->rowCount();
        }else{
            $res = $this->db->getAllRes();
        }
        
        return $res;
    }

    //session count
    public function session_count($userID){
        $this->db->query("SELECT * 
        FROM appointments
        WHERE counsellorID = :userID
        AND appointmentStatus != 3");
        $this->db->bind(':userID', $userID);
        $res = $this->db->rowCount();
        return $res;
    }

    //cancelled count
    public function session_cancelled_count($userID){
        $this->db->query("SELECT *
        FROM appointments
        WHERE counsellorID = :userID
        AND appointmentStatus = 3");
        $this->db->bind(':userID', $userID);
        $res = $this->db->rowCount();
        return $res;
    }

    //completed count
    public function session_completed_count($userID){
        $this->db->query("SELECT *
        FROM appointments
        WHERE counsellorID = :userID
        AND appointmentStatus = 1");
        $this->db->bind(':userID', $userID);
        $res = $this->db->rowCount();
        return $res;
    }

    //total session details
    public function total_session_details($userID){
        $this->db->query("SELECT appointments.studentID,users.fullname,appointments.appointmentDate,
        CASE appointmentStatus 
            WHEN 0 THEN 'Pending' 
            WHEN 1 THEN 'Completed' 
            WHEN 2 THEN 'Requested to Cancel' 
            WHEN 3 THEN 'Cancelled' 
        END AS status FROM appointments INNER JOIN users ON users.userID = appointments.studentID WHERE appointments.counsellorID = :userID");
        $this->db->bind(':userID', $userID);
        $res = $this->db->getAllRes();
        return $res;
    }

    
}