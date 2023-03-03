<?php
    Session::init();
    class Admin extends Controller{
        private $adminModel;
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'admin');
            $this->adminModel = $this->loadModel('AdminModel');
        }
        
        public function index(){
            $this->loadView('helo');
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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //If counselor is approved by admin
                //Change the state to approved in counselor table
                //Send mail informing approval
                
                //If counselor is not approved remove his data from database
                //Send mail informing the rejection
            }
            else{
                //load all unverified counselors and display them
                $data = $this->adminModel->getUnverifiedCounselors();
                $this->loadView('admin/counsellor-request', $data);
            }
        }

        public function complaints(){
            $this->loadView('admin/complaint-log');
        }

    }

?>