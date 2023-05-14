<?php

class Middleware{

    //redirecting a user to a specific page
    public static function redirect($page){
        header('location:' . URLROOT . '/' . $page);
    }
    
    //check whether a user is authorized for accessing a conteoller
    public static function authorizeUser($current_userrole, $authorized_role){
        if($current_userrole == $authorized_role){
            return;
        }
        else{
            Middleware::redirect('access/restrict');
        }
    }

    //Check whether a user is already logged in
    public static function isLoggedIn(){
        if(Session::isLoggedIn()){
            Middleware::redirect('access/restrict');
            echo 'Error';
            exit();
        }
    }

    //Check whether a user is not logged into the system
    public static function isNotLoggedIn(){
        if(!Session::isLoggedIn()){
            Middleware::redirect('access/unauth');
            exit();
        }
    }

    //Method to set the current form level 
    public static function setFormLevel($currentLevel){
        Session::init();
        Session::unset('currentLevel');
        Session::set('currentLevel', $currentLevel);
    }

    //Method to check whether the current form level is allowed
    public static function checkFormLevel($allowedLevel){
        Session::init();
        if(Session::get('currentLevel') < $allowedLevel || Session::get('currentLevel') == null){
            Middleware::redirect('users/register');
            exit();
        }
    }

}