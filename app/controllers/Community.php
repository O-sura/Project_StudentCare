<?php
    Session::init();
    class Community extends Controller{
        private $CommunityModel;
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'student');
            $this->CommunityModel = $this->loadModel('CommunityModel');
        }

        public function index(){
            echo 'This is the index page';
        }

        public function home(){
            $posts = $this->CommunityModel->getAllPosts();

            $data = [
                'posts' => $posts
            ];

            $this->loadView('community/community', $data);
        }

        public function new_post(){
            if(isset($_POST['submit'])) {

                $filename = $_FILES["post-image"]["name"];
                $tempname = $_FILES["post-image"]["tmp_name"];
                $folder =  PUBLICPATH . "/img/community/" . $filename;
            
                if (move_uploaded_file($tempname, $folder)) {
                    echo 'File successfully uploaded';
                } else {
                    //Image uploading error notification
                    echo 'Error in uploading the image';
                    die();
                }
            
                $data = [
                    'title' => trim($_POST['post-title']),
                    'category' => trim($_POST['category']),
                    'post_thumbnail' => $filename,
                    'post_desc' => trim($_POST['post-body']),
                    'author' => Session::get('username')
                ];

                if($this->CommunityModel->addNewPost($data)){
                    //Post Successfully added notification and redirect to community
                    Middleware::redirect('community/home');
                }else{
                    //Error Notification
                    echo 'Error: Something went wrong in adding post to the databse';
                    die();
                }
            }
            else{
                $this->loadView('community/community-newpost');
            }
        }

        public function view_post($id){
            //Fetch the post data and comments associated with it and send as data
            $postData = $this->CommunityModel->getSinglePost($id);
            $comments = $this->CommunityModel->getAllComments($id);

            $data = [
                'post' => $postData,
                'comments' => $comments,
                'loggedInUser' => Session::get('username')
            ];

            $this->loadView('community/single-post',$data);
        }

        //Function to update an already existing community post
        public function update_post(){

        }

        //Function to delete an already existing community post
        public function delete_post(){

        }

        //Controller function to get the serached posts
        public function search_posts(){
            header("Access-Control-Allow-Origin: *");
            if(isset($_GET['query'])){
                //Check whether the search query is empty or not
               if(empty($_GET['query'])){
                    $res =  json_encode($this->CommunityModel->getAllPosts());
               }else{
                    $keyword = "%" . trim($_GET['query']) . "%";
                    $res =  $this->CommunityModel->searchPosts($keyword);
               }
                echo $res;
            }
        }

        //Controller function to get the best posts based on the votes
        public function best_posts(){
            header("Access-Control-Allow-Origin: *");
            $res = $this->CommunityModel->getBestPosts();
            echo $res;
        }

         //Controller function to get the latest posts based on the date
        public function latest_posts(){
            header("Access-Control-Allow-Origin: *");
            $res = $this->CommunityModel->getLatestPosts();
            echo $res;
        }

        public function dropdown_handler(){
            if(isset($_GET['filter'])){
                $_GET['filter'] = trim($_GET['filter']);
                $_GET['author'] = trim($_GET['author']);
                //If the saved filter is set
               if($_GET['filter'] == 'Saved'){
                    $res =  $this->CommunityModel->getSavedPosts($_GET['author']);
               }
               else if($_GET['filter'] == 'Your Posts'){
                    $res =  $this->CommunityModel->getPostsByUser($_GET['author']);
               }
               else{
                    $res =  json_encode($this->CommunityModel->getAllPosts());
               }
                echo $res;
            }
        }


        public function check_vote(){
            if(isset($_POST['post_id'])){
                $_POST['post_id'] = trim($_POST['post_id']);
                $currUser = Session::get('userID');
                $res = $this->CommunityModel->checkIfVoted($currUser, $_POST['post_id']);
                if($res > 0){
                    //Entry already exists so can't upvote
                    http_response_code(400);
                    
                }else{
                    //Not voted before, allow to upvote
                    http_response_code(200);
                }
            }
        }

        //Controller function to add the vote to the post accordingly
        public function vote(){
            $currUser = Session::get('userID');
            if(isset($_POST['post_id']) && isset($_POST['flag'])){
                $_POST['post_id'] = trim($_POST['post_id']);
                $res =  $this->CommunityModel->addVote($currUser, $_POST['post_id'],1);
            }else{
                $_POST['post_id'] = trim($_POST['post_id']);
                $res =  $this->CommunityModel->addVote($currUser, $_POST['post_id'],0);
            }
            echo $res;
        }
    }

?>
