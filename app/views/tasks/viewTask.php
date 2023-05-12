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
    <?php
    require_once '../app/views/tasks/sidebar.php';
    ?>
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
                                                    <option value="not started" selected>Not started</option>
                                                    <option value="started">In progress</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>
                                            <div class="remove">
                                            <a href="<?php echo URLROOT ?>/tasks/delete/?task_id=<?php echo $rows->task_id ?>&task_date=<?php echo $rows->task_date?>"><i class="fa-solid fa-trash"></i></a>
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
                                                    <option value="started" selected>In progress</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="not started">Not started</option>

                                                </select>

                                            </div>
                                            <div class="remove">
                                            <a href="<?php echo URLROOT ?>/tasks/delete/?task_id=<?php echo $rows2->task_id ?>&task_date=<?php echo $rows2->task_date?>"><i class="fa-solid fa-trash"></i></a>
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

                                                <h3 class="completed" id="__<?php echo $rows3->task_id ?>"><a href="EditTask.php"><?php echo $rows3->task_description; ?></a></h3>

                                            </div>

                                            <div class="col-18">

                                                <select class="select" id=<?php echo $rows3->task_id ?> name=<?php echo $rows3->task_id ?> onchange="dropDown(this.id,'<?php echo $rows3->task_color; ?>');">
                                                    <option value="completed" selected>Completed</option>
                                                    <option value="not started">Not started</option>
                                                    <option value="started">In progress</option>
                                                </select>

                                            </div>
                                            <div class="remove">
                                            <a href="<?php echo URLROOT ?>/tasks/delete/?task_id=<?php echo $rows3->task_id ?>&task_date=<?php echo $rows3->task_date?>"><i class="fa-solid fa-trash"></i></a>
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
            </div>
    </div>



    <script src=<?php echo URLROOT . "/public/js/viewTaskScript.js" ?>></script>
</body>

</html>