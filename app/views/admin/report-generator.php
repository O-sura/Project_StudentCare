<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/report-generation.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/dropdown.css"?> >
    <script src= <?php echo URLROOT . "/public/js/report-generator.js"?> defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- <div class="section" id="sidebar">1</div> -->
    <?php include 'sidebar.php'?>
    
    <div class="section" id="page-content">
        <div class="report-config-section">
            <div class="dropdown-section">

                <div class="dropdown-menu" id="">
                    <div class="select-btn">
                        <span class="Sbtn-text">User</span>
                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    </div>
                    <ul class="options">
                        <li class="option">Student</li> 
                        <li class="option">Facility Provider</li> 
                        <li class="option">Counselor</li>
                        <li class="option">Admin</li>
                    </ul>
                </div>
                <div class="dropdown-menu" id="">
                    <div class="select-btn">
                        <span class="Sbtn-text">Type</span>
                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    </div>
                    <ul class="options">
                        <li class="option">Education</li> 
                        <li class="option">Advice</li> 
                        <li class="option">Health</li>
                        <li class="option">Other</li>
                    </ul>
                </div>
                <div class="dropdown-menu" id="">
                    <div class="select-btn">
                        <span class="Sbtn-text">Duration</span>
                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    </div>
                    <ul class="options">
                        <li class="option">Education</li> 
                        <li class="option">Advice</li> 
                        <li class="option">Health</li>
                        <li class="option">Other</li>
                    </ul>
                </div>

            </div>
            <div class="option-display-section">
                <div class="option-box"></div>
                <div class="option-box"></div>
                <div class="option-box"></div>
            </div>
            <button id="report-generate-button">Generate Report</button>
        </div>
        <div class="report-history">
            <table class="reports">
                <tr>
                    <th>Report Name</th>
                    <th>Type</th>
                    <th>Generated Date</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>Community_Stat_30d</td>
                    <td>Community Usage</td>
                    <td>2023/02/10</td>
                    <td>
                        <button class="table-button" id="report-download">Download</button>
                        <button class="table-button" id="report-delete">Remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Community_Stat_30d</td>
                    <td>Community Usage</td>
                    <td>2023/02/10</td>
                    <td>
                        <button class="table-button" id="report-download">Download</button>
                        <button class="table-button" id="report-delete">Remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Community_Stat_30d</td>
                    <td>Community Usage</td>
                    <td>2023/02/10</td>
                    <td>
                        <button class="table-button" id="report-download">Download</button>
                        <button class="table-button" id="report-delete">Remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Community_Stat_30d</td>
                    <td>Community Usage</td>
                    <td>2023/02/10</td>
                    <td>
                        <button class="table-button" id="report-download">Download</button>
                        <button class="table-button" id="report-delete">Remove</button>
                    </td>
                </tr>
               
            </table>
        </div>
    </div>

</body>
</html>