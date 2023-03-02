<?php

class Listing{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addListing(){
        echo 'Data is been added!';
    }
}