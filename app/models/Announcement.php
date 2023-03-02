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

    public function getAnnouncements()
    {
        $this->db->query("SELECT 
        announcement.announcement_id, 
        announcement.subject, 
        announcement.date, 
        users.fullname
        FROM announcement 
        JOIN 
        counselor_alloc ON announcement.counselor_id = counselor_alloc.counselor_id 
        JOIN 
        users ON users.userID = counselor_alloc.counselor_id
        WHERE counselor_alloc.student_id = :studentID;");
        $usr =   '789';
        $this->db->bind(':studentID', $usr);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function viewAnnouncement($data)
    {
        $this->db->query("SELECT * FROM announcement WHERE announcement_id = :announcementID");
        $this->db->bind(':announcementID', $data['announcementID']);
        $results = $this->db->getRes();

        return $results;
    }
}
