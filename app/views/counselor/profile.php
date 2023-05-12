<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css"?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/profile.css"?>">
  <script src=<?php echo URLROOT . "/public/js/Counselor/goback.js"?> defer></script>
  <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php FlashMessage::flash('update_profile_flash') ;?>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    
    <div class="home_content">

        <div class="navtag" id="/Counsellor/profileView" hidden>

        </div>

        <div class="topic">
            <span><h1 class="headApp">Profile</h1></span>
        </div>
        <hr class="hrbar">
        
        <div class="div5">
            
              <div class="topSection">
                    <?php 
                        if(!empty($data['row']->{'profile_img'})){
                            $image = $data['row']->{'profile_img'};
                        }
                        else{
                            $image = "avatar.jpg";
                        }
                    ?>
                    <img class="dp" src="<?php echo URLROOT."/public/img/counselor/".$image ;?>" alt="Profile Picture">
                  <div class="personal">
                      <h2>Personal Information</h2>
                      <label for="name">Name :  <?= $data['row']->{'fullname'} ;?> </label><br>
                      <label for="age">Age : 29 </label><br>
                      <label for="nic">NIC : <?= $data['row']->{'nic'} ;?></label><br>
                      <label for="dob">DOB : <?= $data['row']->{'dob'} ;?></label><br>
                      <label for="spec">Specialization : <?= $data['row']->{'specialization'} ;?></label></br>
                      
                  </div>
                  <a class="edit" href="<?php echo URLROOT."/Counsellor/editProfile"?>"><i class="fa-solid fa-pen-to-square"></i> Edit Info</a>
              </div>
              <div class="divBio">
                <?php if($data['row']->{'counselor_description'} != "") : ?>
                        <label for="bio" class="bio"><i class="fa-solid fa-feather-pointed"></i>&nbsp;Bio : <?= $data['row']->{'counselor_description'} ;?></label></br></br>
                <?php endif ; ?>
              </div>


              <div class="bottomSection">
                  <div class="contact">
                      <h2>Contact Info</h2>
                      <label for="address">Address : <?= $data['row']->{'home_address'} ;?></label><br>
                      <label for="email">Email : <?= $data['row']->{'email'} ;?></label><br>
                      <label for="contact">Contact Number : (+94) <?= $data['row']->{'contact_no'} ;?></label><br>
                      <a class="verify" href="<?php echo URLROOT."/Counsellor/download_verification"?>">Download Verification Document</a> 
                  </div>
              

                  <div class="qualification">
                      <h2>Qualifications</h2>
                      <?php 
                            foreach ($data['qualifications'] as $row) : ?>
                                <label for="q1"><?= $row ;?></label><br>
                            
                        <?php endforeach ?>
                      
                      <!--<label for="q2">Counselling skills including active listening anda non judgemental approach</label><br> -->
                  </div>
                  
              </div>
            
          </div>
  
  </div>

</body>

</html>
