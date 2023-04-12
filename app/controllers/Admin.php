<?php
    Session::init();
    class Admin extends Controller{
        private $adminModel;
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'admin');
            $this->adminModel = $this->loadModel('AdminModel');
        }
        
        public function index(){
            // //$this->loadView('helo');
            // $res = sendMail('osura.silva1@gmail.com',"A test mail","This is a test mail","This is a test mail");
            // if($res){
            //     echo 'Success';
            // }
            // else{
            //     echo 'Failed';
            // }

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
             //load all unverified counselors and display them
             $data = $this->adminModel->getUnverifiedCounselors();
             $this->loadView('admin/counsellor-request', $data);
        }

        public function view_counselor_profile($id){
            $data = $this->adminModel->getCounselorInfo($id)[0];

            $qualifications = explode(",", $data->qualifications);
            $data->qualifications = $qualifications;

            $this->loadView('admin/counselor-admin-verify',$data);
        }

        //Change the counselor account approval state to approved or declined and notify using email
        public function counselor_verify(){
             //If counselor is approved by admin
             //state => 1[approved] / state => 0 [declined]
             $approval = $_GET['approval'];
             $id = $_GET['id'];

            if($approval == 'approve'){
                //Change the state to approved in counselor table
                //Send mail informing approval
                //echo 'Account approved';
               
                $this->adminModel->changeAdminVerification($id, 1);
                //Code for sending approval email
                $user = $this->adminModel->getCounselorInfo($id);
                $subject = 'Your Account is Now Active!';
                $body = '
                    We are pleased to inform you that your account has been approved for StudentCare, our online platform for student counseling. You can now log in and start using the platform to connect with your students and provide counseling services.
                    
                    With StudentCare, you will have access to a range of features that will help you provide better support to your students. These features include:
                    
                    - A user-friendly dashboard for managing your counseling sessions and appointments.
                    - Secure messaging and video conferencing tools for communicating with your students.
                    - Access to personal schedule to manage your sessions.
                    
                    We hope that StudentCare will be a valuable tool for you as you work to support your students. If you have any questions or feedback, please don\'t hesitate to contact us at support@studentcare.com
                    
                    Thank you for your interest in StudentCare.
                    
                    Best regards,
                    
                    Team StudentCare
                
                ' ;
                $altbody = '';
                $res = sendMail($user->email,$subject,$body,$altbody);
                if($res){
                    Middleware::redirect('admin/join_requests');
                }else{
                    Middleware::redirect('access/index');
                }
            }
            if($approval == 'decline'){
                //If counselor is not approved reove his data from database
                //Send mail informing the rejection
                //echo 'Account declined';

                
                //Code for sending rejection email
                $user = $this->adminModel->getCounselorInfo($id);
                $subject = 'Registration Request Rejected for StudentCare';
                $body = '
                    Dear [Counselor Name],

                    I am writing to inform you that we recently received your registration request for StudentCare, our online platform for students seeking counseling services. However, we regret to inform you that your account has been rejected by our admin after reviewing the verification document you have provided.
                    
                    We understand that this news may be disappointing, but we encourage you to review the information you provided and resubmit your registration request. If you have any questions or concerns, please do not hesitate to contact our support team at [contact information].
                    
                    Thank you for your interest in StudentCare, and we look forward to the opportunity to serve you in the future.
                    
                    Best regards,
                    
                    Team StudentCare
                
                ' ;
                $altbody = '';
                $res = sendMail($user->email,$subject,$body,$altbody);
                if($res){
                    $this->adminModel->deleteCounselorInfo($user->userID,$id);
                    Middleware::redirect('admin/join_requests');
                }else{
                    Middleware::redirect('access/index');
                }
            }
        }

        public function complaints(){
            $this->loadView('admin/complaint-log');
        }

        public function user_management(){
            $data = $this->adminModel->getUserManagementInfo();
            if($data){
                $this->loadView('admin/user-management', $data);
            }
            
        }

        public function block_user($userID){
            $status = $this->adminModel->toggleBlockState($userID);
            echo $status;
        }

        public function delete_user($userID){
            $status = $this->adminModel->deleteUser($userID);
            echo $status;
        }

    }

?>