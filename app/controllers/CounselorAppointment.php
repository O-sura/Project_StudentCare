<?php
    Session::init();
    class CounselorAppointment extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');

            $this->postModel = $this->loadModel('Counselor');
        }
        
        public function index(){

            $data = [
                'stuID' => '',
                'stuName' => '',
                'appDate' => '',
                'appTime' => '',
                'desc' => '',
                'stuID_err' => '',
                'stuName_err' => '',
                'appDate_err' => '',
                'appTime_err' => '',
                'desc_err' => ''
            ];
            
            $this->loadView('counselor/appointment',$data);
        }

        public function home(){
            
            $data = [
                'stuID' => '',
                'stuName' => '',
                'appDate' => '',
                'appTime' => '',
                'desc' => '',
                'stuID_err' => '',
                'stuName_err' => '',
                'appDate_err' => '',
                'appTime_err' => '',
                'desc_err' => ''
            ];

            $this->loadView('counselor/appointment',$data);
        }

        public function dailyAppointment(){

            $data = [
                
            ];

            $this->loadView('counselor/appointmentsDaily',$data);
        }

        public function createAppointment(){

            $userid = Session::get('userID');

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data = [

                    'stuID' => $_POST['stuID'],
                    'stuName' => $_POST['stuName'],
                    'appDate' => $_POST['appDate'],
                    'appTime' => $_POST['appTime'],
                    'desc' => trim($_POST['desc']),
                    'stuID_err' => '',
                    'stuName_err' => '',
                    'appDate_err' => '',
                    'appTime_err' => '',
                    'desc_err' => ''

                ];

                //validate studentID
                if(empty($data['stuID'])){
                    $data['stuID_err'] = 'StudentID is required';
                }

                //validate student nama
                if(empty($data['stuName'])){
                    $data['stuName_err'] = 'Student Name is required';
                }

                //validate appointment date
                if(empty($data['appDate'])){
                    $data['appDate_err'] = 'Appointment date is required';
                }

                //validate appointment time
                if(empty($data['appTime'])){
                    $data['appTime_err'] = 'Appointment time is required';
                }

                //valiate appointment description
                if(empty($data['desc'])){
                    $data['desc_err'] = 'Appointment description is required';
                }

                if(empty($data['stuID_err']) && empty($data['stuName_err']) && empty($data['appDate_err']) && empty($data['appTime_err']) && empty($data['desc_err'])){

                    if($this->postModel->addAppointment($data,$userid)){
                        FlashMessage::flash('appointment_add_flash', "Appointment Successfully Added!", "success");
                        Middleware::redirect('CounselorAppointment');
                    }
                    else{
                        die('Something went wong');
                    }
                }
                else{
                    $this->loadView('counselor/appointment',$data);
                }


            }




        }

       

    }

?>


