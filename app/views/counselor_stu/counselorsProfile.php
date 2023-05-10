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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/counselorProfileStyle.css" ?>>
</head>

<body>
    <?php
    require_once '../app/views/counselor_stu/sidebar.php';
    ?>
    <div class="home_content">
        <div class="container">
            <div class="topic">
                <h1>Counselor Profile</h1>
            </div>
            <div class="counselor-details">

                <div class="prof-image">
                    <?php
                    if ($data["counselorProfile"]->profile_img != NULL) {
                        $image = $data["counselorProfile"]->profile_img;
                    } else {
                        $image = "avatar.jpg";
                    }
                    ?>
                    <img src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" id="image2">
                </div>
                <div class="personal">
                    <div class="heading">
                        Personal Information
                    </div>
                    <div class="content-1">
                        <div class="indexes-1">
                            <div>
                                Name:
                            </div>
                            <div>
                                Age:
                            </div>
                            <div>
                                Specializaton:
                            </div>
                        </div>
                        <div class="values-1">
                            <div>
                                <?php echo $data['counselorProfile']->fullname; ?>
                            </div>
                            <div>
                                <?php echo $data['counselorProfile']->age; ?>
                            </div>
                            <div>
                                <?php echo $data['counselorProfile']->specialization; ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col1">
                    <div class="heading">
                        Contact Info
                    </div>
                    <div class="content-2">
                        <div class="indexes-2">
                            <div>
                                Address:
                            </div>
                            <div>
                                Contact Number:
                            </div>
                        </div>
                        <div class="values-2">
                            <div>
                                <?php echo $data['counselorProfile']->home_address; ?> <br> <br>
                            </div>
                            <div>
                                <?php echo $data['counselorProfile']->contact_no; ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col2">
                    <div class="heading">
                        Qualifications
                    </div>
                    <?php $qualifications = explode(",", $data['counselorProfile']->qualifications); ?>
                    <div>
                        <ul>
                            <?php foreach ($qualifications as $qualification) : ?>
                                <li>
                                    <?php echo $qualification; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>


            </div>
            <?php $counselorId = $data['counselorId']; ?>
            <form action="<?php echo URLROOT; ?>/appointments/add_request/<?php echo $counselorId; ?> " method="post">
                <div class="request-form">
                    <?php
                    $hadRequested = $data['hasRequested'];
                    $reachedLimit = $data['requestLimit'];
                    ?>
                    <?php if ($hadRequested == 1) { ?>
                        <p id="already"><i class="fa-solid fa-circle-info"></i> You already have a pending request with this counselor. </p>


                    <?php } else { ?>
                        <?php if ($reachedLimit == 1) { ?>
                            <p id="already"><i class="fa-solid fa-circle-info"></i> You have reached the request limit. </p>
                        <?php } else { ?>
                            <div class="heading" id="requests">
                                Request an Appointment
                            </div>
                            <div class="description">
                                <div class="desc-name">
                                    Appointment description :
                                </div>
                                <div class="text">
                                    <textarea name="rdesc" cols="30" rows="30">Write a short desciption about why you need counselling....</textarea>
                                </div>
                                <div class="submit">
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </form>

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