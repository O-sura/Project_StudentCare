<?php
    Session::init();
    class Counsellor extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
        }
        
        public function index(){
            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }

        public function home(){
            
            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }

        public function profileView(){

            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');

            $row = $this->postModel->getCounselorProfile($user_id);
            $new = explode(",", $row->qualifications);
          
            $data = [
                'qualifications' => $new,
                'row' => $row
            ];            
            //$this->loadView('//')
            $this->loadView('Counselor/profile',$data);
        }

        public function EditProfile(){

            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');
            $user_name = Session::get('username');

            $row = $this->postModel->getCounselorEditDetails($user_id);

            $new = explode(",", $row->qualifications);
          
            $data = [
                'name' => $row->fullname,
                'username' => $user_name,
                'email' => $row->email,
                'nic' => $row->nic,
                'contact' => $row->contact_no,
                'address' => $row->home_address,
                'dob' => $row->dob,
                'specialization' => $row->specialization,
                'qualifications' => $new,
                'profile' => $row->profile_img,
                'name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'address_err' => '',
                'specialization_err' => '',
                'qualification_err' => '',
                'contact_err' => ''
            ];

            

            // print_r($new);
            // exit;

            $this->loadView('Counselor/editDetails',$data);
        }

        public function updateProfileDetails($userid){
            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');
            $row = $this->postModel->getCounselorEditDetails($user_id);

            
           

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $filename = $_FILES["file"]["name"];
                $tempname = $_FILES["file"]["tmp_name"];
                $folder =  PUBLICPATH . "img/counselor/".$filename;

                

                if (move_uploaded_file($tempname, $folder)) {
                //     print_r($tempname);
                // exit;
                     echo 'File successfully uploaded';
                }
                else if(empty($filename) && empty($tempname)){
                    $filename = $row->profile_img;
                    $folder = PUBLICPATH . "img/counselor/".$filename;
                    $tempname = tempnam(sys_get_temp_dir(), 'image_');
                    copy($folder,$tempname);
                   // echo 'File successfully uploaded';
                //    print_r($tempname);
                // exit;
                }
                else {
                     //Image uploading error notification
                     echo 'Error in uploading the image';
                    die();
                }

                //Check and validate the data
                //Set errors if something is wrong
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $contact = $_POST['contact'];
                $specialization = $_POST['specialization'];
                $qualifications = array();
                //$new = explode(",", $row->qualifications);

              


                //while(!empty($_POST['qualifications'])){
                    foreach ($_POST['qualifications'] as $key => $value){
                        // array_push($qualifications, $value);
                        // unset($_POST[$key]);
                        $qualifications[$key] = $value;
                    }
               // }
                
            //    print_r($qualifications);
            //    exit;
                
                
                $data = [
                    'profile_img' => $filename,
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'nic' => $row->nic,
                    'contact' => $contact,
                    'address' => $address,
                    'dob' => $row->dob,
                    'specialization' => $specialization,
                    'qualifications' => $qualifications,
                    'profile' => $row->profile_img,
                    'name_err' => '',
                    'username_err' => '',
                    'email_err' => '',
                    'contact_err' => '',
                    'address_err' => '',
                    'specialization_err' => '',
                    'qualification_err' => ''

                ];

                //  print_r ($data);
                //  exit;

                //Check whether all the fields are filled properly
                if(empty($data['username'])){
                    //echo("Must fill all the fields in the form!");
                    $data['username_err'] = "*Username field is Required";
                  
                    // print_r ($data);
                    // exit;
                }

                if(empty($data['name'])){
                    $data['name_err'] =  "*Name field is Required";
                    // print_r ($data);
                    // exit;
                }

                if(empty($data['email'])){
                    $data['email_err'] = "*Email field is Required";
                    // print_r ($data);
                    // exit;
                }

                if(empty($data['address'])){
                    $data['address_err'] = "*Address field is Required";
                    // print_r ($data);
                    // exit;
                }

                if( empty($data['contact'])){
                    $data['contact_err'] = "*Contact field is Required";
                    // print_r ($data);
                    // exit;
                }

                if(empty($data['specialization'])){
                    $data['specialization_err'] = "*Specialization field is Required";
                    // print_r ($data);
                    // exit;
                }

                if(empty($data['qualifications'])){
                    $data['qualification_err'] = "*Qualification field is Required";
                    // print_r ($data);
                    //exit;
                }

                 //Check whether an account already exists with the provided username
                if($this->postModel->findUserByUsername($username)){
                    //echo("This Username is already taken");
                    if($username == Session::get('username')){
                        $data['username_err'] = "";
                    }
                    else{
                        $data['username_err'] = "*This Username is already taken";
                    }
                    
                    //die();
                }

                //Email is valid or not
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    //echo("Invalid email format");
                    $data['email_err'] = "*Invalid email format";
                    //die();
                }

                 //Check the mobile number
                 if(strlen($contact) != 10){
                    //echo 'Invalid Contact Number';
                    $data['contact_err'] = "*Invalid Contact Number";
                    //die();
                }

                // print_r ($data);
                //     exit;
                //Make sure there are no error flags are set
                if(empty($data['username_err']) && empty($data['name_err']) && empty($data['email_err']) && empty($data['contact_err']) && empty($data['address_err']) && empty($data['specialization_err']) && empty($data['qualification_err'])){

                    // print_r ($data);
                    //  exit;
                    
                    $res = $this->postModel->updateProfileDetails($data,$user_id);
                    
                   

                    if($res){
                        FlashMessage::flash('update_profile_flash', "Successfully Updated Your Profile Details!", "success");
                        Middleware::redirect('Counsellor/ProfileView');
                    }else{
                        //Error Notification
                        echo 'Error: Something went wrong in adding post to the databse';
                        Middleware::redirect('Counsellor/EditProfile');
                        die();
                    }
                }
                else{
                    $this->loadView('counselor/editDetails',$data);
                }
                    

            }
            else{
                //get the relavent details from the model
                //$detail = $this->postModel->getCounselorEditDetails($user_id);
                $row = $this->postModel->getCounselorEditDetails($user_id);

                 $data = [
                //     'name' => $detail->fullname,
                //     'username' => $detail->username,
                //     'email' => $detail->email,
                //     'contact' => $detail->contact_no,
                //     'address' => $detail->home_address,
                //     'specialization' => $detail->specialization,
                //     'qualification' => $detail->qualification
                       'row' => $row
                ];
                
                
                $this->loadView('counselor/profile',$data);
            }
        }

        // public function changeProfile(){

        //     $this->postModel = $this->loadModel('Counselor');
        //     $user_id = Session::get('userID');

        //     $row = $this->postModel->getCounselorEditDetails($user_id);

        //     if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //         $filename = $_FILES["file"]["name"];
        //         $tempname = $_FILES["file"]["tmp_name"];
        //         $folder =  PUBLICPATH . "img/counselor/".$filename;

        //         if (move_uploaded_file($tempname, $folder)) {
        //             echo 'File successfully uploaded';
        //         } else {
        //             //Image uploading error notification
        //             echo 'Error in uploading the image';
        //             die();
        //         }

        //         $data = [
        //             'profile_img' => $filename
    
        //         ];
                
        //         $res = $this->postModel->updateDetails($data,$user_id);
        //         if($res){
        //             Middleware::redirect('Counsellor/ProfileView');
        //         }else{
        //             //Error Notification
        //             echo 'Error: Something went wrong in adding post to the databse';
        //             die();
        //         }
                
        //     }else{
        //         $this->loadView('counselor/editDetails',$data);
        //     }


        // }

        public function notificationView(){
            $data = [
                
            ];

            $this->loadView('Counselor/notification',$data);
        }

        public function studentView(){

            $data = [
                
            ];

            $this->loadView('Counselor/student',$data);
        }


       
        

    }

?>
