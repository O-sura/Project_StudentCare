<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/sidebar.css" ?>">
    <script src=<?php echo URLROOT . "/public/js/Counselor/sidebar.js" ?> defer></script>
    <title></title>
</head>

<body>

    <div class="sidebar">

        <div class="logo_content">
            <div class="logo">
                <div class="logo_name">STUDENTCARE</div>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href=<?php echo URLROOT . "/Counsellor/home" ?>>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href=<?php echo URLROOT . "/Counsellor/profileView" ?>>
                    <i class="fa-solid fa-user-pen"></i>
                    <span class="links_name">Profile</span>
                </a>
                <span class="tooltip">Profile</span>
            </li>
            <li>
                <a href=<?php echo URLROOT . "/Counsellor/studentView" ?>>
                    <i class="fa-solid fa-users"></i>
                    <span class="links_name">View Student</span>
                </a>
                <span class="tooltip">View Student</span>
            </li>
            <li>
                <a href=<?php echo URLROOT . "/Counsellor/notificationView" ?>>
                    <i class="fa-solid fa-bell"></i>
                    <span class="links_name">Notification</span>
                </a>
                <span class="tooltip">Notification</span>
            </li>
            <li>
                <a href=<?php echo URLROOT . "/CounselorAppointment/home" ?>>
                    <i class="fa-solid fa-calendar-check"></i>
                    <span class="links_name">Appointments</span>
                </a>
                <span class="tooltip">Appointments</span>
            </li>
            <li>
                <a href=<?php echo URLROOT . "/CounselorAnnouncement/home" ?>>
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="links_name">Announcements</span>
                </a>
                <span class="tooltip">Announcements</span>
            </li>
            <li>
                <a href=<?php echo URLROOT . "/CounselorReport/home" ?>>
                    <i class="fa-solid fa-rectangle-list"></i>
                    <span class="links_name">Report</span>
                </a>
                <span class="tooltip">Report</span>
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
                        <img src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" alt="">
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