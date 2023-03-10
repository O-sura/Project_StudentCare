<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/dashboard.css"?>">
  <script src= <?php echo URLROOT . "/public/js/Counselor/barchart.js"?> defer></script>
  <script src= <?php echo URLROOT . "/public/js/Counselor/piechart.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">
        
            <div class="divSection" >
                <div class="row1">
                    <div class="row1div1">
                        <h3 class="subb">Appointment Stats</h3>
                        <div class="pie" style="width:70%; ">
                            <canvas id="pieChart"></canvas>
                        </div>
                        <!-- <img class="piechart" src="<?php echo URLROOT."/public/img/free-pie-chart-icon-683-thumb.png"?>"> -->
                    </div>
                    <div class="row1div2">
                        <h3 class="subb">Next Appointment</h3><br>
                        <i class="fa-regular fa-calendar-check" style="font-size: 3em"></i><br><br>
                        <p class="cont">Name : Mr. P.H Gurusinghe</p><br>
                        <p class="cont">Time : 11.30 a.m</P>
                    </div>
                    <div class="row1div3">
                        <h3 class="subb">Students Stats</h3>
                        <div class="graph">
                            <canvas id="myChart" style="width:80%;"></canvas>
                        </div>
                        <!-- <img class="piechart" src="<?php echo URLROOT."/public/img/Blue_bar_graph.png"?>"> -->
                    </div>
                </div>
               
                <h2 class="subTopic">Daily Appointments</h2><br>
                <div class="row2">
                    
                    <div class="row2div1">10:00 <br>A.M</div>
                    <div class="row2div1">11:30 <br>A.M</div>
                    <div class="row2div1">01:30 <br>P.M</div>
                    <div class="row2div1">02:45 <br>P.M</div>
                    <div class="row2div1">04:15 <br>P.M</div>
                </div>
           
                <h2 class="subTopic">Daily Notifications</h2><br>
                <div class="row3">
                    <div class="row3div1">
                        <span><i class="fa-regular fa-circle-dot" style="color:grey;"></i><div class="row3div2">You have new student request from Mr. M.H Ranasinghe</div></span>
                        <span><i class="fa-regular fa-circle-dot" style="color:grey;"></i><div class="row3div2">You have new student request from Ms. G.K Gamage</div></span>
                        <span><i class="fa-regular fa-circle-dot" style="color:grey;"></i><div class="row3div2">You have a important message from the admin</div></span>
                    </div>
                </div>
            </div>
            
        
    </div>
</body>

</html>
