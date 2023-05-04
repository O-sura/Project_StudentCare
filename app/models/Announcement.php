<?php

class Announcement
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
        Session::init();
        Middleware::authorizeUser(Session::get('userrole'), 'student');
    }

    public function getAnnouncements($usr)
    {
        $this->db->query("SELECT 
        ann_post.post_id, 
        ann_post.post_head, 
        ann_post.posted_date, 
        users.fullname,
        counsellor.profile_img
        FROM ann_post 
        JOIN 
        counselor_alloc ON ann_post.userID = counselor_alloc.counselor_id 
        JOIN 
        users ON users.userID = counselor_alloc.counselor_id
        JOIN
        counsellor ON counsellor.counsellorID = counselor_alloc.counselor_id
        WHERE counselor_alloc.student_id = :studentID ORDER BY ann_post.posted_date DESC;");

        $this->db->bind(':studentID', $usr);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function viewAnnouncement($data)
    {
        $this->db->query("SELECT ann_post.*, users.fullname, counsellor.profile_img 
        FROM ann_post JOIN users ON ann_post.userID = users.userID 
        JOIN counsellor ON counsellor.counsellorID = ann_post.userID 
        WHERE ann_post.post_id = :announcementID");
        $this->db->bind(':announcementID', $data['announcementID']);
        $results = $this->db->getRes();

        return $results;
    }

    public function filterAnnouncement($sort, $filter, $usr)
    {
        if($sort=='earliest'){
            if($filter == 'starred'){
                $this->db->query("SELECT 
                ann_post.post_id, 
                ann_post.post_head, 
                ann_post.posted_date, 
                users.fullname,
                counsellor.profile_img
                FROM ann_post 
                JOIN 
                counselor_alloc ON ann_post.userID = counselor_alloc.counselor_id 
                JOIN 
                save_announcement ON save_announcement.announcement_id = ann_post.post_id
                JOIN
                users ON users.userID = counselor_alloc.counselor_id
                JOIN
                counsellor ON counsellor.counsellorID = counselor_alloc.counselor_id
                WHERE counselor_alloc.student_id = :studentID  ORDER BY ann_post.posted_date ASC;");
            }else{
                $this->db->query("SELECT 
                ann_post.post_id, 
                ann_post.post_head, 
                ann_post.posted_date, 
                users.fullname,
                counsellor.profile_img
                FROM ann_post 
                JOIN 
                counselor_alloc ON ann_post.userID = counselor_alloc.counselor_id 
                JOIN 
                users ON users.userID = counselor_alloc.counselor_id
                JOIN
                counsellor ON counsellor.counsellorID = counselor_alloc.counselor_id
                WHERE counselor_alloc.student_id = :studentID ORDER BY ann_post.posted_date ASC;");
            }

        }else{
            if($filter=='starred'){
                $this->db->query("SELECT 
                ann_post.post_id, 
                ann_post.post_head, 
                ann_post.posted_date, 
                users.fullname,
                counsellor.profile_img
                FROM ann_post 
                JOIN 
                counselor_alloc ON ann_post.userID = counselor_alloc.counselor_id 
                JOIN 
                save_announcement ON save_announcement.announcement_id = ann_post.post_id
                JOIN
                users ON users.userID = counselor_alloc.counselor_id
                JOIN
                counsellor ON counsellor.counsellorID = counselor_alloc.counselor_id
                WHERE counselor_alloc.student_id = :studentID  ORDER BY ann_post.posted_date DESC;");
            }else{
                $this->db->query("SELECT 
                ann_post.post_id, 
                ann_post.post_head, 
                ann_post.posted_date, 
                users.fullname,
                counsellor.profile_img
                FROM ann_post 
                JOIN 
                counselor_alloc ON ann_post.userID = counselor_alloc.counselor_id 
                JOIN 
                users ON users.userID = counselor_alloc.counselor_id
                JOIN
                counsellor ON counsellor.counsellorID = counselor_alloc.counselor_id
                WHERE counselor_alloc.student_id = :studentID ORDER BY ann_post.posted_date DESC;");
            }
        }
        
        $this->db->bind(':studentID', $usr);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function searchAnnouncement($search,$filter,$user){
        if($filter=='starred'){
            
        }else{

        }
    }


}
