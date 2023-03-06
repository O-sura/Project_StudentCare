<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/dailyAppointments.css"?>">
  <script src=<?php echo URLROOT . "/public/js/Counselor/goback.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">

        <div class="topic">
            <span><h1 class="headApp">Daily Appointments</h1></span>
        </div>

        <div class="go">
            <span><a id="back-link"><i class="fa-sharp fa-solid fa-arrow-left"></i> Go back </a></span>
        </div>
        
        <div class="content">
            <div class="day">
                <span>08 Tuesday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i id="prev" class="fa-solid fa-chevron-left"></i>&nbsp;&nbsp;<i id="next" class="fa-solid fa-chevron-right"></i></span>   
            </div>
            <hr class="hr1">

            <div class="main">
                <div class="left">
                    <div class="app">
                       
                           <div class="time">
                                10.00 a.m - 11.30 a.m 
                           </div>
                            
                            <div class="image">
                                <img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
                            </div>
                            <div class="name">
                                Tim David 
                            </div> 
                            <button class="btn">
                                <div class="btn-class">
                                    <div class="btnName" >
                                        Start
                                    </div>
                                    <div class="btnIcon">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </div>
                            
                             </button>    
                      
                    </div>
                    <div class="app">
                       
                        <div class="time">
                             10.00 a.m - 11.30 a.m 
                        </div>
                         
                         <div class="image">
                             <img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
                         </div>
                         <div class="name">
                             Tim David 
                         </div> 
                         <button class="btn">
                             <div class="btn-class">
                                 <div class="btnName" >
                                     Start
                                 </div>
                                 <div class="btnIcon">
                                     <i class="fa-solid fa-play"></i>
                                 </div>
                             </div>
                         
                          </button>    
                   
                 </div>
                 <div class="app">
                       
                    <div class="time">
                         10.00 a.m - 11.30 a.m 
                    </div>
                     
                     <div class="image">
                         <img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
                     </div>
                     <div class="name">
                         Tim David 
                     </div> 
                     <button class="btn">
                         <div class="btn-class">
                             <div class="btnName" >
                                 Start
                             </div>
                             <div class="btnIcon">
                                 <i class="fa-solid fa-play"></i>
                             </div>
                         </div>
                     
                      </button>    
               
             </div>
             <div class="app">
                       
                <div class="time">
                     10.00 a.m - 11.30 a.m 
                </div>
                 
                 <div class="image">
                     <img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
                 </div>
                 <div class="name">
                     Tim David 
                 </div> 
                 <button class="btn">
                     <div class="btn-class">
                         <div class="btnName" >
                             Start
                         </div>
                         <div class="btnIcon">
                             <i class="fa-solid fa-play"></i>
                         </div>
                     </div>
                 
                  </button>    
           
         </div>
         <div class="app">
                       
            <div class="time">
                 10.00 a.m - 11.30 a.m 
            </div>
             
             <div class="image">
                 <img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
             </div>
             <div class="name">
                 Tim David 
             </div> 
             <button class="btn">
                 <div class="btn-class">
                     <div class="btnName" >
                         Start
                     </div>
                     <div class="btnIcon">
                         <i class="fa-solid fa-play"></i>
                     </div>
                 </div>
             
              </button>    
       
        </div>

                </div>
                <div class="right">

                    <div class="stu">
                        <div class="imagePP">
                            <img class="imggPPP" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
                        </div>
                        <p class="fname">Tim David</p>
                        <p class="address">No.203, Austin street, St.Petersbhurg</p>
                        <hr class="hr2">
                        <p class="detail">Student Details</p>
                        <p class="dob">DOB  : 10/01/1999</p>
                        <p class="uni">University   : University of Colombo</p>
                        <p class="note">Notice  : Get some advices for studies</p>


                    </div>

                </div>
            </div>

        </div>
        
    </div>

</body>

</html>
