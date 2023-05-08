<?php
Session::init();
class CounselorAnnouncement extends Controller
{

    private $counselorModel;

    public function __construct()
    {

        Middleware::authorizeUser(Session::get('userrole'), 'counsellor');

        $this->counselorModel = $this->loadModel('Counselor');

    }

    public function index()
    {

        $posts = $this->counselorModel->getCounselorAnnouncement();

        $data = [
            'posts' => $posts,
            'body' => isset($_POST['body']) ? $_POST['body'] : "",
            'topic' => isset($_POST['topic']) ? $_POST['topic'] : "",
            'body_err' => '',
            'topic_err' => '',

        ];

        $this->loadView('Counselor/announcement', $data);
    }

    public function home()
    {

        $posts = $this->counselorModel->getCounselorAnnouncement();

        $data = [
            'posts' => $posts,
            'body' => isset($_POST['body']) ? $_POST['body'] : "",
            'topic' => isset($_POST['topic']) ? $_POST['topic'] : "",
            'body_err' => '',
            'topic_err' => '',

        ];

        $this->loadView('Counselor/announcement', $data);
    }

    //add an announcement
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $posts = $this->counselorModel->getCounselorAnnouncement();
            //sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'posts' => $posts,
                'postID' => substr(sha1(date(DATE_ATOM)), 0, 8),
                'body' => trim($_POST['body']),
                'topic' => trim($_POST['topic']),
                'username' => Session::get('username'),
                'body_err' => '',
                'topic_err' => '',

            ];

            //validate body
            if (empty($data['body'])) {
                $data['body_err'] = 'Please write the announcement';
            }

            //validate topic
            if (empty($data['topic'])) {
                $data['topic_err'] = 'Please write the heading';
            }

            // make sure no errors
            if (empty($data['body_err']) && empty($data['topic_err'])) {
                if ($this->counselorModel->addPost($data)) {
                    FlashMessage::flash('post_add_flash', "Announcement Successfully Added!", "success");
                    Middleware::redirect('CounselorAnnouncement');

                } else {
                    die('Something went wong');
                }

            } else {
                //load view with errors
                $this->loadView('counselor/announcement', $data);
            }
        } else {

            $data = [
                'body' => '',
                'topic' => '',
            ];

            $this->loadView('counselor/announcement');
        }

    }

    //delete an announcement
    public function delete($id)
    {

        $data = [
            'id' => $id,
        ];

        //get existing post from model
        $post = $this->counselorModel->getPostById($id);

        //check for owner
        if ($post->user_id != $_SESSION['userID']) {

            Middleware::redirect('CounselorAnnouncement');
        }

        if ($this->counselorModel->deletePost($id)) {
            FlashMessage::flash('post_add_flash', "Announcement Successfully Deleted!", "success");
            //Middleware::redirect('CounselorAnnouncement');
            counselorAnnouncements::home();
        } else {
            die('Something went wrong');
        }

    }

    //edit an announcement
    public function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_POST['id'],
                'postID' => $_POST['id'],
                'body' => trim($_POST['body']),
                'topic' => trim($_POST['topic']),
                'username' => Session::get('username'),
                'body_err' => '',
                'topic_err' => '',
                'action_url' => URLROOT . '/CounselorAnnouncement/edit/$id',

            ];

            //validate body
            if (empty($data['body'])) {
                $data['body_err'] = 'Please write the announcement';
            }

            if (empty($data['topic'])) {
                $data['topic_err'] = 'Please write the heading';
            }

            // make sure no errors
            if (empty($data['body_err']) && empty($data['topic_err'])) {
                if ($this->counselorModel->updatePost($data)) {
                    FlashMessage::flash('post_add_flash', "Announcement Successfully Updated!", "success");
                    Middleware::redirect('CounselorAnnouncement');
                } else {
                    die('Something went wong');
                }

            } else {
                //load view with errors
                $this->loadView('counselor/announcement', $data);
            }
        } else {
            //get the relavent post from model
            $ann = $this->counselorModel->getPostById($id);

            $posts = $this->counselorModel->getAnnouncementExcept($id);

            $data = [
                'id' => $ann->post_id,
                'body' => $ann->post_desc,
                'topic' => $ann->post_head,
                'posts' => $posts,
                'action_url' => URLROOT . '/CounselorAnnouncement/edit/$id',
                'body_err' => '',
                'topic_err' => '',

            ];

            $this->loadView('counselor/announcement', $data);
        }

    }

    //to handle the announcement filter
    public function dropdown_handler()
    {

        $pet = Session::get('userID');

        $annCountObject = $this->counselorModel->countOwnAnnouncements($pet);
        $annOwnCount = json_decode($annCountObject, true);

        if (isset($_GET['filter'])) {
            $_GET['filter'] = trim($_GET['filter']);
            $_GET['userid'] = Session::get('userID');

            if ($_GET['filter'] == 'Your Announcements') {

                $res = json_encode($this->counselorModel->getPostByUser_id($_GET['userid']));

            } else {
                $res = json_encode($this->counselorModel->getCounselorAnnouncement());
            }
            echo $res;
        }

    }

    //Controller function to get the serached posts
    public function search_posts()
    {
        header("Access-Control-Allow-Origin: *");
        if (isset($_GET['query'])) {
            //Check whether the search query is empty or not
            if (empty($_GET['query'])) {
                $res = json_encode($this->counselorModel->getCounselorAnnouncement());
            } else {
                $keyword = "%" . trim($_GET['query']) . "%";
                $res = $this->counselorModel->searchPosts($keyword);
            }
            echo $res;
        }
    }

}
