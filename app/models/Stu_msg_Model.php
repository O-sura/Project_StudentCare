<?php

class Stu_msg_Model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getChats($id)
    {
        if ($id == '789') {
            $this->db->query('SELECT chats.*, users.username, student.profile_img
            FROM chats
            INNER JOIN users ON chats.facility_id = users.userID
            INNER JOIN student ON users.userID = student.userID
            WHERE student_id = :id 
            ORDER BY chats.date DESC');
            $this->db->bind(':id', $id);
            $results = $this->db->getAllRes();
        } else {
            $this->db->query('SELECT chats.*, users.username, student.profile_img
            FROM chats
            INNER JOIN users ON chats.student_id = users.userID
            INNER JOIN student ON users.userID = student.userID
            WHERE facility_id = :id 
            ORDER BY chats.date DESC');
            $this->db->bind(':id', $id);
            $results = $this->db->getAllRes();
        }

        return $results;
    }

    public function getAllMessages($id)
    {
        $senderId = $id; // Change this to the ID of the sender user
        $receiverId = Session::get('userID'); // Change this to the ID of the receiver user   
        $this->db->query('SELECT * FROM messages WHERE ((senderID = :senderId_1 AND receiverID = :receiverId_1) OR (senderID = :senderId_2 AND receiverID = :receiverId_2))');
        $this->db->bind(':senderId_1', $senderId);
        $this->db->bind(':receiverId_1', $receiverId);
        $this->db->bind(':senderId_2', $receiverId);
        $this->db->bind(':receiverId_2', $senderId);
        $results = $this->db->getAllRes();
        return $results;
    }

    public function sendMessage($message, $senderId, $receiverId, $timestamp)
    {
        $this->db->query('INSERT INTO messages (senderID, receiverID, message, received_at) VALUES (:sender_id, :receiver_id, :message, :received_at)');
        $this->db->bind(':message', $message);
        $this->db->bind(':sender_id', $senderId);
        $this->db->bind(':receiver_id', $receiverId);
        $this->db->bind(':received_at', $timestamp);
        if ($this->db->execute()) {
            $status = 'success';
        } else {
            $status = 'failed';
        }
        $response = [
            'message' => $message,
            'status' => $status,
            'received_at' => $timestamp
        ];
        return $response;
    }

    public function getNewMessages($senderId, $receiverId)
    {
        $this->db->query('SELECT * FROM messages WHERE (isReadBySender=0 AND senderID = :senderId AND receiverID = :receiverId) OR (isReadByReceiver=0 AND senderID = :receiverId AND receiverID = :senderId)');
        $this->db->bind(':senderId', $senderId);
        $this->db->bind(':receiverId', $receiverId);
        $messages = $this->db->getAllRes();

       

        return $messages;
    }

    public function updateMessageStatus($messageId,$senderId){

        if($senderId == Session::get('userID')){
            $this->db->query('UPDATE messages SET isReadBySender = 1 WHERE messageID = :messageID');
            $this->db->bind(':messageID', $messageId);
            $this->db->execute();
        }else{
            $this->db->query('UPDATE messages SET isReadByReceiver = 1 WHERE messageID = :messageID');
            $this->db->bind(':messageID', $messageId);
            $this->db->execute();
        }
    }
}
