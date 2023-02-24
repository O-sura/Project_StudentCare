<?php
    Session::init();
    class home extends Controller{

       
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counselor');
        }
       
        
        public function index(){

            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }

       

    }

?>