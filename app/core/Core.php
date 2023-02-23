<?php

    // Contains the main app class
    // Handles the URLs and loads the main controller
    class Core{
        protected $currController = 'Pages';
        protected $currMethod = 'index';
        protected $params = [];

        public function __construct(){
            $url = $this->getURL();

            //ucwords is for making the first letter uppercase
            //Since we are refering this from the public folder, we should give path from their
            if(isset($url[0])){
                if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
                    //Set the currController to the controller passed in URL and unset the index
                    $this->currController = ucwords($url[0]);
                    unset($url[0]);
                }
            }
            
            //include the Controller and create an instance of it
            require_once '../app/controllers/'. $this->currController . '.php';
            $this->currController = new $this->currController;


            //Check whether the passed method exists and set it to the currMethod
            if(isset($url[1])){
                if(method_exists($this->currController, $url[1])){
                    $this->currMethod = $url[1];
                    unset($url[1]);
                }
            }

            //Set the parameters
            $this->params = $url ? array_values($url): [];

            //trigger the callback with the given parameters
            call_user_func_array([$this->currController, $this->currMethod], $this->params);
            
        }

        public function getURL(){
          if(isset($_GET['url'])){
            //to remove the ending / if any
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
          }

        }
        
    }