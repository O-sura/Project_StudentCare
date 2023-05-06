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
            'announcements' => $this->announcementModel->getAnnouncements($usr),
            'savedAnnouncements' => $this->announcementModel->getSavedAnnouncements($usr)
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
        $saved =  json_encode($this->announcementModel->getSavedAnnouncements($usr));
        $data = [
            'announcements' => $res,
            'savedAnnouncements' => $saved
        ];

        echo json_encode($data);
    }
    
    public function announcement_filter_handler(){
        $sort = trim($_GET['sort']);
        $filter = trim($_GET['filter']);
        $usr = Session::get('userID');
        $res =  json_encode($this->announcementModel->filterAnnouncement($sort,$filter,$usr));
        $saved =  json_encode($this->announcementModel->getSavedAnnouncements($usr));
        $data = [
            'announcements' => $res,
            'savedAnnouncements' => $saved
        ];
        echo json_encode($data);
    }

    public function announcement_search_handler(){
        $search = trim($_GET['query']);
        $usr = Session::get('userID');
        $filter = trim($_GET['filter']);
        $sort = trim($_GET['sort']);
        $res =  json_encode($this->announcementModel->searchAnnouncement($search,$sort,$filter,$usr));
        $saved =  json_encode($this->announcementModel->getSavedAnnouncements($usr));
        $data = [
            'announcements' => $res,
            'savedAnnouncements' => $saved
        ];
        echo json_encode($data);
    }

    public function save_announcement(){
        $id = trim($_GET['id']);
        $usr = Session::get('userID');
        if($this->announcementModel->checkSaved($id,$usr)){
            $res =  json_encode($this->announcementModel->deleteSaved($id,$usr));
        }else{
            $res =  json_encode($this->announcementModel->saveAnnouncement($id,$usr));
        }
        echo $res;
    }


}