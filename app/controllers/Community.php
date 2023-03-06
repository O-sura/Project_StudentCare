<?php
    Session::init();
    class Community extends Controller{
        private $CommunityModel;
        public function __construct(){
            Middleware::authorizeUser(Session::get('userrole'), 'student');
            $this->CommunityModel = $this->loadModel('CommunityModel');
        }

        public function index(){
            //echo 'This is the index page';
            $author = $this->CommunityModel->test();

            $data = [
                'author' => $author
            ];

            $this->loadView('test', $data);
        }

        public function home(){
            //$posts = $this->CommunityModel->getAllPosts();

            // $data = [
            //     'posts' => $posts
            // ];

            // Get the current page number from the query string
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            
            // Set the number of posts to display per page
            $posts_per_page = 10;
            
            // Calculate the offset for the current page
            $offset = ($page - 1) * $posts_per_page;
            
            // Get the total number of posts
            $total_posts = $this->CommunityModel->getAllPostCount();
            
            // Get the posts for the current page
            $posts = $this->CommunityModel->getPostsWithLimit($posts_per_page,$offset);
            
            // Calculate the total number of pages
            $total_pages = ceil($total_posts / $posts_per_page);
            
            // Set the data array
            $data = [
                'posts' => $posts,
                'total_pages' => $total_pages,
                'current_page' => $page
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
        public function update_post($id){
            //echo 'Post updated';
            if(isset($_POST['submit'])) {

                $filename = $_FILES["post-image"]["name"];
                $tempname = $_FILES["post-image"]["tmp_name"];
                $folder =  PUBLICPATH . "/img/community/" . $filename;

                $data = $this->CommunityModel->getSinglePost($id);
            
                // check if post-image field is empty or not
                if(empty($filename)) {
                    // assign existing image filename to $filename variable
                    $filename = $data->post_thumbnail;
                }
                else {
                    // move uploaded image to the destination folder
                    if (move_uploaded_file($tempname, $folder)) {
                        echo 'File successfully uploaded';
                    } else {
                        //Image uploading error notification
                        echo 'Error in uploading the image';
                        die();
                    }
                }
            
                $data = [
                    'title' => trim($_POST['post-title']),
                    'category' => trim($_POST['category']),
                    'post_thumbnail' => $filename,
                    'post_desc' => trim($_POST['post-body']),
                    'author' => Session::get('username')
                ];

                if($this->CommunityModel->updatePost($id,$data)){
                    //Post Successfully added notification and redirect to community
                    Middleware::redirect('community/view_post/' . $id);
                }else{
                    //Error Notification
                    echo 'Error: Something went wrong in updating post in the databse';
                    die();
                }
            }
            else{
                $data = $this->CommunityModel->getSinglePost($id);

                if($data->author != Session::get('username')){
                    Middleware::redirect('community/home');
                }else{
                    $this->loadView('community/update-post', $data);
                }
            }
           

        }

        //Function to delete an already existing community post
        public function delete_post($id){
            
            // Delete post from database
            if ($this->CommunityModel->deletePost($id)) {
                FlashMessage::flash('post_deleted', 'Post deleted Successfully', 'success');
                 //Post Successfully deleted notification and redirect to community
            } else {
                FlashMessage::flash('post_not_deleted', 'Post cannot be deleted. Try again later', 'error');
            }
            Middleware::redirect('community/home');
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
                    $res =  $this->CommunityModel->getSavedPosts(Session::get('userID'));
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

        public function save_post(){
            if(isset($_POST['post_id'])){
                $_POST['post_id'] = trim($_POST['post_id']);
                $currUser = Session::get('userID');
                $res = $this->CommunityModel->checkIfSaved($currUser, $_POST['post_id']);
                if($res > 0){
                    //Entry already exists, unsave that post
                    $this->CommunityModel->savePost($currUser, $_POST['post_id'],-1);
                    $status = "Unsaved";
                }else{
                    //Not saved, then add to saved list
                   $this->CommunityModel->savePost($currUser, $_POST['post_id'],1);
                   $status = "Saved";
                }
                echo $status;
            }
        }

        public function new_comment(){
            if(isset($_POST['comment-submit'])) {

                    // Sanitize POST data
                    $post_filters = [
                        'comment' => FILTER_SANITIZE_SPECIAL_CHARS,
                        'author' => FILTER_SANITIZE_SPECIAL_CHARS,
                        'post_id' => FILTER_SANITIZE_NUMBER_INT
                      ];
                      
                      // Sanitize the $_POST data using filter_input_array()
                    $sanitized_data = filter_input_array(INPUT_POST, $post_filters);
              
                    // Get POST data
                    $postId = $sanitized_data['post_id'];
                    $author = trim($sanitized_data['author']);
                    $body = trim($sanitized_data['comment']);
              
                    // Validate POST data
                    $data = [
                      'author' => $author,
                      'body' => $body,
                      'body_error' => ''
                    ];
              
                    if (empty($body)) {
                      $data['body_error'] = 'Please enter your comment.';
                    }
              
                    // Check for errors
                    if (empty($data['body_error'])) {

                      
                      // Add comment to database
                      if ($this->CommunityModel->addComment($postId, $author, $body)) {
                        FlashMessage::flash('comment_added', 'Comment added Successfully', 'success');
                         //Post Successfully added notification and redirect to community
                      } else {
                        FlashMessage::flash('comment_not_added', 'Comment cannot be added', 'error');
                      }
                      Middleware::redirect('community/view_post/'. $postId);
                    } 
                }
            }
                    
    }
         
        
    

?>
