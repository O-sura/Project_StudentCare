<?php
class Announcements extends Controller{
   
    private $announcementModel;
    public function __construct()
    {
        $this->announcementModel = $this->loadmodel('Announcement');
    }

    

    public function index()
    {
        
        $data = [
            'announcements' => $this->announcementModel->getAnnouncements()
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