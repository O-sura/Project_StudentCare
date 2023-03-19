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
            $new_requests_count = $this->studentModel->getNewRequestsCount(Session::get('userID'));
            $new_appointments_count = $this->studentModel->getNewAppointmentsCount(Session::get('userID'));
            $total_count = $new_requests_count + $new_appointments_count;
            $data = ['username' => $usr,
                    'new_requests_count' => $total_count];
            $this->loadview('student_dashboard/index',$data);
        }

        public function profile(){
            $id =   Session::get('userID');
            $data = ['userDetails' => $this->studentModel->getProfile($id)];
            $this->loadview('student_dashboard/profile',$data);
        }

    }
