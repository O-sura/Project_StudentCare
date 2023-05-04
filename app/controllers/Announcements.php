<?php
Session::init();
class Announcements extends Controller{
   
    private $announcementModel;
    public function __construct()
    {
        $this->announcementModel = $this->loadmodel('Announcement');
        Middleware::authorizeUser(Session::get('userrole'), 'student');
    }

    

    public function index()
    {
        $usr = Session::get('userID');
        $data = [
            'announcements' => $this->announcementModel->getAnnouncements($usr)
        ];



        $this->loadview('announcements/index',$data);
    }

    public function show($postId)
    {
       
        $init_data=[
            'announcementID' => $postId
        ];

        $data = [   
            'announcement' => $this->announcementModel->viewAnnouncement($init_data)
        ];
        
        $this->loadview('announcements/view',$data);
    }

    public function announcement_sort_handler(){
        $sort = trim($_GET['sort']);
        $filter = trim($_GET['filter']);
        $usr = Session::get('userID');
        $res =  json_encode($this->announcementModel->filterAnnouncement($sort,$filter, $usr));
        echo $res;
    }
    
    public function announcement_filter_handler(){
        $sort = trim($_GET['sort']);
        $filter = trim($_GET['filter']);
        $usr = Session::get('userID');
        $res =  json_encode($this->announcementModel->filterAnnouncement($sort,$filter,$usr));
        echo $res;
    }


}