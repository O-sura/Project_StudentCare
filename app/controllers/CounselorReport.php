<?php
    Session::init();
    class CounselorReport extends Controller{

        private $counselorModel;

        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
            $this->counselorModel = $this->loadModel('Counselor');
        }
        
        public function index(){

            $data = [];
            
            $this->loadView('counselor/reports',$data);
        }

        public function home(){

            $usr = Session::get('userID');

            $data = [];

            $this->loadView('counselor/reports',$data);
        }

        //to set values to the tiles in report page
        public function appMonthStatsForTiles(){

            $usr = Session::get('userID');
            $month = $_GET['month'];
            $year = $_GET['year'];
            $monthRes = $this->counselorModel->getAllAppointments($usr,$month,$year);

            echo $monthRes;

        }

        //to create the bar chart
        public function appMonthStats(){

            $usr = Session::get('userID');
            $month = $_GET['month'];
            $year = $_GET['year'];
           
            $monthResChart = $this->counselorModel->getAppointmentForMonth($usr,$month,$year);

            echo $monthResChart;
        }


        //for the report generation
        public function generatingReport(){

            $usr = Session::get('userID');
            //$usrname = Session::get('username');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $year = $_POST['year'];
                $month = $_POST['month'];

                $usrDetails = $this->counselorModel->getUserDetails($usr);
                

                $monthAppointmentDetails = $this->counselorModel->getMonthlyAppointmentStats($usr,$year,$month);

                $countApp = $this->counselorModel->getAllAppointments($usr,$month,$year);
                //$countAppointments = json_decode($countApp,true);


                // to get the appointment count based on the status
                $completedAppointments = $this->counselorModel->getCompletedAppointmentCount($usr,$month,$year);
                $pendingAppointments = $this->counselorModel->getPendingAppointmentCount($usr,$month,$year);
                $cancelledAppointments = $this->counselorModel->getCancelledAppointmentCount($usr,$month,$year);
                $requestedAppointments = $this->counselorModel->getRequestedAppointmentCount($usr,$month,$year);

                //to get total appointments
                $allAppointmentCount = $completedAppointments->count + $pendingAppointments->count + $cancelledAppointments->count + $requestedAppointments->count;
                
                //to get student count
                $studentCount = $this->counselorModel->getStudentCount($usr);

                // to get the students who had appointments in particular month
                $appointedStudentsForMonth = $this->counselorModel->getStudentsWhoHadAppointments($usr,$month,$year);

                $data = [
                    'name' => $usrDetails->fullname,
                    'username' =>$usrDetails->username,
                    'student_count' => $studentCount->count,
                    'sessions' => $allAppointmentCount,
                    'cancelled_count' => $cancelledAppointments->count,
                    'completed_count' => $completedAppointments->count,
                    'meeting_details' => $this->getDataArray($monthAppointmentDetails),
                    'student_details' => $this->getDataArray($appointedStudentsForMonth)
                ];

                generatePDF('counselor',$data);

            }
        }

        //to convert array elements into needed way
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


    }



?>