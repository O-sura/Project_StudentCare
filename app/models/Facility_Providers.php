<?php

    class Facility_Providers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        public function addItem($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('INSERT INTO listing(fpID, topic, description, rental, location, address, uniName, image, special_note, category) VALUES (:fpID, :topic, :description, :rental, :location, :address, :uniName, :image_urls, :special_note, :category)');
            
            $this->db->bind(':topic', $data['topic']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':rental', $data['rental']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':uniName', $data['uniName']);
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


        public function editItem($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('UPDATE listing SET topic = :topic, description = :description, rental = :rental, location = :location, address = :address, uniName = :uniName, image = :image_urls, special_note = :special_note, category = :category WHERE userID = :userID');
            
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':topic', $data['topic']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':rental', $data['rental']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':uniName', $data['uniName']);
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


        public function mylisting(){
            $userID = Session::get('userID');
            $this->db->query('SELECT * FROM listing WHERE fpID = (SELECT fpID FROM facility_provider WHERE userID = :userID)'); 
            $this->db->bind(':userID', $userID);
            
            $result = $this->db->getAllRes();
            return $result;
        }


        public function profile(){
            $userID = Session::get('userID');
            $this->db->query('SELECT u.*, f.category FROM users u INNER JOIN facility_provider f ON u.userID = f.userID WHERE u.userID = :userID'); 
            $this->db->bind(':userID', $userID);

            $result = $this->db->getRes();
            return $result;
        }

        public function editprofile(){
            $userID = Session::get('userID');
            $this->db->query('UPDATE u.*, f.category FROM users u INNER JOIN facility_provider f ON u.userID = f.userID WHERE u.userID = :userID'); 
            $this->db->bind(':userID', $userID);

            $result = $this->db->getRes();
            return $result;
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


        public function propertysearch($keyword){
           /*  $this->db->query("SELECT * FROM propertylist WHERE uniName LIKE %:uniName OR topic LIKE %:topic OR price LIKE %:rental ");
            $this->db->bind(':uniName', $uniName);
            $this->db->bind(':topic', $topic);
            $this->db->bind(':rental', $rental);

            $result = $this->db->getRes();
            return $result; */
            $this->db->query('SELECT * FROM listing WHERE topic LIKE :keyword OR uniName LIKE :keyword OR price LIKE :keyword');
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


        public function findItemByLocation(){
            $category = 'Furniture';
            $this->db->query('SELECT * FROM listing WHERE category= :category'); 
            $this->db->bind(':category', $category);
            
            $result = $this->db->getAllRes();
            return $result;
        
        }


        public function findItemByType($type){
            
        }


        public function findItemByRent($rental){
           
        }

        
        public function findItemByUniversity($uniName){
            
        }

        public function deleteItem($id){
            $this->db->query('DELETE FROM listing WHERE id=:id'); 

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

    }


?>