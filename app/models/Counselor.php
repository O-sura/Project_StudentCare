<?php

    class Counselor {

        private $db;

        public function __construct(){
            $this->db = new Database;
        }

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

        public function getCounselorAnnouncement(){
            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID ORDER BY posted_date DESC');

            $results = $this->db->getAllRes();

            return $results; 
        }

        public function addPost($data){

            $this->db->query('SELECT * FROM users WHERE username=:username');
            $this->db->bind(':username',$data['username']);
            $user = $this->db->getRes();

            $this->db->query('INSERT INTO ann_post(post_id,post_desc,posted_date,username,fullname,userID,post_head) VALUES(:postID,:body,:posted_date,:username,:fullname,:userID,:topic)');
            
            date_default_timezone_set('Asia/Kolkata');
            
            //bind values
            $this->db->bind(':userID',$user->userID);
            $this->db->bind(':fullname',$user->fullname);
            $this->db->bind(':postID',$data['postID']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':username',$data['username']);
            $this->db->bind(':topic',$data['topic']);
            $this->db->bind(':posted_date',date('Y-m-d H:i'));
            
            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function updatePost($data){

           // $userID = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('UPDATE ann_post SET post_desc = :body, posted_date = :updated_date, post_head = :topic WHERE post_id = :id');
            
            date_default_timezone_set('Asia/Kolkata');
            //bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':updated_date',date('Y-m-d H:i'));
            $this->db->bind(':topic',$data['topic']);
            
        
            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        public function deletePost($id){
            $userID = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('DELETE FROM ann_post WHERE post_id = :id');
            
            //bind values
            $this->db->bind(':id',$id);
            
            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function getPostById($id){
            $this->db->query('SELECT * FROM ann_post WHERE post_id = :id');
            $this->db->bind(':id',$id);

            $row = $this->db->getRes();

            return $row;
        }

        
        public function getPostByUser_id($user_id){
            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID WHERE ann_post.userID = :userID;');
            $this->db->bind(':userID',$user_id);

            $row = $this->db->getAllRes();

            return $row;
        }
         

        public function getCounselorProfile($user_id){
            $this->db->query('SELECT * FROM users INNER JOIN counsellor ON users.userID = counsellor.userID WHERE users.userID = :user_id');
            $this->db->bind(':user_id',$user_id);
            $results = $this->db->getRes();

            return $results; 
        }

        public function getAnnouncementExcept($id){

            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID WHERE ann_post.post_id != :postid ORDER BY posted_date DESC');
            $this->db->bind(':postid',$id);
            $results = $this->db->getAllRes();

            return $results; 
        }


        public function getCounselorEditDetails($user_id){
            $this->db->query('SELECT * FROM users INNER JOIN counsellor ON users.userID = counsellor.userID WHERE users.userID = :user_id');
            $this->db->bind(':user_id',$user_id);
            $results = $this->db->getRes();

            return $results; 
        }

        public function searchPosts($keyword){
            $this->db->query('SELECT * FROM ann_post INNER JOIN counsellor ON ann_post.userID = counsellor.userID WHERE ann_post.post_head LIKE :keyword OR ann_post.post_desc LIKE :keyword OR ann_post.fullname LIKE :keyword');
            $this->db->bind(':keyword', $keyword);
            $posts = $this->db->getAllRes();
            return json_encode($posts);
        }

        public function updateDetails($data,$user_id){
            $this->db->query('UPDATE counsellor SET profile_img = :pimg WHERE userID = :userid');

            $this->db->bind(':userid', $user_id);
            $this->db->bind(':pimg', $data['profile_img']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateProfileDetails($data,$user_id){
            // $this->db->query('UPDATE users u JOIN counsellor c 
            // ON u.userID = c.userID
            // SET u.username = :Cusername, u.fullname = :Cname, u.email = :Cemail, u.home_address = :Caddress, u.contact_no = :contact, c.specialization = :Cspecialization, c.qualifications = :qualifications 
            // WHERE u.userID = :userid');

            $this->db->query('UPDATE users SET username = :Cusername, fullname = :Cname, email = :Cemail, home_address = :Caddress, contact_no = :contact WHERE  userID = :userid;');

            $this->db->bind(':userid', $user_id);
            $this->db->bind(':Cusername', $data['username']);
            $this->db->bind(':Cemail', $data['email']);
            $this->db->bind(':Cname', $data['name']);
            $this->db->bind(':Caddress', $data['address']);
            $this->db->bind(':contact', $data['contact']);

            if($this->db->execute()){
                
                $this->db->query('UPDATE counsellor SET specialization = :Cspecialization, qualifications = :Cqualifications, profile_img = :pimg WHERE  userID = :userid;');

                $this->db->bind(':userid', $user_id);
                $this->db->bind(':Cspecialization', $data['specialization']);
                $this->db->bind(':Cqualifications',implode(",", $data['qualifications']));
                $this->db->bind(':pimg',$data['profile_img']);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }



            }else{
                return false;
            }
            
        }

        //to check appointment times
        public function checkTime($data,$afterTime,$beforeTime){
            $this->db->query('SELECT COUNT(appointmentTime),appointmentTime,appointmentID FROM appointments WHERE appointmentDate = :appDate AND :aftTime >= appointmentTime AND appointmentTime >= :befTime;');
            $this->db->bind(':appDate', $data['appDate']);
            $this->db->bind(':aftTime', $afterTime);
            $this->db->bind(':befTime', $beforeTime);

            $results = $this->db->getRes();

            return json_encode($results);


        }


        //to get the count of appointmets for a day
        public function countDayAppointments($data){

            $this->db->query('SELECT COUNT(appointmentDate), appointmentID, appointmentTime FROM appointments WHERE appointmentDate = :appDate;');
            $this->db->bind(':appDate',$data['appDate']);

            $results = $this->db->getRes();

            return json_encode($results);
            
        }

        //to check whether requested person already have an appointment on that or not
        public function checkForSamePersonApp($data,$userid){

            $this->db->query('SELECT COUNT(studentID), studentID, appointmentTime, counsellorID FROM appointments WHERE studentID = :stuid AND counsellorID = :cID AND appointmentDate = :appDate;');
            $this->db->bind(':appDate',$data['appDate']);
            $this->db->bind(':stuid',$data['stuID']);
            $this->db->bind(':cID',$userid);

            $results = $this->db->getRes();

            return json_encode($results);
        }
        
        //to get the count of own announcements
        public function countOwnAnnouncements($id){

            $this->db->query('SELECT COUNT(post_id),post_id FROM ann_post WHERE userID = :userid;');
            $this->db->bind(':userid',$id);

            $results = $this->db->getRes();

            return json_encode($results);
            
        }


        public function getAppointmentsDetails($date,$userid){

            $this->db->query('SELECT * FROM appointments INNER JOIN student ON appointments.studentID = student.studentID  WHERE appointments.appointmentDate = :appDate AND appointments.counsellorID = :userid ORDER BY appointments.appointmentTime;');
            $this->db->bind(':appDate',$date);
            $this->db->bind(':userid',$userid);
            
            $results = $this->db->getAllRes();

            return $results; 
        }


        public function addAppointment($data,$userid){

            $appID = substr(sha1(date(DATE_ATOM)), 0, 7);

            $this->db->query('INSERT INTO appointments(meetingID,appointmentID,appointmentDescription,appointmentDate,appointmentTime,counsellorID,studentID,studentName) VALUES(:meeID,:appID,:appDesc,:appDate,:appTime,:CID,:StID,:StName)');

            $this->db->bind(':CID',$userid);
            $this->db->bind(':meeID',$data['meetingID']);
            $this->db->bind(':StID',$data['stuID']);
            $this->db->bind(':StName',$data['stuName']);
            $this->db->bind(':appDate',$data['appDate']);
            $this->db->bind(':appTime',$data['appTime']);
            $this->db->bind(':appDesc',$data['desc']);
            $this->db->bind(':appID',$appID);

            // date('H : i', strtotime($data['appTime']))

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        //to cancel an appointment
        public function cancelAppointment($desc,$appID,$appdate,$userid){

            $this ->db->query('UPDATE appointments SET appointmentStatus = 3, cancellationReason = :reason WHERE counsellorID = :userid AND appointmentDate = :appdate AND appointmentID = :appID ;');

            $this->db->bind(':userid',$userid);
            $this->db->bind(':appID',$appID);
            $this->db->bind(':appdate',$appdate);
            $this->db->bind(':reason',$desc);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        //to get the students based on counselor decision
        public function getStudents($statusOfRequest,$userid){

            $this->db->query('SELECT requests.*, users.fullname FROM requests INNER JOIN users ON requests.studentID = users.userID INNER JOIN student ON users.userID = student.studentID WHERE requests.counsellorID = :userid AND requests.statusPP = :statusPP ORDER BY requests.requested_on DESC;');
            //$this->db->query('SELECT requests.*, users.fullname FROM requests INNER JOIN student users ON requests.counsellorID = users.userID WHERE requests.counsellorID = :userid AND requests.statusPP = :statusPP;');
            $this->db->bind(':userid',$userid);
            $this->db->bind(':statusPP',$statusOfRequest);

            $results = $this->db->getAllRes();

            return $results; 
        }

        //to get all details of students
        public function getStudentsAllDetails($userid){

            $this->db->query('SELECT studentID FROM requests WHERE counsellorID = :cID;');
            $this->db->bind(':cID',$userid);

            $res = $this->db->getAllRes();
            return json_encode($res);

            // $this->db->query('SELECT * FROM student INNER JOIN requests ON student.studentID = requests.studentID WHERE requests.studentID = :userid;');
            
            // //$this->db->bind(':statusPP',$statusOfRequest);

            // $results = $this->db->getAllRes();

            // return $results; 
        }


        //get students ewhen click on student name
        public function getStudentDetails($gotStu){

            //SELECT * FROM requests INNER JOIN student ON student.studentID = requests.studentID INNER JOIN users ON users.userID = requests.studentID WHERE requests.studentID = :gotStu;

            $this->db->query('SELECT student.*,requests.rNote,users.fullname,users.home_address FROM requests INNER JOIN student ON student.studentID = requests.studentID INNER JOIN users ON users.userID = requests.studentID WHERE requests.studentID = :gotStu;');

            $this->db->bind(':gotStu',$gotStu);

            $results = $this->db->getRes();

            return $results;


        }

        //get student details for emailing
        public function getstudentforemail($userid){
            $this->db->query('SELECT users.*,student.university,student.dob,appointments.appointmentDescription FROM users INNER JOIN student ON student.userID = users.userID INNER JOIN appointments ON appointments.studentID = users.userID WHERE users.userID = :gotStu;');

            $this->db->bind(':gotStu',$userid);

            $results = $this->db->getRes();

            return $results;
        }

        //to get appointed student details
        public function getAppointedStudent($stuid,$appdate){

            $this->db->query('SELECT users.fullname,users.home_address,users.email,student.university,student.dob,student.profile_img,appointments.appointmentDescription,appointments.appointmentDate,appointments.appointmentTime,appointments.appointmentID FROM users INNER JOIN student ON student.userID = users.userID INNER JOIN appointments ON appointments.studentID = users.userID WHERE users.userID = :gotStu AND appointments.appointmentDate = :gotDate;');

            $this->db->bind(':gotStu',$stuid);
            $this->db->bind(':gotDate',$appdate);

            $results = $this->db->getRes();

            return $results;
        }


         //to update the status of requested students for particular counselor
        public function updateStudentStatus($decision,$userid,$stuID){

            $this->db->query('UPDATE requests SET statusPP = :decision WHERE  counsellorID = :userid AND studentID = :stuID ;');
            $this->db->bind(':userid',$userid);
            $this->db->bind(':stuID',$stuID);
            $this->db->bind(':decision',$decision);

            if($this->db->execute()){

                if($decision == 1){
                    $this->db->query('INSERT INTO counselor_alloc(counselor_id,student_id) VALUES(:userid,:stuID);');
                    $this->db->bind(':userid',$userid);
                    $this->db->bind(':stuID',$stuID);

                    $this->db->execute();
                }


                return true;
            }else{
                return false;
            }

        }
        

        //to get daily appointments to show on dashboard
        public function getAppointmentTimes($userid,$curdate){

            //$this->db->query('SELECT * FROM appointments WHERE counsellorID = "ee0a55b1" AND appointmentDate = "2023-03-09"');

            $this->db->query('SELECT * FROM appointments WHERE counsellorID = :userid AND appointmentDate = :curdate;');
            $this->db->bind(':curdate',$curdate);
            $this->db->bind(':userid',$userid);

            $results = $this->db->getAllRes();

            return json_encode($results); 

        }


        //to get next appointment to show on dashboard
        public function nextAppointmentDetails($userid,$curdate,$currtime){

            //$this->db->query('SELECT * FROM appointments WHERE counsellorID = "ee0a55b1" AND appointmentDate = "2023-03-09" AND appointmentTime > :currtime ORDER BY appointmentTime ASC');

            $this->db->query('SELECT * FROM appointments WHERE counsellorID = :userid AND appointmentDate = :curdate AND appointmentTime > :currtime;');
            $this->db->bind(':curdate',$curdate);
            $this->db->bind(':userid',$userid);
            $this->db->bind(':currtime', $currtime);

            $results = $this->db->getRes();

            return json_encode($results); 

        }


        //for notification generation

        //new request notifications
        public function newRequestStudents($userid){

            $this->db->query('SELECT requests.studentID,requests.requested_on,users.fullname,student.profile_img FROM requests INNER JOIN student ON requests.studentID = student.studentID INNER JOIN users ON student.studentID = users.userID WHERE requests.statusPP = 0 AND requests.counsellorID = :userid ORDER BY requests.requested_on ASC;');
            $this->db->bind(':userid',$userid);

            $results = $this->db->getAllRes();

            return $results;
        }


        //notification for request cancelling
        public function notiCancelReq($userid){

            $this->db->query('SELECT requests.studentID,requests.requested_on,requests.reason,users.fullname,student.profile_img  FROM requests INNER JOIN student ON requests.studentID = student.studentID INNER JOIN users ON users.userID = student.studentID WHERE requests.statusPP = 3 AND requests.counsellorID = :userid ORDER BY requests.requested_on ASC ;');
            $this->db->bind(':userid',$userid);

            $results = $this->db->getAllRes();

            return $results;


        }

        //update request seen status
        public function updateRequestSeen($userid){

            $this->db->query('UPDATE requests SET counselor_seen = 1 WHERE counsellorID = :userid ;');
            $this->db->bind(':userid',$userid);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        //notification for cancelling appointment
        public function notiCancelApp($userid){

            $this->db->query('SELECT appointments.studentID,appointments.appointmentDate,appointments.appointmentTime,appointments.cancellationReason,student.profile_img,users.fullname FROM appointments INNER JOIN student ON appointments.studentID = student.studentID INNER JOIN users ON student.studentID = users.userID WHERE appointments.appointmentStatus = 2 AND appointments.counsellorID = :userid ;');
            $this->db->bind(':userid',$userid);

            $results = $this->db->getAllRes();

            return $results;

        }


        //update appointment cancel notificationt seen status
        public function updateAppointmentSeen($userid){

            $this->db->query('UPDATE appointments SET counselor_seen = 1 WHERE counsellorID = :userid ;');
            $this->db->bind(':userid',$userid);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }


        public function getInformationForNotification($userid){

            $this->db->query('SELECT requests.*,student.*,appointments.*,users.* FROM requests INNER JOIN student ON requests.studentID = student.studentID INNER JOIN appointments ON appointments.studentID = student.studentID INNER JOIN users ON users.userID = student.studentID WHERE (requests.statusPP = 0 AND requests.counsellorID = :userid) OR (appointments.appointmentStatus = 2 AND appointments.counsellorID = :userid) GROUP BY student.studentID ORDER BY requests.requested_on DESC;');
            $this->db->bind(':userid',$userid);

            $results = json_encode($this->db->getAllRes());

            return $results;

        }

        public function getInformationForDashboardNotification($userid){

            $this->db->query('SELECT requests.*,student.*,appointments.*,users.* FROM requests INNER JOIN student ON requests.studentID = student.studentID INNER JOIN appointments ON appointments.studentID = student.studentID INNER JOIN users ON users.userID = student.studentID WHERE (requests.statusPP = 0 AND requests.counsellorID = :userid) OR (appointments.appointmentStatus = 2 AND appointments.counsellorID = :userid) GROUP BY student.studentID ORDER BY requests.requested_on DESC LIMIT 5;');
            $this->db->bind(':userid',$userid);

            $results = json_encode($this->db->getAllRes());

            return $results;

        }




    }