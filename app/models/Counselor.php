<?php

    class Counselor {

        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getCounselorAnnouncement(){
            $this->db->query('SELECT * FROM ann_post ORDER BY posted_date DESC');

            $results = $this->db->getAllRes();

            return $results; 
        }

        public function addPost($data){

            $this->db->query('SELECT * FROM users WHERE username=:username');
            $this->db->bind(':username',$data['username']);
            $user = $this->db->getRes();

            $this->db->query('INSERT INTO ann_post(post_id,post_desc,username,fullname) VALUES(:postID,:body,:username,:fullname)');
            
            
            //bind values
            $this->db->bind(':fullname',$user->fullname);
            $this->db->bind(':postID',$data['postID']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':username',$data['username']);
            
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
            $this->db->query('UPDATE ann_post SET post_desc = :body, posted_date = :updated_date WHERE post_id = :id');
            
            //bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':updated_date',date('Y-m-d H:i:s'));
            
        
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

        
        public function getPostByUserId($userid){
            $this->db->query('SELECT * FROM ann_post INNER JOIN users ON ann_post.username = : users.username;');
            $this->db->bind(':id',$id);

            $row = this->db->getAllRes();

            return $row;
        }
         

        public function getCounselorProfile($user_id){
            $this->db->query('SELECT * FROM users INNER JOIN counsellor ON users.userID = counsellor.userID WHERE users.userID = :user_id');
            $this->db->bind(':user_id',$user_id);
            $results = $this->db->getAllRes();

            return $results; 
        }

        public function getAnnouncementExcept($id){

            $this->db->query('SELECT * FROM ann_post WHERE post_id != :postid ORDER BY posted_date DESC');
            $this->db->bind(':postid',$id);
            $results = $this->db->getAllRes();

            return $results; 
        }


        public function getCounselorEditDetails($user_id){
            $this->db->query('SELECT * FROM users INNER JOIN counsellor ON users.userID = counsellor.userID WHERE users.userID = :user_id');
            $this->db->bind(':user_id',$user_id);
            $results = $this->db->getAllRes();

            return $results; 
        }

        public function searchPosts($keyword){
            $this->db->query('SELECT * FROM ann_post WHERE post_desc LIKE :keyword OR fullname LIKE :keyword');
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

    }