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
 
            <div class="div4">
            
                <div class="div5">
                    <h1>Monthly Session Overview</h1><br>
                    <div class="subdiv">
                        <div class="sub1">
                            <h2>Total <br> Appointments <br><br> <h1>20</h1></h2>
                        </div>
                        <div class="sub2">
                            <h2>Completed Appointments <br><br> <h1>18</h1></h2>
                        </div>
                        <div class="sub3">
                            <h2>Cancelled Appointments <br><br> <h1>2</h1></h2>
                        </div>
                    </div>
                    <div class="graph">
                            <canvas id="myChart" style="width:50%;"></canvas>
                    </div>
                </div>
                <div class="div6">
                    <select class="drop1" name="year" id="">
                        <option  value="default">Year</option>
                        <option value="">2020</option>
                        <option value="">2021</option>
                        <option value="">2022</option>
                        <option value="">2023</option>
                    </select>
                    <select class="drop2" name="year" id="">
                        <option  value="default">Month</option>
                        <option value="">January</option>
                        <option value="">February</option>
                        <option value="">March</option>
                        <option value="">April</option>
                        <option value="">May</option>
                        <option value="">June</option>
                        <option value="">July</option>
                        <option value="">August</option>
                        <option value="">September</option>
                        <option value="">October</option>
                        <option value="">November</option>
                        <option value="">December</option>
                    </select>

                    <button class="download"><i class="fa-solid fa-circle-arrow-down"></i> Download</button>
                </div>

            </div>
    
  </div>
</body>

</html>
