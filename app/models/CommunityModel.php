<?php

class CommunityModel{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getSinglePost($id){
        $this->db->query('SELECT * FROM posts WHERE post_id = :postID');
        $this->db->bind(':postID', $id);
        $post = $this->db->getRes();
        return $post;
    }

    public function getAllPosts(){
        $this->db->query('SELECT * FROM posts');
        $posts = $this->db->getAllRes();
        return $posts;
    }

    public function addNewPost($data){
        $this->db->query('INSERT INTO posts(post_title, category,post_thumbnail, post_desc,author) VALUES (:post_title, :category, :post_thumbnail, :post_desc, :author)');
        $this->db->bind(':post_title', $data['title']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':post_thumbnail', $data['post_thumbnail']);
        $this->db->bind(':post_desc', $data['post_desc']);
        $this->db->bind(':author', $data['author']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updatePost($postID, $newData){
        $this->db->query('UPDATE posts SET post_title = :post_title, category = :category, post_thumbnail = :thumbnail, post_desc = :post_desc WHERE post_id = :postID');
        $this->db->bind(':post_title', $newData['title']);
        $this->db->bind(':category', $newData['category']);
        $this->db->bind(':thumbnail', $newData['post_thumbnail']);
        $this->db->bind(':post_desc', $newData['post_desc']);
        $this->db->bind('postID', $postID);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deletePost($postID){
        $this->db->query('DELETE FROM posts WHERE post_id = :postID');
        $this->db->bind(':postID', $postID);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function searchPosts($keyword){
        $this->db->query('SELECT * FROM posts WHERE post_title LIKE :keyword OR post_desc LIKE :keyword OR category LIKE :keyword');
        $this->db->bind(':keyword', $keyword);
        $posts = $this->db->getAllRes();
        return json_encode($posts);
    }

    public function getBestPosts(){
        $this->db->query('SELECT * FROM posts ORDER BY votes DESC');
        $posts = $this->db->getAllRes();
        return json_encode($posts);
    }

    public function getLatestPosts(){
        $this->db->query('SELECT * FROM posts ORDER BY posted_at DESC');
        $posts = $this->db->getAllRes();
        return json_encode($posts);
    }

    public function getSavedPosts($userID){
        $this->db->query('SELECT * FROM posts WHERE post_id IN (SELECT post_id FROM saved_post WHERE userID = :user_id)');
        $this->db->bind(':user_id', $userID);
        $posts = $this->db->getAllRes();
        return json_encode($posts);
    }

    public function getPostsByUser($author){
        $this->db->query('SELECT * FROM posts WHERE author = :author');
        $this->db->bind(':author', $author);
        $posts = $this->db->getAllRes();
        return json_encode($posts);
    }

    public function getAllComments($id){
        $this->db->query('SELECT * FROM comments WHERE post_id = :id');
        $this->db->bind(':id', $id);
        $comments = $this->db->getAllRes();
        return $comments;
    }

    public function checkIfVoted($userID, $postID){
        $this->db->query('SELECT * FROM post_voted WHERE post_id = :postID AND userID = :userID');
        $this->db->bind(':postID', $postID);
        $this->db->bind(':userID', $userID);
        return $this->db->rowCount();
    }

    public function checkIfSaved($userID, $postID){
        $this->db->query('SELECT * FROM saved_post WHERE post_id = :postID AND userID = :userID');
        $this->db->bind(':postID', $postID);
        $this->db->bind(':userID', $userID);
        return $this->db->rowCount();
    }

    public function addVote($userID, $postID,$flag){
        $this->db->query('INSERT INTO post_voted VALUES(:postID, :userID)');
        $this->db->bind(':postID', $postID);
        $this->db->bind(':userID', $userID);
        $this->db->execute();

        if($flag == 1){//It is an upvote request
            $this->db->query('UPDATE posts SET votes = votes + 1 WHERE post_id = :postID');
        }else{//It is an downvote request
            $this->db->query('UPDATE posts SET votes = votes - 1 WHERE post_id = :postID');
        }
        $this->db->bind(':postID', $postID);
        $this->db->execute();

        $this->db->query('SELECT votes FROM posts WHERE post_id = :id');
        $this->db->bind(':id', $postID);
        $votes = $this->db->getRes();
        return json_encode($votes);
    }

    public function savePost($userID, $postID,$flag){
        if($flag == 1){//It is an save post request
            $this->db->query('SELECT author FROM posts WHERE post_id = :postID');
            $this->db->bind(':postID', $postID);
            $author = $this->db->getRes();

            $this->db->query('INSERT INTO saved_post VALUES(:postID, :userID, :author)');
            $this->db->bind(':postID', $postID);
            $this->db->bind(':userID', $userID);
            $this->db->bind(':author', $author->author);
            $this->db->execute();

        }
        if($flag == -1){//It is unsave post request
            $this->db->query('DELETE FROM saved_post WHERE userID = :userID AND post_id = :postID');
            $this->db->bind(':postID', $postID);
            $this->db->bind(':userID', $userID);
            $this->db->execute();
        }
    }

    public function test(){
        $this->db->query('SELECT author FROM posts WHERE post_id = :postID');
            $this->db->bind(':postID', 21);
            return $this->db->getRes();
    }
}