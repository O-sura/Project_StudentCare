<?php

    class Pages extends Controller{
        private $userModel;
        public function __construct(){
            $this->userModel = $this->loadmodel('User');
        }

        //Method for loading the default page
        public function index(){
            $data = [
                'fname_err' => '',
                'lname_err' => '',
                'email_err' => '',
                'message_err' => ''
            ];
            $this->loadView('index',$data);
        }

        public function about(){
            echo 'About Page';
        }

        public function terms_and_conditions(){
            echo 'Terms and Conditions';
        }

        public function privacy_policy(){
            echo 'Privacy Policy';
        }

        public function rules_and_regulations(){
            echo 'Rules and Regulations';
        }

        public function error_404(){
            $this->loadView('error404');
        }

        public function contact_us(){
            if($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['submit']) ){
                $fname = trim($_POST['fname']);
                $lname = trim($_POST['lname']);
                $message = trim($_POST['message']);
                $email = trim($_POST['email']);
    
                $data = [
                    'fname' => $fname,
                    'lname' => $lname,
                    'message' => $message,
                    'email' => $email,
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'message_err' => ''
                ];

                if(empty($data['fname'])){
                    $data['fname_err'] = "*First Name is Required";
                }
                if(empty($data['lname'])){
                    $data['lname_err'] = "*Last Name is Required";
                }
                if(empty($data['message'])){
                    $data['message_err'] = "*Message body cannot be empty";
                }

                if(empty($data['email'])){
                    $data['email_err'] = "*Email cannot be empty";
                }else{
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        //echo("Invalid email format");
                        $data['email_err'] = "*Invalid email format";
                        //die();
                    }
                }

                if(empty($data['fname_err']) && empty($data['email_err']) && empty($data['lname_err']) && empty($data['message_err'])){
                    if($this->userModel->sendContactNotification($data)){
                        FlashMessage::flash('message-sent-flash',"Message Successfully Sent!",'success');
                    }else{
                        FlashMessage::flash('message-not-sent-flash',"Something Went Wrong!",'warning');
                    }
                    Middleware::redirect('pages/index');
                }
            }
        }
    }