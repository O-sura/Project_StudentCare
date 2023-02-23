<?php
    Session::init();
    class Counsellor extends Controller{
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');
        }
        
        public function index(){
            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }

        public function home(){
            
            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }

        public function profileView(){

            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');

            $row = $this->postModel->getCounselorProfile($user_id);
          
            $data = [
                
                'row' => $row
            ];

            $this->loadView('Counselor/profile',$data);
        }

        public function EditProfile(){

            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');

            $row = $this->postModel->getCounselorEditDetails($user_id);
          
            $data = [
                
                'row' => $row
            ];

            $this->loadView('Counselor/editDetails',$data);
        }

        public function changeProfile(){

            $this->postModel = $this->loadModel('Counselor');
            $user_id = Session::get('userID');

            $row = $this->postModel->getCounselorEditDetails($user_id);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $filename = $_FILES["file"]["name"];
                $tempname = $_FILES["file"]["tmp_name"];
                $folder =  PUBLICPATH . "img/counselor/".$filename;

                if (move_uploaded_file($tempname, $folder)) {
                    echo 'File successfully uploaded';
                } else {
                    //Image uploading error notification
                    echo 'Error in uploading the image';
                    die();
                }

                $data = [
                    'profile_img' => $filename
    
                ];
                
                $res = $this->postModel->updateDetails($data,$user_id);
                if($res){
                    Middleware::redirect('Counsellor/ProfileView');
                }else{
                    //Error Notification
                    echo 'Error: Something went wrong in adding post to the databse';
                    die();
                }
                
            }else{
                $this->loadView('counselor/editDetails',$data);
            }


            // if($_SERVER['REQUEST_METHOD'] == 'POST'){

                
            //         if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){

            //             $filename = PUBLICPATH."img/counselor/".$_FILES['file']['name'];

            //             move_uploaded_file($_FILES['file']['tmp_name'], $filename);
                      
            //         }else{
            //             echo "Please add a valid image!";
            //         }
                        
                
            // }

            
            // $data = [
            //     'row' => $row
            // ];

            //$this->loadView('Counselor/editDetails',$data);


        }

        public function notificationView(){
            $data = [
                
            ];

            $this->loadView('Counselor/notification',$data);
        }

        public function studentView(){

            $data = [
                
            ];

            $this->loadView('Counselor/student',$data);
        }


       
        

    }

?>
