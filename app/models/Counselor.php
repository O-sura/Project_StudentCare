<?php

    class Counselor {

        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findUserByUsername($username){
            $this->db->query('SELECT * FROM users WHERE username= :username');
            $this->db->bind(':username', $username);

            $row = $this->db->getRes();
            if($this->db->rowCount() > 0){
                return true;
            }
            else
                return false;
        }

        public function getCounselorAnnouncement(){
            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID ORDER BY posted_date DESC');

            $results = $this->db->getAllRes();

            return $results; 
        }

        public function addPost($data){

            $this->db->query('SELECT * FROM users WHERE username=:username');
            $this->db->bind(':username',$data['username']);
            $user = $this->db->getRes();

            $this->db->query('INSERT INTO ann_post(post_id,post_desc,username,fullname,userID,post_head) VALUES(:postID,:body,:username,:fullname,:userID,:topic)');
            
            
            //bind values
            $this->db->bind(':userID',$user->userID);
            $this->db->bind(':fullname',$user->fullname);
            $this->db->bind(':postID',$data['postID']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':username',$data['username']);
            $this->db->bind(':topic',$data['topic']);
            
            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function updatePost($data){

           // $userID = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('UPDATE ann_post SET post_desc = :body, posted_date = :updated_date, post_head = :topic WHERE post_id = :id');
            
            //bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':updated_date',date('Y-m-d H:i:s'));
            $this->db->bind(':topic',$data['topic']);
            
        
            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function deletePost($id){
            $userID = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('DELETE FROM ann_post WHERE post_id = :id');
            
            //bind values
            $this->db->bind(':id',$id);
            
            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function getPostById($id){
            $this->db->query('SELECT * FROM ann_post WHERE post_id = :id');
            $this->db->bind(':id',$id);

            $row = $this->db->getRes();

            return $row;
        }

        
        public function getPostByUser_id($user_id){
            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID WHERE ann_post.userID = :userID;');
            $this->db->bind(':userID',$user_id);

            $row = $this->db->getAllRes();

            return $row;
        }
         

        public function getCounselorProfile($user_id){
            $this->db->query('SELECT * FROM users INNER JOIN counsellor ON users.userID = counsellor.userID WHERE users.userID = :user_id');
            $this->db->bind(':user_id',$user_id);
            $results = $this->db->getRes();

            return $results; 
        }

        public function getAnnouncementExcept($id){

            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID WHERE ann_post.post_id != :postid ORDER BY posted_date DESC');
            $this->db->bind(':postid',$id);
            $results = $this->db->getAllRes();

            return $results; 
        }


        public function getCounselorEditDetails($user_id){
            $this->db->query('SELECT * FROM users INNER JOIN counsellor ON users.userID = counsellor.userID WHERE users.userID = :user_id');
            $this->db->bind(':user_id',$user_id);
            $results = $this->db->getRes();

            return $results; 
        }

        public function searchPosts($keyword){
            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID WHERE ann_post.post_head LIKE :keyword OR ann_post.post_desc LIKE :keyword OR ann_post.fullname LIKE :keyword');
            $this->db->bind(':keyword', $keyword);
            $posts = $this->db->getAllRes();
            return json_encode($posts);
        }

        public function updateDetails($data,$user_id){
            $this->db->query('UPDATE counsellor SET profile_img = :pimg WHERE userID = :userid');

            $this->db->bind(':userid', $user_id);
            $this->db->bind(':pimg', $data['profile_img']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateProfileDetails($data,$user_id){
            // $this->db->query('UPDATE users u JOIN counsellor c 
            // ON u.userID = c.userID
            // SET u.username = :Cusername, u.fullname = :Cname, u.email = :Cemail, u.home_address = :Caddress, u.contact_no = :contact, c.specialization = :Cspecialization, c.qualifications = :qualifications 
            // WHERE u.userID = :userid');

            $this->db->query('UPDATE users SET username = :Cusername, fullname = :Cname, email = :Cemail, home_address = :Caddress, contact_no = :contact WHERE  userID = :userid;');

            $this->db->bind(':userid', $user_id);
            $this->db->bind(':Cusername', $data['username']);
            $this->db->bind(':Cemail', $data['email']);
            $this->db->bind(':Cname', $data['name']);
            $this->db->bind(':Caddress', $data['address']);
            $this->db->bind(':contact', $data['contact']);

            if($this->db->execute()){
                
                $this->db->query('UPDATE counsellor SET specialization = :Cspecialization, qualifications = :Cqualifications, profile_img = :pimg WHERE  userID = :userid;');

                $this->db->bind(':userid', $user_id);
                $this->db->bind(':Cspecialization', $data['specialization']);
                $this->db->bind(':Cqualifications',implode(",", $data['qualifications']));
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

        public function addAppointment($data,$userid){

            $appID = substr(sha1(date(DATE_ATOM)), 0, 7);

            $this->db->query('INSERT INTO appointments(appointmentID,appointmentDescription,appointmentDate,appointmentTime,counsellorID,studentID,studentName) VALUES(:appID,:appDesc,:appDate,:appTime,:CID,:StID,:StName)');

            $this->db->bind(':CID',$userid);
            $this->db->bind(':StID',$data['stuID']);
            $this->db->bind(':StName',$data['stuName']);
            $this->db->bind(':appDate',$data['appDate']);
            $this->db->bind(':appTime',$data['appTime']);
            $this->db->bind(':appDesc',$data['desc']);
            $this->db->bind(':appID',$appID);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

    }