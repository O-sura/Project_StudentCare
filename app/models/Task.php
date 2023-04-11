<?php
class Task
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getNotStarted($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_status = 'not started' AND task_date = :taskDate");
        //$this->db->bind(':scheduleID', $data['scheduleID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getNotStartedToday($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_status = 'not started' AND task_date = :taskDate");
        //$this->db->bind(':scheduleID', $data['scheduleID']);
        $today = date('Y-m-d');
        $this->db->bind(':taskDate', $today);
        $results = $this->db->getAllRes();

        return $results;
    }


    public function getStarted($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_status = 'started' AND task_date = :taskDate");
       // $this->db->bind(':scheduleID', $data['scheduleID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getStartedToday($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_status = 'started' AND task_date = :taskDate");
        //$this->db->bind(':scheduleID', $data['scheduleID']);
        $today = date('Y-m-d');
        $this->db->bind(':taskDate', $today);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getCompleted($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_status = 'completed' AND task_date = :taskDate");
        //$this->db->bind(':scheduleID', $data['scheduleID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getAll($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_date = :taskDate");
        //$this->db->bind(':scheduleID', $data['scheduleID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getAllToday($data)
    {
        //schedule_id = :scheduleID AND
        $this->db->query("SELECT * FROM task WHERE  task_date = :taskDate");
        //$this->db->bind(':scheduleID', $data['scheduleID']);
        $today = date('Y-m-d');
        $this->db->bind(':taskDate', $today);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function addTask($data)
    {
        $this->db->query("INSERT INTO task (task_id,schedule_id,task_date, task_time, task_status, task_description,task_color) VALUES (:taskID, :scheduleID, :taskDate, :taskTime, :taskStatus, :taskName, :taskcolor)");

        $taskID = substr(sha1(date(DATE_ATOM)), 0, 8);
        $this->db->bind(':taskID', $taskID);
        $this->db->bind(':scheduleID', $data['scheduleID']);
        $this->db->bind(':taskDate', $data['taskOMODate']);
        $this->db->bind(':taskTime', $data['taskTime']);
        $this->db->bind(':taskStatus', $data['taskStatus']);
        $this->db->bind(':taskName', $data['taskName']);
        $this->db->bind(':taskcolor', $data['taskcolor']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastID()
    {
        $this->db->query("SELECT task_id FROM task ORDER BY task_id DESC LIMIT 1;");
        $result = $this->db->getRes();

        return $result;
    }


    public function addReminder($data)
    {
        $this->db->query("INSERT INTO reminder (task_id, date, time) VALUES (:taskID, :reminderDate, :reminderTime)");
        $this->db->bind(':taskID', $data['taskID']);
        $this->db->bind(':reminderDate', $data['reminderDate']);
        $this->db->bind(':reminderTime', $data['reminderTime']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getWeekly($date)
    {
        $this->db->query("SELECT * FROM task WHERE task_date = :taskDate");
        $this->db->bind(':taskDate', $date);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getTaskDates($scheduleID)
    {
        //WHERE schedule_id = :scheduleID
        $this->db->query("SELECT task_date FROM task ");
       // $this->db->bind(':scheduleID', $scheduleID['scheduleID']);
        $results = $this->db->getAllRes();

        return $results;
    }
}
