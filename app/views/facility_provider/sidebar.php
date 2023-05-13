<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/sidebar.css"?> >
    <script src=<?php echo URLROOT . "/public/js/facility_provider/sidebar.js"?> defer></script>
    <title></title>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name">StudentCare</div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-bars" id="btn"></i>
            </div>
        </div>
        <ul class="nav_list">
            <li>
                <a href=<?php echo URLROOT. "/facility_provider/"?>>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">My Listings</span>
                </a>
                <span class="tooltip">My Listings</span>
            </li>

            <li>
                <a href=<?php echo URLROOT. "/facility_provider/propertyView"?>>
                    <i class="fa-solid fa-house-chimney"></i>
                    <span class="links_name">Property</span>
                </a>
                <span class="tooltip">Property</span>
            </li>

            <li>
                <a href=<?php echo URLROOT. "/facility_provider/foodView"?>>
                    <i class="fa-solid fa-utensils"></i>
                    <span class="links_name">Food</span>
                </a>
                <span class="tooltip">Food</span>
            </li>

            <li>
                <a href=<?php echo URLROOT. "/facility_provider/furnitureView"?>>
                    <i class="fa-solid fa-chair"></i></i>
                    <span class="links_name">Furniture</span>
                </a>
                <span class="tooltip">Furniture</span>
            </li>

            <li>
                <a href=<?php echo URLROOT. "/facility_provider/report"?>>
                    <i class="fa-solid fa-address-card"></i></i>
                    <span class="links_name">Report</span>
                </a>
                <span class="tooltip">Report</span>
            </li>

            <li>
                <a href=<?php echo URLROOT. "/messaging_facility/index"?>>
                    <i class="fa-solid fa-message"></i>
                    <span class="links_name">Message</span>
                </a>
                <span class="tooltip">Message</span>
            </li>
            
        </ul>
        <div class="profile_content">
            <?php
                if (Session::get('prof_img')->profile_img != NULL) {
                    $image = Session::get('prof_img')->profile_img;
                } else {
                    $image = "avatar.jpg";
                }
            ?>
            <div class="profile">
                <div class="profile_details">
                    <img src="<?php echo URLROOT . "/public/img/fprovider/" . $image; ?>" alt="">
                    <div class="name">
                        <?php echo Session::get('username') ?>
                    </div>
                </div>
                <a href= <?php echo URLROOT . "/users/logout"?>><i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i></a>
            </div>
        </div>

    </div>
    
