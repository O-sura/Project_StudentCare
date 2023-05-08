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
        //get the unseen appointment ids
        $init_data = [
            'newAppointments' => $this->appointmentModel->getUnseenAppointments($id)
        ];
        //set all the appointments as seen by user
        $this->appointmentModel->updateAppointmentSeen($id);
        $data = [
            'appointments' => $this->appointmentModel->getAllAppointments($id),
            'newAppointments' => $init_data['newAppointments'],
            'cancelledAppointments' => $this->appointmentModel->getCancelledAppointments($id)
        ];
        $this->loadview('counselor_stu/index', $data);
    }

    public function cancel_appointment($appointmentID)
    { 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $init_data = [
            'reason' => trim($_POST['rdesc']),
            'appointmentID' => $appointmentID,
            'appointmentStatus' => 2, //2 means cancelled
            'cancelledDate' => date('Y-m-d H:i:s')
        ];

        if ($this->appointmentModel->cancelAppointment($init_data)) {
            Appointments::index();
        } else {
            die('Something went wrong');
        }
    }

    public function list()
    {

        $data = [
            'counselors' => $this->appointmentModel->getAllCounselorDetails()
        ];
        $this->loadview('counselor_stu/counselorList', $data);
    }

    public function requests()
    {

        $user_id = Session::get('userID');
        //get the unseen requset ids
        $init_data = [
            'newRequests' => $this->appointmentModel->getUnseenRequests($user_id)
        ];
        //mark all the requests as seen by user
        $this->appointmentModel->updateSeen($user_id);

        $data = [
            'pendingRequests' => $this->appointmentModel->getPendingRequests(Session::get('userID')),
            'acceptedRequests' => $this->appointmentModel->getAcceptedRequests(Session::get('userID')),
            'rejectedRequests' => $this->appointmentModel->getRejectedRequests(Session::get('userID')),
            'pendingCount' => $this->appointmentModel->getPendingRequestsCount(Session::get('userID')),
            'acceptedCount' => $this->appointmentModel->getAcceptedRequestsCount(Session::get('userID')),
            'rejectedCount' => $this->appointmentModel->getRejectedRequestsCount(Session::get('userID')),
            'newRequests' => $init_data['newRequests']
        ];

        $this->loadview('counselor_stu/requests', $data);
    }

    public function profile($counselorId)
    {
        $init_data = [
            'counselorID' => $counselorId,
            'studentID' => Session::get('userID')
        ];

        $data = [
            'counselorId' => $counselorId,
            'counselorProfile' => $this->appointmentModel->getProfile($init_data),
            'hasRequested' => $this->appointmentModel->hasRequested($init_data),
            'requestLimit' => $this->appointmentModel->requestLimit($init_data)
        ];

        $this->loadview('counselor_stu/counselorsProfile', $data);
    }

    public function add_request($counselorId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $init_data = [
                'requestDescription' => trim($_POST['rdesc']),
                'counselorID' => $counselorId,
                'studentID' => Session::get('userID'),
                'requestStatus' => 0, //0 means request is still pending

            ];
            if ($this->appointmentModel->addRequest($init_data)) {

                Appointments::profile($counselorId);
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'counselorId' => $counselorId,
                'hasRequested' => $this->appointmentModel->hasRequested($counselorId),
                'requestLimit' => $this->appointmentModel->requestLimit($counselorId)
            ];
            $this->loadview('counselor_stu/addRequest', $data);
        }
    }

    public function delete_request($requestId)
    {
        if ($this->appointmentModel->deleteRequest($requestId)) {
            Appointments::requests();
        } else {
            die('Something went wrong');
        }
    }

    public function counselor_handler()
    {
        if (isset($_GET['counselorID'])) {
            $id = trim($_GET['counselorID']);
            $init_data = [
                'counselorID' => $id
            ];
            $res =  json_encode($this->appointmentModel->getProfile($init_data));


            echo $res;
        }
    }

    public function editRequest($requestID){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $init_data = [
                'requestDescription' => trim($_POST['rdesc']),
                'requestID' => $requestID
            ];
            if($this->appointmentModel->editRequest($init_data)){
                Appointments::requests();
            }else{
                die('Something went wrong');
            }
        }else{
            $data = [
                'requestDetails' => $this->appointmentModel->getRequestDetails($requestID)
            ];
            $this->loadview('counselor_stu/editRequest', $data);
        }
    }

    public function undoCancellation(){
     
        $appointmentID = trim($_GET['id']);
        if($this->appointmentModel->undoCancellation($appointmentID)){
            Appointments::index();
        }else{
            die('Something went wrong');
        }
    }

    public function counselor_type_handler()
    {
        if (isset($_GET['filter'])) {
            $specialization = trim($_GET['filter']);
            if($specialization == 'All'){
                $res = json_encode($this->appointmentModel->getAllCounselorDetails());
            }else{
                $res =  json_encode($this->appointmentModel->getCounselorsByType($specialization));
            }


            echo $res;
        }
    }

    public function counselor_search_handler()
    {
        if (isset($_GET['query'])) {
            $search = trim($_GET['query']);
            $type = trim($_GET['type']);
           
            $res =  json_encode($this->appointmentModel->getCounselorsBySearch($search, $type));
            

            echo $res;
        }
    }
}
