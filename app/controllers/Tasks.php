<?php
class Tasks extends Controller
{

    private $taskModel;
    public function __construct()
    {
        
        $this->taskModel = $this->loadmodel('Task');
        
    }

    public function index()
    {
        $init_data = [
            'scheduleID' => 1
        ];

        $data = [
            'taskDates' => $this->taskModel->getTaskDates($init_data)
        ];

        $array = $data['taskDates'];
        $dates = array();
        foreach ($array as $object) {
            $dates[] = $object->task_date;
        }

        $data = [
            'taskDates' => $dates,
            'notStarted' => $this->taskModel->getNotStartedToday($init_data),
            'inProgress' => $this->taskModel->getStartedToday($init_data),
            'all' => $this->taskModel->getAllToday($init_data),
        ];

        $this->loadview('tasks/index', $data);
    }

    public function weekly()
    {
        $today = date('Y-m-d');
        $data = [
            'taskDate' => $today
        ];

        $data = [
            'monday' => date('Y-m-d', strtotime('monday this week', strtotime($data['taskDate']))),
            'tuesday' => date('Y-m-d', strtotime('tuesday this week', strtotime($data['taskDate']))),
            'wednesday' => date('Y-m-d', strtotime('wednesday this week', strtotime($data['taskDate']))),
            'thursday' => date('Y-m-d', strtotime('thursday this week', strtotime($data['taskDate']))),
            'friday' => date('Y-m-d', strtotime('friday this week', strtotime($data['taskDate']))),
            'saturday' => date('Y-m-d', strtotime('saturday this week', strtotime($data['taskDate']))),
            'sunday' => date('Y-m-d', strtotime('sunday this week', strtotime($data['taskDate']))),
            'today' => date('Y-m-d', strtotime($data['taskDate'])),
        ];

        $data = [
            'monday' => $data['monday'],
            'tuesday' => $data['tuesday'],
            'wednesday' => $data['wednesday'],
            'thursday' => $data['thursday'],
            'friday' => $data['friday'],
            'saturday' => $data['saturday'],
            'sunday' => $data['sunday'],
            // 'today' => date('Y-m-d', strtotime($data['taskDate'])),
            'mondayTasks' => $this->taskModel->getWeekly($data['monday']),
            'tuesdayTasks' => $this->taskModel->getWeekly($data['tuesday']),
            'wednesdayTasks' => $this->taskModel->getWeekly($data['wednesday']),
            'thursdayTasks' => $this->taskModel->getWeekly($data['thursday']),
            'fridayTasks' => $this->taskModel->getWeekly($data['friday']),
            'saturdayTasks' => $this->taskModel->getWeekly($data['saturday']),
            'sundayTasks' => $this->taskModel->getWeekly($data['sunday']),
        ];


        $this->loadview('tasks/weeklyView', $data);
    }


    public function view()
    {
        $init_data = [
            'scheduleID' => 1,
            'taskDate' => trim($_POST['date']),
        ];

        $data = [
            'notStarted' => $this->taskModel->getNotStarted($init_data),
            'started' => $this->taskModel->getStarted($init_data),
            'completed' => $this->taskModel->getCompleted($init_data),
            'all' => $this->taskModel->getAll($init_data),
            'day' => date('l', strtotime($init_data['taskDate'])),
            'dayNum' => date('d', strtotime($init_data['taskDate'])),
        ];


        $this->loadview('tasks/viewTask', $data);
    }

 


    public function today()
    {
        $today = date('Y-m-d');
        $init_data = [
            'scheduleID' => 1,
            'taskDate' => $today,
        ];

        $data = [
            'notStarted' => $this->taskModel->getNotStarted($init_data),
            'started' => $this->taskModel->getStarted($init_data),
            'completed' => $this->taskModel->getCompleted($init_data),
            'all' => $this->taskModel->getAll($init_data),
            'day' => date('l', strtotime($init_data['taskDate'])),
            'dayNum' => date('d', strtotime($init_data['taskDate'])),
        ];



        $this->loadview('tasks/viewTask', $data);
    }


    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $init_data = [
                'taskName' => trim($_POST['tname']),
                'taskOMODate' => trim($_POST['tdate']),
                'taskTime' => trim($_POST['ttime']),
                'setReminder' => trim($_POST['reminder']),
                'taskcolor' => trim($_POST['tcolor']),
                'taskStatus' => 'not started',
                'scheduleID' => 1,
                'reminderDate' => '',
                'reminderTime' => '',
                'taskDate' => ''
            ];
            if ($this->taskModel->addTask($init_data)) {
                $task_id = $this->taskModel->getLastID();
                if ($init_data['setReminder'] == 1) {
                    $data = [
                        'taskID' => $task_id->task_id,
                        'reminderDate' => trim($_POST['rdate']),
                        'reminderTime' => trim($_POST['rtime']),
                        'taskDate' => $init_data['taskDate']
                    ];
                    $this->taskModel->addReminder($data);
                }
                Middleware::redirect('tasks/');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'scheduleID' => 1,
                'setReminder' => 0,
            ];


            $this->loadview('tasks/addTask', $data);
        }
    }
}
