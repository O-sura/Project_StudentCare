<?php
Session::init();
class Appointments extends Controller
{

    private $appointmentModel;
    public function __construct()
    {
        $this->appointmentModel = $this->loadmodel('Appointment');
    }



    public function index()
    {

        $this->loadview('counselor_stu/index');
    }

//Function to load the counselor list view
    public function list()
    {
        
        $data = [
            'counselors' => $this->appointmentModel->getAllCounselorDetails()
        ];
        $this->loadview('counselor_stu/counselorList',$data);
    }

    public function requests(){
        $this->loadview('counselor_stu/requests');
    }

    public function profile($counselorId)
    {
        $init_data=[
            'counselorID' => $counselorId
        ];

        $data = [
            'counselorId'=>$counselorId,
            'counselorProfile' => $this->appointmentModel->getProfile($init_data),
            'qualifications' => $this->appointmentModel->getQualifications($init_data)
        ];
        
        $this->loadview('counselor_stu/counselorsProfile',$data);
    }

    public function add_request($counselorId){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $init_data = [
            'requestDate' => trim($_POST['rdate']),
            'requestTime' => trim($_POST['rtime']),
            'requestDescription' => trim($_POST['rdesc']),
            'counselorID' => $counselorId,
            'studentID' => Session::get('userID'),
            'requestStatus'=> 0, //0 means request is still pending
            
        ];
        if ($this->appointmentModel->addRequest($init_data)) {
            
            Appointments::profile($counselorId);
        } else {
            die('Something went wrong');
        }
    }





}
