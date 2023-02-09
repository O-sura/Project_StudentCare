<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/report.css"?>>
    <script src=<?php echo URLROOT . "/public/js/facility_provider/addItem.js"?> defer ></script>
    <title>Report</title>
</head>
<body>
    <div class="page">
        
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <div class="yourprofile">
                <a href=<?php echo URLROOT. "/facility_provider/profile"?>>
                    <p>Profile</p>
                    <i class="fa fa-user"></i>
                </a>
            </div>
            <div class="report">
                <div class="div4">
                    <div class="div5">
                        <h1>Monthly Facility Overview</h1><br>
                        <div class="subdiv">
                            <div class="sub1">
                                <h2>Total<br>Listings<br> <h1>03</h1></h2>
                            </div>
                            <div class="listing">
                                <div class="sub2">
                                    <h2>Property Listings<br> <h1>02</h1></h2>
                                </div>
                                <div class="sub3">
                                    <h2>Food<br>Listings<br> <h1>01</h1></h2>
                                </div>
                                <div class="sub4">
                                    <h2>Furniture Listings<br> <h1>-</h1></h2>
                                </div>
                            </div>
                        </div>
                        <div class=""></div>
                    </div>
                    <div class="div6">
                        <select class="drop1" name="year" id="">
                            <option value="default">Year</option>
                            <option value="">2020</option>
                            <option value="">2021</option>
                            <option value="">2022</option>
                            <option value="">2023</option>
                        </select>
                        <select class="drop2" name="year" id="">
                            <option value="default">Month</option>
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
        </div>
    </div>
</body>
</html>