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
        <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/messagingStyle.css" ?>>
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
                    <a href="<?php echo URLROOT."/users/logout"?>"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
                </div>
            </div>
        </div>
        <div class="home_content">
            <div class="container">
                <div class="col-1">
                    <div class="topic">
                        <h1>Messages</h1>
                    </div>
                    <div class="sliders">
                        <div class="counselors">
                            <h3>Counselors</h3>
                        </div>
                        <div class="facility-providers">
                            <h3>Facility Providers</h3>
                        </div>
                    </div>
                    <div class="horizontal">
                        <div class="new">
                            <hr>
                        </div>
                        <div class="rest">
                            <hr>
                        </div>
                    </div>
                    <div class="messages">
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Jacob
                                </div>
                                <div class="text">
                                    <p>I'll let you know</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1615109398623-88346a601842?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Daniel
                                </div>
                                <div class="text">
                                    <p>Let's see about that</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Samantha
                                </div>
                                <div class="text">
                                    <p>Call me later</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=761&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Laura
                                </div>
                                <div class="text">
                                    <p>👍</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1609528904487-b3476d8f8451?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Abdul Salam
                                </div>
                                <div class="text">
                                    <p>Good luck</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1581403341630-a6e0b9d2d257?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Amanda Smith
                                </div>
                                <div class="text">
                                    <p>Please take medication</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="message">
                            <div class="prof-image">
                                <img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765&q=80" id="image2" >
                            </div>
                            <div class="message-details">
                                <div class="name">
                                    Dr. Graemer
                                </div>
                                <div class="text">
                                    <p>Call me later</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="sender-profile">
                        <div class="sender-image">
                            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" id="image2" >
                        </div>
                        <div class="sender-name">
                            <h2>Dr. Jacob</h2>
                            
                        </div>
                    </div>
                    
                    <div class="messaging-space">
                        <div class="sender-wrapper">
                            <div class="sender">
                                Hello
                            </div>
                        </div>
                        <div class="receiver-wrapper">
                            <div class="receiver">
                                Hey
                            </div>
                        </div>
                        <div class="sender-wrapper">
                            <div class="sender">
                                Can I have a session this week as well?
                            </div>
                        </div>
                        <div class="receiver-wrapper">
                            <div class="receiver">
                                Son I'll have to check my schedule
                            </div>
                        </div>
                        <div class="sender-wrapper">
                            <div class="sender">
                                It's better if you can this week
                            </div>
                        </div>
                        <div class="receiver-wrapper">
                            <div class="receiver">
                                are you avaialable on friday?
                            </div>
                        </div>
                        <div class="sender-wrapper">
                            <div class="sender">
                                yes I am
                            </div>
                        </div>
                        <div class="receiver-wrapper">
                            <div class="receiver">
                                at what time?
                            </div>
                        </div>
                        <div class="sender-wrapper">
                            <div class="sender">
                                probably 4:00 pm
                            </div>
                        </div>
                        <div class="receiver-wrapper">
                            <div class="receiver">
                                I'm available at 4:00 pm
                            </div>
                        </div>
                        <div class="sender-wrapper">
                            <div class="sender">
                               how about 3:00 pm?
                            </div>
                        </div>
                        <div class="receiver-wrapper">
                            <div class="receiver">
                                I'll let you know
                            </div>
                        </div>
                        <div class="sender-wrapper">
                            <div class="sender">
                                okay doctor
                            </div>
                        </div>
                    </div>
                    <div class="type-area">
                        <div class="type-box">
                            <input type="text" placeholder="Type a message.....">
                            <i id = "send"class="fa-regular fa-paper-plane"></i>
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