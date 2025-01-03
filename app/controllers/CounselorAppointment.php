<?php
Session::init();
class CounselorAppointment extends Controller
{

    private $counselorModel;

    public function __construct()
    {
        Middleware::authorizeUser(Session::get('userrole'), 'counsellor');

        $this->counselorModel = $this->loadModel('Counselor');
    }

    public function index()
    {

        $data = [
            'stuID' => '',
            'stuName' => '',
            'appDate' => '',
            'appTime' => '',
            'desc' => '',
            'descC' => '',
            'stuID_err' => '',
            'stuName_err' => '',
            'appDate_err' => '',
            'appTime_err' => '',
            'desc_err' => '',
            'descC_err' => '',
        ];

        $this->loadView('counselor/appointment', $data);
    }

    public function home()
    {

        $userid = Session::get('userID');

        $data = [
            'stuID' => '',
            'stuName' => '',
            'appDate' => '',
            'appTime' => '',
            'desc' => '',
            'descC' => '',
            'stuID_err' => '',
            'stuName_err' => '',
            'appDate_err' => '',
            'appTime_err' => '',
            'desc_err' => '',
            'descC_err' => '',
        ];

        $this->loadView('counselor/appointment', $data);
    }

    //show daily appointments
    public function dailyAppointment($appdate = null)
    {

        $userid = Session::get('userID');

        $newdate = isset($_POST['date']) ? $_POST['date'] : $appdate;

        $init_data = [
            'taskDate' => $newdate,
        ];

        //to get the appointment details
        $row = $this->counselorModel->getAppointmentsDetails($init_data['taskDate'], $userid);

        $data = [

            'day' => date('l', strtotime($init_data['taskDate'])),
            'dayNum' => date('d', strtotime($init_data['taskDate'])),
            'dayYear' => date('Y', strtotime($init_data['taskDate'])),
            'descC' => '',
            'row' => $row,
            'descC_err' => '',

        ];

        $this->loadView('counselor/appointmentsDaily', $data);
    }

    //create an appointmeent
    public function createAppointment()
    {

        $userid = Session::get('userID');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [

                'meetingID' => substr(sha1(date(DATE_ATOM)), 0, 15),
                'stuID' => $_POST['stuID'],
                'stuName' => $_POST['stuName'],
                'appDate' => $_POST['appDate'],
                'appTime' => date('H:i:s', strtotime($_POST['appTime'])),
                'desc' => trim($_POST['desc']),
                'stuID_err' => '',
                'stuName_err' => '',
                'appDate_err' => '',
                'appTime_err' => '',
                'desc_err' => '',

            ];

            //to check whether new appointing person already has an appointment on that day
            $personCheck = $this->counselorModel->checkForSamePersonApp($data, $userid);
            $personCheckCount = json_decode($personCheck, true);

            $x = $personCheckCount['appointmentStatus'];
            // echo $x;
            // exit;

            if ($personCheckCount['COUNT(studentID)'] == 1 && $x != 3) {
                $data['stuID_err'] = 'This student already has an appointment on that day';
            }

            //Check whether maximum time allocating slots are filled or not
            $appDayCountObject = $this->counselorModel->countDayAppointments($data);
            $appDayCount = json_decode($appDayCountObject, true);

            if ($appDayCount['COUNT(appointmentDate)'] == 5) {
                $data['appDate_err'] = 'Time slots are already filled. Choose another day';
            }

            //have to check whether the student is in counselors' accepted list
            $inList = $this->counselorModel->checkStudentForCounselor($userid, $data['stuID']);
            if ($inList == false) {
                $data['stuID_err'] = 'This student is not under you';
                $data['stuName_err'] = 'This student is not under you';
            }

            //check the inserted time is between following times
            $timediff = 30;

            $addtimes = new DateTime($data['appTime']);
            $addtimes->add(new DateInterval('PT' . $timediff . 'M'));
            $afterTime = $addtimes->format('H:i:s');

            $reducetimes = new DateTime($data['appTime']);
            $reducetimes->sub(new DateInterval('PT' . $timediff . 'M'));
            $beforeTime = $reducetimes->format('H:i:s');

            $getdate = $this->counselorModel->checkTime($data, $afterTime, $beforeTime);
            $getdateC = json_decode($getdate, true);

            //check whether requested time can allocate or not
            if ($getdateC['COUNT(appointmentTime)'] == 1) {
                $data['appTime_err'] = 'Requested time is already allocated, choose another time';
            }

            //check wether to be appointment date is a passed day or not
            $currdate = date('Y-m-d');
            if ($data['appDate'] < $currdate) {
                $data['appDate_err'] = 'You cannot pick already past days';
            }

            //to add an appointment on current date

            // Set the default timezone to your timezone
            date_default_timezone_set('Asia/Kolkata');
            $currtime = date('H:i');

            if ($data['appTime'] <= $currtime && $data['appDate'] == $currdate) {
                $data['appTime_err'] = 'Please pick a time after 15 minutes from current time';
            }

            //validate studentID
            if (empty($data['stuID'])) {
                $data['stuID_err'] = 'StudentID is required';
            }

            //validate student nama
            if (empty($data['stuName'])) {
                $data['stuName_err'] = 'Student Name is required';
            }

            //validate appointment date
            if (empty($data['appDate'])) {
                $data['appDate_err'] = 'Appointment date is required';
            }

            //validate appointment time
            if (empty($data['appTime'])) {
                $data['appTime_err'] = 'Appointment time is required';
            }

            //validate appointment description
            if (empty($data['desc'])) {
                $data['desc_err'] = 'Appointment description is required';
            }

            if (empty($data['stuID_err']) && empty($data['stuName_err']) && empty($data['appDate_err']) && empty($data['appTime_err']) && empty($data['desc_err'])) {

                if ($this->counselorModel->addAppointment($data, $userid)) {

                    $loggedUser = $this->counselorModel->getCounselorProfile($userid); //to get the related counselor details
                    $user = $this->counselorModel->getstudentforemail($data['stuID']); //to get the related student detils

                    //to send an email to the related student informing about the session
                    $subject = 'Link for the Counseling Session';
                    $body = 'Please click the below link to logging to the session.<br> <a href=http://localhost:3000/' . $data['meetingID'] . '>Join in</a>
                                <br> Counselor Name : ' . $loggedUser->fullname . '<br> Date : ' . $data['appDate'] . '<br> Time : ' . $data['appTime'];
                    $altbody = 'Counselor Name : ' . $user->fullname . '<br> Date : ' . $data['appDate'] . '<br> Time : ' . $data['appTime'];
                    $res = sendMail($user->email, $subject, $body, $altbody);

                    FlashMessage::flash('appointment_add_flash', "Appointment Successfully Added!", "success");
                    Middleware::redirect('CounselorAppointment');
                } else {
                    die('Something went wong');
                }
            } else {
                $this->loadView('counselor/appointment', $data);
            }

        }

    }

    //cancel an appointment
    public function cancellationOfAppointment()
    {

        $appdate = $_GET['appdate'];

        $appID = $_GET['appID'];

        $userid = Session::get('userID');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['submit'])) {

                $data = [
                    'descC' => trim($_POST['descC']),
                    'appdate' => $appdate,
                    'descC_err' => '',

                ];

                if (empty($data['descC_err'])) {

                    if ($this->counselorModel->cancelAppointment($data['descC'], $appID, $appdate, $userid)) {

                        FlashMessage::flash('appointment_cancel_flash', "Appointment Cancelled!", "success");
                        CounselorAppointment::dailyAppointment($appdate);

                    } else {
                        die('Something went wong');
                    }

                }
            }

        }
    }

    //mark an appointment as completed
    public function completeAppointment()
    {

        $appdate = $_GET['appdate'];

        $appID = $_GET['appID'];

        $this->counselorModel->completeAppointmentUpdate($appdate, $appID);

        CounselorAppointment::dailyAppointment($appdate);

    }

    //load the student profile after clicking the appointment of the student
    public function selectAppointedStudent()
    {

        $this->counselorModel = $this->loadModel('Counselor');

        if (isset($_POST['gotStu'])) {

            $gotStu = $_POST['gotStu'];
            $gotDate = $_POST['gotDate'];

            $result = $this->counselorModel->getAppointedStudent($gotStu, $gotDate);

            echo json_encode($result);
        }

    }

    //to color the appointed dates
    public function makeColoredAppointedDates()
    {
        $userid = Session::get('userID');
        $appDates = $this->counselorModel->getAppointmentDates($userid);
        $dates = array();
        foreach ($appDates as $object) {
            $dates[] = $object->appointmentDate;
        }

        echo json_encode($dates);

    }

}
