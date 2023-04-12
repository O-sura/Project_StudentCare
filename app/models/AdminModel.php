<?php

class AdminModel{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //fetch all unverified counselors
    public function getUnverifiedCounselors(){
        $this->db->query("SELECT c.*, u.fullname FROM counsellor c INNER JOIN users u ON c.userID = u.userID WHERE admin_verified = 0");
        $unverified_list = $this->db->getAllRes();
        return $unverified_list;
    }

    //function to check whether a particular counsellor is manually verified by the admin or not
    public function changeAdminVerification($id,$state){
        $this->db->query("UPDATE TABLE counsellor SET admin_verified = :verify_state WHERE userID = :id");
        $this->db->bind(':verify_state', $state);
        $this->db->bind(':id', $id);

        $this->db->getRes();
    }  

    //Delete counselor register info if he got rejected by the admins
    public function deleteCounselorInfo($uid,$cid){
        $this->db->query("DELETE FROM counsellor WHERE counsellorID = :id");
        $this->db->bind(':id', $cid);

        if($this->db->getRes()){
            $this->db->query("DELETE FROM users WHERE userID = :id");
            $this->db->bind(':id', $uid);
            $this->db->getRes();
        }else{
            return false;
        }
    }

    //Return info about a counselor info taking counselor ID as a parameter
    public function getCounselorInfo($id){
        $this->db->query("SELECT c.*, u.* FROM counsellor c INNER JOIN users u ON c.userID = u.userID WHERE c.counsellorID = :id");
        $this->db->bind(':id', $id);
        $info = $this->db->getAllRes();
        return $info;
    }

    public function getUserManagementInfo(){
        $this->db->query("SELECT userID,username,user_role,isBlocked from users");
        $res = $this->db->getAllRes();
        return $res;
    }

    public function toggleBlockState($userID){
        $this->db->query("UPDATE users SET isBlocked = !isBlocked WHERE userID  = :userID");
        $this->db->bind(':userID',$userID);
        $this->db->getRes();
        
        $this->db->query("SELECT isBlocked FROM users WHERE userID = :userID");
        $this->db->bind(':userID',$userID);
        $currstate = $this->db->getRes();
        return json_encode($currstate);
    }

    public function deleteUser($userID){
        $this->db->query("DELETE FROM users WHERE userID  = :userID");
        $this->db->bind(':userID',$userID);
        if($this->db->getRes()){
            $res = 1;
        }else{
            $res = 0;
        }
        return json_encode($res);
    }
    
}


?>