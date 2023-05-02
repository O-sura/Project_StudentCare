<?php
    Session::init();
    class Student extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'student');
        }
        
        public function index(){

        }

        public function home(){
            $data = [
                'username' => Session::get('username')
            ];

            $this->loadView('community/dashboard', $data);
        }

    }

?>