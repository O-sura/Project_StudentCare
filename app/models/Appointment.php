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
        $this->db->query("SELECT users.userID, users.fullname, counsellor.counselor_description, counsellor.specialization, counsellor.profile_img
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
        $this->db->query("SELECT request.request_id, request.requested_on, request.request_status, users.email, users.fullname, counsellor.profile_img ,counsellor.specialization
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

    public function getRequestDetails($id){
        $this->db->query("SELECT request.request_id,request.requested_on ,request.request_description, users.fullname, counsellor.specialization
        FROM request
        INNER JOIN users
        ON request.counselor_id = users.userID
        INNER JOIN counsellor
        ON request.counselor_id = counsellor.userID
        WHERE request.request_id = :requestID;");
        $this->db->bind(':requestID', $id);
        $results = $this->db->getRes();

        return $results;
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
        $this->db->query("SELECT appointments.meetingID,appointments.appointmentID, appointments.appointmentDate, appointments.appointmentTime, users.fullname, counsellor.profile_img, counsellor.specialization, counsellor.counsellorID
        FROM appointments
        INNER JOIN users
        ON appointments.counsellorID = users.userID
        INNER JOIN counsellor
        ON appointments.counsellorID = counsellor.userID
        WHERE appointments.studentID = :studentID AND appointments.appointmentDate >= CURDATE() AND appointments.appointmentStatus = 0
        ORDER BY appointments.appointmentDate ASC, appointments.appointmentTime ASC;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getCancelledAppointments($studentID){
        $this->db->query("SELECT appointments.meetingID,appointments.appointmentID, appointments.appointmentDate, appointments.appointmentTime,appointments.cancellationReason,appointments.appointmentStatus, users.fullname, counsellor.profile_img, counsellor.specialization, counsellor.counsellorID
        FROM appointments
        INNER JOIN users
        ON appointments.counsellorID = users.userID
        INNER JOIN counsellor
        ON appointments.counsellorID = counsellor.userID
        WHERE appointments.studentID = :studentID AND appointments.appointmentDate >= CURDATE() AND (appointments.appointmentStatus = 2 OR appointments.appointmentStatus = 3)
        ORDER BY appointments.appointmentDate ASC, appointments.appointmentTime ASC;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function updateSeen($id)
    {
        $this->db->query("UPDATE request SET student_seen = 1 WHERE student_id = :studentID");
        $this->db->bind(':studentID', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAppointmentSeen($id)
    {
        $this->db->query("UPDATE appointments SET student_seen = 1 WHERE studentID = :studentID");
        $this->db->bind(':studentID', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUnseenRequests($studentID)
    {
        $this->db->query("SELECT request_id FROM request WHERE student_id = :studentID AND student_seen = 0");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }
   
    public function getUnseenAppointments($studentID)
    {
        $this->db->query("SELECT appointmentID FROM appointments WHERE studentID = :studentID AND student_seen = 0");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function editRequest($data)
    {
        $this->db->query("UPDATE request SET request_description = :request_description, counselor_seen = 0 WHERE request_id = :request_id");
        $this->db->bind(':request_description', $data['requestDescription']);
        $this->db->bind(':request_id', $data['requestID']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancelAppointment($data){
        $this->db->query("UPDATE appointments SET appointmentStatus = 2, cancellationReason = :reason, counselor_seen = 0, requested_on = :cancelledOn WHERE appointmentID = :appointmentID");
        $this->db->bind(':appointmentID', $data['appointmentID']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':cancelledOn', $data['cancelledDate']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
