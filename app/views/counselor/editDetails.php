<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/editDetails.css"?>">
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
            <form action=<?php echo URLROOT."/Counsellor/changeProfile"?> method="post" enctype="multipart/form-data">
            <div class="firstContainer">
                <div class="topSection">
                    <div class="go">
                        <span><a id="back-link"><i class="fa-sharp fa-solid fa-arrow-left"></i> Go back </a></span>
                    </div>
                    <?php 
                        if(isset($data['profile_img'])){
                            $image = $data['profile_img'];
                        }
                    ?>
                    <img class="dp" src="<?php echo PUBLICPATH."img/counselor/".$row->{'profile_img'} ?>" alt="">
                    
                        <div class="buttonU">
                            <label for="inputTag" style="cursor:pointer;">
                                <br/>
                                <i class="fa fa-2x fa-camera" style="cursor:pointer; margin-left: 28%; margin-top: -20%;"></i>
                                <input id="inputTag" type="file" name="file" style="display:none;"/>
                                <br/>
                                <span id="imageName"></span>
                            </label>
                        </div>
                </div>
                <div class="middleSection">
                  <div class="colA">
                      <label for="name">Name</label><br>
                      <input type="text" value="<?= $row->{'fullname'} ;?>"><br><br>
                      <label for="email">Email</label><br>
                      <input type="email" value="<?= $row->{'email'} ;?>"><br><br>
                      <label for="contact">Contact Number</label><br>
                      <input type="number" value="<?= $row->{'contact_no'} ;?>"><br><br>
                      <label for="dob">Date of Birth</label><br>
                      <input type="date" value="<?= $row->{'dob'} ;?>">
                  </div>
                  <div class="colB">
                      <label for="uName">Username</label><br>
                      <input type="text" value="<?= $row->{'username'} ;?>"><br><br>
                      <label for="nic">NIC</label><br>
                      <input type="text" value="<?= $row->{'nic'} ;?>"><br><br>
                      <label for="address">Address</label><br>
                      <input type="text" value="<?= $row->{'home_address'} ;?>"><br><br>
                      <label for="spec">Specification</label><br>
                      <input type="text" value="<?= $row->{'specialization'} ;?>">
                  </div>
                  
                </div>
            </div>
            
            <div class="qualificationSection">
                <label for="qualify">Qualification(s)</label><br>
                <input class="quali" type="text" value="<?= $row->{'qualifications'} ;?>"><br><br>
                <div id="input-container" class="input-container"></div>
                <button class="add" id="add-button"><i class="fa-solid fa-plus" style="color:white"></i>  Add another</button>
                
            </div>
            <div class="bottomSection">
                <h2>Change Password</h2>
                <div class="changepw">
                    <div class="colC">
                        <label for="currentpw">Current Password</label><br>
                        <input class="pw" type="password">
    
                    </div>
                    <div class="colD">
                        <label for="newpw">Current Password</label><br>
                        <input class="pw" type="password"><br><br>
                        <label for="verlfypw">Current Password</label><br>
                        <input class="pw" type="password">
                    </div>
                </div>
                <div class="last">
                    <a class="dlt">Delete my Profile</a>
                    <input type="submit" class="save" value="Save Changes" name="saveChanges">
                </div>
            </div>
        <?php endforeach ?>  
    </div>
    </form>
  </div>

</body>
<script type="text/javascript" src="<?php echo URLROOT . "/public/js/Counselor/add.js"?>"></script>

</html>
