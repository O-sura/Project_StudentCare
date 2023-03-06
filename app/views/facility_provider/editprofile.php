<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/profile.css"?> >
    <script src=<?php echo URLROOT . "/public/js/facility_provider/profile.js"?> defer></script>
    <title>Profile</title>
</head>
<body>
    <div class="page">

        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <div class="head">
                <a id="back-link">
                    <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
                </a>

                <h1>My Profile</h1>
            </div>

            <div class="profile">
                <div id="prof_img">
                    <img src="<?php echo URLROOT . "/public/img/avatar.jpg"?>" alt="">
                    <div class="profile_image">
                        <input type="file" name="image" id="image">
                        <i class="fa fa-camera"></i>
                    </div>
                </div>
                <div class="personal">
                    <h2>Personal Information</h2>
                    <p class="info">
                        <span>Name : <?php echo $data['editprofile']->fullname; ?></span><br>
                        <span>Username : <?php echo $data['editprofile']->username; ?></span><br>
                        <span>NIC : <?php echo $data['editprofile']->nic; ?></span>
                    </p>
                </div>
            </div>

            <div class="details">

                <div class="contact">
                    <h2>Contact Information</h2>
                    <span>Address : <?php echo $data['editprofile']->home_address; ?></span><br>
                    <span>Email : <?php echo $data['editprofile']->email; ?></span><br>
                    <span>Contact Number : <?php echo $data['editprofile']->contact_no; ?></span>
                </div>

                <div class="category_details">
                    <h2>Selected Category</h2>
                    <i class="fa-sharp fa-solid fa-square"></i><?php echo $data['editprofile']->category; ?>
                </div>
            </div>
        </div>

    </div>
</body>
</html>