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
        $this->db->query("SELECT * FROM task WHERE task_user = :userID AND task_status = 'not started' AND task_date = :taskDate");
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getNotStartedToday($id)
    {
        $this->db->query("SELECT * FROM task WHERE task_user = :userID AND task_status = 'not started' AND task_date = :taskDate");
        $this->db->bind(':userID', $id);
        $today = date('Y-m-d');
        $this->db->bind(':taskDate', $today);
        $results = $this->db->getAllRes();

        return $results;
    }


    public function getStarted($data)
    {
        $this->db->query("SELECT * FROM task WHERE task_user = :userID AND task_status = 'started' AND task_date = :taskDate");
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getStartedToday($id)
    {
        $this->db->query("SELECT * FROM task WHERE task_user = :userID AND task_status = 'started' AND task_date = :taskDate");
        $this->db->bind(':userID', $id);
        $today = date('Y-m-d');
        $this->db->bind(':taskDate', $today);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getCompleted($data)
    {
        $this->db->query("SELECT * FROM task WHERE task_user = :userID AND task_status = 'completed' AND task_date = :taskDate");
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getAll($data)
    {
        $this->db->query("SELECT * FROM task WHERE task_user = :userID AND task_date = :taskDate");
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':taskDate', $data['taskDate']);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getAllToday($id)
    {
        $this->db->query("SELECT * FROM task WHERE task_user= :userID AND task_date = :taskDate");
        $this->db->bind(':userID', $id);
        $today = date('Y-m-d');
        $this->db->bind(':taskDate', $today);
        $results = $this->db->getAllRes();

        return $results;
    }

    public function addTask($data)
    {
        $this->db->query("INSERT INTO task(task_user, task_id, task_date, task_time, task_status, task_description,task_color) VALUES (:user, :taskID, :taskDate, :taskTime, :taskStatus, :taskName, :taskcolor)");

        $taskID = substr(sha1(date(DATE_ATOM)), 0, 8);
        $this->db->bind(':user', $data['userID']);
        $this->db->bind(':taskID', $taskID);
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


    public function getWeekly($date)
    {
        $this->db->query("SELECT * FROM task WHERE task_date = :taskDate AND task_user = :userID");
        $this->db->bind(':taskDate', $date);
        $this->db->bind(':userID', Session::get('userID'));
        $results = $this->db->getAllRes();

        return $results;
    }

    public function getTaskDates($id)
    {
        $this->db->query("SELECT task_date FROM task WHERE task_user = :userID");
        $this->db->bind(':userID', $id);
        $results = $this->db->getAllRes();

        return $results;
    }
}
