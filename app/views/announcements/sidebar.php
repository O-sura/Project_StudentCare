<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/sidebar.css" ?>>
    <script type="module" src=<?php echo URLROOT . "/public/js/student/sidebar.js" ?> defer></script>
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
                <a href='<?php echo URLROOT ?>/student/home'>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>

            </li>
            <li>
                <a href='<?php echo URLROOT ?>/community/home'>
                    <i class="fa-solid fa-users"></i>
                    <span class="links_name">Community</span>
                </a>

            </li>
            <li>
                <a href='<?php echo URLROOT ?>/tasks/'>
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="links_name">Schedule</span>
                </a>

            </li>
            <li>
                <a href='<?php echo URLROOT ?>/appointments/'>
                    <i class="fa-solid fa-calendar-check"></i></i>
                    <span class="links_name">Appointments</span>
                </a>

            </li>
            <li>
                <a href='<?php echo URLROOT ?>/announcements/' id="chosen">
                    <i class="fa-solid fa-bullhorn"></i></i>
                    <span class="links_name">Announcements</span>
                </a>

            </li>
            <li>
                <a href="<?php echo URLROOT ?>/Student_facility/">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span class="links_name">Listings</span>
                </a>

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
                <div class="profile_details">
                    <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" alt="">
                    <div class="name">
                    <?php echo Session::get('username') ?>
                    </div>
                </div>
                <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
</body>

</html>