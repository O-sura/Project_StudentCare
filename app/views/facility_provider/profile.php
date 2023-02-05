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

                <i class="fa-sharp fa-solid fa-pen"><span>    Edit Profile</span></i>
            </div>

            <div class="profile">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=388&q=80" alt="">
                <div class="personal">
                    <h2>Personal Information</h2>
                    <p class="info">
                        <span>Name : <?php echo $data['profile']->fullname; ?></span><br>
                        <span>Username : <?php echo $data['profile']->username; ?></span><br>
                        <span>NIC : <?php echo $data['profile']->nic; ?></span>
                    </p>
                </div>
            </div>

            <div class="details">

                <div class="contact">
                    <h2>Contact Information</h2>
                    <span>Address : <?php echo $data['profile']->home_address; ?></span><br>
                    <span>Email : <?php echo $data['profile']->email; ?></span><br>
                    <span>Contact Number : <?php echo $data['profile']->contact_no; ?></span>
                </div>

                <div class="category_details">
                    <h2>Selected Category</h2>
                    <i class="fa-sharp fa-solid fa-square"><?php echo $data['profile']->category; ?></i>
                </div>
            </div>
        </div>

    </div>
</body>
</html>