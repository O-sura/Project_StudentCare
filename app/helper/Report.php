<?php

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;


//Data format for generating report for counselor
// $data = [
//     'name' => "Osura Viduranga",
//     'username' => "OsuraV",
//     'student_count' => 05,
//     'sessions' => 10,
//     'cancelled_count' => 3,
//     'completed_count' => 10,
//     'meeting_details' => array(
//         array(
//         "userID" => "STU2123",
//         "name" => "John Doe",
//         "meeting_date" => "2023-03-12",
//         "status" => "Completed"
//         ),
//         array(
//             "userID" => "STU2123",
//             "name" => "John Doe",
//             "meeting_date" => "2023-03-12",
//             "status" => "Completed"
//         ),
//         array(
//             "userID" => "STU2123",
//             "name" => "John Doe",
//             "meeting_date" => "2023-03-12",
//             "status" => "Completed"
//         ),
//     ),
//     'student_details' => array(
//         array("userID" => "STU2123","name"=>"John Doe"),
//         array("userID" => "STU2123","name"=>"John Doe")
//     )

// ];


//Data format for generating report for facility provider
$data = [
    'name' => "Osura Viduranga",
    'username' => "OsuraV",
    'listing_count' => 05,
    'categories' => "Furniture,Food",
    'listing_details' => array(
        array(
                    "listingID" => "",
                    "rating" => "",
                    "description" => "",
                    "category" => "",
                    'review_count' => ''
            )
    )
];



function generatePDF($role,$data){
    $options = new Options;
    $options->setChroot(__DIR__); //For marking the file root
    $options->setIsRemoteEnabled(true);

    // Create a new Dompdf instance
    $dompdf = new Dompdf($options);

    // Set options
    $dompdf->setPaper('A4', 'portrait');

    // Load HTML content-provide the path to the html file
    $dompdf->loadHtml(reportHelper($role,$data));

    // Render PDF
    $dompdf->render();

    // Output PDF to the browser
    $dompdf->stream('report.pdf', array('Attachment' => false));
}

//generatePDF('facility_provider',$data);

//provides the 
function conselorReport($data){
//Associated Student List - StudID,Name
//StudID,Name,Meeting Date,Status
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="report-style.css">
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
                        return "<tr><td>" . $student['userID'] . "</td><td>". $student['name'] ."</td></tr>";
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
                        return "<tr><td>" . $meeting['userID'] . "</td><td>". $meeting['name'] ."</td><td>". $meeting['meeting_date'] ."</td><td>". $meeting['status']."</td></tr>";
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

function fpReport($data){
    return '
    <!DOCTYPE>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="report-style.css">
        </head>
        <body>
            <h1>Monthly Report</h1><br>
            <table class="details">
                <tr>
                    <td>
                        <p><b>Name:</b> '. $data['name'] .'</p>
                    </td>
                    <td>
                        <p><b>Total Listings:</b> '. $data['listing_count'] .'</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Username:</b> '. $data['username'] .'</p>
                    </td>
                    <td>
                        <p><b>Associalted Categories:</b> '. $data['categories'] .'</p>
                    </td>
                </tr>
            </table>

            <br>

            <br>
            <h2>Listing Details</h2>
            <table class="style-table">
            <tr>
                <th>ListingID</th>
                <th>Rating</th>
                <th>Description</th>
                <th>Category</th>
                <th>Reviews</th>
            </tr>
            '. 
                implode("", 
                    array_map(function($listing) {
                        return "<tr><td>" . $listing['listingID'] . "</td><td>". $listing['rating'] ."</td><td>". $listing['description'] ."</td><td>". $listing['category']."</td><td>". $listing['review_count'] ."</td></tr>";
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

//report for single user-details


function reportHelper($role,$data){
    if($role == 'counselor'){
        return conselorReport($data);
    }
    else if($role == 'facility_provider'){
        return fpReport($data);
    }
}



?>