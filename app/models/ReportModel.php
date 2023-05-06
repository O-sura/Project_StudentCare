<?php

class ReportModel{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //total user count within a period
    public function totalUserCount($start_date,$end_date){
        $this->db->query("SELECT COUNT(*) as count from users WHERE registeredAt BETWEEN :startDate AND :emdDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    //function for getting user count by category
    public function userCountByRole($start_date,$end_date){
        $this->db->query("SELECT user_role, COUNT(*) as count from users WHERE user_role != \"admin\" AND registeredAt BETWEEN :startDate AND :emdDate GROUP BY user_role;");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->getAllRes();
        return $res;
    }

    //community posts
    public function postCount($start_date,$end_date){
        $this->db->query("SELECT * from posts WHERE  posted_at BETWEEN :startDate AND :emdDate");
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
        $this->db->query("SELECT DISTINCT author FROM posts WHERE posted_at BETWEEN :startDate AND :emdDate");
        $res1 = $this->db->getAllRes();

        $this->db->query("SELECT DISTINCT author FROM comments  WHERE posted_at BETWEEN :startDate AND :emdDate");
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
        $this->db->query("SELECT * from comments WHERE  added_date BETWEEN :startDate AND :emdDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    //post reportings
    public function postReportCount($start_date,$end_date){
        $this->db->query("SELECT * from post_reported WHERE  reported_at BETWEEN :startDate AND :emdDate");
        $this->db->bind(':startDate', $start_date);
        $this->db->bind(':endDate', $end_date);
        $res = $this->db->rowCount();
        return $res;
    }

    //total_counselling_sessions
    
    
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
    public function task_engagement($start_date,$end_date){
        $this->db->query("SELECT * FROM task WHERE date_added BETWEEN :startDate AND :endDate");
            $this->db->bind(':startDate', $start_date);
            $this->db->bind(':endDate', $end_date);
            $results = $this->db->rowCount();

            return $results;
    }

    public function task_completion($start_date,$end_date){
        $this->db->query("SELECT * FROM task WHERE (date_added BETWEEN :startDate AND :endDate) AND (task_status = 'completed')");
            $this->db->bind(':startDate', $start_date);
            $this->db->bind(':endDate', $end_date);
            $results = $this->db->rowCount();

            return $results;
    }
    //can get task completeion percentage by dividing task_comlpletion by task_engagement

    public function study_time_engagement($start_date,$end_date){
        $this->db->query("SELECT * FROM event WHERE date_added BETWEEN :startDate AND :endDate");
            $this->db->bind(':startDate', $start_date);
            $this->db->bind(':endDate', $end_date);
            $results = $this->db->rowCount();

            return $results;
    }

    public function study_time_completion($start_date,$end_date){
        $this->db->query("SELECT * FROM event WHERE (date_added BETWEEN :startDate AND :endDate) AND (event_status = 2)");
            $this->db->bind(':startDate', $start_date);
            $this->db->bind(':endDate', $end_date);
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
}