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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/requestStyle.css" ?>>
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

    <div class="container">
        <div class="row1">
            <h1>Requests</h1>
        </div>
        <div class="row2">
            <div class="col1">
                <div class="topic">
                    <h3><a href="<?php echo URLROOT ?>/appointments/">Appointments</a></h3>
                </div>
                <div class="slider">
                    <hr>
                </div>
            </div>
            <div class="col2">
                <div class="topic">
                    <h3><a href="<?php echo URLROOT ?>/appointments/list">Counselors</a></h3>
                </div>
                <div class="slider">
                    <hr>
                </div>
            </div>
            <div class="col3">
                <div class="topic">
                    <h3><a href="<?php echo URLROOT ?>/appointments/requests">Requests</a></h3>
                </div>
                <div class="slider">
                    <hr>
                </div>
            </div>
            <div class="col4">
                <div class="topic">
                    <h3>dff</h3>
                </div>
                <div class="slider">
                    <hr>
                </div>
            </div>
        </div>
        <div class="row3">


            <div class="meeting">
                <div class="date">
                    <h3>Accepted Requests</h3><br>
                </div>
                <?php if ($data['acceptedCount'] > 0) {
                    foreach ($data['acceptedRequests'] as $accepted) :
                        $id = $accepted->rID;
                        $requested_on = $accepted->requested_on;
                        $date = date("d M Y", strtotime($requested_on));
                        $specialization = $accepted->specialization;
                        $name = $accepted->fullname;
                        $email = $accepted->email;
                        $requestIds = array_column($data['newRequests'], 'rID');
                ?>
                        <div class="call" id="accepted">
                            <div class="date">
                                <?php echo $date ?>
                            </div>
                            <div class="time">
                                <?php echo $specialization ?>
                            </div>
                            <div class="image">
                                <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" class="image2">
                            </div>
                            <div class="counselor-name">
                                <h3>Dr. <?php echo $name ?></h3>
                            </div>
                            <div>
                                <button class="btn" id="<?php echo $email ?>" onclick="sendEmail(this.id)">Send Email</button>
                            </div>
                            <?php
                            if (in_array($id, $requestIds)) { ?>
                                <span class="icon_button_badge"><i class="fa-solid fa-circle-exclamation"></i></span>

                            <?php } ?>

                        </div>
                    <?php endforeach;
                } else { ?>
                    <div class="call" id="noAccepts">
                        <h4>No Accepted Requests</h4>
                    </div>

                <?php   } ?>

            </div>
            <div class="meeting">
                <div class="date">
                    <h3>Pending Requests</h3><br>
                </div>
                <?php if ($data['pendingCount'] > 0) {
                    foreach ($data['pendingRequests'] as $pending) :
                        $id = $pending->rID;
                        $requested_on = $pending->requested_on;
                        $date = date("d M Y", strtotime($requested_on));
                        $specialization = $pending->specialization;
                        $name = $pending->fullname;
                        $requestIds = array_column($data['newRequests'], 'rID');
                ?>
                        <div class="call">
                            <div class="date">
                                <?php echo $date ?>
                            </div>
                            <div class="time">
                                <?php echo $specialization ?>
                            </div>
                            <div class="image">
                                <img src="https://images.unsplash.com/photo-1566753323558-f4e0952af115?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1021&q=80" class="image2">
                            </div>
                            <div class="counselor-name">
                                <h3>Dr. <?php echo $name ?> </h3>
                            </div>
                            <div class="clickables">
                                <div class="join">
                                    <button class="btn2" onclick="window.location.href='<?php echo URLROOT ?>/appointments/editRequest/<?php echo $id; ?>'">Edit request</button>
                                </div>
                                <div class="join">
                                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/appointments/delete_request/<?php echo $id; ?>'">Remove</button>
                                </div>
                            </div>
                            <?php
                            if (in_array($id, $requestIds)) { ?>
                                <span class="icon_button_badge"><i class="fa-solid fa-circle-exclamation"></i></span>

                            <?php } ?>
                        </div>
                    <?php endforeach;
                } else { ?>
                    <div class="call" id="noPending">
                        <h3>No Pending Requests</h3>
                    </div>

                <?php   } ?>

            </div>


            <div class="meeting">
                <div class="date">
                    <h3>Rejected requests</h3><br>
                </div>
                <?php if ($data['rejectedCount'] > 0) {
                    foreach ($data['rejectedRequests'] as $rejected) :
                        $id = $rejected->rID;
                        $requested_on = $rejected->requested_on;
                        $date = date("d M Y", strtotime($requested_on));
                        $specialization = $rejected->specialization;
                        $reason = $rejected->reason;
                        $name = $rejected->fullname;
                        $requestIds = array_column($data['newRequests'], 'rID');
                ?>

                        <div class="call" id="rejected">
                            <div class="date">
                                <?php echo $date; ?>
                            </div>
                            <div class="time">
                                <?php echo $specialization; ?>
                            </div>
                            <div class="image">
                                <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" class="image2">
                            </div>
                            <div class="counselor-name">
                                <h3>Dr. <?php echo $name; ?></h3>
                            </div>
                            <div class="clickables">
                                <div class="join">

                                    Reason :

                                </div>
                                <div class="join">
                                    <?php echo $reason; ?>
                                </div>
                            </div>

                            <span class="icon_button_badge"><i class="fa-solid fa-circle-exclamation"></i></span>



                        </div>
                    <?php endforeach;
                } else { ?>
                    <div class="call" id="noRejects">
                        <h3>No rejected Requests</h3>
                    </div>

                <?php   } ?>

            </div>
        </div>
    </div>




    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        function sendEmail(email) {
            const subject = 'Request for an appointment';
            const body = 'Hi, I would like to request an appointment with you.';
            const mailtoLink = `mailto:${email}?subject=${subject}&body=${body}`;
            window.location.href = mailtoLink;
        }
    </script>
</body>

</html>