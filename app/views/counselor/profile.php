<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/profile.css"?>">
  <script src=<?php echo URLROOT . "/public/js/Counselor/goback.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    
    <div class="home_content">
        
          <div class="div5">
            <?php foreach ($data['row'] as $row ): ?>
              <div class="topSection">
                  <img class="dp" src="<?php echo URLROOT."/public/img/counselor/img7.jpg"?>" alt="">
                  <div class="personal">
                      <h2>Personal Information</h2>
                      <label for="name">Name :  <?= $row->{'fullname'} ;?> </label><br>
                      <label for="age">Age : 29 </label><br>
                      <label for="nic">NIC : <?= $row->{'nic'} ;?></label><br>
                      <label for="dob">DOB : <?= $row->{'dob'} ;?></label><br>
                      <label for="spec">Specialization : <?= $row->{'specialization'} ;?></label></br>
                  </div>
                  <a class="edit" href="<?php echo URLROOT."/Counsellor/editProfile"?>"><i class="fa-solid fa-pen-to-square"></i> Edit Info</a>
              </div>
              <div class="bottomSection">
                  <div class="contact">
                      <h2>Contact Info</h2>
                      <label for="address">Address : <?= $row->{'home_address'} ;?></label><br>
                      <label for="email">Email : <?= $row->{'email'} ;?></label><br>
                      <label for="contact">Contact Number : (+94) <?= $row->{'contact_no'} ;?></label><br>
                      <a class="verify" href="">Download Verification Document</a> 
                  </div>
              

                  <div class="qualification">
                      <h2>Qualifications</h2>
                      <label for="q1"><?= $row->{'qualifications'} ;?></label><br>
                      <!--<label for="q2">Counselling skills including active listening anda non judgemental approach</label><br> -->
                  </div>
                  
              </div>
            <?php endforeach ?> 
          </div>
  
  </div>

</body>

</html>
