<?php
class Appointment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCounselorDetails()
    {
        $this->db->query("SELECT users.userID, users.fullname, counsellor.counselor_description, counsellor.specialization
        FROM users
        INNER JOIN counsellor
        ON users.userID = counsellor.userID;"); 
        
        $results = $this->db->getAllRes();

        return $results;
    }



   


}
