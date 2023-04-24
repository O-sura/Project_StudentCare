<?php
Session::init();
class Student extends Controller
{
    private $studentModel;
    public function __construct()
    {
        Middleware::authorizeUser(Session::get('userrole'), 'student');
        $this->studentModel = $this->loadmodel('Student_model');
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
            $folder =  PUBLICPATH . "img/student/" . $filename;



            if (move_uploaded_file($tempname, $folder)) {
            } else if (empty($filename) && empty($tempname)) {
                $filename = $row->profile_img;
                $folder = PUBLICPATH . "img/student/" . $filename;
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
}
