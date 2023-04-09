<?php

class Facility_StudentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function propertyView()
    {
        $category = 'Property';
        $this->db->query('SELECT * FROM listing WHERE category= :category');
        $this->db->bind(':category', $category);

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
}
