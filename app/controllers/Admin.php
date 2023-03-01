<?php
    Session::init();
    class Admin extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'admin');
        }
        
        public function index(){
            $this->loadView('test');
        }

        public function home(){
            $this->loadView('admin/dashboard');
        }

        public function reports(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               if(isset($_POST['template'])){
                //var_dump($_POST['template']);
                generateReport($_POST['template']);
               }
            }else{
                $this->loadView('admin/report-generator');
            }
        }

        public function join_requests(){
            $this->loadView('admin/counsellor-request');
        }

        public function complaints(){
            $this->loadView('admin/complaint-log');
        }

    }

?>