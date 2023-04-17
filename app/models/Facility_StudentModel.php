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
    public function foodView($university)
    {
        $category = 'Food';
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


    public function furnitureView($university)
    {
        $category = 'Furniture';
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

    public function viewOneListing($id)
    {
        $this->db->query("SELECT * FROM listing WHERE listing_id= :id ");
        $this->db->bind(':id', $id);

        $result = $this->db->getRes();
        return $result;
    }

    public function getListingsForUni($uni)
    {
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

    public function getListingsForUniFurniture($uni)
    {
        //id,images,topic,uni,distance,rating ,rental,location
        $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
        FROM listing
        INNER JOIN uni_distance_listing 
        ON listing.listing_id = uni_distance_listing.listing_id 
        WHERE uni_distance_listing.uni_name= :uni AND listing.category='Furniture'
        ORDER BY uni_distance_listing.distance ASC ");
        $this->db->bind(':uni', $uni);

        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForUniFood($uni)
    {
        //id,images,topic,uni,distance,rating ,rental,location
        $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
        FROM listing
        INNER JOIN uni_distance_listing 
        ON listing.listing_id = uni_distance_listing.listing_id 
        WHERE uni_distance_listing.uni_name= :uni AND listing.category='Food'
        ORDER BY uni_distance_listing.distance ASC ");
        $this->db->bind(':uni', $uni);

        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForPrice($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental ASC ");
        } else {
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

    public function getListingsForPriceFurniture($sort_order,$uni){
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Furniture' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental ASC ");
        } else {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Furniture' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForPriceFood($sort_order,$uni){
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Food' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental ASC ");
        } else {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Food' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rental DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForRating($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating ASC ");
        } else {
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

    public function getListingsForRatingFurniture($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Furniture' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating ASC ");
        } else {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Furniture' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForRatingFood($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Food' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating ASC ");
        } else {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Food' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.rating DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForDate($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Property' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date ASC ");
        } else {
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

    public function getListingsForDateFurniture($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Furniture' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date ASC ");
        } else {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Furniture' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getListingsForDateFood($sort_order, $uni)
    {
        if ($sort_order == 'asc') {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Food' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date ASC ");
        } else {
            $this->db->query("SELECT listing.listing_id, listing.first_image,listing.topic,uni_distance_listing.uni_name,uni_distance_listing.distance,listing.rating,listing.rental,listing.location
            FROM listing
            INNER JOIN uni_distance_listing 
            ON listing.listing_id = uni_distance_listing.listing_id 
            WHERE listing.category='Food' AND uni_distance_listing.uni_name= :uni
            ORDER BY listing.added_date DESC ");
        }
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getDistances()
    {
        $this->db->query("SELECT * FROM uni_distance_listing");
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getDistance($id){
        $this->db->query("SELECT * FROM uni_distance_listing WHERE listing_id = :id");
        $this->db->bind(':id', $id);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getStudentUni()
    {
        $this->db->query("SELECT university FROM student WHERE studentID=:std");
        $this->db->bind(':std', Session::get('userID'));
        $result = $this->db->getRes();
        return $result;
    }

    public function searchListings($search, $uni)
    {
        $this->db->query("SELECT listing.listing_id, listing.first_image, listing.topic, uni_distance_listing.uni_name, uni_distance_listing.distance, listing.rating, listing.rental, listing.location
        FROM listing
        INNER JOIN uni_distance_listing ON listing.listing_id = uni_distance_listing.listing_id 
        WHERE listing.category = 'Property' 
          AND uni_distance_listing.uni_name = :uni 
          AND (
            LOWER(listing.topic) LIKE LOWER(:search) 
            OR LOWER(listing.location) LIKE LOWER(:search) 
            OR LOWER(listing.description) LIKE LOWER(:search) 
            OR LOWER(listing.address) LIKE LOWER(:search) 
            OR LOWER(listing.special_note) LIKE LOWER(:search)
          )");
        $this->db->bind(':search', $search);
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function searchListingsFurniture($search, $uni)
    {
        $this->db->query("SELECT listing.listing_id, listing.first_image, listing.topic, uni_distance_listing.uni_name, uni_distance_listing.distance, listing.rating, listing.rental, listing.location
        FROM listing
        INNER JOIN uni_distance_listing ON listing.listing_id = uni_distance_listing.listing_id 
        WHERE listing.category = 'Furniture' 
          AND uni_distance_listing.uni_name = :uni 
          AND (
            LOWER(listing.topic) LIKE LOWER(:search) 
            OR LOWER(listing.location) LIKE LOWER(:search) 
            OR LOWER(listing.description) LIKE LOWER(:search) 
            OR LOWER(listing.address) LIKE LOWER(:search) 
            OR LOWER(listing.special_note) LIKE LOWER(:search)
          )");
        $this->db->bind(':search', $search);
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function searchListingsFood($search, $uni)
    {
        $this->db->query("SELECT listing.listing_id, listing.first_image, listing.topic, uni_distance_listing.uni_name, uni_distance_listing.distance, listing.rating, listing.rental, listing.location
        FROM listing
        INNER JOIN uni_distance_listing ON listing.listing_id = uni_distance_listing.listing_id 
        WHERE listing.category = 'Food' 
          AND uni_distance_listing.uni_name = :uni 
          AND (
            LOWER(listing.topic) LIKE LOWER(:search) 
            OR LOWER(listing.location) LIKE LOWER(:search) 
            OR LOWER(listing.description) LIKE LOWER(:search) 
            OR LOWER(listing.address) LIKE LOWER(:search) 
            OR LOWER(listing.special_note) LIKE LOWER(:search)
          )");
        $this->db->bind(':search', $search);
        $this->db->bind(':uni', $uni);
        $result = $this->db->getAllRes();
        return $result;
    }

    public function getStudentDetails(){
        $this->db->query("SELECT * FROM student WHERE studentID=:std");
        $this->db->bind(':std', Session::get('userID'));
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

    public function addComment($review_id,$listing_id, $rating, $feedback){
        $this->db->query("INSERT INTO listing_feedback (review_id, listing_id, student_id, star_rating, feedback) VALUES (:review_id, :listing_id, :student_id, :rating, :feedback)");
        $this->db->bind(':review_id', $review_id);
        $this->db->bind(':listing_id', $listing_id);
        $this->db->bind(':student_id', Session::get('userID'));
        $this->db->bind(':rating', $rating);
        $this->db->bind(':feedback', $feedback);
        $result = $this->db->execute();
        return $result;
    }

    public function updateComment($id, $rating, $feedback){
        $this->db->query("UPDATE listing_feedback SET star_rating=:rating, feedback=:feedback WHERE listing_id=:id AND student_id=:std");
        $this->db->bind(':id', $id);
        $this->db->bind(':std', Session::get('userID'));
        $this->db->bind(':rating', $rating);
        $this->db->bind(':feedback', $feedback);
        $result = $this->db->execute();
        return $result;
    }

    public function checkComment($id){
        $this->db->query("SELECT * FROM listing_feedback WHERE listing_id=:id AND student_id=:std");
        $this->db->bind(':id', $id);
        $this->db->bind(':std', Session::get('userID'));
       //count no.of results
        $result = $this->db->rowCount();
        if($result>0){
            return true;
        }else{
            return false;
        }
    }

    public function checkHelpful($review_id){
        $this->db->query("SELECT * FROM review_helpful WHERE student_id=:std AND review_id=:review_id");
        $this->db->bind(':std', Session::get('userID'));
        $this->db->bind(':review_id', $review_id);
       //count no.of results
        $result = $this->db->rowCount();
        if($result>0){
            return true;
        }else{
            return false;
        }

    }

    public function addHelpful($review_id){
        $this->db->query("INSERT INTO review_helpful (review_id, student_id) VALUES (:review_id, :student_id)");
        $this->db->bind(':review_id', $review_id);
        $this->db->bind(':student_id', Session::get('userID'));
        $result = $this->db->execute();
        return $result;
    }

    public function removeHelpful($review_id){
        $this->db->query("DELETE FROM review_helpful WHERE review_id=:review_id AND student_id=:std");
        $this->db->bind(':review_id', $review_id);
        $this->db->bind(':std', Session::get('userID'));
        $result = $this->db->execute();
        return $result;
    }


}
