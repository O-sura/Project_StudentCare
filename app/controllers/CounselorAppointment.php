<?php
    Session::init();
    class CounselorAppointment extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
        }
        
        public function index(){

            $data = [];
            
            $this->loadView('counselor/appointment',$data);
        }

        public function home(){
            
            $data = [];

            $this->loadView('counselor/appointment',$data);
        }

       

    }

?>


