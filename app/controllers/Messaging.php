<?php
Session::init();
class Messaging extends Controller
{
    private $messagingModel;
    public function __construct()
    {
        Middleware::authorizeUser(Session::get('userrole'), 'student');
        $this->messagingModel = $this->loadmodel('Stu_msg_Model');
    }
    public function index()
    {

        $data = [
            'chats' => $this->messagingModel->getChats(Session::get('userID'))
        ];

        $this->loadview('messaging/index', $data);
    }

    public function get_all()
    {
        if (isset($_GET['id'])) {
            $id = trim($_GET['id']);
            $res =  json_encode($this->messagingModel->getAllMessages($id));
            echo $res;
        }
    }

    public function send_message()
    {
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        $init_data = json_decode(file_get_contents('php://input'), true);
        $message = $init_data['messageBody'];
        $senderId = Session::get('userID');
        $receiverId = $init_data['id'];
        $timestamp = date('Y-m-d H:i:s');

        $res = $this->messagingModel->sendMessage($message, $senderId, $receiverId, $timestamp);
        header('Content-Type: application/json');
        echo json_encode($res);
    }

    public function fetch_messages()
    {
        if (isset($_GET['id'])) {
            $receiverId = trim($_GET['id']);
            $senderId = Session::get('userID');
            $res =  $this->messagingModel->getNewMessages($senderId, $receiverId);
            foreach($res as $message) {
                $this->messagingModel->updateMessageStatus($message->messageID,$message->senderID);
            }
           
            header('Content-Type: application/json');
            echo json_encode($res);
        }
    }

    public function create_chat($id)
    {
        $studentId = Session::get('userID');
        $facilityId = $id;
        if($this->messagingModel->checkChat($studentId, $facilityId)){
            Messaging::index();
        }else{
            if($this->messagingModel->createChat($studentId, $facilityId)){
                Messaging::index();
            }else{
                echo 'error';
            }
        }

       
    }
}
