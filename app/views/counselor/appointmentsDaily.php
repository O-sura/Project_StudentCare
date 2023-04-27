<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css"?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/dailyAppointments.css"?>">
  <script src=<?php echo URLROOT . "/public/js/Counselor/goback.js"?> defer></script>
  <script src=<?php echo URLROOT . "/public/js/Counselor/appointmentStudent.js"?> defer></script>
  <title></title>
</head>

<body>
    <?php FlashMessage::flash('appointment_cancel_flash') ;?> 
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">

        <div class="container"> 

            <div class="topic">
                <span><h1 class="headApp">Daily Appointments</h1></span>
            </div>
            <hr>

            <div class="go">
                <span><a id="back-link"><i class="fa-sharp fa-solid fa-arrow-left"></i> Go back </a></span>
            </div>
            
            <div class="content">
                <div class="day">
                    <p class="clickedDate"><?php echo $data['day']; ?> <?php echo $data['dayNum']; ?> <?php echo $data['dayYear']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>   
                </div>
                <hr class="hr1">

                <div class="main">
                    <?php if(count($data['row']) > 0) :?>
                        <div class="left">
                        
                            <?php foreach ($data['row'] as $row ): ?>
                                <!-- <div class="app"> -->
                                    <?php if($row->appointmentStatus == 0) : ?>

                                        <div class="app" id="app">
                                    
                                                <div class="time">
                                                        <?php if(date('H',strtotime($row->appointmentTime)) < 12):?> 
                                                            <?php echo date('H : i',strtotime($row->appointmentTime))." A.M" ;?> 
                                                        <?php else :?>
                                                            <?php echo date('H : i',strtotime($row->appointmentTime))." P.M" ; ?>
                                                        <?php endif ;?>
                                                </div>
                                                
                                                <div class="image" >
                                                    <button class="btnImage" id="stu" value="<?php echo $row->studentID ?>"><img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> </button>
                                                    <input type="hidden" id="aPPtime" value="<?php echo $row->appointmentDate ?>">
                                                </div>
                                                <div class="name">
                                                    <?php echo $row->studentName ;?>  
                                                </div> 
                                                <div class="divBtn">
                                                    <button class="btn" id="getAppStu" value="<?php echo $row->studentID ?>">
                                                        <div class="btn-class">
                                                            <div class="btnName" id="btnName">
                                                                Meeting
                                                                <input type="hidden" id="getAppTime" value="<?php echo $row->appointmentDate ?>">
                                                                <input type="hidden" id="getAppStu" value="<?php echo $row->studentID ?>">
                                                            </div>
                                                            <div class="btnIcon">
                                                                <i class="fa-solid fa-play"></i>
                                                            </div>
                                                        </div>
                                                    
                                                    </button>    
                                                </div>
                                        
                                        </div>

                                    <?php elseif($row->appointmentStatus == 3): ?>

                                        <div class="appCancel" id="app"  style="pointer-events: none;">
                                    
                                                <div class="time">
                                                        <?php if(date('H',strtotime($row->appointmentTime)) < 12):?> 
                                                            <?php echo date('H : i',strtotime($row->appointmentTime))." A.M" ;?> 
                                                        <?php else :?>
                                                            <?php echo date('H : i',strtotime($row->appointmentTime))." P.M" ; ?>
                                                        <?php endif ;?>
                                                </div>
                                                
                                                <div class="image" >
                                                    <button class="btnImage" id="stu" value="<?php echo $row->studentID ?>"><img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> </button>
                                                    <input type="hidden" id="aPPtime" value="<?php echo $row->appointmentDate ?>">
                                                </div>
                                                <div class="name">
                                                    <?php echo $row->studentName ;?>  
                                                </div> 
                                                <div class="divBtn">
                                                    <button class="btn" id="getAppStu" value="<?php echo $row->studentID ?>">
                                                        <div class="btn-class">
                                                            <div class="btnName" id="btnName">
                                                                Cancelled
                                                                <input type="hidden" id="getAppTime" value="<?php echo $row->appointmentDate ?>">
                                                                <input type="hidden" id="getAppStu" value="<?php echo $row->studentID ?>">
                                                            </div>
                                                            <div class="btnIcon">
                                                                <i class="fa-solid fa-ban"></i>
                                                            </div>
                                                        </div>
                                                    
                                                    </button>    
                                                </div>
                                        
                                        </div>
                                    <?php elseif($row->appointmentStatus == 1) : ?>

                                        <div class="appComplete" id="appCom"  style="pointer-events: none;">
                                    
                                                <div class="time">
                                                        <?php if(date('H',strtotime($row->appointmentTime)) < 12):?> 
                                                            <?php echo date('H : i',strtotime($row->appointmentTime))." A.M" ;?> 
                                                        <?php else :?>
                                                            <?php echo date('H : i',strtotime($row->appointmentTime))." P.M" ; ?>
                                                        <?php endif ;?>
                                                </div>
                                                
                                                <div class="image" >
                                                    <button class="btnImage" id="stu" value="<?php echo $row->studentID ?>"><img class="imgg" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> </button>
                                                    <input type="hidden" id="aPPtime" value="<?php echo $row->appointmentDate ?>">
                                                </div>
                                                <div class="name">
                                                    <?php echo $row->studentName ;?>  
                                                </div> 
                                                <div class="divBtn">
                                                    <button class="btn" id="getAppStu" value="<?php echo $row->studentID ?>">
                                                        <div class="btn-class">
                                                            <div class="btnName" id="btnName">
                                                                Completed
                                                                <input type="hidden" id="getAppTime" value="<?php echo $row->appointmentDate ?>">
                                                                <input type="hidden" id="getAppStu" value="<?php echo $row->studentID ?>">
                                                            </div>
                                                            <div class="btnIcon">
                                                                 <i class="fa-sharp fa-solid fa-circle-check"></i>
                                                            </div>
                                                        </div>
                                                    
                                                    </button>    
                                                </div>
                                        
                                        </div>

                                    <?php endif; ?>
                                <!-- </div> -->
                            <?php endforeach ?> 
                        </div>
                                
                        <div class="right">

                            <!-- <div class="stu" >
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


                            </div> -->

                        </div>

                    <?php else : ?>
                        <div class="Noapp">
                            <?php echo "There is no any appointment yet" ?>
                        </div>

                    <?php endif ;?>

                    </div>
                    
                </div>

            </div>

        </div>


        <!-- The Modal for start meeting or cancellation -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
        

            <div class="modal-content">
                <span class="close">&times;</span>
                
                <button class = "btnStart" id="uploadBtn"><a class='start' href="http://localhost:3000/<?php echo $row->meetingID ?>" target="_blank">Start meeting</a></button>
                <button class = "btnCom" id="comBtn" name="completeBtn"><a name="completeLink" id="completedApp" class='complete'  href=" ">Completed</a></button>
                <button id="removeBtn" class="rbtn" value="<?php echo $row->studentID ?>">Cancel appointment</button>
                
            </div>

        </div>

        <!-- The modal for cancellation -->

        <div id="myModalCancel" class="modalCancel">

        <!-- Modal content -->
            <form  id="formID" action="" method="POST"> 
                <div class="modalCancel-content">

                    <input type="text" name="studentID" value="Hi" hidden>

                    <span class="closeC">&times;</span>
                    <h3>Appointment Cancellation</h3><br>
                    <p class="detCancel" id="cancelName"></p>
                    <p class="detCancel" id="cancelDate"></p>
                    <p class="detCancel" id="cancelTime"></p>
                    <p class="detCancel">Requested by student to cancel : <input type="checkbox" name="check"></p> 
                    <p class="detCancel">Reason for Cancellation :</p>
                    

                    <p id="error"></p>
                    <textarea name="descC" id="textDes" placeholder="Description" rows = "15" cols = "5" class="Desc"></textarea><br>
                
                    <button id="removeBtnC" type="submit" name="submit" onclick="validateTextArea()">Cancel appointment</button>
                   
                </div>
            </form>
        </div>
        
    </div>

</body>

</html>
