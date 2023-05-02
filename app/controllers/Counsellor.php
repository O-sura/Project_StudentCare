<?php
    Session::init();
    class Counsellor extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
            $this->postModel = $this->loadModel('Counselor');
        }
        
        public function index(){
            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }

        //load the dashboard view. Registered counselor directly coming to this page after login
        public function home(){
            
            $this->postModel = $this->loadModel('Counselor');
            $userid = Session::get('userID');
            //Counsellor::getAppointmentStats();
            //get the time zone
            date_default_timezone_set('Asia/Kolkata');

            $curdate = date('Y-m-d');
            $currtime = date('H:i:s');

            $row = $this->postModel->getAppointmentTimes($userid,$curdate);
            $rowNext = $this->postModel->nextAppointmentDetails($userid,$curdate,$currtime);
            $recentNoti = json_decode($this->postModel->getInformationForDashboardNotification($userid));

            $getApp = json_decode($row,true);
            $getNextApp = json_decode($rowNext,true);

            

            // print_r($getNextApp);
            // exit;
            // $timeapp = $newrow['appointmentTime'];
            // print_r($timeapp);
            // exit;

            $data = [
                'row'=> $getApp,
                'rowNext' => $getNextApp,
                'recentNoti' => $recentNoti,
            ];

            // print_r($recentNoti);
            // exit;

            // print_r ($data[0]['appointmentTime']);
            // exit;
            //Counsellor::nextAppointment();
           
            $this->loadView('Counselor/dashboard',$data);

           
        }


        // public function nextAppointment(){

        //     $this->postModel = $this->loadModel('Counselor');
        //     $userid = Session::get('userID');

        //     date_default_timezone_set('Asia/Kolkata');

        //     $curdate = date('Y-m-d');
        //     $currtime = date('H:i:s');

        //     $row = $this->postModel->nextAppointmentDetails($userid,$curdate,$currtime);

        //     $data = json_decode($row,true);

        //     // print_r ($data);
        //     // exit;

        //     $this->loadView('Counselor/dashboard',$data);


        // }

        //load the profile view
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

        //load the edit profile view
        public function EditProfile(){

            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');
            $user_name = Session::get('username');

            $row = $this->postModel->getCounselorEditDetails($user_id);

            $new = explode(",", $row->qualifications);  //get qualification by seperating using the comma
          
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
                'description' => $row->counselor_description,
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
    
        //update profle details
        public function updateProfileDetails($userid){
            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');
            $row = $this->postModel->getCounselorEditDetails($user_id);

            
           

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //to upload the profile image
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
                $description = $_POST['bioDesc'];
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
                    'description' => $description,
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

        //load the notification section
        public function notificationView(){

            $this->postModel = $this->loadModel('Counselor');
            $userid = Session::get('userID');

            // $res1 = $this->postModel->newRequestStudents($userid);

            // $res2 = $this->postModel->notiCancelReq($userid);

            // $res3 = $this->postModel->notiCancelApp($userid);

            $res = json_decode($this->postModel->getInformationForNotification($userid));
            $rowcount = count($res);
            // print_r ($res);
            // exit;

            $data = [
                // 'row1' => $res1,
                // 'row2' => $res2,
                // 'row3' => $res3
                'row' => $res,
                'rowcount' =>  $rowcount
                // 'newReqCount' => "",
                // 'canAppCount' => ""
                
            ];

            //to categorize the notifications
            // $count1 = 0;
            // $count2 = 0;
            // foreach ($res as $item) {
            //     if ($item->statusPP == 0 && $item->appointmentStatus == 0) {
            //         $count1++;
            //     }
            //     elseif($item->appointmentStatus == 2) {
            //         $count2++;
            //     }
            // }
                    


            // if( $count1 > 0){
            //     $data['newReqCount'] = 'have';
            // }

            // if( $count2 > 0){
            //     $data['canAppCount'] = 'have';
            // }

       
            // print_r($data);
            // echo $count1, $count2;
            // exit();

            $this->loadView('Counselor/notification',$data);
        }

        //load the recieved students' requests section
        public function studentView(){

            $this->postModel = $this->loadModel('Counselor');
            $userid = Session::get('userID');

            // if(isset($_GET['New_Requests'])){
            //     $statusNew = $_GET['New_Requests'];
            // }

            $statusNew = "";
            $statusNew0 = 0;
            $statusNew1 = 1;
            $statusNew2 = 2;

            $row = $this->postModel->getStudents($statusNew,$userid);
            $row0 = $this->postModel->getStudents($statusNew0,$userid);
            $row1 = $this->postModel->getStudents($statusNew1,$userid);
            $row2 = $this->postModel->getStudents($statusNew2,$userid);

            
            //check whether the correspondin section empty or not
            
            $data = [
                'row' => $row,
                'row0' => $row0,
                'row1' => $row1,
                'row2' => $row2
            
            ];
            
            $this->loadView('Counselor/student',$data);
                
                

           
        }

        // public function dropdown_handler(){
        //     if(isset($_GET['filter'])){
        //         $_GET['filter'] = trim($_GET['filter']);
        //         $_GET['userid'] = Session::get('userID');
        //         //$_GET['username'] = trim($_GET['username']);
        //         //If the saved filter is set
        //     //    if($_GET['filter'] == 'Saved'){
        //     //         $res =  $this->CommunityModel->getSavedPosts(Session::get('userID'));
        //     //    }
        //        if($_GET['filter'] == '0'){
        //             $res =  json_encode($this->postModel->getStudents($_GET['filter']));
        //        }
        //        else if($_GET['filter'] == '1'){
        //             $res =  json_encode($this->postModel->getStudents($_GET['filter']));
        //        }
        //        else if($_GET['filter'] == '2'){
        //             $res =  json_encode($this->postModel->getStudents($_GET['filter']));
        //        }
        //         echo $res;
        //     }

        // }

        //filter students based on counselor decision(accept, reject)
        public function filterStatus(){

            $this->postModel = $this->loadModel('Counselor');
            $userid = Session::get('userID');

            if(isset($_POST['statusPP'])){

                $status = $_POST['statusPP'];
                $statusNew = 0;

                if($status === ""){
                    $details = json_encode($this->postModel->getStudents($statusNew,$userid));
                }
                else{
                    $details = json_encode($this->postModel->getStudents($status,$userid));
                }

                echo $details;

                
            }
        }

        //load the student profile after clicking student name
        public function selectStudent(){

            $this->postModel = $this->loadModel('Counselor');

            if(isset($_POST['gotStu'])){
                

                $gotStu = $_POST['gotStu'];

                // echo $gotStu;
                // exit;

                $result = $this->postModel->getStudentDetails($gotStu);

                echo json_encode($result);
            }

        }

        //To accept or reject student's requests
        public function acceptRejectStudent($id){

            $this->postModel = $this->loadModel('Counselor');
            $userid = Session::get('userID');

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              

                if(isset($_POST['accept'])){

                    $newStatus = 1;

                    $result = $this->postModel->updateStudentStatus($newStatus,$userid,$id);
                    Counsellor::studentView();
                }
                else if(isset($_POST['decline'])){
                    $newStatus = 2;

                    $result = $this->postModel->updateStudentStatus($newStatus,$userid,$id);
                    Counsellor::studentView();
                }

               
            }
        }

        //To remove accepted student
        public function removeStudent($id){

            $this->postModel = $this->loadModel('Counselor');
            $userid = Session::get('userID');

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              

                if(isset($_POST['remove'])){

                    $newStatus = 2;

                    $result = $this->postModel->updateStudentStatus($newStatus,$userid,$id);
                    Counsellor::studentView();
                }
               
            }
        }

        public function getAppointmentStats(){
            $userid = Session::get('userID');

            $res = $this->postModel->getAllAppointments($userid);
        
            echo $res;
        }

        public function getDatailForBarChart(){
            $userid = Session::get('userID');

            $res = $this->postModel->getAppointmentForWeek($userid);
        
            echo $res;

        }

        // public function showAppointmentTimes(){
            
        //     $this->postModel = $this->loadModel('Counselor');
        //     $userid = Session::get('userID');

        //     $curdate = date('Y-m-d');
        //     $row = $this->postModel->getAppointmentTimes($userid,$curdate);

        //     echo $row;
        //     exit;

        //     $data = [
        //         'rowT'=> $row
        //     ];

           
        //     $this->loadView('Counselor/dashboard',$data);
       


        // }

    }

?>
