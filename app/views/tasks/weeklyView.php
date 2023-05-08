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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/weeklyView.css" ?>>
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
        <div class="container">
            <div class="row1">
                <h1>Personal Schedule</h1>
            </div>
            <div class="row2">
                <div class="flex">
                    <div class="month">
                        <h3><a href="<?php echo URLROOT ?>/tasks/">Monthly</a></h3><br>
                        <hr class="rest">
                    </div>
                    <div class="week">
                        <h3><a href="<?php echo URLROOT ?>/tasks/weekly">Weekly</a></h3><br>
                        <hr>

                    </div>
                    <div class="daily">
                        <h3><a href="<?php echo URLROOT ?>/tasks/today">Daily</a></h3>
                    </div>
                </div>

            </div>
            <div class="row3">
                <div class="col-1">
                    <div class="day">
                        <h3>Monday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['monday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['mondayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>
                <div class="col-2">
                    <div class="day">
                        <h3>Tuesday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['tuesday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['tuesdayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>
                <div class="col-3">
                    <div class="day">
                        <h3>Wednesday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['wednesday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['wednesdayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>
                <div class="col-4">
                    <div class="day">
                        <h3>Thursday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['thursday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['thursdayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>
                <div class="col-5">
                    <div class="day">
                        <h3>Friday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['friday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['fridayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>
                <div class="col-6">
                    <div class="day">
                        <h3>Saturday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['saturday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['saturdayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>
                <div class="col-7">
                    <div class="day">
                        <h3>Sunday</h3>
                    </div>
                    <div class="date">
                        <h3><?php echo date('d', strtotime($data['sunday'])) ?></h3>
                    </div>
                    <div class="tasks">
                        <?php foreach ($data['sundayTasks'] as $task) { ?>
                            <div class="task" style="background-color:<?php echo $task->task_color; ?>;">
                                <?php echo $task->task_description . "<br><br>"; ?>
                            </div>

                        <?php  }
                        ?>


                    </div>
                </div>

            </div>
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