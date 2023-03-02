<?php
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

    public function profile()
    {
        $this->loadview('counselor_stu/counselorsProfile');
    }
}
