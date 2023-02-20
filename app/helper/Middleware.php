<?php

class Middleware{

    public static function redirect($page){
        header('location:' . URLROOT . '/' . $page);
    }
    
    public static function authorizeUser($current_userrole, $authorized_role){
        if($current_userrole == $authorized_role){
            return;
        }
        else{
            Middleware::redirect('access/restrict');
        }
    }

    public static function isLoggedIn(){
        if(Session::isLoggedIn()){
            Middleware::redirect('access/restrict');
            echo 'Error';
            exit();
        }
    }

    public static function isNotLoggedIn(){
        if(!Session::isLoggedIn()){
            Middleware::redirect('access/unauth');
            exit();
        }
    }

    //Method to set the current form level 
    public static function setFormLevel($currentLevel){
        Session::unset('currentLevel');
        Session::set('currentLevel', $currentLevel);
    }

    //Method to check whether the current form level is allowed
    public static function checkFormLevel($allowedLevel){
        if(Session::get('currentLevel') < $allowedLevel || Session::get('currentLevel') == null){
            Middleware::redirect('users/register');
            exit();
        }
    }

}