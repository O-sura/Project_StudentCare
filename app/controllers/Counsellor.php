<?php
Session::init();
class Counsellor extends Controller
{

    private $userModel;
    private $counselorModel;

    public function __construct()
    {
        Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
        $this->counselorModel = $this->loadModel('Counselor');
        $this->userModel = $this->loadModel('User');
    }

    public function index()
    {
        $data = [];

        $this->loadView('Counselor/dashboard', $data);
    }

    //load the dashboard view. Registered counselor directly coming to this page after login
    public function home()
    {

        $userid = Session::get('userID');
        date_default_timezone_set('Asia/Kolkata'); // set timezone to Kolkata, India


        //get the time zone
        date_default_timezone_set('Asia/Kolkata');

        $curdate = date('Y-m-d');
        $currtime = date('H:i:s');

        $row = $this->counselorModel->getAppointmentTimes($userid, $curdate);
        $rowNext = $this->counselorModel->nextAppointmentDetails($userid, $curdate, $currtime);
        $recentNoti = json_decode($this->counselorModel->getInformationForDashboardNotification($userid));

        $getApp = json_decode($row, true);
        $getNextApp = json_decode($rowNext, true);

        $data = [
            'row' => $getApp,
            'rowNext' => $getNextApp,
            'recentNoti' => $recentNoti,
        ];

        $this->loadView('Counselor/dashboard', $data);

    }

    //load the profile view
    public function profileView()
    {

        $user_id = Session::get('userID');

        $row = $this->counselorModel->getCounselorProfile($user_id);
        $new = explode(",", $row->qualifications);

        $data = [
            'qualifications' => $new,
            'row' => $row,
        ];

        $this->loadView('Counselor/profile', $data);
    }

    //load the edit profile view
    public function EditProfile()
    {

        $user_id = Session::get('userID');
        $user_name = Session::get('username');

        $row = $this->counselorModel->getCounselorEditDetails($user_id);

        $new = explode(",", $row->qualifications); //get qualification by seperating using the comma

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
            'contact_err' => '',
        ];

        $this->loadView('Counselor/editDetails', $data);
    }

    //update profle details
    public function updateProfileDetails($userid)
    {
        $this->counselorModel = $this->loadModel('Counselor');
        $user_id = Session::get('userID');
        $row = $this->counselorModel->getCounselorEditDetails($user_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //to upload the profile image
            $filename = $_FILES["file"]["name"];
            $tempname = $_FILES["file"]["tmp_name"];
            $folder = PUBLICPATH . "/img/counselor/" . $filename;

            if (move_uploaded_file($tempname, $folder)) {

                echo 'File successfully uploaded';
            } else if (empty($filename) && empty($tempname)) {
                $filename = $row->profile_img;
                $folder = PUBLICPATH . "/img/counselor/" . $filename;
                $tempname = tempnam(sys_get_temp_dir(), 'image_');
                copy($folder, $tempname);

            } else {
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
            $description = $_POST['bioDesc'];
            $qualifications = array();
            //$new = explode(",", $row->qualifications);

            foreach ($_POST['qualifications'] as $key => $value) {
                $qualifications[$key] = $value;
            }

            $data = [
                'profile_img' => $filename,
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'nic' => $row->nic,
                'contact' => $contact,
                'address' => $address,
                'dob' => $row->dob,
                'specialization' => $row->specialization,
                'qualifications' => $qualifications,
                'profile' => $row->profile_img,
                'description' => $description,
                'name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'contact_err' => '',
                'address_err' => '',
                'qualification_err' => '',

            ];

            //Check whether all the fields are filled properly
            if (empty($data['username'])) {

                $data['username_err'] = "*Username field is Required";

            }

            if (empty($data['name'])) {
                $data['name_err'] = "*Name field is Required";

            }

            if (empty($data['email'])) {
                $data['email_err'] = "*Email field is Required";

            }

            if (empty($data['address'])) {
                $data['address_err'] = "*Address field is Required";

            }

            if (empty($data['contact'])) {
                $data['contact_err'] = "*Contact field is Required";

            }

            if (empty($data['qualifications'])) {
                $data['qualification_err'] = "*Qualification field is Required";

            }

            //Check whether an account already exists with the provided username
            if ($this->counselorModel->findUserByUsername($username)) {

                if ($username == Session::get('username')) {
                    $data['username_err'] = "";
                } else {
                    $data['username_err'] = "*This Username is already taken";
                }

            }

            //Email is valid or not
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $data['email_err'] = "*Invalid email format";

            }

            //Check the mobile number
            if (strlen($contact) != 10) {

                $data['contact_err'] = "*Invalid Contact Number";

            }

            //Make sure there are no error flags are set
            if (empty($data['username_err']) && empty($data['name_err']) && empty($data['email_err']) && empty($data['contact_err']) && empty($data['address_err']) && empty($data['qualification_err'])) {

                $res = $this->counselorModel->updateProfileDetails($data, $user_id);

                if ($res) {
                    FlashMessage::flash('update_profile_flash', "Successfully Updated Your Profile Details!", "success");
                    Middleware::redirect('Counsellor/ProfileView');
                } else {
                    //Error Notification
                    echo 'Error: Something went wrong in adding post to the databse';
                    Middleware::redirect('Counsellor/EditProfile');
                    die();
                }
            } else {
                $this->loadView('counselor/editDetails', $data);
            }

        } else {
            //get the relavent details from the model

            $row = $this->counselorModel->getCounselorEditDetails($user_id);

            $data = [

                'row' => $row,
            ];

            $this->loadView('counselor/profile', $data);
        }
    }


    //download verification doc
    public function download_verification(){

        $usr = Session::get('userID');
        $file = $this->counselorModel->getVerificationDocName($usr);
        $filepathOfDoc = json_decode($file,true);
        $filepath = $filepathOfDoc[0]['verification_doc'];
        // echo ($filepath);
        // exit;
        
        $path = APPROOT . '/uploads/' . $filepath;
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

    //load the notification section
    public function notificationView()
    {

        $userid = Session::get('userID');
        date_default_timezone_set('Asia/Kolkata'); // set timezone to Kolkata, India


        $res = json_decode($this->counselorModel->getInformationForNotification($userid));
        $rowcount = count($res);

        $data = [

            'row' => $res,
            'rowcount' => $rowcount,

        ];

        $this->loadView('Counselor/notification', $data);
    }

    //To mark as read the notifications
    public function markAsReadNotifications()
    {
        $usr = Session::get('userID');

        if (isset($_GET['stuID']) && isset($_GET['R_A_ID'])) {

            $gotStu = $_GET['stuID'];
            $gotID = $_GET['R_A_ID'];

            $this->counselorModel->markReadAsNotificationModel($usr, $gotStu, $gotID);
            Counsellor::notificationView();
            echo json_encode(['success' => true]); // return success response as JSON

        } else {
            echo json_encode(['success' => false]); // return error response as JSON
        }
    }

    //load the recieved students' requests section
    public function studentView()
    {

        $userid = Session::get('userID');

        $statusNew = "";
        $statusNew0 = 0;
        $statusNew1 = 1;
        $statusNew2 = 2;

        $row = $this->counselorModel->getStudents($statusNew, $userid);
        $row0 = $this->counselorModel->getStudents($statusNew0, $userid);
        $row1 = $this->counselorModel->getStudents($statusNew1, $userid);
        $row2 = $this->counselorModel->getStudents($statusNew2, $userid);

        //check whether the correspondin section empty or not

        $data = [
            'row' => $row,
            'row0' => $row0,
            'row1' => $row1,
            'row2' => $row2,

        ];

        $this->loadView('Counselor/student', $data);

    }

    //to filter the students as new, accepted & rejected
    public function filterStatus()
    {

        $userid = Session::get('userID');

        if (isset($_POST['statusPP'])) {

            $status = $_POST['statusPP'];
            $statusNew = 0;

            if ($status === "") {
                $details = json_encode($this->counselorModel->getStudents($statusNew, $userid));
            } else {
                $details = json_encode($this->counselorModel->getStudents($status, $userid));
            }

            echo $details;

        }
    }

    //load the student profile after clicking student name
    public function selectStudent()
    {

        if (isset($_POST['gotStu'])) {

            $gotStu = $_POST['gotStu'];

            $result = $this->counselorModel->getStudentDetails($gotStu);

            echo json_encode($result);
        }

    }

    //To accept or reject student's requests
    public function acceptRejectStudent($id)
    {

        $userid = Session::get('userID');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['accept'])) {

                $newStatus = 1;

                $data = [
                    'newStatus' => $newStatus,
                    'cID' => $userid,
                    'stuID' => $id,
                    'reason' => "",
                ];

                $result = $this->counselorModel->updateStudentStatus($data);
                Counsellor::studentView();
            } else if (isset($_POST['submit'])) {

                if (isset($_POST['descC'])) {

                    $newStatus = 2;

                    $reason = $_POST['descC'];

                    $data = [
                        'newStatus' => $newStatus,
                        'cID' => $userid,
                        'stuID' => $id,
                        'reason' => $reason,
                    ];

                    $result = $this->counselorModel->updateStudentStatus($data);
                    Counsellor::studentView();
                }

            }

        }
    }

    //To remove accepted student
    public function removeStudent($id)
    {

        $userid = Session::get('userID');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['submit'])) {

                $reason = $_POST['descC'];
                $newStatus = 2;

                $data = [
                    'newStatus' => $newStatus,
                    'cID' => $userid,
                    'stuID' => $id,
                    'reason' => $reason,
                ];

                $result = $this->counselorModel->updateStudentStatus($data);
                Counsellor::studentView();
            }

        }
    }

    //to get the statistics of appointments
    public function getAppointmentStats()
    {
        $userid = Session::get('userID');
        $currentMonth = date('n');
        $currentYear = date('Y');

        $res = $this->counselorModel->getAllAppointments($userid, $currentMonth, $currentYear);

        echo $res;
    }

    //to get the details for bar chart
    public function getDatailForBarChart()
    {
        $userid = Session::get('userID');

        $res = $this->counselorModel->getAppointmentForWeek($userid);

        echo $res;

    }

    //to change the profile password
    public function changePassword()
    {
        $username = Session::get('username');

        $data = [
            'username' => $username,
            'currentPW' => '',
            'password' => '',
            'confirmPW' => '',
            'currentPW_err' => '',
            'password_err' => '',
            'confirmPW_err' => '',
        ];

        $this->loadView('Counselor/changePW', $data);
    }

    public function changeCurrentPassword()
    {

        $username = Session::get('username');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Log the user in and start the session

            if (isset($_POST['change-password'])) {

                $data = [
                    'username' => $username,
                    'currentPW' => trim($_POST['current-password']),
                    'password' => trim($_POST['password']),
                    'confirmPW' => trim($_POST['password-confirm']),
                    'currentPW_err' => '',
                    'password_err' => '',
                    'confirmPW_err' => '',
                ];

                $password = $data['password'];

                if (!$this->userModel->validatePassword($data['username'], $data['currentPW'])) {
                    $data['currentPW_err'] = '*Current Password does not match';
                }

                //Password and repeated once are matched
                if ($_POST['password'] !== $_POST['password-confirm']) {
                    //echo("Password mismatch");
                    $data['confirmPW_err'] = "*Password mismatch";
                    // die();
                }

                //password has(Min. 8 len, one character, one letter, one special char)
                if (strlen($password) < 8) {
                    //echo("Password should have at least 8 characters");
                    $data['password_err'] = "*Password should have at least 8 characters";
                    //die();
                } else {
                    if (!preg_match('/[0-9]/', $password)) {
                        //echo("Password must contain at least one number");
                        $data['password_err'] = "*Password must contain at least one number";
                        //die();
                    } else if (!preg_match('/[a-z]/', $password)) {
                        //echo('Password must contain at least one lowercase letter');
                        $data['password_err'] = "*Password must contain at least one lowercase letter";
                        //die();
                    } else if (!preg_match('/[A-Z]/', $password)) {
                        //echo('Password must contain at least one uppercase letter');
                        $data['password_err'] = "*Password must contain at least one uppercase letter";
                        //die();
                    } else if (!preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>,;@\|\-=\-_+\-¬\`\]]/", $password)) {
                        //echo('Password must contain at least one special character');
                        $data['password_err'] = "*Password must contain at least one special character";
                        //die();
                    }
                }

                // print_r($data);
                // exit;

                if (empty($data['currentPW'])) {
                    $data['currentPW_err'] = "Please enter current password";
                }

                if (empty($data['confirmPW'])) {
                    $data['confirmPW_err'] = "Please enter confirm password";
                }

                if (empty($data['password'])) {
                    $data['password_err'] = "Please enter new password";
                }

                if (empty($data['username_err']) && empty($data['currentPW_err']) && empty($data['password_err']) && empty($data['confirmPW_err'])) {

                    $this->userModel->updatePassword($username, $data['password']);
                    FlashMessage::flash('password_change_flash', "Successfully Updated Your Password!", "success");
                    Middleware::redirect('Counsellor/EditProfile');
                } else {
                    $this->loadView('Counselor/changePW', $data);
                }
            }

        }
    }

    //to delete own profile of counselor
    public function deleteOwnProfile()
    {

        $userid = Session::get('userID');

        $this->counselorModel->updateUserAsDeleted($userid);

        // $data == [];

        $this->loadView('index');
    }

}
