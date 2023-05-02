<?php

//all session settings abstracted
class Session {

    //starts session
    public static function init() {
        if(session_status() !== PHP_SESSION_ACTIVE || session_status() === PHP_SESSION_NONE) {
                // Set the session timeout value to 30 minutes
                //ini_set('session.gc_maxlifetime', 1800);
                session_start();
                //OVERLOAD TEST
                Session::set("curr_time", time());
        }
    }
    //sets values
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    //returns value in session
    public static function get($key) {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return null;
    }

    public static function destroy() {
        session_destroy();
    }

    //remove value from array
    public static function unset($key) {
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    public static function isLoggedIn(){
        if(isset($_SESSION['userID'])){
            return true;
        }
        else{
            return false;
        }
    }

}
?>