<?php

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//main function wich handles the report generation based on the provided configurations and settings
function generatePDF($role,$data,$type = null,$multiFlag = 0){
    $options = new Options;
    $options->setChroot(__DIR__); //For marking the file root
    $options->setIsRemoteEnabled(true);

    // Create a new Dompdf instance
    $dompdf = new Dompdf($options);

    // Set options
    $dompdf->setPaper('A4', 'portrait');

    // Load HTML content-provide the path to the html file
    if($multiFlag == 0){
        $dompdf->loadHtml(individualReportHelper($role,$data));
    }else{
        $dompdf->loadHtml(multiReportHelper($role,$type,$data));
    }

    // Render PDF
    $dompdf->render();

    // Output PDF to the browser
    $dompdf->stream('report.pdf', array('Attachment' => false));

    if($multiFlag == 1){
        $output = $dompdf->output();
        $today = new DateTime();
        $date = $today->format('Y-m-d');
        $filename = $role . "_" .$date . "_" . substr(sha1(date(DATE_ATOM)), 0, 8) . ".pdf";
        $path_to_store = APPROOT. "/uploads/reports/" . $filename;
        file_put_contents($path_to_store,$output);
    }
}


//provides the template for generating report for single counselor
function conselorReport($data){
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/StudentCare/public/css/report-style.css">
        </head>
        <body>
            <div class="title-container"><h1>Monthly Report</h1><br></div>
            <table class="details">
                <tr>
                    <td>
                        <p><b>Name:</b> '. $data['name'] .'</p>
                    </td>
                    <td>
                        <p><b>No. of Sessions(month):</b> '. $data['sessions'] .'</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Username:</b> '. $data['username'] .'</p>
                    </td>
                    <td>
                        <p><b>Associalted Students:</b> '. $data['student_count'] .'</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Cancelled Appointments:</b> '. $data['cancelled_count'] .'</p>
                    </td>
                    <td>
                        <p><b>Completed Sessions:</b> '. $data['completed_count'] .'</p>
                    </td>
                </tr>
            </table>

            <br>

            <h2>Student List:</h2>
            <table class="style-table">
            <tr>
                <th>StudentID</th>
                <th>Student Name</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($student) {
                        return "<tr><td>" . $student['studentID'] . "</td><td>". $student['fullname'] ."</td></tr>";
                    }, $data['student_details'])
                )
            .'</table>

            <br>
            <h2>Counselling Session Details:</h2>
            <table class="style-table">
            <tr>
                <th>StudentID</th>
                <th>Student Name</th>
                <th>Meeting Date</th>
                <th>Status</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($meeting) {
                        return "<tr><td>" . $meeting['studentID'] . "</td><td>". $meeting['fullname'] ."</td><td>". $meeting['appointmentDate'] ."</td><td>". $meeting['status']."</td></tr>";
                    }, $data['meeting_details'])
                )
            .'</table>
            <footer>
                <p>Copyright © 2023 StudentCare | All rights reserved.</p>
            </footer>
        </body>
    </html>
    ';
}

//provides the template for generating report for single facility provider
function fpReport($data){
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/StudentCare/public/css/report-style.css">
        </head>
        <body>
            <h1>Monthly Report</h1><br>
            <table class="details">
                <tr>
                    <td>
                        <p><b>Name:</b> '. $data['name'] .'</p>
                    </td>
                    <td>
                        <p><b>Username:</b> '. $data['username'] .'</p>
                    </td>
                </tr>
            </table>

            <br>

            <br>
            <h2>Listing Details</h2>
            <table class="style-table">
            <tr>
                <th>ListingID</th>
                <th>Topic</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Address</th>
                <th>Feedbacks</th>
                <th>Reviews(P/N)</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['listing_id'] . "</td><td>". $listing['topic'] . "</td><td>". $listing['category'] . "</td><td>". $listing['rating'] . "</td><td>". $listing['address'] . "</td><td>". $listing['num_feedbacks'] . "</td><td>". $listing['num_good_reviews'] . "/". $listing['num_bad_reviews'] . "</td></tr>";
                    }, $data['listing_details'])
                )   
            .'</table>
            <footer>
                <p>Copyright © 2023 StudentCare | All rights reserved.</p>
            </footer>
        </body>
    </html>
    ';
}

//report template for whole system overview details
function system_overview($data){
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/StudentCare/public/css/report-style.css">
        </head>
        <body>
            <center><h1>System Overview Report Report</h1><center><br>

            <br>
            <h2>Users Overview</h2>
            <table class="style-table">
            <tr>
                <th>User Role</th>
                <th>#of Users</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($user) {
                        return "<tr><td>" . $user['user_role'] . "</td><td>". $user['count'] . "</td></tr>";
                    }, $data['users_by_role'])
                )
            .'</table

            <br>
            <h2>Overal Analytics</h2>
            <table class="details">
                <tr>
                    <td>
                        <p><b>Total Users:</b> '. $data['total_users'] . '</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Total Community Posts:</b> '. $data['total_community_posts'] .'</p>
                    </td>
                    <td>
                        <p><b>Community Engagememt:</b> '. round($data['community_engagement'],2) .'</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Total Comments:</b> '. $data['comment'] .'</p>
                    </td>
                    <td>
                        <p><b>Post Reportings:</b> '. $data['post_reportings'] .'</p>
                    </td>
                </tr>
            </table>

            <br>

            <br>
            <h2>Counselling Session Details</h2>
            <table class="style-table">
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($session) {
                        return "<tr><td>" . $session['status'] . "</td><td>". $session['count'] . "</td></tr>";
                    }, $data['total_csessions'])
                )
            .'</table>

            <br><br>
            <table class="details">
                <tr>
                    <td>
                        <p><b>Counselor-Student Engagement:</b> '. round($data['counselor-stu-engagement'],2) .'</p>
                    </td>
                    <td>
                        <p><b>Counselor-Announcement Engagement:</b> '. round($data['counselor-ann-engagement'],2) .'</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Student-MobileApp Engagement:</b> '. round($data['stu_mobile_engagement'],2) .'</p>
                    </td>
                    <td>
                        <p><b>Student-Listing Engagement:</b> '. round($data['stu-listing-engagement'],2) .'</p>
                    </td>
                </tr>
            </table>

            <br>
            <h2>Listing Overview</h2>
            <table class="style-table">
            <tr>
                <th>Type</th>
                <th>count</th>
                <th>Average Rating</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['category'] . "</td><td>". $listing['listing_count'] ."</td><td>". round($listing['average_rating'],1) . "</td></tr>";
                    }, $data['listing_overview'])
                )
            .'</table>

            <br>
            <h2>Listings by Location</h2>
            <table class="style-table">
            <tr>
                <th>Location</th>
                <th>Count</th>
                <th>Percentage(%)</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($list) {
                        return "<tr><td>" . $list['location'] . "</td><td>". $list['count'] . "</td><td>". round($list['percentage'],2) . "</td></tr>";
                    }, $data['listing_by_location'])
                )
            .'</table>

            <footer>
                <p>Copyright © 2023 StudentCare | All rights reserved.</p>
            </footer>
        </body>
    </html>
    ';
}

//report template for counselling session data
function counselor_overview($data){
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/StudentCare/public/css/report-style.css">
        </head>
        <body>
            <h1>Counselling Overview Report</h1><br>
            <table class="details">
                <tr>
                    <td>
                        <p><b>Counselor-Student Enagement(%):</b> '. round($data['counselor-stu-engagement'],2) .'</p>
                    </td>
                    <td>
                        <p><b>Counselor-Announcement Engagement(%):</b> '. round($data['counselor-ann-engagement'],2) .'</p>
                    </td>
                </tr>
            </table>

            <br>
            <h2>Counselor Specializations</h2>
            <table class="style-table">
            <tr>
                <th>Specialization</th>
                <th>Count</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($category) {
                        return "<tr><td>" . $category['specialization'] . "</td><td>". $category['count'] ."</td></tr>";
                    }, $data['counselor_specilaization'])
                )
            .'</table>

            <br>

            <br>
            <h2>Session Details</h2>
            <table class="style-table">
            <tr>
                <th>StudentID</th>
                <th>Full Name</th>
                <th>Appointment Date</th>
                <th>Status</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['studentID'] . "</td><td>". $listing['fullname'] ."</td><td>". $listing['appointmentDate'] ."</td><td>". $listing['status']."</td></tr>";
                    }, $data['total_csessions'])
                )
            .'</table>
            <footer>
                <p>Copyright © 2023 StudentCare | All rights reserved.</p>
            </footer>
        </body>
    </html>
    ';
}

//report template for listing data
function listing_overview($data){
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/StudentCare/public/css/report-style.css">
        </head>
        <body>
            <center><h1>Overall Listing Overview</h1><center><br>

            <br>
            <h2>Listing Performance</h2>
            <table class="style-table">
            <tr>
                <th>ListingID</th>
                <th>Topic</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Address</th>
                <th>#Of Feedbacks</th>
                <th>Bad Reviews</th>
                <th>Good Reviews</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['listing_id'] . "</td><td>". $listing['topic'] . "</td><td>". $listing['category'] . "</td><td>". $listing['rating'] . "</td><td>". $listing['address'] . "</td><td>". $listing['num_feedbacks'] . "</td><td>". $listing['num_bad_reviews'] . "</td><td>". $listing['num_good_reviews'] . "</td></tr>";
                    }, $data['listing_performance'])
                )
            .'</table

            <br>
            <h2>User Activity</h2>
            <table class="style-table">
            <tr>
                <th>UserID</th>
                <th>No. of Messages Sent</th>
                <th>No. of Listings Added</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['userid'] ."</td><td>". $listing['num_listings_added'] . "</td><td>" . $listing['num_messages_sent'] ."</td></tr>";
                    }, $data['user_activity'])
                )
            .'</table

            <br>
            <h2>Geographic Analysis</h2>
            <table class="style-table">
            <tr>
                <th>Location</th>
                <th>No. of Listings</th>
                <th>Avg. Rating</th>
                <th>Avg. Feedback</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['location'] ."</td><td>". $listing['num_listings'] . "</td><td>" . $listing['avg_rating'] ."</td><td>" . $listing['avg_num_feedback'] ."</td></tr>";
                    }, $data['geographic_analysis'])
                )
            .'</table

            <footer>
                <p>Copyright © 2023 StudentCare | All rights reserved.</p>
            </footer>
        </body>
    </html>
    ';
}

//function for handling selecting the proper template for generating the report
function individualReportHelper($role,$data){
    if($role == 'counselor'){
        return conselorReport($data);
    }
    else if($role == 'facility_provider'){
        return fpReport($data);
    }
    else if($role == 'student'){
        return studentReport($data);
    }
}

//function for hanlding the proper report template for reports which contains data from
//more than one role
function multiReportHelper($role,$type,$data){
    if($role == 'Admin'){
        if($type == 'System Overview'){
            return system_overview($data);
        }
    }
    else if($role == 'Counselor'){
        if($type == 'Session Details'){
            return counselor_overview($data);
        }
    }
    else if($role == 'Facility_Provider'){
        if($type == 'Listing Overview'){
            return listing_overview($data);
        }
    }
}


?>