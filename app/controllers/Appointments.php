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
        $id = Session::get('userID');
        $data = [
            'appointments' => $this->appointmentModel->getAllAppointments($id)
        ];
        $this->loadview('counselor_stu/index',$data);
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

        $data = [
            'pendingRequests' => $this->appointmentModel->getPendingRequests(Session::get('userID')),
            'acceptedRequests' => $this->appointmentModel->getAcceptedRequests(Session::get('userID')),
            'rejectedRequests' => $this->appointmentModel->getRejectedRequests(Session::get('userID')),
            'pendingCount' => $this->appointmentModel->getPendingRequestsCount(Session::get('userID')),
            'acceptedCount' => $this->appointmentModel->getAcceptedRequestsCount(Session::get('userID')),
            'rejectedCount' => $this->appointmentModel->getRejectedRequestsCount(Session::get('userID'))
        ];

        $this->loadview('counselor_stu/requests',$data);
    }

    public function profile($counselorId)
    {
        $init_data=[
            'counselorID' => $counselorId,
            'studentID' => Session::get('userID')
        ];

        $data = [
            'counselorId'=>$counselorId,
            'counselorProfile' => $this->appointmentModel->getProfile($init_data),
            'qualifications' => $this->appointmentModel->getQualifications($init_data),
            'hasRequested' => $this->appointmentModel->hasRequested($init_data),
            'requestLimit' => $this->appointmentModel->requestLimit($init_data)
        ];
        
        $this->loadview('counselor_stu/counselorsProfile',$data);
    }

    public function add_request($counselorId){
        if($_SERVER['REQUEST_METHOD'] == 'POST')    {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $init_data = [
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
        }else{
            $data = [
                'counselorId'=>$counselorId,
                'hasRequested' => $this->appointmentModel->hasRequested($counselorId),
                'requestLimit' => $this->appointmentModel->requestLimit($counselorId)
            ];
            $this->loadview('counselor_stu/addRequest',$data);
        }

    }

    public function delete_request($requestId){
        if($this->appointmentModel->deleteRequest($requestId)){
            Appointments::requests();
        }else{
            die('Something went wrong');
        }
    }

    public function counselor_handler(){
        if(isset($_GET['counselorID'])){
            $id = trim($_GET['counselorID']);
            $init_data = [
                'counselorID' => $id
            ];
            $res =  json_encode($this->appointmentModel->getProfile($init_data));
           
        
            echo $res;
        }

    }




}
