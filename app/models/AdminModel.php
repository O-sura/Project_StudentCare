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
    
}


?>