<?php

    class Database{
        private $db_host = DB_HOST;
        private $db_user = DB_USER;
        private $db_name = DB_NAME;
        private $db_passwd = DB_PASSWD;

        private $pdo;
        private $stmt;
        private $error;

        public function __construct(){
            $dsn = 'mysql:host='. $this->db_host . ';dbname='. $this->db_name;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //Make the pdo instance using the given configurations
            try{    
                $this->pdo = new PDO($dsn, $this->db_user, $this->db_passwd, $options);
            }
            catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Prepare the sql statement
        public function query($sql){
            $this->stmt = $this->pdo->prepare($sql);
        }

        //Bind values
        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                            $type = PDO::PARAM_NULL;
                            break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($param, $value, $type);
        }

        //Execute the prepared query
        public function execute(){
            return $this->stmt->execute();
        }

        //Fetch more than one result
        public function getAllRes(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Fetch only one result
        public function getRes(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //Count the no. of resulting records
        public function rowCount(){
            $this->execute();
            return $this->stmt->rowCount();
        }
    }