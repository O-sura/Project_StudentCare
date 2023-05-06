<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/viewStyle.css" ?>>
</head>

<body>
    <?php
    require_once '../app/views/announcements/sidebar.php';
    ?>
    <div class="home_content">
        <div class="container">
            <?php
            $subject = $data['announcement']->post_head;
            $message = $data['announcement']->post_desc;
            $format_message = nl2br($message);
            $datetime_stamp = $data['announcement']->posted_date; // example datetime stamp
            $formatted_date = date("l, j F Y, g.i A", strtotime($datetime_stamp));
            ?>
            <div class="row1">
                <h1>Announcements</h1>
                <hr>
            </div>

            <div class="row2">
                <div class="col1">
                    <?php

                    if ($data['announcement']->profile_img != NULL) {
                        $image = $data['announcement']->profile_img;
                    } else {
                        $image = "avatar.jpg";
                    }
                    ?>
                    <img id="image" src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" alt="">
                </div>
                <div class="col2">
                    <div class="col2-row1">
                        <?php echo $subject; ?>
                    </div>
                    <div class="col2-row2">
                        by <?php echo  $data['announcement']->fullname; ?> on <?php echo $formatted_date ?>
                    </div>
                </div>
            </div>
            <div class="row3">

                <?php echo $format_message; ?>

            </div>
        </div>


    </div>

</body>

</html>