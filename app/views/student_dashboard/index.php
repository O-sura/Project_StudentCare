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
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css" ?>">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/dashboardStyle.css" ?>>
    <script type="module" src=<?php echo URLROOT . "/public/js/student/dashboard.js" ?> defer></script>
    <script src=<?php echo URLROOT . "/public/js/flash.js" ?> defer></script>
    
</head>

<body>
    
    <?php
    require_once '../app/views/student_dashboard/sidebar.php';
    ?>
    <?php FlashMessage::flash('system_feedback_flash'); ?>
    <div class="home_content">
        <div class="container">
            <!-- Popup Form -->
            <div class="overlay">
                <div class="popup">
                    <form action="<?php echo URLROOT; ?>/student/give_feedback" method="post">
                        <div class="heading">
                            Give us your feedback
                        </div>
                        <div class="description">
                            <div class="desc-name">
                                Description:
                            </div>
                            <div class="text">
                                <textarea name="rdesc" cols="30" rows="10">Your feedback is invaluable to us...</textarea>
                            </div>
                            <div class="submit">
                                <button type="submit" class="btn">Send feedback</button>
                            </div>
                        </div>
                    </form>
                    <button class="exit-button">&times;</button>
                </div>
            </div>

            <!-- End Popup Form -->
            <div class="row1">
                <h1>Greetings User</h1>
            </div>
            <div class="row2">
                <div class="user-details">
                    <h2>Profile</h2>
                    <div class="prof-img">
                        <?php
                        if ($data["userDetails"]->profile_img != NULL) {
                            $image = $data["userDetails"]->profile_img;
                        } else {
                            $image = "avatar.jpg";
                        }
                        ?>
                        <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" alt="" id="image2">
                    </div>
                    <div class="prof-details">
                        <h3><?php echo $data['username'] ?></h3><br><br>
                        <button class="btn" id = "edit"> <i class="fa-solid fa-pen-to-square"></i> Edit profile</button>
                        <div class="feedback">
                            <button class="btn2" id="feedback">
                                <h3><i class="fa-regular fa-comment-dots"></i> Give feedback</h3>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="chart">
                    <div class="study-time">
                        <div class="col1">
                            <h3>Study time stats</h3>
                        </div>
                        <div class="col-2">
                            <select class="select">

                                <option value="Exam">Last 7 days</option>
                                <option value="Club">Last 14 days</option>
                                <option value="Gym">Last 30 days</option>
                            </select>
                        </div>

                    </div>

                    <div class="graph">
                        <canvas id="myChart" style="width:100%;max-width:80%"></canvas>
                    </div>

                </div>
            </div>
            <div class="row3">
                <div class="notifications">
                    Notifications
                </div>
                <div class="boxes">
                    <div class="messages" id="messages">
                        <div class="topic2">
                            <h3>Messages</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-brands fa-facebook-messenger"></i>
                        </div>
                        <?php if ($data['new_messages_count'] > 0) : ?>
                            <span class="icon_button_badge"><?php echo $data['new_messages_count'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="messages" id="tasks">
                        <div class="topic2">
                            <h3>Tasks</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <?php if ($data['task_notification_count'] > 0) : ?>
                            <span class="icon_button_badge"><?php echo $data['task_notification_count'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="messages" id="announcements">
                        <div class="topic2">
                            <h3>Announcements</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <span class="icon_button_badge">2</span>
                    </div>
                    <div class="messages" id="appointments">
                        <div class="topic2">
                            <h3>Appointments</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <?php if ($data['new_requests_count'] > 0) : ?>
                            <span class="icon_button_badge"><?php echo $data['new_requests_count'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>


    </div>

</body>

</html>

</html>