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
        ON users.userID = counsellor.userID
        WHERE counsellor.admin_verified = 1;");

        $results = $this->db->getAllRes();

        return $results;
    }

    public function getProfile($data)
    {
        $this->db->query("SELECT users.userID, users.fullname, users.home_address, users.contact_no, users.userID, TIMESTAMPDIFF(YEAR, counsellor.dob, CURDATE()) AS age , counsellor.specialization, counsellor.counselor_description, counsellor.profile_img, counsellor.qualifications
        FROM users
        INNER JOIN counsellor
        ON users.userID = counsellor.userID
        WHERE users.userID = :counselorID;");
        $this->db->bind(':counselorID', $data['counselorID']);
        $results = $this->db->getRes();

        return $results;
    }


    public function addRequest($data)
    {
        // $requestId = substr(sha1(date(DATE_ATOM)), 0, 8);

        $this->db->query("INSERT INTO requests (studentID, counsellorID, statusPP, rNote) VALUES (:studentID, :counselorID, :requestStatus, :requestDescription)");
        // $this->db->bind(':requestID', $requestId);
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
        $this->db->query("SELECT * FROM requests WHERE studentID = :studentID AND counsellorID = :counselorID AND statusPP = 0");
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
        $this->db->query("SELECT * FROM requests WHERE studentID = :studentID AND statusPP = 0");
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
        $this->db->query("SELECT requests.rID, requests.requested_on, requests.statusPP, users.fullname, counsellor.profile_img, counsellor.specialization
        FROM requests
        INNER JOIN users
        ON requests.counsellorID = users.userID
        INNER JOIN counsellor
        ON requests.counsellorID = counsellor.userID
        WHERE requests.studentID = :studentID AND requests.statusPP = 0;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getAcceptedRequests($studentID)
    {
        $this->db->query("SELECT requests.rID, requests.requested_on, requests.statusPP, users.email, users.fullname, counsellor.profile_img ,counsellor.specialization
        FROM requests
        INNER JOIN users
        ON requests.counsellorID = users.userID
        INNER JOIN counsellor
        ON requests.counsellorID = counsellor.userID
        WHERE requests.studentID = :studentID AND requests.statusPP = 1;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getRejectedRequests($studentID)
    {
        $this->db->query("SELECT requests.rID, requests.requested_on, requests.statusPP,requests.reason, users.fullname, counsellor.profile_img, counsellor.specialization
        FROM requests
        INNER JOIN users
        ON requests.counsellorID = users.userID
        INNER JOIN counsellor
        ON requests.counsellorID = counsellor.userID
        WHERE requests.studentID = :studentID AND requests.statusPP = 2;");
        $this->db->bind(':studentID', $studentID);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getPendingRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM requests WHERE studentID = :studentID AND statusPP = 0");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getAcceptedRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM requests WHERE studentID = :studentID AND statusPP = 1");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getRejectedRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM requests WHERE studentID = :studentID AND statusPP = 2");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getRequestDetails($id){
        $this->db->query("SELECT requests.rID,requests.requested_on ,requests.rNote, users.fullname, counsellor.specialization
        FROM requests
        INNER JOIN users
        ON requests.counsellorID = users.userID
        INNER JOIN counsellor
        ON requests.counsellorID = counsellor.userID
        WHERE requests.rID = :requestID;");
        $this->db->bind(':requestID', $id);
        $results = $this->db->getRes();

        return $results;
    }

    public function deleteRequest($id)
    {
        $this->db->query("DELETE FROM requests WHERE rID = :requestID");
        $this->db->bind(':requestID', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllAppointments($studentID)
    {
        $this->db->query("SELECT appointments.*, users.fullname, counsellor.profile_img, counsellor.specialization, counsellor.counsellorID
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
        $this->db->query("UPDATE requests SET student_seen = 1 WHERE studentID = :studentID");
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
        $this->db->query("SELECT rID FROM requests WHERE studentID = :studentID AND student_seen = 0");
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
        $this->db->query("UPDATE requests SET rNote = :rNote, student_req_seen = 0 WHERE rID = :rID");
        $this->db->bind(':rNote', $data['requestDescription']);
        $this->db->bind(':rID', $data['requestID']);

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

    public function undoCancellation($appointmentID){
        $this->db->query("UPDATE appointments SET appointmentStatus = 0, cancellationReason = NULL, counselor_seen = 0, requested_on = NULL WHERE appointmentID = :appointmentID");
        $this->db->bind(':appointmentID', $appointmentID);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCounselorsByType($specialization){
        $this->db->query("SELECT users.userID, users.fullname, counsellor.counselor_description, counsellor.specialization, counsellor.profile_img
        FROM users
        INNER JOIN counsellor
        ON users.userID = counsellor.userID
        WHERE counsellor.specialization = :specialization;");
        $this->db->bind(':specialization', $specialization);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getCounselorsBySearch($search,$type){

        if($type == 'All'){
            $this->db->query("SELECT users.userID, users.fullname, counsellor.counselor_description, counsellor.specialization, counsellor.profile_img
            FROM users
            INNER JOIN counsellor
            ON users.userID = counsellor.userID
            WHERE LOWER(users.fullname) LIKE LOWER(:search) OR LOWER(counsellor.specialization) LIKE LOWER(:search) OR LOWER(counsellor.counselor_description) LIKE LOWER(:search);");
            $this->db->bind(':search', '%'.$search.'%');
            $results = $this->db->getAllRes();

            return $results;
        }else{

            $this->db->query("SELECT users.userID, users.fullname, counsellor.counselor_description, counsellor.specialization, counsellor.profile_img
            FROM users
            INNER JOIN counsellor
            ON users.userID = counsellor.userID
            WHERE (LOWER(users.fullname) LIKE LOWER(:search) OR LOWER(counsellor.specialization) LIKE LOWER(:search) OR LOWER(counsellor.counselor_description) LIKE LOWER(:search)) AND (counsellor.specialization = :type);");
            $this->db->bind(':search', '%'.$search.'%');
            $this->db->bind(':type', $type);
            $results = $this->db->getAllRes();

            return $results;


        }

    }




}
