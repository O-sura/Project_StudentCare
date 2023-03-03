<?php

    //Base controller that loads relevant models and views
    class Controller{

        //takes the view and the passed data for rendering the view
        public function loadView($view, $data = []){
            if(file_exists('../app/views/'. $view . '.php')){
                require_once '../app/views/'. $view . '.php';
            }
            else{
                //Return the 404 page
                Middleware::redirect('pages/error_404');
            }
        }

        public function loadModel($model){
            //require the model file
            require_once '../app/models/'. $model. '.php';
            return new $model();
        }
    }