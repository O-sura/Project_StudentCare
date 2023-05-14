<?php
    Session::init();
    class Admin extends Controller{
        private $adminModel;
        private $studentModel;
        private $counselorModel;
        private $fpModel;
        private $userModel;
        private $reportModel;
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'admin');
            $this->adminModel = $this->loadModel('AdminModel');
            $this->studentModel = $this->loadmodel('Student_model');
            $this->counselorModel = $this->loadmodel('Counselor');
            $this->fpModel = $this->loadmodel('Facility_Providers');
            $this->userModel = $this->loadmodel('User');
            $this->reportModel = $this->loadModel('ReportModel');
        }
        
        public function index(){

        }

        //loading admin dashboard with data
        public function home(){
            $data = [
                'total_users' => $this->adminModel->totalUserCount()[0]->count,
                'counselor_req' => $this->adminModel->newCounselorReq()[0]->count,
                'new_posts' => $this->adminModel->postCount()[0]->count,
                'engagement' => $this->adminModel->authorCount(),
                'top_posts' => $this->adminModel->getTopPosts(),
                'total_listings' => $this->adminModel->listingCount()[0]->count,
                'average_rating' => $this->adminModel->listingCount()[0]->avg_rating,
                'top_listings' => $this->adminModel->getTopListings()
            ];

            $this->loadView('admin/dashboard', $data);
        }

        //handling the report generation process for the admin
        public function reports(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               if(isset($_GET['individual'])){
                //report which contains only info about a single user
                //NOT USED
               }
               else{
                //report which contains overall details about a specific section
                $duration = $_POST['duration'];
                $type =  $_POST['type'];
                $role = $_POST['role'];

                $today = new DateTime();
                $endDate = $today->format('Y-m-d');
                
                if($duration == 'Weekly'){
                    $startDate = $today->sub(new DateInterval('P7D'))->format('Y-m-d');
                }
                else if($duration == 'Monthly'){
                    $startDate =  $today->sub(new DateInterval('P30D'))->format('Y-m-d');
                }
                else if($duration == '3-Months'){
                    $startDate =  $today->sub(new DateInterval('P90D'))->format('Y-m-d');
                }
                else if($duration == '6-Months'){
                    $startDate =  $today->sub(new DateInterval('P180D'))->format('Y-m-d');
                }
                
                
                $data = $this->getReportData($role,$type,$startDate,$endDate);
                generatePDF($role,$data,$type,true);
            
               }
            }else{
                $pdfFolder = APPROOT. "/uploads/reports/";
                $pdfFiles = glob($pdfFolder . "*.pdf");
                $data = array();
                foreach ($pdfFiles as $pdfFile) {
                    $fileName = basename($pdfFile);
                    $role = explode("_", $fileName)[0];
                    $createdDate = date("Y-m-d H:i:s", filectime($pdfFile));
                    $data[] = array('filename' => $fileName,'role' => $role, 'created_date' => $createdDate);
                }
                $this->loadView('admin/report-generator', $data);
            }
        }

        //converts an object array into array of array
        function getDataArray($objectArray) {
            $result = array();
            foreach ($objectArray as $object) {
              $temp = array();
              foreach ($object as $key => $value) {
                $temp[$key] = $value;
              }
              array_push($result, $temp);
            }
            return $result;
          }
          
        //function to pick data required for generating the report
        public function getReportData($role,$type,$startdate,$enddate){
            if($role == 'Admin'){
                if($type == 'System Overview'){

                    $roles_and_counts = $this->getDataArray($this->reportModel->userCountByRole($startdate,$enddate));
                    $listings = $this->getDataArray($this->reportModel->listing_overview($startdate,$enddate));
                    $listing_by_loc = $this->getDataArray($this->reportModel->listing_by_location($startdate,$enddate));
                    $sessions_by_status = $this->getDataArray($this->reportModel->sessionsByStatus($startdate,$enddate));

                    $mobile_engaged = $this->reportModel->mobile_app_interaction($startdate,$enddate);
                    $total = $this->reportModel->totalStudentCount()[0]->count;
                    $data = [
                        'users_by_role' => $roles_and_counts,
                        'total_users' => $this->reportModel->totalUserCount($startdate,$enddate),
                        'total_community_posts' => $this->reportModel->totalUserCount($startdate,$enddate),
                        'community_engagement' =>$this->reportModel->authorCount($startdate,$enddate),
                        'comment' => $this->reportModel->commentCount($startdate,$enddate),
                        'post_reportings' => $this->reportModel->postReportCount($startdate,$enddate),
                        'total_csessions' => $sessions_by_status,
                        'counselor-stu-engagement' => $this->reportModel->counselor_stu_engagement()->counselor_student_engagement,
                        'counselor-ann-engagement' => $this->reportModel->counselor_ann_engagement()->counselor_announcement_engagement,
                        'listing_overview' => $listings,
                        'stu-listing-engagement' => $this->reportModel->student_listing_engagement($startdate,$enddate),
                        'listing_by_location' => $listing_by_loc,
                        'stu_mobile_engagement' => round(($mobile_engaged/$total)*100,2)
                    ];
                    return $data;
                }
            }
            if($role == 'Counselor'){
                if($type == 'Session Details'){
                    $data = [
                        'total_csessions' => $this->getDataArray($this->reportModel->totalCSessions($startdate,$enddate)),
                        'counselor-stu-engagement' => $this->reportModel->counselor_stu_engagement()->counselor_student_engagement,
                        'counselor-ann-engagement' => $this->reportModel->counselor_ann_engagement()->counselor_announcement_engagement,
                        'counselor_specilaization' => $this->getDataArray($this->reportModel->counselors_by_specialization())
                    ];
                    return $data;
                }
            }
            if($role == 'Facility_Provider'){
                if($type == 'Listing Overview'){
                    $data = [
                        'listing_performance' => $this->getDataArray($this->reportModel->listing_performance_report($startdate,$enddate)),
                        'user_activity' => $this->getDataArray($this->reportModel->user_activity_report($startdate,$enddate)),
                        'geographic_analysis' => $this->getDataArray($this->reportModel->geographic_analysis_report($startdate,$enddate)),
                    ];
                    return $data;
                }
            }
        }

        //Function for handling the deletion of a report generated by admin
        public function deleteReport($filename){
            $filepath = APPROOT. "/uploads/reports/". $filename;
    
            if (file_exists($filepath)) {
                unlink($filepath); // Delete the file
                echo json_encode(array('status' => 1));
            } else {
                echo "File $filename not found.";
            }
        }

        //Function for handling the downloading process of an already generated report
        public function downloadReport($filename){
            $path = APPROOT. "/uploads/reports/". $filename;
            if (file_exists($path)) {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($path) . '"');
                header('Content-Length: ' . filesize($path));
                readfile($path);
                exit;
            } else {
                echo 'File not found.';
            }
        }

        //loading the unverified counselor list
        public function join_requests(){
             //load all unverified counselors and display them
             $data = $this->adminModel->getUnverifiedCounselors();
             $this->loadView('admin/counsellor-request', $data);
        }

        //loading the profile of an individual counselor(unverified)
        public function view_counselor_profile($id){
            $data = $this->adminModel->getCounselorInfo($id);

            $qualifications = explode(",", $data->qualifications);
            $data->qualifications = $qualifications;

            $this->loadView('admin/counselor-admin-verify',$data);
        }

        //Change the counselor account approval state to approved or declined and notify using email
        public function counselor_verify(){
            $id = $_GET['id'];
            $approval = $_GET['approval'];
            if($id){

                if($approval == 1){
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
                else if($approval == 0){
                    //If counselor is not approved reove his data from database
                    //Send mail informing the rejection
                    //echo 'Account declined';

                    
                    //Code for sending rejection email
                    $user = $this->adminModel->getCounselorInfo($id);
                    $subject = 'Registration Request Rejected for StudentCare';
                    $body = '
                        Dear [Counselor Name],

                        I am writing to inform you that we recently received your registration request for StudentCare, our online platform for students seeking counseling services. However, we regret to inform you that your account has been rejected by our admin after reviewing the verification document you have provided.
                        
                        We understand that this news may be disappointing, but we encourage you to review the information you provided and resubmit your registration request. If you have any questions or concerns, please do not hesitate to contact our support team at support@studentcare.com.
                        
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
            
        }

        //display the complaints section for admin
        public function complaints(){
            $this->loadView('admin/complaint-log');
        }

        //user management dashboard for admin
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

        //function for handling student profile viewing
        public function studentProfileHandler($userID){
            $user = $this->studentModel->getProfile($userID);
            $data = [
                'userID' => $userID,
                'profile_img' => $user->profile_img,
                'name' => $user->fullname,
                'username' => $user->username,
                'contact' => $user->contact_no,
                'address' => $user->home_address,
                'nic' => $user->nic,
                'university' => $user->university,
                'dob' => $user->dob,
                'email' => $user->email,
                'name_err' => '',
                'username_err' => '',
                'contact_err' => '',
                'address_err' => '',
                'nic_err' => '',
                'university_err' => '',
                'dob_err' => '',
                'email_err' => ''
            ];
            $this->loadview('admin/admin_stu_edit', $data);
        }

        //function for handling student profile viewing
        public function counselorProfileHandler($userID){
            $user = $this->counselorModel->getCounselorProfile($userID);
            $data = [
                'userID' => $userID,
                'profile_img' => $user->profile_img,
                'name' => $user->fullname,
                'username' => $user->username,
                'contact' => $user->contact_no,
                'address' => $user->home_address,
                'nic' => $user->nic,
                'specialization' => $user->specialization,
                'qualifications' => explode(",", $user->qualifications),
                'dob' => $user->dob,
                'email' => $user->email,
                'name_err' => '',
                'username_err' => '',
                'contact_err' => '',
                'address_err' => '',
                'nic_err' => '',
                'dob_err' => '',
                'specialization_err' => '',
                'qualification_err' => '',
                'email_err' => ''
            ];
            $this->loadview('admin/admin_counselor_edit', $data);
        }

        //function for handling facility provider profile viewing
        public function fpProfileHandler($userID){
            $user = $this->fpModel->getProfile($userID);
            $data = [
                'userID' => $userID,
                'profile_img' => $user->profile_img,
                'name' => $user->fullname,
                'username' => $user->username,
                'contact' => $user->contact_no,
                'address' => $user->home_address,
                'nic' => $user->nic,
                'categories' => explode(",", $user->category),
                'email' => $user->email,
                'name_err' => '',
                'username_err' => '',
                'contact_err' => '',
                'address_err' => '',
                'nic_err' => '',
                'email_err' => ''
            ];
            
            $this->loadview('admin/admin_fp_edit', $data);
        }

        //function for handling admin profile viewing
        public function adminProfileHandler($userID){
            $user = $this->adminModel->getProfile($userID);
            $data = [
                'userID' => $userID,
                'name' => $user->fullname,
                'username' => $user->username,
                'contact' => $user->contact_no,
                'address' => $user->home_address,
                'nic' => $user->nic,
                'email' => $user->email,
            ];
            
            $this->loadview('admin/admin_profile_view', $data);
        }

        //function for viewing single user profile
        public function show_user($userID){
            $role = $this->adminModel->getRole($userID);
            $role = $role->{'user_role'};
            if($role == 'student'){
                //load student details
                $this->studentProfileHandler($userID);
            }else if($role == 'counsellor'){
                //load counselor details
                $this->counselorProfileHandler($userID);
            }else if($role == 'facility_provider'){
                //load facility provider details 
                $this->fpProfileHandler($userID);
            }
            else if($role == 'admin'){
                //load admin details 
                $this->adminProfileHandler($userID);
            }
        }

        //handling the updating process of a student profile done by the admin
        public function update_student($userID){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $row = $this->studentModel->getProfile($userID);
    
    
                //Check and validate the data
                //Set errors if something is wrong
                $name = $_POST['name'];
                $username = $_POST['username'];
                $address = $_POST['address'];
                $contact = $_POST['phone'];
                $nic = $_POST['nic'];
                $university = $_POST['university'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
    
                $data = [
                    'userID' => $userID,
                    'profile_img' => $row->profile_img,
                    'name' => $name,
                    'username' => $username,
                    'contact' => $contact,
                    'address' => $address,
                    'nic' => $nic,
                    'university' => $university,
                    'dob' => $dob,
                    'email' => $email,
                    'name_err' => '',
                    'username_err' => '',
                    'contact_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'university_err' => '',
                    'dob_err' => '',
                    'email_err' => ''
                ];
    
    
                //Check whether all the fields are filled properly
                if (empty($data['username'])) {
                    //echo("Must fill all the fields in the form!");
                    $data['username_err'] = "*Username field is Required";
                }

                //Check whether an account already exists with the provided username
                if ($this->studentModel->findUserByUsername($username)) {
                    $curr_username = $this->adminModel->getCurrentUsername($userID);
                    $curr_username = $curr_username->{'username'};
                    if ($username == $curr_username) {
                        $data['username_err'] = "";
                    } else {
                        $data['username_err'] = "*This Username is already taken";
                    }
                }
    
                if (empty($data['name'])) {
                    $data['name_err'] =  "*Name field is Required";
                }
    
                if (empty($data['address'])) {
                    $data['address_err'] = "*Address field is Required";
                }
    
                if (empty($data['contact'])) {
                    $data['contact_err'] = "*Contact field is Required";
                }

                if (empty($data['nic'])) {
                    $data['nic_err'] = "*NIC field is Required";
                }

                if (empty($data['university'])) {
                    $data['university_err'] = "*University field is Required";
                }

                if (empty($data['dob'])) {
                    $data['dob_err'] = "*DOB field is Required";
                }

                if (empty($data['email'])) {
                    $data['email_err'] = "*Email field is Required";
                }
    
                //Check the mobile number
                if (strlen($contact) != 10) {
                    $data['contact_err'] = "*Invalid Contact Number";
                }

                //Make sure there are no error flags are set
                if (empty($data['username_err']) && empty($data['name_err'])  && empty($data['contact_err']) && empty($data['address_err']) && empty($data['university_err']) && empty($data['nic_err']) && empty($data['dob_err']) && empty($data['email_err'])) {
                    $res = $this->adminModel->updateStudentDetails($data, $userID);
    
                    if ($res) {
                        FlashMessage::flash('update_profile_flash', "Successfully Updated the Profile Details!", "success");
                        Admin::user_management();
                    } else {
                        //Error Notification
                        echo 'Error: Something went wrong in adding post to the databse';
                        FlashMessage::flash('update_profile_flash', "Something Went Wrong!", "error");
                        Admin::user_management();
                        die();
                    }
                } else {
                    $this->loadview('admin/admin_stu_edit', $data);
                }
            }
        

        
        }

        //handling the updating process of a counselor profile done by the admin
        public function update_counselor($userID){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $row = $this->counselorModel->getCounselorProfile($userID);
    
                //Check and validate the data
                //Set errors if something is wrong
                $name = $_POST['name'];
                $username = $_POST['username'];
                $address = $_POST['address'];
                $contact = $_POST['phone'];
                $nic = $_POST['nic'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
                $specialization = $_POST['specialization'];
                $qualifications = [];

                foreach ($_POST['qualifications'] as $key => $value){
                    // array_push($qualifications, $value);
                    // unset($_POST[$key]);
                    $qualifications[$key] = $value;
                }
    
                $data = [
                    'userID' => $userID,
                    'profile_img' => $row->profile_img,
                    'name' => $name,
                    'username' => $username,
                    'contact' => $contact,
                    'address' => $address,
                    'nic' => $nic,
                    'specialization' => $specialization,
                    'qualifications' => $qualifications,
                    'dob' => $dob,
                    'email' => $email,
                    'name_err' => '',
                    'username_err' => '',
                    'contact_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'dob_err' => '',
                    'specialization_err' => '',
                    'qualification_err' => '',
                    'email_err' => ''
                ];
    
    
                //Check whether all the fields are filled properly
                if (empty($data['username'])) {
                    //echo("Must fill all the fields in the form!");
                    $data['username_err'] = "*Username field is Required";
                }

                //Check whether an account already exists with the provided username
                if ($this->studentModel->findUserByUsername($username)) {
                    $curr_username = $this->adminModel->getCurrentUsername($userID);
                    $curr_username = $curr_username->{'username'};
                    //echo("This Username is already taken");
                    if ($username == $curr_username) {
                        $data['username_err'] = "";
                    } else {
                        $data['username_err'] = "*This Username is already taken";
                    }
                }
    
                if (empty($data['name'])) {
                    $data['name_err'] =  "*Name field is Required";
                }
    
                if (empty($data['address'])) {
                    $data['address_err'] = "*Address field is Required";
                }
    
                if (empty($data['contact'])) {
                    $data['contact_err'] = "*Contact field is Required";
                }

                if (empty($data['nic'])) {
                    $data['nic_err'] = "*NIC field is Required";
                }

                if (empty($data['dob'])) {
                    $data['dob_err'] = "*DOB field is Required";
                }

                if (empty($data['email'])) {
                    $data['email_err'] = "*Email field is Required";
                }

                if(empty($data['specialization'])){
                    $data['specialization_err'] = "*Specialization is required";
                }

                if(empty($_POST['qualifications'])){
                    $data['qualifications_err'] = "*Qualifications cannot be empty";
                }
    
                //Check the mobile number
                if (strlen($contact) != 10) {
                    $data['contact_err'] = "*Invalid Contact Number";
                }

                //Make sure there are no error flags are set
                if (empty($data['username_err']) && empty($data['name_err'])  && empty($data['contact_err']) && empty($data['address_err']) &&  empty($data['nic_err']) && empty($data['dob_err']) && empty($data['email_err'])) {
                    $res = $this->adminModel->updateCounselorDetails($data, $userID);
    
                    if ($res) {
                        FlashMessage::flash('update_profile_flash', "Successfully Updated the Profile Details!", "success");
                        Admin::user_management();
                    } else {
                        //Error Notification
                        echo 'Error: Something went wrong in adding post to the databse';
                        FlashMessage::flash('update_profile_flash', "Something Went Wrong!", "error");
                        Admin::user_management();
                        die();
                    }
                } else {
                    $this->loadview('admin/admin_counselor_edit', $data);
                }
            }
        }

        //handling the updating process of a facilityProvider profile done by the admin
        public function update_fp($userID){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $row = $this->fpModel->getProfile($userID);
    
    
                //Check and validate the data
                //Set errors if something is wrong
                $name = $_POST['name'];
                $username = $_POST['username'];
                $address = $_POST['address'];
                $contact = $_POST['phone'];
                $nic = $_POST['nic'];
                $email = $_POST['email'];
    
                $data = [
                    'userID' => $userID,
                    'profile_img' => $row->profile_img,
                    'name' => $name,
                    'username' => $username,
                    'contact' => $contact,
                    'address' => $address,
                    'nic' => $nic,
                    'categories' => explode(",", $row->category),
                    'email' => $email,
                    'name_err' => '',
                    'username_err' => '',
                    'contact_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'email_err' => ''
                ];
    
    
                //Check whether all the fields are filled properly
                if (empty($data['username'])) {
                    $data['username_err'] = "*Username field is Required";
                }

                //Check whether an account already exists with the provided username
                if ($this->studentModel->findUserByUsername($username)) {
                    $curr_username = $this->adminModel->getCurrentUsername($userID);
                    $curr_username = $curr_username->{'username'};
                    if ($username == $curr_username) {
                        $data['username_err'] = "";
                    } else {
                        $data['username_err'] = "*This Username is already taken";
                    }
                }
    
                if (empty($data['name'])) {
                    $data['name_err'] =  "*Name field is Required";
                }
    
                if (empty($data['address'])) {
                    $data['address_err'] = "*Address field is Required";
                }
    
                if (empty($data['contact'])) {
                    $data['contact_err'] = "*Contact field is Required";
                }

                if (empty($data['nic'])) {
                    $data['nic_err'] = "*NIC field is Required";
                }

                if (empty($data['email'])) {
                    $data['email_err'] = "*Email field is Required";
                }
    
                //Check the mobile number
                if (strlen($contact) != 10) {
                    $data['contact_err'] = "*Invalid Contact Number";
                }

                //Make sure there are no error flags are set
                if (empty($data['username_err']) && empty($data['name_err'])  && empty($data['contact_err']) && empty($data['address_err']) &&  empty($data['nic_err']) && empty($data['dob_err']) && empty($data['email_err'])) {
                    $res = $this->adminModel->updateFpDetails($data, $userID);
    
                    if ($res) {
                        FlashMessage::flash('update_profile_flash', "Successfully Updated the Profile Details!", "success");
                        Admin::user_management();
                    } else {
                        //Error Notification
                        FlashMessage::flash('update_profile_flash', "Something Went Wrong!", "error");
                        Admin::user_management();
                        die();
                    }
                } else {
                    $this->loadview('admin/admin_fp_edit', $data);
                }
            }
        }

        //fetches the user details(registered within last week) for charts in admin dashboard
        public function get_lastweek_users(){
            echo $this->adminModel->newRegUsers();
        }

        //fetches the user details based on roles for charts in admin dashboard
        public function get_role_data(){
            echo $this->adminModel->userCountByRole();
        }

        //fetches the post details for charts in admin dashboard
        public function get_post_data(){
            echo $this->adminModel->getCommunityPostData();
        }

        //fetches the comment details for charts in admin dashboard
        public function get_comment_data(){
            echo $this->adminModel->getCommunityCommentData();
        }

        //fetches the listing details for charts in admin dashboard
        public function get_listing_data(){
            echo $this->adminModel->getListingData();
        }

        //downloading the verification document submitted by the counselor when registering
        public function download_verification($file){
            $path = APPROOT . '/uploads/' . $file;
            if (file_exists($path)) {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($path) . '"');
                header('Content-Length: ' . filesize($path));
                readfile($path);
                exit;
            } else {
                echo 'File not found.';
            }
        }

        //Controller function to get the serached posts
        public function search_user(){
           //Check whether the search query is empty or not
           if(isset($_GET['query'])){
                if(empty($_GET['query'])){
                    $res =  json_encode($this->adminModel->getUserManagementInfo());
                }
                else{
                    $keyword = "%" . trim($_GET['query']) . "%";
                    $res =  $this->adminModel->searchUsers($keyword);
                }
                echo $res;
           }
        }

        //creating a new admin profile
        public function create_admin(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                //Check and validate the data
                //Set errors if something is wrong
                $name = trim($_POST['name']);
                $username = trim($_POST['username']);
                $address = trim($_POST['address']);
                $contact = trim($_POST['phone']);
                $password = trim($_POST['password']);
                $repassword = trim($_POST['repassword']);
                $nic = trim($_POST['nic']);
                $email = trim($_POST['email']);
    
                $data = [
                    'userID' => substr(sha1(date(DATE_ATOM)), 0, 8),
                    'name' => $name,
                    'username' => $username,
                    'contact' => $contact,
                    'address' => $address,
                    'nic' => $nic,
                    'email' => $email,
                    'password' => $password,
                    'repassword' => $repassword,
                    'role' => "admin",
                    'name_err' => '',
                    'username_err' => '',
                    'contact_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'repassword_err' => ''
                ];
    
                //Check whether all the fields are filled properly
                if(empty($username)) {
                    $data['username_err'] = "*Username field is Required";
                }
                //Check whether an account already exists with the provided username
                if($username != null){
                    if($this->userModel->findUserByUsername($username)) {
                        $data['username_err'] = "*This username is already taken";
                    }
                }
    
                if(empty($name)) {
                    $data['name_err'] =  "*Name field is Required";
                }
    
                if(empty($address)) {
                    $data['address_err'] = "*Address field is Required";
                }
    
                if(empty($contact)) {
                    $data['contact_err'] = "*Contact field is Required";
                }

                if(empty($nic)) {
                    $data['nic_err'] = "*NIC field is Required";
                }

                if(empty($email)) {
                    $data['email_err'] = "*Email field is Required";
                }

                if($email != null){
                    if($this->userModel->findUserByEmail($email)) {
                        $data['email_err'] = "*Account with given email already exists";
                    }
                }

                //Email is valid or not
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['email_err'] = "*Invalid email format";
                }

                //Password and repeated once are matched
                if($password !== $repassword){
                    $data['repassword_err'] = "*Password mismatch";
                }

                if (empty($repassword)) {
                    $data['repassword_err'] = "*Password confirmation is required";
                }

                //password has(Min. 8 len, one character, one letter, one special char)
                if(strlen($password)<8){
                    $data['password_err'] = "*Password should have at least 8 characters";
                }
                else{
                    if (!preg_match('/[0-9]/', $password)) {
                        $data['password_err'] = "*Password must contain at least one number";
                    }
                    else if(!preg_match('/[a-z]/', $password)){
                        $data['password_err'] = "*Password must contain at least one lowercase letter";
                    }
                    else if(!preg_match('/[A-Z]/', $password)){
                        $data['password_err'] = "*Password must contain at least one uppercase letter";
                    }
                    else if(!preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>,;@\|\-=\-_+\-¬\`\]]/", $password)){
                        $data['password_err'] = "*Password must contain at least one special character";
                    }
                }

                //Check NIC number
                if(!(str_contains($nic,'v') || (str_contains($nic,'V')))){
                    if(strlen($nic) != 12){
                        $data['nic_err'] = "*Invalid NIC";
                    }
                }
                else{
                    if(strlen($nic) != 10){
                        $data['nic_err'] = "*Invalid NIC";
                    }
                }   

    
                //Check the mobile number
                if (strlen($contact) != 10) {
                    $data['contact_err'] = "*Invalid Contact Number";
                }

                //Make sure there are no error flags are set
                if (empty($data['username_err']) && empty($data['name_err'])  && empty($data['contact_err']) && empty($data['address_err']) && empty($data['password_err']) && empty($data['nic_err']) && empty($data['repassword_err']) && empty($data['email_err'])) {
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                    $res = $this->adminModel->createAdminProfile($data);
    
                    if ($res) {
                        FlashMessage::flash('admin_profile_flash', "New Admin Profile Successfully Created!", "success");
                        Admin::user_management();
                    } else {
                        //Error Notification
                        echo 'Error: Something went wrong in adding post to the databse';
                        Admin::user_management();
                        die();
                    }
                } else {
                    $this->loadview('admin/create-admin', $data);
                }
            }
            else{
                $data = [
                    'userID' => '',
                    'name' => '',
                    'username' => '',
                    'contact' => '',
                    'address' => '',
                    'nic' => '',
                    'email' => '',
                    'password' => '',
                    'repassword' => '',
                    'name_err' => '',
                    'username_err' => '',
                    'contact_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'repassword_err' => ''
                ];
                $this->loadView('admin/create-admin',$data);
            }
        }
        
        //fetching all notifications about reported posts
        public function get_post_reports(){
            echo $this->adminModel->getPostReportings();
        }

        //fetching all notifications sent through contact us form
        public function get_contact_notifications(){
            echo $this->adminModel->getOtherNotifications();
        }

        public function mark_as_read(){
            // Get the notification ID from the URL parameter
            $notificationId = $_GET['id'];
            $type = $_GET['type'];


            // Return a response to indicate success or failure
            if($this->adminModel->markAsRead($type,$notificationId)) {
                http_response_code(200); // OK
            } else {
                http_response_code(400); // Bad Request
            }
        }

        public function mark_all_as_read(){
            $type = $_GET['type'];
            // Return a response to indicate success or failure
            if($this->adminModel->markAllAsRead($type)) {
                http_response_code(200); // OK
            } else {
                http_response_code(400); // Bad Request
            }
        }

        //function for generating user summary report
        public function getSummary($userID){
            $user = $this->adminModel->getProfile($userID);
            if($user->user_role == "counsellor"){
                $data = [
                        'name' => $user->fullname,
                        'username' => $user->username,
                        'student_count' => $this->reportModel->student_count($userID,1),
                        'sessions' => $this->reportModel->session_count($userID),
                        'cancelled_count' => $this->reportModel->session_cancelled_count($userID),
                        'completed_count' => $this->reportModel->session_completed_count($userID),
                        'meeting_details' => $this->getDataArray($this->reportModel->total_session_details($userID)),
                        'student_details' => $this->getDataArray($this->reportModel->student_count($userID,0))

                    ];
                generatePDF('counselor',$data);
            }
            else if($user->user_role == "facility_provider"){
                $data = [
                    'name' => $user->fullname,
                    'username' => $user->username,
                    'listing_details' => $this->getDataArray($this->reportModel->listing_performance($userID))
                ];
                generatePDF('facility_provider',$data);
            }
        }

    

}

?>