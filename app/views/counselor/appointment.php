<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css"?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/appointment.css"?>">
  <script src= <?php echo URLROOT . "/public/js//Counselor/appointment.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php FlashMessage::flash('appointment_add_flash') ;?> 
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">

      <div class="navtag" id="/CounselorAppointment/home" hidden>

      </div>
        
      <div class="topic">
          <span><h1 class="headApp">Appointments</h1></span>
      </div>
      <hr class="hrbar">

        <div class="div4">
          <div class="bottomSection">
                      <div class="div5">
                          <div class="wrap">
                              <div class="wrapper">
                                <header>
                                  <p class="current-date"></p>
                                  <div class="icons">
                                    <i id="prev" class="fa-solid fa-chevron-left"></i>
                                    <i id="next" class="fa-solid fa-chevron-right"></i>
                                  </div>
                                </header>
                                <div class="calendar">
                                  <ul class="weeks">
                                    <li>Sun</li>
                                    <li>Mon</li>
                                    <li>Tue</li>
                                    <li>Wed</li>
                                    <li>Thu</li>
                                    <li>Fri</li>
                                    <li>Sat</li>
                                  </ul>
                                  <form id="form" method="post" action="<?php echo URLROOT."/CounselorAppointment/dailyAppointment" ?>">
                                    <ul class=" days">
                    
                                    </ul>
                                    <input type="text" id="date" name="date">
                    
                                  </form>
                                </div>
                              </div>
                          </div>      
                      </div>
                      <div class="div6">

                        <form action="<?php echo URLROOT."/counselorAppointment/createAppointment" ;?>" method="post">
                          <h3>Create an Appointment</h3><br>

                          <?php 
                                if($data['stuID_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['stuID_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                          ?>
                          <br><label for="stuID">Student User_ID</label><br>
                          <input type="text" name="stuID">
                          </div>

                          <?php 
                                if($data['stuName_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['stuName_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                          ?>
                          <br><label for="stuName">Student Name</label><br>
                          <input type="text" name="stuName">
                          </div>

                          <?php 
                                if($data['appDate_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['appDate_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                          ?>
                          <br><label for="date">Date</label><br>
                          <input type="date" name="appDate">
                          </diV>

                          <?php 
                                if($data['appTime_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['appTime_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                          ?>
                          <br><label for="time">Time</label><br>
                          <input type="time" name="appTime">
                          </div>

                          <?php 
                                if($data['desc_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['desc_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                          ?>
                          <br><label for="description">Description</label><br>
                          <textarea name="desc" id="" cols="5" rows="5"></textarea>
                          </div>
                          <button class="postBtn" name="submit">Add appointment</button>
                        </form>
                      </div>
                  </div>
            </div>
        </div>   
            
        
    </div>

</body>

</html>
