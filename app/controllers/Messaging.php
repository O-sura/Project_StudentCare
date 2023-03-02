<?php
    class Messaging extends Controller{
        public function __construct(){
            // Middleware::authorizeUser(Session::get('userrole'), 'student');
        }
        public function index(){
            $this->loadview('messaging/index');
        }
    }