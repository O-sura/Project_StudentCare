<?php
    Session::init();
    class CounselorAnnouncement extends Controller{
        
        public function __construct(){

            Middleware::authorizeUser(Session::get('userrole'), 'counsellor');

            $this->postModel = $this->loadModel('Counselor');
            
        }
        
        public function index(){

            
            $posts = $this->postModel->getCounselorAnnouncement();
          
            $data = [
                'posts' => $posts,
                'body' => isset($_POST['body'])? $_POST['body']: "",
                'update_body' => ''
            ];

            $this->loadView('Counselor/announcement',$data);
        }

        public function home(){

            
            $posts = $this->postModel->getCounselorAnnouncement();
          
            $data = [
                'posts' => $posts,
                'body' => isset($_POST['body'])? $_POST['body']: "",
                'update_body' => ''
            ];

            $this->loadView('Counselor/announcement',$data);
        }

        public function add(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'postID' => substr(sha1(date(DATE_ATOM)), 0, 8),
                    'body' => trim($_POST['body']),
                    //'update_body' => '',
                    'username' => Session::get('username'),
                    'body_err' => ''
                    //'action_url' => './CounselorAnnouncement/edit($id)'

                ];

                //validate body
                if(empty($data['body'])){
                    $data['body_err'] = 'Please write the announcement';
                }
                
                
                // make sure no errors
                if(empty($data['body_err'])){
                     if($this->postModel->addPost($data)){
                        FlashMessage::flash('post_add_flash', "Announcement Successfully Added!", "success");
                        Middleware::redirect('CounselorAnnouncement');
                    } 
                    else{
                        die('Something went wong');
                    }

                }
                else{
                    //load view with errors 
                    $this->loadView('counselor/announcement',$data);
                }
            }
            else{

                $data = [
                    'body' => ''
                    //'update_body' => ''
                ];
    
                $this->loadView('counselor/announcement');
            }

            
        }


        public function delete($id){

            //if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data = [
                    'id' => $id
                ];

                //get existing post from model
                $post = $this->postModel->getPostById($id);

                //check for owner
                if($post->user_id != $_SESSION['userID']){

                    Middleware::redirect('CounselorAnnouncement');
                }
 
                if($this->postModel->deletePost($id)){
                    FlashMessage::flash('post_add_flash', "Announcement Successfully Deleted!", "success");
                    Middleware::redirect('CounselorAnnouncement');
                }
                else{
                    die('Something went wrong');
                }
                
           // }
            // else{
               // Middleware::redirect('./CounselorAnnouncement');
           // }
        }

        public function filterAnnouncement($userid){
            $post = $this->postModel->getPostByUserId($userid);
            


        }


        //Controller function to get the serached posts
        public function search_posts(){
            header("Access-Control-Allow-Origin: *");
            if(isset($_GET['query'])){
                //Check whether the search query is empty or not
               if(empty($_GET['query'])){
                    $res =  json_encode($this->Counselor->getCounselorAnnouncement());
               }else{
                    $keyword = "%" . trim($_GET['query']) . "%";
                    $res =  $this->Counselor->searchPosts($keyword);
               }
                echo $res;
            }
        }





        /////////////////////////


        public function edit($id){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $_POST['id'],
                    'postID' => $_POST['id'],
                    'body' => trim($_POST['body']),
                    'username' => Session::get('username'),
                    'body_err' => '',
                    'action_url' => URLROOT . '/CounselorAnnouncement/edit/$id'

                ];

                //validate body
                if(empty($data['body'])){
                    $data['body_err'] = 'Please write the announcement';
                }
                
                
                // make sure no errors
                if(empty($data['body_err'])){
                     if($this->postModel->updatePost($data)){
                        FlashMessage::flash('post_add_flash', "Announcement Successfully Updated!", "success");
                        Middleware::redirect('CounselorAnnouncement');
                    } 
                    else{
                        die('Something went wong');
                    }

                }
                else{
                    //load view with errors 
                    $this->loadView('counselor/announcement',$data);
                }
            }
            else{
                //get the relavent post from model
                $ann = $this->postModel->getPostById($id);

                $posts = $this->postModel->getAnnouncementExcept($id);

                $data = [
                    'id' => $ann->post_id,
                    'body' => $ann->post_desc,
                    'posts' => $posts,
                    'action_url' => URLROOT . '/CounselorAnnouncement/edit/$id'
            
                    
                ];
    
                $this->loadView('counselor/announcement',$data);
            }

            
        }

        

        

    }

