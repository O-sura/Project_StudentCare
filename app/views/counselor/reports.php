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
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/reports.css"?>">
  <script src= <?php echo URLROOT . "/public/js/Counselor/repochart.js"?> defer></script>
  
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">

        <div class="navtag" id="/CounselorReport/home" hidden>

        </div>

        <div class="topic">
            <span><h1 class="headApp">Reports</h1></span>
        </div>
        <hr class="hrbar">
 
            <div class="div4">
            
                <div class="div5">
                    <h1>Monthly Session Overview</h1><br>
                    <div class="subdiv">
                        <div class="sub1">
                            <h2>Total Appointments <br><br> <h1 class="count" id="total"> </h1></h2>
                        </div>
                        <div class="sub2">
                            <h2>Completed Appointments <br><br> <h1 class="count" id="completed"></h1></h2>
                        </div>
                        <div class="sub3">
                            <h2>Cancelled Appointments <br><br> <h1 class="count" id="cancelled"></h1></h2>
                        </div>
                    </div>
                    <div class="graph">
                            <canvas id="myChart" style="width:50%;"></canvas>
                    </div>
                </div>
                <div class="div6">
                    <form action="<?php echo URLROOT."/counselorReport/generatingReport" ;?>" method = "POST" >
                        <select class="drop1" name="year" id="year">
                            <option  value="2023">Year</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                        <select class="drop2" name="month" id="month">
                            <option  value="05">Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>

                        <button name="downloadSubmit" class="download"><i class="fa-solid fa-circle-arrow-down"></i> Download</button>
                    </form>
                </div>

            </div>
    
  </div>
</body>

</html>
