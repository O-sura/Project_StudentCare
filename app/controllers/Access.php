<?php

    class Access extends Controller{
        public function index(){
            $this->loadView('error404');
            die();
        }

        public function restrict(){
            //Not allowed to access(Not allowed user)
            $data = [
                'err_code' => 401,
                'display_data' => 'Oops. Looks like you are in the wrong place'
            ];

            $this->loadView('unauth', $data);
            die();
        }

        public function verify(){
            //Profile not verified
            $data = [
                'err_code' => 404,
                'display_data' => 'You must verify your account before signing in.'
            ];

            
            $this->loadView('unauth', $data);
        }


    }

?>