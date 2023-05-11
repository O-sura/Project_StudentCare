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
    <?php
    require_once '../app/views/tasks/sidebar.php';
    ?>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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
                            <?php
                                $color = $task->task_color;
                                $id = 'not';
                                if($task->task_status == 'completed'){
                                    $color = '#fff';
                                    $id= 'completed';
                                }
                            ?>
                            <div class="task" id = "<?php echo $id ?>" style="background-color:<?php echo $color; ?>;">
                                <div class="time"> <?php echo $task->task_time ?> </div>
                                <div class="desc" >
                                    <?php echo $task->task_description . "<br><br>"; ?>
                                </div>
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