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
    <?php
    require_once '../app/views/counselor_stu/sidebar.php';
    ?>
    <div class="home_content">
        <div class="container">
            <?php $requestId = $data['requestDetails']->rID; ?>
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
                            <textarea name="rdesc" cols="30" rows="30"><?php echo $data['requestDetails']->rNote ?></textarea>
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