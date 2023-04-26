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


}