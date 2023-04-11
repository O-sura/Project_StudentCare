<?php
class Appointments extends Controller
{

    private $announcementModel;
    public function __construct()
    {
        // $this->announcementModel = $this->loadmodel('Announcement');
    }



    public function index()
    {

        $this->loadview('counselor_stu/index');
    }

    public function list()
    {
        $this->loadview('counselor_stu/counselorList');
    }

    public function requests(){
        $this->loadview('counselor_stu/requests');
    }

    public function profile()
    {
        $this->loadview('counselor_stu/counselorsProfile');
    }
}
