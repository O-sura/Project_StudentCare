<?php

    class Facility_Provider extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'facility_provider');
        }

        public function index(){

        }

        public function home(){
            echo 'This is the homepage of Facility Provider';
        }
    }

?>