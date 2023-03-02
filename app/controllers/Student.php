<?php
    Session::init();
    class Student extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'student');
        }
        
        public function index(){

        }

        public function home(){
            $usr =   Session::get('username');
            $data = ['username' => $usr];
            $this->loadview('student_dashboard/index',$data);
        }

        public function profile(){
            // $usr =   Session::get('username');
            // $data = ['username' => $usr];
            $this->loadview('student_dashboard/profile');
        }

    }