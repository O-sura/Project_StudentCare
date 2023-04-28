<?php

    class Facility_Providers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        public function addItem($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('INSERT INTO listing(listing_id, fpID, topic, description, rental, location, address, image, special_note, category) VALUES (:listingID ,:fpID, :topic, :description, :rental, :location, :address, :image_urls, :special_note, :category)');
            
            $this->db->bind(':listingID', $data['listingID']);
            $this->db->bind(':topic', $data['topic']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':rental', $data['rental']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':address', $data['address']);
            // $this->db->bind(':uniName', $data['uniName']);
            $this->db->bind(':image_urls', $data['image_urls']);
            $this->db->bind(':special_note', $data['special_note']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':fpID', $data['fpID']);


            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function addUniDistance($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('INSERT INTO uni_distance_listing(listing_id, uni_name, distance) VALUES (:listingID, :uniName, :distance)');
            
            $this->db->bind(':listingID', $data['uniID']);
            $this->db->bind(':uniName', $data['uniName']);
            $this->db->bind(':distance', $data['uniDistance']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function editItem($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('UPDATE listing SET topic = :topic, description = :description, rental = :rental, location = :location, address = :address, uniName = :uniName, image = :image_urls, special_note = :special_note, category = :category WHERE userID = :userID');
            
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':topic', $data['topic']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':rental', $data['rental']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':address', $data['address']);
            //$this->db->bind(':uniName', $data['uniName']);
            $this->db->bind(':image_urls', $data['image_urls']);
            $this->db->bind(':special_note', $data['special_note']);
            $this->db->bind(':category', $data['category']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function editUniDistance($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('UPDATE uni_distance_listing SET uni_name = :uniName, distance = :uniDistance)');
            
            $this->db->bind(':listingID', $data['uniID']);
            $this->db->bind(':uniName', $data['uniName']);
            $this->db->bind(':distance', $data['uniDistance']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function mylisting(){
            $userID = Session::get('userID');
            $this->db->query('SELECT * FROM listing WHERE fpID = (SELECT fpID FROM facility_provider WHERE userID = :userID)'); 
            $this->db->bind(':userID', $userID);
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function profile(){
            $userID = Session::get('userID');
            $this->db->query('SELECT u.*, f.category,f.profile_img FROM users u INNER JOIN facility_provider f ON u.userID = f.userID WHERE u.userID = :userID'); 
            $this->db->bind(':userID', $userID);

            $result = $this->db->getRes();
            return $result;
        }


        public function getUserByUsername($username){
            $this->db->query('SELECT * from users WHERE username = :username'); 
            $this->db->bind(':username', $username);

            $result = $this->db->getRes();
            return $result;
        }


        public function editprofile($user_id){
            $this->db->query('SELECT users.*,facility_provider.* FROM users INNER JOIN facility_provider ON users.userID = facility_provider.fpID WHERE users.userID = :user_id');
            $this->db->bind('user_id',$user_id);
            $results = $this->db->getRes();
            return $results; 
        }


        public function updateProfileDetails($data,$user_id){
            $this->db->query('UPDATE users SET username = :FPusername, fullname = :FPname, email = :FPemail, home_address = :FPaddress, contact_no = :contact WHERE  userID = :userid;');
            
            $this->db->bind(':userid',$user_id);
            $this->db->bind(':FPusername', $data['username']);
            $this->db->bind(':FPemail', $data['email']);
            $this->db->bind(':FPname', $data['name']);
            $this->db->bind(':FPaddress', $data['address']);
            $this->db->bind(':contact', $data['contact']);
            //$this->db->bind(':category', $data['category']);

            if($this->db->execute()){
                $this->db->query('UPDATE facility_provider SET profile_img = :pimg WHERE  userID = :userid;');
                $this->db->bind(':userid', $user_id);
                $this->db->bind(':pimg',$data['profile']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }


        public function propertyView(){
            $category = 'Property';
            $this->db->query('SELECT * FROM listing WHERE category= :category'); 
            $this->db->bind(':category', $category);
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function foodView(){
            $category = 'Food';
            $this->db->query('SELECT * FROM listing WHERE category= :category'); 
            $this->db->bind(':category', $category);
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function furnitureView(){
            $category = 'Furniture';
            $this->db->query('SELECT * FROM listing WHERE category= :category'); 
            $this->db->bind(':category', $category);
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function viewOneListing($id){
            $this->db->query("SELECT * FROM listing WHERE listing_id= :id ");
            $this->db->bind(':id', $id);
            
            $result = $this->db->getRes();
            return $result;
        }


        public function getDistance($id){
            $this->db->query("SELECT * FROM uni_distance_listing WHERE listing_id = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->getAllRes();
            return $result;
        }
    

        public function getFacilityProviderDetails($id){
            $this->db->query("SELECT facility_provider.*,users.* FROM 
            facility_provider 
            INNER JOIN users ON facility_provider.userID = users.userID
            INNER JOIN listing ON facility_provider.fpID = listing.fpID
            WHERE listing.listing_id=:id");
            $this->db->bind(':id', $id);
            $result = $this->db->getRes();
            return $result;
        }


        public function getComments($id){
            $this->db->query("SELECT listing_feedback.*,users.username,student.profile_img
            FROM listing_feedback
            INNER JOIN users ON listing_feedback.student_id = users.userID
            INNER JOIN student ON users.userID = student.studentID 
            WHERE listing_feedback.listing_id=:id ORDER BY listing_feedback.date_added DESC");
            $this->db->bind(':id', $id);
            $result = $this->db->getAllRes();
            return $result;
        }


        public function getlisting(){
            $this->db->query('SELECT * FROM listing ORDER BY added_date DESC');

            $results = $this->db->getAllRes();

            return $results; 
        }


        public function propertysearch($keyword){

            $this->db->query('SELECT * FROM listing WHERE listing.topic LIKE :keyword OR listing.uniName LIKE :keyword');
            $this->db->bind(':keyword', $keyword);
            $result = $this->db->getAllRes();
            return json_encode($result);
        }


        public function report(){
            $this->db->query('SELECT * FROM listing'); 
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function message(){
            $this->db->query('SELECT * FROM listing'); 
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function deleteItem($id){
            $this->db->query('DELETE FROM listing WHERE listing_id=:id');
            
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


        public function getItemById($id){
            $this->db->query('SELECT * FROM listing WHERE listing_id=:id');
            $this->db->bind(':id',$id);
            
            $row = $this->db->getRes();
            return $row;
        }


        public function university_filter($uni){
            $this->db->query("SELECT * FROM listing WHERE listing.category='Property'");
            $this->db->bind(':uni', $uni);

            $result = $this->db->getAllRes();
            return $result;
        }

        
        public function getDistances(){
            $this->db->query("SELECT * FROM uni_distance_listing");
            $result = $this->db->getAllRes();
            return $result;
        }

    }

?>