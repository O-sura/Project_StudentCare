<?php
    Session::init();
    class Admin extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'admin');
        }
        
        public function index(){

        }

        public function home(){
            $this->loadView('admin/dashboard');
        }

        public function reports(){
            $this->loadView('admin/report-generator');
        }

        public function join_requests(){
            $this->loadView('admin/counsellor-request');
        }

        public function complaints(){
            $this->loadView('admin/complaint-log');
        }

    }

?>