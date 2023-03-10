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
        $this->db->query("SELECT users.userID, users.fullname, users.home_address, users.contact_no, TIMESTAMPDIFF(YEAR, counsellor.dob, CURDATE()) AS age , counsellor.specialization, counsellor.counselor_description, counsellor.profile_img
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

    public function addRequest($data)
    {
        $requestId = substr(sha1(date(DATE_ATOM)), 0, 8);

        $this->db->query("INSERT INTO request (request_id, student_id, counselor_id, request_status, request_description) VALUES (:requestID,  :studentID, :counselorID, :requestStatus, :requestDescription)");
        $this->db->bind(':requestID', $requestId);
        $this->db->bind(':counselorID', $data['counselorID']);
        $this->db->bind(':studentID', $data['studentID']);
        $this->db->bind(':requestStatus', $data['requestStatus']);
        $this->db->bind(':requestDescription', $data['requestDescription']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hasRequested($data)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND counselor_id = :counselorID AND request_status = 0");
        $this->db->bind(':counselorID', $data['counselorID']);
        $this->db->bind(':studentID', $data['studentID']);
        $results = $this->db->getRes();

        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    public function requestLimit($data)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND request_status = 0");
        $this->db->bind(':studentID', $data['studentID']);
        $count = $this->db->rowCount();

        if ($count < 3) {
            return false;
        } else {
            return true;
        }
    }

    public function getPendingRequests($studentID)
    {
        $this->db->query("SELECT request.request_id, request.requested_on, request.request_status, users.fullname, counsellor.profile_img, counsellor.specialization
        FROM request
        INNER JOIN users
        ON request.counselor_id = users.userID
        INNER JOIN counsellor
        ON request.counselor_id = counsellor.userID
        WHERE request.student_id = :studentID AND request.request_status = 0;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getAcceptedRequests($studentID)
    {
        $this->db->query("SELECT request.request_id, request.requested_on, request.request_status, users.fullname, counsellor.profile_img ,counsellor.specialization
        FROM request
        INNER JOIN users
        ON request.counselor_id = users.userID
        INNER JOIN counsellor
        ON request.counselor_id = counsellor.userID
        WHERE request.student_id = :studentID AND request.request_status = 1;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getRejectedRequests($studentID)
    {
        $this->db->query("SELECT request.request_id, request.requested_on, request.request_status,request.reason, users.fullname, counsellor.profile_img, counsellor.specialization
        FROM request
        INNER JOIN users
        ON request.counselor_id = users.userID
        INNER JOIN counsellor
        ON request.counselor_id = counsellor.userID
        WHERE request.student_id = :studentID AND request.request_status = 2;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getPendingRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND request_status = 0");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getAcceptedRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND request_status = 1");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getRejectedRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND request_status = 2");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function deleteRequest($id)
    {
        $this->db->query("DELETE FROM request WHERE request_id = :requestID");
        $this->db->bind(':requestID', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllAppointments($studentID)
    {
        $this->db->query("SELECT appointments.appointmentID, appointments.appointmentDate, appointments.appointmentTime, users.fullname, counsellor.profile_img, counsellor.specialization, counsellor.counsellorID
        FROM appointments
        INNER JOIN users
        ON appointments.counsellorID = users.userID
        INNER JOIN counsellor
        ON appointments.counsellorID = counsellor.userID
        WHERE appointments.studentID = :studentID AND appointments.appointmentDate >= CURDATE()
        ORDER BY appointments.appointmentDate ASC, appointments.appointmentTime ASC;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }
}
