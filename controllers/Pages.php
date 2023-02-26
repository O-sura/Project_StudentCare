<?php

    class Pages extends Controller{
        public function __construct(){
            
        }

        //Method for loading the default page
        public function index(){
            $this->loadView('index');
        }

        public function about(){
            echo 'About Page';
        }

        public function terms_and_conditions(){
            echo 'Terms and Conditions';
        }

        public function privacy_policy(){
            echo 'Privacy Policy';
        }

        public function rules_and_regulations(){
            echo 'Rules and Regulations';
        }
    }