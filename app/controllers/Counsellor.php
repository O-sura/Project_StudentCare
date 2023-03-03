<?php
    Session::init();
    class Counsellor extends Controller{
        private $userModel;

        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
            //$this->userModel =  $this->loadModel('Counsellor');
        }

        

        public function index(){

        }

        public function home(){
            echo 'This is the homepage of Counsellor';
        }
    }

?>