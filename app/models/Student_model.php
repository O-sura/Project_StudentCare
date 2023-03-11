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
}