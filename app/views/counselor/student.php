<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script type="module" src= <?php echo URLROOT . "/public/js/Counselor/filterStu.js"?> defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/student.css"?>">
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">
        <div class="topic">
            <span><h1 class="headApp">Students</h1></span>
        </div>
        <hr class="hrbar">
  
        <div class="div4">
            <?php if(count($data['row']) == 0) : ?>
                
                <div class="ifnot">You don't have any student or students' request yet</div>
                                            
            <?php else: ?>

                <div class="div5">
                    <select name="New_Requests"  id="selector">
                    
                        <option  value="0">New  Requests</option>
                        <option  value="1">Accepted List</option>
                        <option  value="2">Rejected List</option>
                    </select>
                    <!-- <div class="dropdown-menu">
                        <div class="select-btn">
                            <span class="Sbtn-text">New Requests</span>
                            <i class="fa-sharp fa-solid fa-chevron-down"></i>
                        </div>
                        <ul class="options">
                            <li class="option">New Requests</li> 
                            <li class="option">Accepted Students</li> 
                            <li class="option">Rijected Students</li>
                            
                        </ul>
                    </div> -->
                    <hr>
                    <div class="studentList">
                        <!-- <div id="search-results"></div> -->
                        <?php foreach ($data['row'] as $row) :?>
                            <button name="clickStu" data-student-id="<?php echo $row->studentID; ?>" class="student"  value="<?php echo $row->studentID; ?>"><?php echo $row->studentName; ?></button><br>
                        <?php endforeach ?> 

                    
                        
                    </div>
                </div>
                <div class="div6">
                    <!-- <?php foreach ($data['row'] as $row) :?>
                    <form action="<?php echo URLROOT."Counsellor/acceptRejectStudent" ;?>" method="post">
                    <div class="imageSection">
                        <div class="img">
                            <img class="dpImg" src="<?php echo URLROOT."/public/img/img7.jpg"?>" alt="">
                        </div>
                        <div class="btnDiv">
                            <button class="accept" name="accept" ><i class="fa-solid fa-user-plus"></i> &nbsp;&nbsp; Accept</button><br>
                            <button class="decline" name="decline"><i class="fa-solid fa-user-minus"></i> &nbsp;&nbsp; Decline</button>
                        </div>

                    </div>
                    <div class="infoSection">
                        
                        <br><label for="name">Name  : </label><?php echo $row->studentName ?><br>
                        <label for="age">DOB    : </label>22<br>
                        <label for="uni">University : </label>University of Kelaniya<br>
                        <label for="address">Address    : </label>No-24, Colombo 04<br>
                        <label for="email">University email : </label>uk@pgk2000@gmail.com

                        <span>
                            <h3 class="note">  Request Note : </h3>
                            <p class="noted">
                                Hope to get your valuable service for my life.
                            </p>
                        </span>
                    
                    
                    </div>
                    </form>
                    <?php  break; endforeach ?>      -->
                </div>

                                            
            <?php endif;?>
        </div>
    
  </div>
</body>

</html>



