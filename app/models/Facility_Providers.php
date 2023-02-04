<?php

    class Facility_Providers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function addItem($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('INSERT INTO listing(topic, description, rental, location, address, uniName, image, special_note, category) VALUES (:topic, :description, :rental, :location, :address, :uniName, :image_urls, :special_note, :category)');
            
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

        public function mylisting($reg_id,$data){
            $this->db->query('SELECT * FROM listing'); 
            
            $result = $this->db->getAllRes();
            return $result;
        }

        public function profile(){
            $this->db->query('SELECT * FROM listing'); 
            
            $result = $this->db->getAllRes();
            return $result;
        }

        public function propertyView(){
            $this->db->query('SELECT * FROM listing'); 
            //$this->db->query('SELECT * FROM listing WHERE category= Property'); 
            //$this->db->bind(':category', $category);
            
            $result = $this->db->getAllRes();
            return $result;
        }

        public function foodView(){
            $this->db->query('SELECT * FROM listing'); 
            
            $result = $this->db->getAllRes();
            return $result;
        }

        public function furnitureView(){
            $this->db->query('SELECT * FROM listing'); 
            
            $result = $this->db->getAllRes();
            return $result;
        }

        public function viewOneListing($id){
            $this->db->query("SELECT * FROM listing WHERE listing_id= :id ");
            $this->db->bind(':id', $id);
            
            $result = $this->db->getRes();
            return $result;
        }

        public function searchItem($uniName,$topic,$rental){
            
        }

        public function findItemByLocation($location){
            
        }

        public function findItemByType($type){
            
        }

        public function findItemByRent($rental){
           
        }

        public function findItemByUniversity($uniName){
            
        }

    }


?>