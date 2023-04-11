<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/editRequestStyle.css" ?>>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name"></div>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href='<?php echo URLROOT ?>/student/home'>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/community/home'>
                    <i class="fa-solid fa-users"></i>
                    <span class="links_name">Community</span>
                </a>
                <span class="tooltip">Community</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/tasks/'>
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="links_name">Schedule</span>
                </a>
                <span class="tooltip">Schedule</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/appointments/'>
                    <i class="fa-solid fa-calendar-check"></i></i>
                    <span class="links_name">Appointments</span>
                </a>
                <span class="tooltip">Appointments</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/announcements/'>
                    <i class="fa-solid fa-bullhorn"></i></i>
                    <span class="links_name">Announcements</span>
                </a>
                <span class="tooltip">Announcements</span>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/Student_facility/">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span class="links_name">Listings</span>
                </a>
                <span class="tooltip">Listings</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80">
                    <div class="name">
                        Oshada
                    </div>
                </div>
                <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="container">
            <?php $requestId = $data['requestDetails']->request_id; ?>
            <form action="<?php echo URLROOT; ?>/appointments/editRequest/<?php echo $requestId; ?> " method="post">
                <div class="request-form">
                    <div class="heading">
                        Edit Appointment Request
                        <hr>
                    </div>
                    <div class="counselor-details">
                        <div class="counselor-name">
                            <div class="name">
                                Counselor Name
                            </div>
                            <div class="text">
                                <h3><?php echo $data['requestDetails']->fullname ?></h3>
                            </div>
                        </div>
                        <div class="counselor-name">
                            <div class="name">
                                Counselor Specialization
                            </div>
                            <div class="text">
                                <h3><?php echo $data['requestDetails']->specialization ?></h3>
                            </div>
                        </div>
                        <div class="counselor-name">
                            <div class="name">
                                Requested On
                            </div>
                            <div class="text">
                                <h3><?php echo $data['requestDetails']->requested_on ?></h3>
                            </div>
                        </div>

                    </div>
                    <div class="description">
                        <div class="desc-name">
                            Description
                        </div>
                        <div class="text">
                            <textarea name="rdesc" cols="30" rows="30"><?php echo $data['requestDetails']->request_description ?></textarea>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn">Confirm Changes</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>

</html>