<?php
class Student_facility extends Controller
{


    public function __construct()
    {
        // $this->announcementModel = $this->loadmodel('Announcement');
    }



    public function index()
    {

        $this->loadview('facility/index');
    }

    public function food(){
        $this->loadview('facility/foodView');
    }

    public function furniture(){
        $this->loadview('facility/furnitureView');
    }

    public function viewProperty(){
        $this->loadview('facility/viewProperty');
    }
}
