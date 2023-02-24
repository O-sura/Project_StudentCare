<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/student.css"?>">
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">
  
        <div class="div4">
            <div class="div5">
                <select name="New Requests" class="selector" id="">
                    <option value="">New  Requests</option>
                    <option value="">Accepted List</option>
                    <option value="">Rijected List</option>
                </select>
                <hr>
                <div class="studentList">
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    <a class="student" href="#">Student 1</a><br>
                    
                </div>
            </div>
            <div class="div6">
                <div class="imageSection">
                    <div class="img"><img class="dpImg" src="<?php echo URLROOT."/public/img/img7.jpg"?>" alt=""></div>
                    <div class="btnDiv">
                        <button class="accept"><i class="fa-solid fa-user-plus"></i>   Accept</button>
                        <button class="decline"><i class="fa-solid fa-user-minus"></i>  Decline</button>
                    </div>

                </div>
                <div class="infoSection">
                    <br><label for="name">Name  : </label>P.G Kumarage<br>
                    <label for="age">Age    : </label>22<br>
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
            </div>
        </div>
    
  </div>
</body>

</html>
