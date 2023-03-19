<?php

class Student_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProfile($id)
    {
        $this->db->query("SELECT * FROM users WHERE userID = :studentID;"); 
        $this->db->bind(':studentID', $id);
        $results = $this->db->getRes();

        return $results;
    }

    public function getNewRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND user_seen = 0;");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getNewAppointmentsCount($studentID)
    {
        $this->db->query("SELECT * FROM appointments WHERE studentID = :studentID AND user_seen = 0;");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }
}