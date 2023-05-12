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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/appointmentStyle.css" ?>>
    <script type="module" src=<?php echo URLROOT . "/public/js/student/loadCounselors.js" ?> defer></script>
    <script src=<?php echo URLROOT . "/public/js/flash.js" ?> defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" defer></script>
</head>

<body>
    <?php
    require_once '../app/views/counselor_stu/sidebar.php';
    ?>
    <div class="home_content">
        <div class="container">
            <div class="row1">
                <h1>Appointments</h1>
            </div>
            <div class="row2">
                <div class="col1">
                    <div class="topic1">
                        <h3><a href="<?php echo URLROOT ?>/appointments/">Appointments</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col2">
                    <div class="topic1">
                        <h3><a href="<?php echo URLROOT ?>/appointments/list">Counselors</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col3">
                    <div class="topic1">
                        <h3><a href="<?php echo URLROOT ?>/appointments/requests">Requests</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col4">
                    <div class="topic1">
                        <h3>dff</h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row3">
                <div class="appointments">
                    <!-- pending appointments -->
                    <h2>Upcoming appointments</h2>

                    <?php if (empty($data['appointments'])) { ?>
                        <div class="call-empty">
                            <h3>No appointments yet</h3>
                        </div>
                    <?php } ?>


                    <?php foreach ($data['appointments'] as $appointment) :
                        $date = date('jS \of F', strtotime($appointment->appointmentDate));
                        $time = date('h:i A', strtotime($appointment->appointmentTime));
                        $counselor = $appointment->fullname;
                        $timezone = new DateTimeZone('Asia/Kolkata'); // Set your time zone here
                        $currentTime = new DateTime('now', $timezone);
                        $today = $currentTime->format('Y-m-d');
                        $id = $appointment->appointmentID;
                        $meetingId = $appointment->meetingID;
                        $counselorId = $appointment->counsellorID;
                        if ($appointment->profile_img != NULL) {
                            $image = $appointment->profile_img;
                        } else {
                            $image = "avatar.jpg";
                        }
                        $appointmentIds = array_column($data['newAppointments'], 'appointmentID');
                    ?>
                        <!-- Popup Form -->
                        <div class="overlay">
                            <div class="popup">
                                <form action="<?php echo URLROOT; ?>/appointments/cancel_appointment/<?php echo $id; ?> " method="post">
                                    <div class="heading">
                                        Appointment cancellation
                                    </div>
                                    <div class="description">
                                        <div class="desc-name">
                                            Description:
                                        </div>
                                        <div class="text">
                                            <textarea name="rdesc" cols="30" rows="10">Reason for cancellation</textarea>
                                        </div>
                                        <div class="submit">
                                            <button type="submit" class="btn2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <button class="exit-button">&times;</button>
                            </div>
                        </div>

                        <!-- End Popup Form -->
                        <div class="meeting">
                            <div class="date">
                                <?php if ($appointment->appointmentDate == $today) : ?>
                                    <h3>Today</h3>
                                <?php else : ?>
                                    <h3><?php echo $date ?></h3>
                                <?php endif; ?>
                            </div>
                            <div class="call">
                                <div class="time">
                                    <?php echo $time ?>
                                </div>
                                <div class="image">
                                    <img src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" class="image2">
                                </div>
                                <div class="counselor-name" id="<?php echo $counselorId ?>">
                                    <h3>Dr.<?php echo $counselor ?></h3>
                                </div>
                                <?php if ($appointment->appointmentDate == $today && $appointment->appointmentTime <= $currentTime && $appointment->is_started == 1) { ?>
                                    <div class="join">
                                        <button class="btn" id="uploadBtn" onclick="meeting(<?php $meetingId ?>)">
                                            <div class="btn-class">
                                                <div class="btnName">
                                                Started
                                                </div>
                                                <div class="btnIcon">
                                                <i class="fa-solid fa-circle fa-fade fa-2xs" style="color: #17e82f;"></i>
                                                </div>
                                            </div>

                                        </button>
                                    </div>
                                    <div class="join2">
                                        <button class="btn2" id="uploadBtn" onclick="showPopup()">
                                            <div class="btn-class">
                                                <div class="btnName">
                                                    Cancel
                                                </div>
                                                <div class="btnIcon">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                            </div>

                                        </button>
                                    </div>
                                <?php } else { ?>
                                    <div class="join">
                                        <button class="btn3">
                                            <div class="btn-class">
                                                <div class="btnName">
                                                    Upcoming
                                                </div>
                                                <div class="btnIcon">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                            </div>

                                        </button>
                                    </div>
                                    <div class="join2">
                                        <button class="btn2" id="uploadBtn" onclick="showPopup()">
                                            <div class="btn-class">
                                                <div class="btnName">
                                                    Cancel
                                                </div>
                                                <div class="btnIcon">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                            </div>

                                        </button>
                                    </div>
                                    <?php
                                    if (in_array($id, $appointmentIds)) { ?>
                                        <span class="icon_button_badge"><i class="fa-solid fa-circle-exclamation"></i></span>

                                <?php }
                                } ?>

                            </div>
                        </div>

                    <?php endforeach; ?>
                    <!-- cancelled appointments -->
                    <br><br>
                    <h2>Appointment cancellation requests</h2>

                    <?php if (empty($data['cancelledAppointments'])) { ?>
                        <div class="call-empty">
                            <h3>No cancellation requests</h3>
                        </div>
                    <?php } ?>

                    <?php foreach ($data['cancelledAppointments'] as $appointment) :
                        $date = date('jS \of F', strtotime($appointment->appointmentDate));
                        $time = date('h:i A', strtotime($appointment->appointmentTime));
                        $counselor = $appointment->fullname;
                        $today = date('Y-m-d');
                        $currentTime = date('H:i');
                        $id = $appointment->appointmentID;
                        $meetingId = $appointment->meetingID;
                        $counselorId = $appointment->counsellorID;
                        $cancellationReason = $appointment->cancellationReason;
                        $appointmentStatus =  $appointment->appointmentStatus;
                        if ($appointment->profile_img != NULL) {
                            $image = $appointment->profile_img;
                        } else {
                            $image = "avatar.jpg";
                        }
                        $appointmentIds = array_column($data['newAppointments'], 'appointmentID');
                    ?>
                        <div class="meeting">
                            <div class="date">
                                <h3><?php echo $date ?></h3>
                            </div>
                            <div class="call">
                                <div class="time">
                                    <?php echo $time ?>
                                </div>
                                <div class="image">
                                    <img src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" class="image2">
                                </div>
                                <div class="counselor-name" id="<?php echo $counselorId ?>">
                                    <h3>Dr.<?php echo $counselor ?></h3>
                                </div>
                                <div class="join">
                                    <h4><?php echo $cancellationReason ?></h4>
                                </div>
                                <div class="join2">
                                    <?php if ($appointmentStatus == 2) { ?>
                                        <button class="btn2" id="uploadBtn" onclick="undo('<?php echo $id ?>')">
                                            <div class="btn-class">
                                                <div class="btnName">
                                                    Pending
                                                </div>
                                                <div class="btnIcon">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                            </div>
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn3" id="uploadBtn">
                                            <div class="btn-class2">
                                                <div class="btnName">
                                                    Cancelled
                                                </div>
                                            </div>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>


                </div>
                <div class="counselor-details" id="search-results">
                    <div class="counselor-pic">
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" id="image3">
                    </div>
                    <div class="counselor-name">
                        <h3>Dr.Howard Morrison</h3>
                    </div>
                    <div class="address">
                        <p>123, Main Street, Colombo 01</p>
                    </div>
                    <div class="horizontal">
                        <hr>
                    </div>
                    <div class="topic1">
                        <h3>Counselor Details</h3>
                    </div>
                    <div class="details">
                        <div class="index">
                            <div class="dob">
                                DOB
                            </div>
                            <div class="qualification">
                                Qualification
                            </div>
                            <div class="first-appointment">
                                First Appointment
                            </div>
                            <div class="description">
                                Description
                            </div>
                        </div>
                        <div class="content">
                            <div class="dob-details">
                                16 August 1968
                            </div>
                            <div class="qualification-details">
                                MBBS, MD, FRCPsych
                            </div>
                            <div class="first-appointment-details">
                                3 September 2022
                            </div>
                            <div class="description-details">
                                <pre>
Chartered 
psychologist 
specialized in 
counselling and psychotherapy with 
expertise in dealing 
with children, adolescents and 
families.
                                   </pre>
                            </div>
                        </div>
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

        function showPopup() { //show modal for cancel appointment
            var popup = document.querySelector(".overlay");
            popup.style.display = "block";
        }

        function undo(id) {
            //got to a function in the controller to undo the cancellation

            let url = `http://localhost/StudentCare/Appointments/undoCancellation?id=${id}`;
            window.location.href = url;
        }

        const overlay = document.querySelector('.overlay');
        const popup = overlay.querySelector('.popup');
        const exitButton = popup.querySelector('.exit-button');

        function closePopup() {
            var popup = document.querySelector(".overlay");
            popup.style.display = "none";
        }

        exitButton.addEventListener('click', closePopup);
        overlay.addEventListener('click', (event) => {
            if (event.target === overlay) {
                closePopup();
            }
        });


    </script>
</body>

</html>