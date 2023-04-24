<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/facility_provider/editDetails.css"?>">
    
    <title></title>
</head>

<body>
    <div class="sidebar">
        <?php include "sidebar.php"; ?>
    </div>
    
    <div class="home_content">
        <a id="back-link">
            <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
        </a>
        <div class="div5">
            <?php foreach ($data['editprofile'] as $editprofile ): ?>
                <div class="firstContainer">
                    <div class="topSection">
                        <img class="dp" src="<?php echo URLROOT."/public/img/avatar.jpg"?>" alt="">
                        <div class="buttonU">

                        <form action="<?php echo URLROOT."/Counsellor/changeProfile"?>" method="post" enctype="multipart/form-data">

                            <label for="inputTag" style="cursor:pointer;">
                                <br/>
                                <i class="fa fa-2x fa-camera" style="cursor:pointer;"></i>
                                <input id="inputTag" type="file" name="file" style="display:none;"/>
                                <br/>
                                <input type="submit" value="Save Image" class="changePP" name="saveImg"/>
                                <span id="imageName"></span>
                            </label>
                        </form>
                            
                        </div>
                        <button class="dlt">Delete My Profile</button>
                    </div>
                    <div class="middleSection">
                        <div class="colA">
                            <label for="name">Name</label><br>
                            <input type="text" value="<?= $editprofile->{'fullname'} ;?>"><br><br>
                            <label for="email">Email</label><br>
                            <input type="email" value="<?= $editprofile->{'email'} ;?>"><br><br>
                            <label for="contact">Contact Number</label><br>
                            <input type="number" value="<?= $editprofile->{'contact_no'} ;?>"><br><br>
                        </div>
                        <div class="colB">
                            <label for="uName">Username</label><br>
                            <input type="text" value="<?= $editprofile->{'username'} ;?>"><br><br>
                            <label for="nic">NIC</label><br>
                            <input type="text" value="<?= $editprofile->{'nic'} ;?>"><br><br>
                            <label for="address">Address</label><br>
                            <input type="text" value="<?= $editprofile->{'home_address'} ;?>"><br><br>
                        </div>
                    
                    </div>
                </div>
                
                <div class="categorySection">
                    <label for="category">Category(s)</label><br>
                    <input class="category" type="text" value="<?= $editprofile->{'category'} ;?>"><br><br>
                </div>
                <div class="bottomSection">
                    <input type="submit" class="save" value="Save Changes">
                </div>
            <?php endforeach ?>  
        </div>
  
  </div>

</body>
<script type="text/javascript" src="<?php echo URLROOT . "/public/js/facility_provider/editProfile.js"?>"></script>

</html>
