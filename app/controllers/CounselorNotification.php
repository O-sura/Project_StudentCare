<?php
    Session::init();
    class CounselorNotification extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counselor');
        }
        
        public function index(){

            $data = [];

            $this->loadView('Counselor/notification',$data);
        }

        public function home(){
            $usr =   Session::get('username');
            echo $usr;
        }

    }

?>