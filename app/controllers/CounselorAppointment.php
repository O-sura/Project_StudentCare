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

        //show daily appointments
        public function dailyAppointment(){

            $userid = Session::get('userID');



            $init_data = [
                'scheduleID' => 1,
                'taskDate' => trim($_POST['date']),
            ];

            $row = $this->postModel->getAppointmentsDetails($init_data['taskDate'],$userid);
           

            $data = [

                'day' => date('l', strtotime($init_data['taskDate'])),
                'dayNum' => date('d', strtotime($init_data['taskDate'])),
                'row' => $row,
                
            ];

            $this->loadView('counselor/appointmentsDaily',$data);
        }

        //create an appointmeent
        public function createAppointment(){

            $userid = Session::get('userID');

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data = [


                    'meetingID' => substr(sha1(date(DATE_ATOM)), 0, 15),
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


                //check the inserted time is between following times
                $timediff = 30;
            
                $addtimes = new DateTime($data['appTime']);
                $addtimes->add(new DateInterval('PT'.$timediff.'M')); 
                $afterTime = $addtimes->format('H:i:s');

                $reducetimes = new DateTime($data['appTime']);
                $reducetimes->sub(new DateInterval('PT'.$timediff.'M'));
                $beforeTime = $reducetimes->format('H:i:s');

                $getdate = $this->postModel->checkTime($data,$afterTime,$beforeTime);
                $getdateC = json_decode($getdate,true);

                // echo $getdateC['COUNT(appointmentTime)']."<br>";
                // echo $getdateC['appointmentID']."<br>";
                // echo "hello";
                // exit;

                //check whether requested time can allocate or not
                if($getdateC['COUNT(appointmentTime)'] == 1){
                    $data['appTime_err'] = 'Requested time is already allocated, choose another time';
                }


                //Check whether maximum time allocating slots are filled or not
                $appDayCountObject = $this->postModel->countDayAppointments($data);
                $appDayCount = json_decode($appDayCountObject,true);

                if($appDayCount['COUNT(appointmentDate)'] == 5){
                    $data['appDate_err'] = 'Time slots are already filled. Choose another day';
                }

                //check wether to be appointment date is a passed day or not
                $currdate = date('Y-m-d');
                if($data['appDate'] < $currdate){
                    $data['appDate_err'] = 'You cannot pick already passed days';
                }

                // echo $currdate;
                // exit;


                if(empty($data['stuID_err']) && empty($data['stuName_err']) && empty($data['appDate_err']) && empty($data['appTime_err']) && empty($data['desc_err'])){

                    if($this->postModel->addAppointment($data,$userid)){


                        $loggedUser = $this->postModel->getCounselorProfile($userid);   //to get the related counselor details
                        $user = $this->postModel->getstudentforemail($data['stuID']);   //to get the related student detils

                        //to send an email to the related student informing about the session
                        $subject = 'Link for the Counseling Session';
                        $body = 'Please click the below link to logging to the session.<br> <a href=http://localhost/3000'.$data['meetingID'].'>Join in</a>
                                <br> Counselor Name : '.$loggedUser->fullname.'<br> Date : '.$data['appDate'].'<br> Time : '.$data['appTime'] ;
                        $altbody = 'Counselor Name : '.$user->fullname.'<br> Date : '.$data['appDate'].'<br> Time : '.$data['appTime'];
                        $res = sendMail($user->email,$subject,$body,$altbody);

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


        //load the student profile after clicking the appointment of the student
        public function selectAppointedStudent(){

            $this->postModel = $this->loadModel('Counselor');

            if(isset($_POST['gotStu'])){
                

                $gotStu = $_POST['gotStu'];

                // echo $gotStu;
                // exit;

                $result = $this->postModel->getstudentforemail($gotStu);

                echo json_encode($result);
            }

        }

       

    }

?>


