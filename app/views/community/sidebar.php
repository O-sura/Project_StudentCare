<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="./fontawesome/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/sidebar.css"?> >
  <script src= <?php echo URLROOT . "/public/js/sidebar.js"?> defer></script>
  <title></title>
</head>

<body>
  <div class="sidebar">
    <div class="logo_content">
      <div class="logo">
        <div class="logo_name">StudentCare</div>
      </div>
      <i class="fa-solid fa-bars" id="btn"></i>
    </div>
    <ul class="nav_list">
      <li>
        <a href=<?php echo URLROOT . "/student/home"?>>
          <i class="fa-solid fa-gauge"></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href=<?php echo URLROOT . "/community/home"?> >
          <i class="fa-solid fa-users"></i>
          <span class="links_name">Community</span>
        </a>
        <span class="tooltip">Community</span>
      </li>
      <li>
        <a href="<?php echo URLROOT . "/tasks/index"?>">
          <i class="fa-solid fa-calendar-days"></i>
          <span class="links_name">Schedule</span>
        </a>
        <span class="tooltip">Schedule</span>
      </li>
      <li>
        <a href="<?php echo URLROOT . "/appointments/home"?>">
          <i class="fa-solid fa-calendar-check"></i></i>
          <span class="links_name">Appointments</span>
        </a>
        <span class="tooltip">Appointments</span>
      </li>
      <li>
        <a href="<?php echo URLROOT . "/announcements/home"?>">
          <i class="fa-solid fa-bullhorn"></i></i>
          <span class="links_name">Announcements</span>
        </a>
        <span class="tooltip">Announcements</span>
      </li>
      <li>
        <a href="<?php echo URLROOT . "/student_facility/home"?>">
          <i class="fa-solid fa-house-circle-check"></i>
          <span class="links_name">Listings</span>
        </a>
        <span class="tooltip">Listings</span>
      </li>
    </ul>
    <?php
        if (Session::get('prof_img')->profile_img != NULL) {
            $image = Session::get('prof_img')->profile_img;
        } else {
            $image = "avatar.jpg";
        }
        ?>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details" id="loggedInUser">
                    <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" alt="">
                    <div class="name">
                    <?php echo Session::get('username') ?>
                    </div>
                </div>
                <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>

  </div>
  <div class="home_content">
    
