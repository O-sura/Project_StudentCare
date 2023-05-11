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
    <script src=<?php echo URLROOT . "/public/js/facility_provider/editProfile.js"?> defer></script>
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    <title></title>
</head>

<body>
    <?php FlashMessage::flash('password_change_flash') ;?>
    <div class="sidebar">
        <?php include "sidebar.php"; ?>
    </div>
    
    <div class="home_content">
        
        <div class="div5">
        
            <form action=<?php echo URLROOT."/facility_provider/updateProfileDetails/".$_SESSION['userID'] ;?> method="post" enctype="multipart/form-data">  
            
            <a id="back-link">
                <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
            </a>

            <div class="firstContainer">
                <!-- enctype="multipart/form-data" -->
                    <div class="topSection">
                        <?php 
                            if(!empty($data['profile_img'])){
                                $image = "fprovider/" . $data['profile_img'];
                            }
                            else{
                                $image = "avatar.jpg";
                            }
                        ?>

                        <div class="dp">
                            <img  class="dpI" id="output" src="<?php echo URLROOT."/public/img/".$image ;?>" alt="Profile Picture">
                        </div>
                        
                        
                        <div class="buttonU">
                            <label for="inputTag" style="cursor:pointer;">
                                <br/>
                                <i class="fa fa-2x fa-camera" style="cursor:pointer; margin-left: 28%; margin-top: -20%;"></i>
                                <input id="inputTag" type="file" name="file" style="display:none;" accept="image/*" onchange="loadFile(event)"/>
                                <br/>
                                <span id="imageName"></span>
                            </label>
                        </div>
                    </div>
                    <div class="middleSection">
                        <div class="colA">
                            <?php 
                                if($data['name_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['name_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <label for="name">Name:</label><br>
                            <input type="text" value="<?= $data['name'] ;?>" name="name"  class="form-input">
                            </div>
                            
                            <?php 
                                if($data['email_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['email_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="email">Email:</label><br>
                            <input type="email" value="<?= $data['email'] ;?>" name="email"  class="form-input">
                            </div>

                            <?php 
                                if($data['contact_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['contact_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="contact">Contact Number:</label><br>
                            <input type="number" value="<?= $data['contact'] ;?>" name="contact"  class="form-input">
                            </div>
                            
                        </div>
                        <div class="colB">
                            <?php 
                                if($data['username_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['username_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <label for="uName">Username:</label><br>
                            <input type="text" value="<?= $data['username'] ;?>" name="username"  class="form-input">
                            </div>
                            

                            <?php 
                                if($data['nic_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['nic_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="nic">NIC:</label><br>
                            <input type="text" value="<?= $data['nic'] ;?>" name="nic" class="form-input">
                            <!-- disabled="disabled" -->
                            </div>

                            <?php 
                                if($data['address_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="address">Address:</label><br>
                            <input type="text" value="<?= $data['address'] ;?>" name="address"  class="form-input">
                            </div>

                            <?php 
                                if($data['category_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['category_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="category">Category:</label><br>
                            <input type="text" value="<?= $data['category'] ;?>" name="category"  class="form-input">
                            <p>Enter your category(Property,Food,Furniture)</p>
                            </div>

                            <div class="special">
                                <a class="pwBtn" id="pwBtn" href="http://localhost/StudentCare/Facility_Provider/changePassword">Change Password</a><br><br>
                                <a class="dlt" id="dltBtn">Delete my Profile</a>
                            </div>

                             <!-- The Modal for delete the profile -->
                            <div id="myModal" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    
                                    <p>Are you sure want to delete your profile?</p>
                                    <div class="modalBtn">
                                        <button id="removeBtn" class="rbtn" name="removeBtn"><a name="removeLink" id="removeUser" class='remove'  href="http://localhost/StudentCare/Facility_Provider/deleteOwnProfile">Yes</a></button>
                                        <button class = "btnCan" id="canBtn" >No</button>
                                    </div>
                                    
                                </div>

                            </div>
                            
                        </div>
                    </div>
            
                <div class="bottomSection">
                    <div class="last">
                        <input type="submit" class="save" value="Save Changes" name="saveChanges">
                    </div>
                </div>
                <!-- <div class="delete">
                    <input type="submit" class="delete" value="Delete Profile" name="deleteProfile">
                </div>-->
            </div>
            </form>
        </div>
    </div>

</body>
</html>
