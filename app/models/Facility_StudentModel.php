<?php

class Facility_StudentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function propertyView($university)
    {
        $category = 'Property';
        $this->db->query('SELECT listing.* 
        FROM listing
        INNER JOIN uni_distance_listing
        ON listing.listing_id = uni_distance_listing.listing_id
        WHERE uni_distance_listing.uni_name= :uni AND listing.category= :category ');
        $this->db->bind(':category', $category);
        $this->db->bind(':uni', $university);
        $result = $this->db->getAllRes();
        return $result;
    }
    public function foodView()
    {
        $category = 'Food';
        $this->db->query('SELECT * FROM listing WHERE category= :category');
        $this->db->bind(':category', $category);

        $result = $this->db->getAllRes();
        return $result;
    }


    public function furnitureView()
    {
        $category = 'Furniture';
        $this->db->query('SELECT * FROM listing WHERE category= :category');
        $this->db->bind(':category', $category);

        $result = $this->db->getAllRes();
        return $result;
    }

    public function viewOneListing($id)
    {
        $this->db->query("SELECT * FROM listing WHERE listing_id= :id ");
        $this->db->bind(':id', $id);

        $result = $this->db->getRes();
        return $result;
    }

    public function getListingsForUni($uni){
        //id,images,topic,uni,distance,rating ,rental,location
        $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
        FROM listing
        INNER JOIN uni_distance_listing 
        ON listing.listing_id = uni_distance_listing.listing_id 
        WHERE uni_distance_listing.uni_name= :uni AND listing.category='Property'
        ORDER BY uni_distance_listing.distance ASC ");
        $this->db->bind(':uni', $uni);

        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForPrice($sort_order,$uni){
        if($sort_order == 'asc'){
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental ASC ");
        }else{
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForRating($sort_order,$uni){
        if($sort_order == 'asc'){
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating ASC ");
        }else{
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;

    }

    public function getListingsForDate($sort_order,$uni){
        if($sort_order == 'asc'){
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date ASC ");
        }else{
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }


    public function getDistances(){
        $this->db->query("SELECT * FROM uni_distance_listing");
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getStudentUni(){
        $this->db->query("SELECT university FROM student WHERE studentID=:std");
        $this->db->bind(':std',Session::get('userID'));
        $result = $this->db->getRes();
        return $result;
    }
}
