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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/dashboardStyle.css" ?>>
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
                        <?php echo $data['username'] ?>
                    </div>
                </div>
                <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="container">
            <div class="row1">
                <h1>Greetings User</h1>
            </div>
            <div class="row2">
                <div class="user-details">
                    <h2>Profile</h2>
                    <div class="prof-img">
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="" id="image2">
                    </div>
                    <div class="prof-details">
                        <h3><?php echo $data['username'] ?></h3><br><br>
                        <button class="btn"> <i class="fa-solid fa-pen-to-square"></i> Edit profile</button>
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
                        <div class="topic">
                            <h3>Messages</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-brands fa-facebook-messenger"></i>
                        </div>
                    </div>
                    <div class="messages" id="tasks">
                        <div class="topic">
                            <h3>Tasks</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                    </div>
                    <div class="messages" id="announcements">
                        <div class="topic">
                            <h3>Announcements</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                    </div>
                    <div class="messages" id="appointments">
                        <div class="topic">
                            <h3>Appointments</h3>
                        </div>
                        <div class="favcons">
                            <i class="fa-regular fa-calendar-check"></i>
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

        //Javascript for chart
        var xValues = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        var yValues = [5, 6, 13, 13, 1, 6, 7];
        var barColors = ["#1A285A", "#1A285A", "#1A285A", "#1A285A", "#1A285A", "#1A285A", "#1A285A"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Study hours this week"
                }
            }
        });

        var edit = document.querySelector('.btn');
        var messages = document.querySelector('#messages');
        var tasks = document.querySelector('#tasks');
        var announcements = document.querySelector('#announcements');
        var appointments = document.querySelector('#appointments');
        messages.addEventListener('click', function() {
            window.location.href = '<?php echo URLROOT ?>/messaging/';
        });
        tasks.addEventListener('click', function() {
            window.location.href = '<?php echo URLROOT ?>/tasks/';
        });
        announcements.addEventListener('click', function() {
            window.location.href = '<?php echo URLROOT ?>/announcements/';
        });
        appointments.addEventListener('click', function() {
            window.location.href = '<?php echo URLROOT ?>/appointments/';
        });

        edit.addEventListener('click', function() {
            window.location.href = '<?php echo URLROOT ?>/student/profile';
        });
    </script>
</body>

</html>