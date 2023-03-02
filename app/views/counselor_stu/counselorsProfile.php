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
        <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/counselorProfileStyle.css" ?>>
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
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80"  >
                        <div class="name">
                            Oshada
                        </div>
                    </div>
                    <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
                </div>
            </div>
        </div>
        <div class="home_content">
            <div class="container">
                <div class="topic">
                    <h1>Counselor Profile</h1>
                </div>
                <div class="counselor-details">
                    <div class="row1">
                        <div class="prof-image">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fGZlbWFsZSUyMGRvY3RvcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" id="image2"  >
                        </div>
                        <div class="personal">
                            <div class="heading">
                                Personal Information
                            </div>
                            <div class="content-1">
                                <div class="indexes-1">
                                    <div>
                                        Name:
                                    </div>
                                    <div>
                                        Age:
                                    </div>
                                    <div>
                                        Specialized In:
                                    </div>
                                </div>
                                <div class="values-1">
                                    <div>
                                        Lawrence Dorsey
                                    </div>
                                    <div>
                                        25
                                    </div>
                                    <div>
                                        Career Guidance
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row2">
                        <div class="col1">
                            <div class="heading">
                                Contact Info
                            </div>
                            <div class="content-2">
                                <div class="indexes-2">
                                    <div >
                                    Address:
                                    </div>
                                    <div>
                                        Contact Number:
                                    </div>
                                </div>
                                <div class="values-2">
                                    <div>
                                         6th Flr Paul VI Cent 24 Malwatte Road, 11
                                    </div>
                                    <div>
                                        (+94) ( 011) 2535325
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col2">
                            <div class="heading">
                                Qualifications
                            </div>
                            <div>
                                3-year degree in psychology accredited by The British Psychological Society (BPS)
                                Counselling skills including active listening and a non-judgemental approach
                                Experience of working with a range of issues including anxiety, depression, stress, relationship problems, bereavement, and low self-esteem
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="request-form">
                    <div class="heading">
                        Request an Appointment
                    </div>
                    <div class="basic-info">
                        <div class="indexes">
                            <div class="date">
                                Appointment Date
                            </div>
                            <div class="time">
                                Appointment Time
                            </div>

                        </div>
                        <div class="fields">
                            <div class="date">
                                <input type="date">
                            </div>
                            <div class="time">
                                <input type="time">
                            </div>
                        </div>
                    </div>
                    <div class="description">
                        <div class="desc-name">
                            Description
                        </div>
                        <div class="text">
                            <textarea name="" id="" cols="30" rows="10">Write a short desciption about why you need counselling....</textarea>
                    </div>
                    <div class="submit">
                        <button type="submit" class="btn">Submit</button>
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

        </script>
    </body>
</html>