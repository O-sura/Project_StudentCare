<?php
    Session::init();
    class Student extends Controller{
        private $studentModel;
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'student');
            $this->studentModel = $this->loadmodel('Student_model');
        }
        
        public function index(){

        }

        public function home(){
            $usr =   Session::get('username');
            $data = ['username' => $usr];
            $this->loadview('student_dashboard/index',$data);
        }

        public function profile(){
            $id =   Session::get('userID');
            $data = ['userDetails' => $this->studentModel->getProfile($id)];
            $this->loadview('student_dashboard/profile',$data);
        }

    }
