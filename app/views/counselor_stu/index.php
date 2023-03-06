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
        <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/appointmentStyle.css" ?>>
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
                    <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
                </div>
            </div>
        </div>
        <div class="home_content">
            <div class="container">
                <div class="row1">
                    <h1>Appointments</h1>
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
                    <div class="appointments">
                        
                            <div class="meeting">
                                <div class="date">
                                    <h3>Today</h3>
                                </div>
                                <div class="call">
                                    <div class="time">
                                        10:00 AM -11.30 AM
                                    </div>
                                    <div class="image">
                                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" class="image2" >
                                    </div>
                                    <div class="counselor-name">
                                        <h3>Dr.Howard Morrison</h3>
                                    </div>
                                    <div class="join">
                                        <button class="btn">
                                            <div class="btn-class">
                                                <div class="btnName">
                                                    Join
                                                </div>
                                                <div class="btnIcon">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                            </div>
                                            
                                        </button>    
                                    </div>
                                </div>
                            </div>
                       
                        
                            <div class="meeting">
                                <div class="date">
                                    <h3>14 November</h3>
                                </div>
                                <div class="call">
                                    <div class="time">
                                        10:00 AM -11.30 AM
                                    </div>
                                    <div class="image">
                                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" class="image2" >
                                    </div>
                                    <div class="counselor-name">
                                        <h3>Dr.Howard Morrison</h3>
                                    </div>
                                    <div class="join">
                                        <button class="btn">
                                            <div class="btn-class">
                                                <div class="btnName" >
                                                    Join
                                                </div>
                                                <div class="btnIcon">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                            </div>
                                            
                                        </button>    
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class="counselor-details">
                        <div class="counselor-pic">
                            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" id="image3" >
                        </div>
                        <div class="counselor-name">
                            <h3>Dr.Howard Morrison</h3>
                        </div>
                        <div class="address">
                            <p>123, Main Street, Colombo 01</p>
                        </div>
                        <div class="horizontal">
                            <hr>
                        </div>
                        <div class="topic">
                            <h3>Counselor Details</h3>
                        </div>
                        <div class="details">
                            <div class="index">
                                <div class="dob">
                                    DOB
                                </div>
                                <div class="qualification">
                                    Qualification
                                </div>
                                <div class="first-appointment">
                                    First Appointment
                                </div>
                                <div class="description">
                                    Description
                                </div>
                            </div>
                            <div class="content">
                                <div class="dob-details">
                                    16 August 1968
                                </div>
                                <div class="qualification-details">
                                    MBBS, MD, FRCPsych
                                </div>
                                <div class="first-appointment-details">
                                    3 September 2022
                                </div>
                                <div class="description-details">
                                   <pre>
Chartered 
psychologist 
specialized in 
counselling and psychotherapy with 
expertise in dealing 
with children, adolescents and 
families.
                                   </pre>
                                </div>       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                <span class="close">&times;</span>

                <button class = "btn" id="uploadBtn">Join meeting</button>
                <button id="removeBtn">Cancel appointment</button>
                </div>
            
            </div>

        </div>
        
        
        <script>
           
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");
    
            btn.onclick = function() {
                sidebar.classList.toggle("active");
            }// Get the modal
            var modal = document.getElementById("myModal");
var btns = document.getElementsByClassName("btn");
var span = document.getElementsByClassName("close")[0];

for (var i = 0; i < btns.length; i++) {
  btns[i].onclick = function() {
    modal.style.display = "block";
  }
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

        </script>
    </body>
</html>