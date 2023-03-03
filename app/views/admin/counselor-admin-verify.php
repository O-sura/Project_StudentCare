<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/admin/counselor-admin-verify.css"?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <div class="section" id="sidebar">1</div>
    <div class="section" id="page-content">
        <div class="container">
            <div class="top-section">
                <div class="profile-info">
                    <span class="profile">Profile</span>
                    <div class="small-div"><img src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="profile-image"></div>
                </div>
            </div>
            <div class="back-option">
                <span class="back-arrow"><i class="fa-sharp fa-solid fa-arrow-left" id="back" onclick="goToPrevious()"></i></span>
                <h5 onclick="goToPrevious()">Go Back</h5>
            </div>
            <div class="mid-section">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="profile-image">
                </div>
                <div class="personal-info">
                    <h1>Personal Information</h2>
                    <p class="info"><b>Name:</b> Lawrence Dorsey</p>
                    <p class="info"><b>Age:</b> 29</p>
                    <p class="info"><b>NIC:</b> 91502345V</p>
                    <p class="info"><b>DOB:</b> 1991-04-14</p>
                </div>
            </div>
            <div class="bottom-section">
                <div class="contact-info">
                    <h1>Contact Info</h2>
                    <p class="info"><b>Address:</b> 6th Flr Paul VI Cent 24 Malwatte Road, 11</p>
                    <p class="info"><b>Email:</b> lawrance.dorsey@gmail.com</p>
                    <p class="info"><b>Contact Number:</b>(+94) (071)-2767524</p>
                    
                </div>
                <div class="personal-info">
                    <h1>Qualifications</h2>
                    <p class="info">3-year degree in psychology accredited by The British Psychological Society (BPS)</p>
                    <p class="info">Counselling skills including active listening and a non-judgemental approach</p>
                    <a href="#" class="download-link">Download Verification Document</a>
                </div>
            </div>
            <div class="button-section">
                <button type="submit" value="" id="view-button">Accept Request</button>
                <button type="submit" value="" id="view-button">Decline Request</button>
            </div>
        </div>
    </div>
</body>
</html>