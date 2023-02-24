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
        <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/requestStyle.css" ?>>
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
                <div class="row1">
                    <h1>Requests</h1>
                </div>
                <div class="row2">
                    <div class="col1">
                        <div class="topic">
                            <h3><a href="<?php echo URLROOT ?>/appointments/">Appointments</a></h3>
                        </div>
                        <div class="slider">
                            <hr>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="topic">
                            <h3><a href="<?php echo URLROOT ?>/appointments/list">Counselors</a></h3>
                        </div>
                        <div class="slider">
                            <hr>
                        </div>
                    </div>
                    <div class="col3">
                        <div class="topic">
                            <h3><a href="<?php echo URLROOT ?>/appointments/requests">Requests</a></h3>
                        </div>
                        <div class="slider">
                            <hr>
                        </div>
                    </div>
                    <div class="col4">
                        <div class="topic">
                            <h3>dff</h3>
                        </div>
                        <div class="slider">
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row3">
                    
                            
                            <div class="meeting">
                                <div class="date">
                                    <h3>Pending Requests</h3>
                                </div>
                            
                                <div class="call">
                                    <div class="date">
                                        15 Movember 2022
                                    </div>
                                    <div class="time">
                                        10:00 AM -11.30 AM
                                    </div>
                                    <div class="image">
                                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" class="image2" >
                                    </div>
                                    <div class="counselor-name">
                                        <h3>Dr.Howard Morrison</h3>
                                    </div>
                                    <div class="clickables">
                                        <div class="join">
                                            <button class="btn">
                                                
                                                    
                                                        Edit
                                                    
                                                    
                                                
                                                
                                            </button>    
                                        </div>
                                        <div class="join">
                                            <button class="btn">
                                                
                                                        Remove
                                                    
                                                    
                                                
                                                
                                            </button>    
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="call">
                                    <div class="date">
                                        15 Movember 2022
                                    </div>
                                    <div class="time">
                                        10:00 AM -11.30 AM
                                    </div>
                                    <div class="image">
                                        <img src="https://images.unsplash.com/photo-1566753323558-f4e0952af115?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1021&q=80" class="image2" >
                                    </div>
                                    <div class="counselor-name">
                                        <h3>Dr.Daniel Morrison </h3>
                                    </div>
                                    <div class="clickables">
                                        <div class="join">
                                            <button class="btn">
                                                
                                                    
                                                        Edit
                                                    
                                                    
                                                
                                                
                                            </button>    
                                        </div>
                                        <div class="join">
                                            <button class="btn">
                                                
                                                        Remove
                                                    
                                                    
                                                
                                                
                                            </button>    
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                       
                        
                            <div class="meeting">
                                <div class="date">
                                    <h3>Rejected requests</h3>
                                </div>
                                <div class="call">
                                    <div class="date">
                                        15 Movember 2022
                                    </div>
                                    <div class="time">
                                        10:00 AM -11.30 AM
                                    </div>
                                    <div class="image">
                                        <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" class="image2" >
                                    </div>
                                    <div class="counselor-name">
                                        <h3>Dr.Karen Taylor</h3>
                                    </div>
                                    <div class="clickables">
                                        <div class="join">
                                            
                                                Reason :
                                            
                                        </div>
                                        <div class="join">
                                            Unavailable
                                        </div>
                                    </div>
                                    
                                </div>
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