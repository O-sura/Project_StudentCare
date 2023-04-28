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

    public function getRole($userID){
        $this->db->query("SELECT user_role FROM users WHERE userID  = :userID");
        $this->db->bind(':userID',$userID);
        return $this->db->getRes();
    }

    public function getCurrentUsername($userID){
        $this->db->query("SELECT username FROM users WHERE userID  = :userID");
        $this->db->bind(':userID',$userID);
        return $this->db->getRes();
    }

    public function updateStudentDetails($data,$userID){
        $this->db->query('UPDATE users SET username = :Cusername, fullname = :Cname, home_address = :Caddress, contact_no = :contact, nic = :nic, email = :email WHERE  userID = :userid;');

        $this->db->bind(':userid', $userID);
        $this->db->bind(':Cusername', $data['username']);
        $this->db->bind(':Cname', $data['name']);
        $this->db->bind(':Caddress', $data['address']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':nic', $data['nic']);

        if($this->db->execute()){
            $this->db->query('UPDATE student SET profile_img = :pimg, dob = :dob, university = :university WHERE  userID = :userid;');
            $this->db->bind(':userid', $userID);
            $this->db->bind(':university', $data['university']);
            $this->db->bind(':dob', $data['dob']);
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

    public function updateCounselorDetails($data,$user_id){
        $this->db->query('UPDATE users SET username = :Cusername, fullname = :Cname, email = :Cemail, home_address = :Caddress, contact_no = :contact, nic = :nic WHERE  userID = :userid;');

        $this->db->bind(':userid', $user_id);
        $this->db->bind(':Cusername', $data['username']);
        $this->db->bind(':Cemail', $data['email']);
        $this->db->bind(':Cname', $data['name']);
        $this->db->bind(':Caddress', $data['address']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':nic', $data['nic']);

        if($this->db->execute()){
            
            $this->db->query('UPDATE counsellor SET specialization = :Cspecialization, qualifications = :Cqualifications, profile_img = :pimg, dob = :dob WHERE  userID = :userid;');

            $this->db->bind(':userid', $user_id);
            $this->db->bind(':Cspecialization', $data['specialization']);
            $this->db->bind(':Cqualifications',implode(",", $data['qualifications']));
            $this->db->bind(':pimg',$data['profile_img']);
            $this->db->bind(':dob', $data['dob']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }



        }else{
            return false;
        }
        
    }

    public function updateFpDetails($data,$user_id){
        $this->db->query('UPDATE users SET username = :Cusername, fullname = :Cname, email = :Cemail, home_address = :Caddress, contact_no = :contact, nic = :nic WHERE  userID = :userid;');

        $this->db->bind(':userid', $user_id);
        $this->db->bind(':Cusername', $data['username']);
        $this->db->bind(':Cemail', $data['email']);
        $this->db->bind(':Cname', $data['name']);
        $this->db->bind(':Caddress', $data['address']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':nic', $data['nic']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function totalUserCount(){
        $this->db->query("SELECT COUNT(*) as count from users");
        $res = $this->db->getAllRes();
        return $res;
    }

    public function totalStudentCount(){
        $this->db->query("SELECT COUNT(*) as count from users WHERE user_role = \"student\" ");
        $res = $this->db->getAllRes();
        return $res;
    }

    public function newCounselorReq(){
        $this->db->query("SELECT COUNT(*) as count from counsellor WHERE admin_verified = 0 ");
        $res = $this->db->getAllRes();
        return $res;
    }

     public function newRegUsers(){
        $this->db->query("SELECT DAYNAME(registeredAt) AS reg_date, COUNT(*) AS count FROM users WHERE registeredAt BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW() GROUP BY DATE(registeredAt);");
        $res = $this->db->getAllRes();
        return json_encode($res);
    }

     public function userCountByRole(){
        $this->db->query("SELECT user_role, COUNT(*) as count from users WHERE user_role != \"admin\" GROUP BY user_role;");
        $res = $this->db->getAllRes();
        return json_encode($res);
    }

    public function postCount(){
        $this->db->query("SELECT COUNT(*) as count from posts;");
        $res = $this->db->getAllRes();
        return $res;
    }

    public function authorCount(){
        $this->db->query("SELECT DISTINCT author FROM posts");
        $res1 = $this->db->getAllRes();

        $this->db->query("SELECT DISTINCT author FROM comments");
        $res2 = $this->db->getAllRes();

        
        
        if($res1 && $res2){
            //merging two arrays together and finding only the unique author who have made either a comment or a post
            $mergedAuthors = array_merge($res1,$res2);
            $uniqueAuthors = array_unique(array_column($mergedAuthors, 'author'));
            $total_engaged =  count($uniqueAuthors);
            $total_students = $this->totalStudentCount()[0]->count;
            $engaged_percent = ($total_engaged/$total_students)*100;
            return $engaged_percent;
        }
    }

    public function getCommunityPostData(){
        $this->db->query("SELECT DAYNAME(posted_at) AS posted_date, COUNT(*) AS count FROM posts WHERE posted_at BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() GROUP BY DATE(posted_at);");
        $res = $this->db->getAllRes();
        return json_encode($res);
    }

    public function getCommunityCommentData(){
        $this->db->query("SELECT DAYNAME(added_date) AS posted_date, COUNT(*) AS count FROM comments WHERE added_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() GROUP BY DATE(added_date);");
        $res = $this->db->getAllRes();        
        return json_encode($res);
    }

    public function getTopPosts(){
        $this->db->query("SELECT posts.post_id, posts.post_title, posts.author, COUNT(comments.comment_id) AS comment_count, MAX(posts.votes) AS max_votes FROM posts LEFT JOIN comments ON posts.post_id = comments.post_id GROUP BY posts.post_id ORDER BY max_votes DESC LIMIT 5;");
        $res = $this->db->getAllRes();
        return $res;
    }

    public function listingCount(){
        $this->db->query("SELECT COUNT(*) as count, AVG(rating) as avg_rating from listing;");
        $res = $this->db->getAllRes();
        return $res;
    }

    public function getListingData(){
        $this->db->query("SELECT DAY(added_date) AS added_date, COUNT(*) AS count FROM listing WHERE added_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() GROUP BY DATE(added_date);");
        $res = $this->db->getAllRes();
        return json_encode($res);
    }

    public function getTopListings(){
        $this->db->query("SELECT listing.listing_id, listing.topic, listing.category, COUNT(listing_feedback.review_id) AS review_count, MAX(listing.rating) AS rating FROM listing LEFT JOIN listing_feedback ON listing.listing_id = listing_feedback.listing_id GROUP BY listing.listing_id ORDER BY rating DESC LIMIT 5;");
        $res = $this->db->getAllRes();
        return $res;
    }
    
    
}


?>