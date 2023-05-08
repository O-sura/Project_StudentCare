<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/report-generation.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/dropdown.css"?> >
    <script src=<?php echo URLROOT . "/public/js/report-generator.js"?> defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- <div class="section" id="sidebar">1</div> -->
    <?php include 'sidebar.php'?>
    
    <div class="section" id="page-content">
        <span class="heading">Reports</span><hr>
        <div class="report-config-section">
            <div class="dropdown-section">

                <div class="dropdown-menu" id="userrole-dropdown">
                    <select id="dropdown-1">
                        <option value="Admin">Admin</option>
                        <option value="Counselor">Counselor</option>
                        <option value="Facility_Provider">Facility Provider</option>
                    </select>
                </div>
                <div class="dropdown-menu" id="type-dropdown">
                    <select id="dropdown-2">
                        <option value="">Select Report Type</option>
                    </select>
                </div>
                <div class="dropdown-menu" id="duration-dropdown">
                    <select id="dropdown-3">
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="3-Month">3-Months</option>
                        <option value="6-Month">6-Months</option>
                    </select>
                </div>

            </div>
            <div class="option-display-section">
                <form action=<?php echo URLROOT . "/admin/reports/"?> method="post" id="report-input-form">
                    <div class="option-box"><input type="text" id="input-1" readonly></div>
                    <div class="option-box"><input type="text" id="input-2" readonly></div>
                    <div class="option-box"><input type="text" id="input-3" readonly></div>
                </form>
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