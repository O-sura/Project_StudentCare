<?php

    class Counsellor extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
        }

        public function index(){

        }

        public function home(){
            echo 'This is the homepage of Counsellor';
        }
    }

?>