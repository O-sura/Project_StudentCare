<?php
    Session::init();
    class CounselorReport extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
        }
        
        public function index(){

            $data = [];
            
            $this->loadView('counselor/reports',$data);
        }

        public function home(){
            
            $data = [];

            $this->loadView('counselor/reports',$data);
        }
    }

?>