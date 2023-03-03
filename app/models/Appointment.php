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

    public function getProfile($data)
    {
        $this->db->query("SELECT users.userID, users.fullname, users.home_address, users.contact_no, TIMESTAMPDIFF(YEAR, counsellor.dob, CURDATE()) AS age , counsellor.specialization
        FROM users
        INNER JOIN counsellor
        ON users.userID = counsellor.userID
        WHERE users.userID = :counselorID;"); 
        $this->db->bind(':counselorID', $data['counselorID']);
        $results = $this->db->getRes();

        return $results;
    }

    public function getQualifications($data)
    {
        $this->db->query("SELECT qualification_details
        FROM qualifications
        WHERE counselor_id = :counselorID;"); 
        $this->db->bind(':counselorID', $data['counselorID']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function addRequest($data){
        $requestId = substr(sha1(date(DATE_ATOM)), 0, 8);
        
        $this->db->query("INSERT INTO request (request_id, student_id, counselor_id, request_date, request_time, request_status, request_description) VALUES (:requestID,  :studentID, :counselorID, :requestDate, :requestTime, :requestStatus, :requestDescription)");
        $this->db->bind(':requestID', $requestId);
        $this->db->bind(':counselorID', $data['counselorID']);
        $this->db->bind(':studentID', $data['studentID']);
        $this->db->bind(':requestDate', $data['requestDate']);
        $this->db->bind(':requestTime', $data['requestTime']);
        $this->db->bind(':requestStatus', $data['requestStatus']);
        $this->db->bind(':requestDescription', $data['requestDescription']);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

   


}
