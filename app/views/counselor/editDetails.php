<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/editDetails.css"?>">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css"?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script src=<?php echo URLROOT . "/public/js/Counselor/goback.js"?> defer></script>
  <script src=<?php echo URLROOT . "/public/js/Counselor/editDetails.js"?> defer></script>
  <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php FlashMessage::flash('password_change_flash') ;?>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">

        <div class="navtag" id="/Counsellor/profileView" hidden>

        </div>
        
        <div class="div5">
        
            <form action=<?php echo URLROOT."/Counsellor/updateProfileDetails/".$_SESSION['userID'] ;?> method="post" enctype="multipart/form-data">  
            <div class="firstContainer">

                <!-- enctype="multipart/form-data" -->

                    <div class="topSection">
                        <div class="go">
                            <span><a id="back-link"><i class="fa-sharp fa-solid fa-arrow-left"></i> Go back </a></span>
                        </div>
                        <?php 
                            if(!empty($data['profile'])){
                                $image = $data['profile'];
                            }
                            else{
                                $image = "avatar.jpg";
                            }
                        ?>

                        <div class="dp">
                            <img  class="dpI" id="output" src="<?php echo URLROOT."/public/img/counselor/".$image ;?>" alt="Profile Picture">
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
                            <label for="name">Name</label><br>
                            <input type="text" value="<?= $data['name'] ;?>" name="name"  class="form-input">
                            </div>
                            
                            <?php 
                                if($data['email_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['email_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="email">Email</label><br>
                            <input type="email" value="<?= $data['email'] ;?>" name="email"  class="form-input">
                            </div>

                            <?php 
                                if($data['contact_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['contact_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="contact">Contact Number</label><br>
                            <input type="number" value="<?= $data['contact'] ;?>" name="contact"  class="form-input">
                            </div>
                            
                            <br><label for="dob">Date of Birth</label><br>
                            <input type="date" value="<?= $data['dob'] ;?>" name="dob" disabled="disabled"  class="form-input">
                        </div>
                        <div class="colB">
                            <?php 
                                if($data['username_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['username_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <label for="uName">Username</label><br>
                            <input type="text" value="<?= $data['username'] ;?>" name="username"  class="form-input">
                            </div>
                            
                            <br><label for="nic">NIC</label><br>
                            <input type="text" value="<?= $data['nic'] ;?>" name="nic" disabled="disabled"  class="form-input">

                            <?php 
                                if($data['address_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <br><label for="address">Address</label><br>
                            <input type="text" value="<?= $data['address'] ;?>" name="address"  class="form-input">
                            </div>

                            
                            <br><label for="spec">Specialization</label><br>
                            <input type="text" value="<?= $data['specialization'] ;?>" disabled="disabled" name="specialization"  class="form-input">
                            
                    
                        </div>
                    </div>
                <div>
                    
                </div>
                <div class="qualificationSection">
                    <label for="editBio">Bio</label><br>
                    <input class="quali" name="bioDesc" value="<?= $data['description'] ;?>"><br><br>
                    <div class="qualiD" id="qualiD" >
                        <?php 
                            if($data['qualification_err'])
                            echo '<div class="form-field" id="qualifications" data-error=" ' . $data['qualification_err'] . '">';
                            else
                            echo '<div class="form-field" id="qualifications">';
                        ?>
                        <label for="qualify">Qualification(s)</label><br>
                        <?php 
                            foreach ($data['qualifications'] as $row) : ?>
                                <input class="quali" type="text" value="<?php echo $row ;?>" name="qualifications[]" class="form-input" id="qualification_0"><br><br>
                            
                        <?php endforeach ?>
                        
                        </div>
                        <div id="input-container" class="input-container"></div>
                        <button class="add" id="add-button" onclick="addAnother()" type="button"><i class="fa-solid fa-plus" style="color:white"></i>  Add another</button>
                    </div>
                    
                    
                </div>
                <div class="bottomSection">
                    <div class="last">
                        <div class="special">
                            <a class="pwBtn" id="pwBtn" href="http://localhost/StudentCare/Counsellor/changePassword">Change Password</a><br><br>
                            <a class="dlt" id="dltBtn">Delete my Profile</a>
                        </div>
                        <input type="submit" class="save" value="Save Changes" name="saveChanges">
                    </div>
                </div>

            </div>
            </form>
        </div>

        <!-- The Modal for delete the profile -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
        

            <div class="modal-content">
                <span class="close">&times;</span>
                
                <p>Are you sure want to delete your profile?</p>
                <div class="modalBtn">
                    <button id="removeBtn" class="rbtn" name="removeBtn"><a name="removeLink" id="removeUser" class='remove'  href="http://localhost/StudentCare/Counsellor/deleteOwnProfile">Yes</a></button>
                    <button class = "btnCan" id="canBtn" >No</button>
                </div>
                
            </div>

        </div>

    </div>

</body>

</html>
