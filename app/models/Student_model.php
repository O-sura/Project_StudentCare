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
        $this->db->query("SELECT users.nic, users.username,users.email, users.fullname, users.home_address, users.contact_no, student.profile_img, student.university, student.dob 
        FROM users
        Inner Join student
        ON users.userID = student.userID
        WHERE users.userID = :studentID;"); 
        $this->db->bind(':studentID', $id);
        $results = $this->db->getRes();

        return $results;
    }

    public function getNewRequestsCount($studentID)
    {
        $this->db->query("SELECT * FROM request WHERE student_id = :studentID AND student_seen = 0;");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getNewAppointmentsCount($studentID)
    {
        $this->db->query("SELECT * FROM appointments WHERE studentID = :studentID AND student_seen = 0;");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM users WHERE username= :username');
        $this->db->bind(':username', $username);

        
        if($this->db->rowCount() > 0){
            return true;
        }
        else
            return false;
    }

    public function updateProfileDetails($data,$user_id){
  

        $this->db->query('UPDATE users SET username = :Cusername, fullname = :Cname, home_address = :Caddress, contact_no = :contact WHERE  userID = :userid;');

        $this->db->bind(':userid', $user_id);
        $this->db->bind(':Cusername', $data['username']);
        $this->db->bind(':Cname', $data['name']);
        $this->db->bind(':Caddress', $data['address']);
        $this->db->bind(':contact', $data['contact']);

        if($this->db->execute()){
            
            $this->db->query('UPDATE student SET profile_img = :pimg WHERE  userID = :userid;');

            $this->db->bind(':userid', $user_id);
            $this->db->bind(':pimg',$data['profile_img']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }



        }else{
            return false;
        }
        
    }

    public function getNewMessagesCount($studentID)
    {
        $this->db->query("SELECT * FROM messages WHERE receiverID = :studentID AND isReadByReceiver = 0;");
        $this->db->bind(':studentID', $studentID);
        $count = $this->db->rowCount();

        return $count;
    }

    public function getTaskNotificationCount($studentID)
    {
        $this->db->query("SELECT * FROM task WHERE task_user = :studentID AND task_date = :today AND task_status = 'not started';");
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':today', date('Y-m-d'));
        $count = $this->db->rowCount();

        return $count;
    }
}