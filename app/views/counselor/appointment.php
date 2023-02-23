<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/appointment.css"?>">
  <script src= <?php echo URLROOT . "/public/js//Counselor/appointment.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">
        
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
                                  <form id="form" method="post" action="form.php">
                                    <ul class=" days">
                    
                                    </ul>
                                    <input type="text" id="date" name="date">
                    
                                  </form>
                                </div>
                              </div>
                          </div>      
                      </div>
                      <div class="div6">
                          <h3>Create an Appointment</h3><br><br>
                          <label for="stu_ID">Student User_ID</label><br>
                          <input type="text"><br><br>
                          <label for="stu_Name">Student Name</label><br>
                          <input type="text"><br><br>
                          <label for="date">Date</label><br>
                          <input type="date"><br><br>
                          <label for="time">Time</label><br>
                          <input type="time"><br><br>
                          <label for="description">Description</label><br>
                          <textarea name="" id="" cols="5" rows="5"></textarea>
                          <button class="postBtn">Add appointment</button>
                      </div>
                  </div>
            </div>
        </div>   
            
        
    </div>
</body>

</html>
