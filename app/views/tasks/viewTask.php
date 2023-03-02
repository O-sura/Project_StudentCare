<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/viewTaskStyle.css" ?>>
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
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                    <div class="name">
                        Oshada
                    </div>
                </div>
                <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <form method="post">
            <div class="container">
                <div class="rows1">
                    <h1>Personal Schedule</h1>
                </div>
                <div class="rows2">
                    <div class="flex">
                        <div class="month">
                            <h3><a href="<?php echo URLROOT ?>/tasks/">Monthly</a></h3><br>
                            <hr class="rest">

                        </div>
                        <div class="week">
                            <h3><a href="<?php echo URLROOT ?>/tasks/weekly">Weekly</a></h3>
                        </div>
                        <div class="day">
                            <h3><a href="<?php echo URLROOT ?>/tasks/today">Daily</a></h3><br>
                            <hr>
                        </div>
                    </div>

                </div>


                <div class="wrapper">
                    <h2><?php echo $data['day']; ?> <?php echo $data['dayNum']; ?></h2>
                </div>
                <div class="row-4">
                    Tasks today
                </div>
                <div class="row-x">
                    <div class="col-x">
                        <?php
                        if (count($data['all']) == 0) {
                            echo "No tasks on this day";
                        }
                        ?>
                        <?php
                        if (count($data['all']) > 0) {
                        ?>
                            <div class="row-5">

                                <div class="col-1">
                                    <?php
                                    foreach ($data['notStarted'] as $rows) : ?>
                                        <?php
                                        $time = $rows->task_time;

                                        ?>
                                        <div class="col-3">
                                            <label> <?php echo date("h:i A", strtotime($time)); ?></label>
                                        </div>

                                        <div class="col-4" id="_<?php echo $rows->task_id ?>" style="background-color:<?php echo $rows->task_color; ?>;">
                                            <div class="col-5">
                                                <h3 id="__<?php echo $rows->task_id ?>"><a href="EditTask.php"><?php echo $rows->task_description; ?></a></h3>
                                            </div>

                                            <div class="col-6">

                                                <select class="select" id=<?php echo $rows->task_id ?> name=<?php echo $rows->task_id ?> onchange="dropDown(this.id,'<?php echo $rows->task_color; ?>');">
                                                    <option value="not started">Not started</option>
                                                    <option value="started">In progress</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>

                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>




                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (count($data['started']) > 0) {
                        ?>
                            <div class="row-8">

                                <div class="col-7">
                                    <?php
                                    foreach ($data['started'] as $rows2) :
                                    ?>
                                        <?php
                                        $time = $rows2->task_time;

                                        ?>
                                        <div class="col-9">
                                            <label> <?php echo date("h:i A", strtotime($time)); ?></label>
                                        </div>

                                        <div class="col-10" id="_<?php echo $rows2->task_id ?>" style="background-color:<?php echo $rows2->task_color; ?>;">
                                            <div class="col-11">
                                                <h3 id="__<?php echo $rows2->task_id ?>"><a href="EditTask.php"><?php echo $rows2->task_description; ?></a></h3>
                                            </div>

                                            <div class="col-12">

                                                <select class="select" id=<?php echo $rows2->task_id ?> name=<?php echo $rows2->task_id ?> onchange="dropDown(this.id,'<?php echo $rows2->task_color; ?>');">
                                                    <option value="started">In progress</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="not started">Not started</option>

                                                </select>

                                            </div>

                                        </div>
                                    <?php
                                    endforeach;
                                    ?>

                                </div>


                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (count($data['completed']) > 0) {
                        ?>
                            <div class="row-9">

                                <div class="col-13">
                                    <?php
                                    foreach ($data['completed'] as $rows3) :
                                    ?>
                                        <?php
                                        $time = $rows3->task_time;

                                        ?>

                                        <div class="col-15">
                                            <label> <?php echo date("h:i A", strtotime($time)); ?></label>
                                        </div>

                                        <div class="col-16" id="_<?php echo $rows3->task_id ?>">
                                            <div class="col-17">

                                                <h3 class="completed" id="__<?php echo $rows3->task_id ?> onclick()"><a href="EditTask.php"><?php echo $rows3->task_description; ?></a></h3>

                                            </div>

                                            <div class="col-18">

                                                <select class="select" id=<?php echo $rows3->task_id ?> name="<?php echo $rows3->task_id ?>" onchange="dropDown(this.id,'<?php echo $rows3->task_color; ?>');">
                                                    <option value="completed">Completed</option>
                                                    <option value="not started">Not started</option>
                                                    <option value="started">In progress</option>
                                                </select>

                                            </div>

                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>




                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-y">
                        <div class="col-2">
                            <button class="btn" id="btn4"><a href="<?php echo URLROOT; ?>/tasks/add">Add task</a></button>
                        </div>
                        <div class="col-14">
                            <button class="btn2" type="submit" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <script src=<?php echo URLROOT . "/public/js/viewTaskScript.js" ?>></script>
</body>

</html>