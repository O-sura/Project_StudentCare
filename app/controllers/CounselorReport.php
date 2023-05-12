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

            // $res = $this->counselorModel->getAllAppointments($usr);
            // $arrayResult = json_decode($res,true);

            // $monthRes = $this->counselorModel->getAppointmentForMonth($usr);

            // // CounselorReport::appMonthStats();
            // // exit;



            // $pending = 0;
            // $completed = 0;
            // $requested = 0;
            // $cancelled = 0;
            // $all = 0;

            // for ($i = 0; $i < count($arrayResult); $i++) {
            //   $appStatus = $arrayResult[$i]['appointmentStatus'];
            //   $appCount = $arrayResult[$i]['count'];
            
            //   if ($appStatus == 0) {
            //     $pending = $appCount;
            //   } else if ($appStatus == 1) {
            //     $completed = $appCount;
            //   } else if ($appStatus == 2) {
            //     $requested = $appCount;
            //   } else if ($appStatus == 3) {
            //     $cancelled = $appCount;
            //   }
            // }

            // $all = $pending+$completed+$requested+$cancelled;
           
            
            // $data = [
            //     'pending' => $pending,
            //     'completed' => $completed,
            //     'requested' => $requested,
            //     'cancelled' => $cancelled,
            //     'all' => $all
            // ];

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


    }



?>