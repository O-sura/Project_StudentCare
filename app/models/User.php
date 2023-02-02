<?php

    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function register($data){
            $userID = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('INSERT INTO users (userID, username, email, password_hash, fullname, home_address, nic, contact_no, user_role, verification_code) VALUES (:userID, :username, :email, :password_hash, :fullname, :home_address, :nic, :contact_no, :user_role, :verification_code)');
            $this->db->bind(':userID', $userID);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password_hash', $data['password']);
            $this->db->bind(':fullname', $data['name']);
            $this->db->bind(':home_address', $data['address']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':contact_no', $data['contact']);
            $this->db->bind(':user_role', $data['role']);
            $this->db->bind(':verification_code', sha1(uniqid()));
            
            if($this->db->execute()){
               if($this->register_helper($userID, $data)){
                    return true;
               }
               else{
                    return false;
               }
            }
            else{
                return false;
            }
        }

        public function register_helper($userID, $data){
            if($data['role'] == 'student'){
                $studentID = substr(sha1(date(DATE_ATOM)), 0, 8);
                $this->db->query('INSERT INTO student (userID, studentID, dob, university, locations) VALUES (:userID, :studentID, :dob, :university, :locations)');
                $this->db->bind(':userID', $userID);
                $this->db->bind(':studentID', $studentID);
                $this->db->bind(':dob', $data['dob']);
                $this->db->bind(':university', $data['university']);
                $this->db->bind(':locations', $data['locations']);
                
                if($this->db->execute()){
                    return true;
                }
                else{
                    return false;
                }
            }
            else if($data['role'] == 'counsellor'){
                $counsellorID = substr(sha1(date(DATE_ATOM)), 0, 8);
                $this->db->query('INSERT INTO counsellor (userID, counsellorID, dob, specialization, qualifications, verification_doc) VALUES (:userID, :counsellorID, :dob, :specialization, :qualifications, :verification_doc)');
                $this->db->bind(':userID', $userID);
                $this->db->bind(':counsellorID', $counsellorID);
                $this->db->bind(':dob', $data['dob']);
                $this->db->bind(':specialization', $data['specialization']);
                $this->db->bind(':qualifications', implode(",", $data['qualifications']));
                $this->db->bind(':verification_doc', $data['verification_doc']);
                
                if($this->db->execute()){
                    return true;
                }
                else{
                    return false;
                }
            }
            else if($data['role'] == 'facility_provider'){
                $fpID = substr(sha1(date(DATE_ATOM)), 0, 8);
                $this->db->query('INSERT INTO facility_provider (userID, fpID, category) VALUES (:userID, :fpID, :category)');
                $this->db->bind(':userID', $userID);
                $this->db->bind(':fpID', $fpID);
                $this->db->bind(':category', implode(",", $data['category']));
                
                if($this->db->execute()){
                    return true;
                }
                else{
                    return false;
                }
            }
        }

        //Find user with the given email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email= :email');
            $this->db->bind(':email', $email);

            $row = $this->db->getRes();
            if($this->db->rowCount() > 0){
                return true;
            }
            else
                return false;
        }

        //Find user with the given username
        public function findUserByUsername($username){
            $this->db->query('SELECT * FROM users WHERE username= :username');
            $this->db->bind(':username', $username);

            $row = $this->db->getRes();
            if($this->db->rowCount() > 0){
                return true;
            }
            else
                return false;
        }

        //Get the userrole of the account based on the provided credentials
        public function getUserInfo($username){
            $this->db->query('SELECT * FROM users WHERE username= :username OR email = :email');
            $this->db->bind(':username', $username);
            $this->db->bind(':email', $username);

            $row = $this->db->getRes();
            return $row;
        }

        //Validate the given password
        public function validatePassword($username,$password){
            $this->db->query('SELECT * FROM users WHERE username= :username');
            $this->db->bind(':username', $username);

            $row = $this->db->getRes();
            $isValid = password_verify($password, $row->password_hash);
            if($isValid){
                return true;
            }else{
                return false;
            }
        }

        //Check whether the user is verified or not
        public function isVerified($username){
            $this->db->query('SELECT * FROM users WHERE username= :username');
            $this->db->bind(':username', $username);

            $row = $this->db->getRes();
            $isVerified= $row->is_activated;
            if($isVerified){
                return true;
            }else{
                return false;
            }
        }

        //Verify newly registered email
        public function verifyEmail($code){
            $this->db->query('SELECT * from users WHERE  verification_code = :code');
            $this->db->bind(':code', $code);

            $row = $this->db->getRes();
            $username = $row->username;
            $prevState = $row->is_activated;

            $this->db->query('UPDATE users SET is_activated = 1,verification_code = null WHERE  verification_code = :code');
            $this->db->bind(':code', $code);

            $row = $this->db->getRes();

            $this->db->query('SELECT * from users WHERE  username=:username');
            $this->db->bind(':username', $username);

            $row = $this->db->getRes();
            
            if($prevState != $row->is_activated){
                $res = true;
            }
            else{
                $res = false;
            }
            return $res;
        }

        //Function for setting a browser cookie
        public function setCookie($username){
            // generate a unique token
            $token = uniqid();

            // set a cookie on the user's browser that contains the token
            setcookie('remember_token', $token, time()+3600);

            $this->db->query("UPDATE users SET remember_token = :token WHERE username = :username");            
            $this->db->bind(':token', $token);
            $this->db->bind(':username', $username);

            $this->db->getRes();
        }

        //Function to check whether a remember-me cookie is there
        public function getCookie($remember_token){
            $this->db->query("SELECT * FROM users WHERE remember_token = :token");
            $this->db->bind(':token', $remember_token);

            $user = $this->db->getRes();
            if($this->db->rowCount() == 1){
                return $user;
            }
            else{
                return null;
            }
        }

        //Clear a browser cookie
        public function clearCookie(){
            //Start the session
            Session::init();

            // delete the remember_token cookie
            setcookie('remember_token', null, time()-3600);

            // clear the remember_token field in the database
            $userID = Session::get('userID');
            $this->db->query("UPDATE users SET remember_token = NULL WHERE userID = :id");
            $this->db->bind(':id', $userID);

            $this->db->getRes();
        }

        //Store a unique token with the current timestamp
        public function storeToken($email, $token, $time){
            $this->db->query("INSERT INTO user_token VALUES(:email, :token, :gen_time)");
            $this->db->bind(':email', $email);
            $this->db->bind(':token', $token);
            $this->db->bind(':gen_time', $time);

            $this->db->getRes();
        }

        //Function to find the user email with a given specific token
        public function findEmailByToken($token){
            $this->db->query("SELECT * FROM user_token WHERE token = :token");
            $this->db->bind(':token', $token);

            $user = $this->db->getRes();
            if($user){
                return $user->email;
            }
            else{
                return null;
            }
        }

        //Check the validity of the token
        public function isTokenValid($token){
            $this->db->query("SELECT * FROM user_token WHERE token = :token");
            $this->db->bind(':token', $token);

            $timestamp = $this->db->getRes()->created_at;

            if(!$timestamp || $timestamp + 86400 < time()){
                return false;
            }else{
                return true;
            }
        }

        //Function to update user password with a new one
        public function updatePassword($username, $password){
           $hashedPwd =  password_hash($password, PASSWORD_DEFAULT);
           $this->db->query("UPDATE users SET password_hash = :hashedPwd WHERE username = :username");            
           $this->db->bind(':hashedPwd', $hashedPwd);
           $this->db->bind(':username', $username);

           $this->db->getRes();
        }

    }


?>