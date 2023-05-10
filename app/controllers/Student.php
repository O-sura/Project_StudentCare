<?php
Session::init();
class Student extends Controller
{
    private $studentModel;
    private $userModel;
    private $taskModel;
    public function __construct()
    {
        Middleware::authorizeUser(Session::get('userrole'), 'student');
        $this->studentModel = $this->loadmodel('Student_model');
        $this->userModel = $this->loadmodel('User');
        $this->taskModel = $this->loadmodel('Task');
    }

    public function index()
    {
    }

    public function home()
    {
        $usr =   Session::get('username');
        $new_requests_count = $this->studentModel->getNewRequestsCount(Session::get('userID'));
        $new_appointments_count = $this->studentModel->getNewAppointmentsCount(Session::get('userID'));
        $new_messages_count = $this->studentModel->getNewMessagesCount(Session::get('userID'));
        $task_notification_count = $this->studentModel->getTaskNotificationCount(Session::get('userID'));
        $total_count = $new_requests_count + $new_appointments_count;
        $data = [
            'username' => $usr,
            'new_requests_count' => $total_count,
            'new_messages_count' => $new_messages_count,
            'task_notification_count' => $task_notification_count,
            'userDetails' => $this->studentModel->getProfile(Session::get('userID'))
        ];
        $this->loadview('student_dashboard/index', $data);
    }

    public function profile()
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = $this->studentModel->getProfile(Session::get('userID'));
            $filename = $_FILES["file"]["name"];
            $tempname = $_FILES["file"]["tmp_name"];
            $folder =  PUBLICPATH . "/img/student/" . $filename;



            if (move_uploaded_file($tempname, $folder)) {
            } else if (empty($filename) && empty($tempname)) {
                $filename = $row->profile_img;
                $folder = PUBLICPATH . "/img/student/" . $filename;
                $tempname = tempnam(sys_get_temp_dir(), 'image_');
                copy($folder, $tempname);
            }

            //Check and validate the data
            //Set errors if something is wrong
            $name = $_POST['name'];
            $username = $_POST['uname'];
            $address = $_POST['address'];
            $contact = $_POST['phone'];




            $data = [
                'profile_img' => $filename,
                'name' => $name,
                'username' => $username,
                'contact' => $contact,
                'address' => $address,
                'profile' => $row->profile_img,
                'name_err' => '',
                'username_err' => '',
                'contact_err' => '',
                'address_err' => ''
            ];


            //Check whether all the fields are filled properly
            if (empty($data['username'])) {
                //echo("Must fill all the fields in the form!");
                $data['username_err'] = "*Username field is Required";

                // print_r ($data);
                // exit;
            }

            if (empty($data['name'])) {
                $data['name_err'] =  "*Name field is Required";
                // print_r ($data);
                // exit;
            }

            if (empty($data['address'])) {
                $data['address_err'] = "*Address field is Required";
                // print_r ($data);
                // exit;
            }

            if (empty($data['contact'])) {
                $data['contact_err'] = "*Contact field is Required";
                // print_r ($data);
                // exit;
            }

            //Check whether an account already exists with the provided username
            if ($this->studentModel->findUserByUsername($username)) {
                //echo("This Username is already taken");
                if ($username == Session::get('username')) {
                    $data['username_err'] = "";
                } else {
                    $data['username_err'] = "*This Username is already taken";
                }

                //die();
            }

            //Check the mobile number
            if (strlen($contact) != 10) {
                //echo 'Invalid Contact Number';
                $data['contact_err'] = "*Invalid Contact Number";
                //die();
            }

            // print_r ($data);
            //     exit;
            //Make sure there are no error flags are set
            if (empty($data['username_err']) && empty($data['name_err'])  && empty($data['contact_err']) && empty($data['address_err'])) {

                // print_r ($data);
                //  exit;

                $res = $this->studentModel->updateProfileDetails($data, Session::get('userID'));

                if ($res) {
                    FlashMessage::flash('update_profile_flash', "Successfully Updated Your Profile Details!", "success");
                    Session::set('username', $username);
                    Student::home();
                } else {
                    //Error Notification
                    echo 'Error: Something went wrong in adding post to the databse';
                    Student::home();
                    die();
                }
            } else {
                $id =   Session::get('userID');
                $row = $this->studentModel->getProfile($id);
                $data['userDetails'] = $this->studentModel->getProfile($id);
                $this->loadview('student_dashboard/profile', $data);
            }
        } else {
            $id =   Session::get('userID');
            $row = $this->studentModel->getProfile($id);
            $data = [
                'userDetails' => $this->studentModel->getProfile($id),
                'name_err' => '',
                'username_err' => '',
                'address_err' => '',
                'contact_err' => ''
            ];
            $this->loadview('student_dashboard/profile', $data);
        }
    }

    public function give_feedback()
    {
        $reason = trim($_POST['rdesc']);
        $feedback_id = substr(sha1(date(DATE_ATOM)), 0, 8);
        $user = Session::get('userID');
        $nameObj = $this->userModel->getUserDetails($user);
        $name = $nameObj->fullname;
        //split name into fname and lname
        $fname = explode(" ", $name)[0];
        $lname = explode(" ", $name)[1];
        $email = $nameObj->email;
        $data = [
            'feedback_id' => $feedback_id,
            'email' => $email,
            'reason' => $reason,
            'fname' => $fname,
            'lname' => $lname,
        ];
        if ($this->userModel->addSystemFeedback($data)) {
            FlashMessage::flash('system_feedback_flash', "Thank you for your valuable feedback!", "success");
            Student::home();
        } else {
            FlashMessage::flash('system_feedback_flash', "Sorry, Failed!", "error");
            Student::home();
        };
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
                    Student::home();
                } else {
                    $this->loadView('student_dashboard/changePW', $data);
                }
            }
        } else {
            $data = [
                'currentPW' => '',
                'password' => '',
                'confirmPW' => '',
                'currentPW_err' => '',
                'password_err' => '',
                'confirmPW_err' => '',
            ];
            $this->loadView('student_dashboard/changePW', $data);
        }
    }

    public function get_event_data()
    {
        if ($_GET['filter'] == 'this') {
            $today = date('Y-m-d');
            $user = Session::get('userID');
            $init_data = [
                'monday' => date('Y-m-d', strtotime('monday this week', strtotime($today))),
                'tuesday' => date('Y-m-d', strtotime('tuesday this week', strtotime($today))),
                'wednesday' => date('Y-m-d', strtotime('wednesday this week', strtotime($today))),
                'thursday' => date('Y-m-d', strtotime('thursday this week', strtotime($today))),
                'friday' => date('Y-m-d', strtotime('friday this week', strtotime($today))),
                'saturday' => date('Y-m-d', strtotime('saturday this week', strtotime($today))),
                'sunday' => date('Y-m-d', strtotime('sunday this week', strtotime($today))),
            ];


            $data = [
                'monday' => json_encode($this->taskModel->getStudyTime($init_data['monday'], $user)),
                'tuesday' => json_encode($this->taskModel->getStudyTime($init_data['tuesday'], $user)),
                'wednesday' => json_encode($this->taskModel->getStudyTime($init_data['wednesday'], $user)),
                'thursday' =>  json_encode($this->taskModel->getStudyTime($init_data['thursday'], $user)),
                'friday' => json_encode($this->taskModel->getStudyTime($init_data['friday'], $user)),
                'saturday' => json_encode($this->taskModel->getStudyTime($init_data['saturday'], $user)),
                'sunday' => json_encode($this->taskModel->getStudyTime($init_data['sunday'], $user)),
            ];
        } else if($_GET['filter'] == '14'){
            $today = date('Y-m-d');
            $user = Session::get('userID');
            $init_data = [];
            for ($i = 0; $i < 14; $i++) {
                $pastDate = date('Y-m-d', strtotime("-$i days", strtotime($today)));
                $init_data[] = $pastDate;
            }

            $data = [];
            foreach ($init_data as $date) {
                $data[$date] = json_encode($this->taskModel->getStudyTime($date, $user));
            }
        }else{
            $today = date('Y-m-d');
            $user = Session::get('userID');
            $init_data = [];
            for ($i = 0; $i < 30; $i++) {
                $pastDate = date('Y-m-d', strtotime("-$i days", strtotime($today)));
                $init_data[] = $pastDate;
            }

            $data = [];
            foreach ($init_data as $date) {
                $data[$date] = json_encode($this->taskModel->getStudyTime($date, $user));
            }
        }


        $res = json_encode($data);
        echo $res;
    }
}
