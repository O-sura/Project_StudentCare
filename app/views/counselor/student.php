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
            <?php if((count($data['row']) == 0) && (count($data['row0']) == 0) && (count($data['row1']) == 0) && count($data['row2']) == 0 ) : ?>
                
                <div class="ifnot">You don't have any student or students' request yet</div>
                                            
            <?php else: ?>

                <div class="div5">
                    <select name="New_Requests"  id="selector">
                    
                        <option  value="0">New  Requests</option>
                        <option  value="1">Accepted List</option>
                        <option  value="2">Rejected List</option>
                    </select>
                  
                    <hr>
                    <div class="studentList">
                        <!-- <div id="search-results"></div> -->
                        <?php foreach ($data['row'] as $row) :?>
                            <button name="clickStu" data-student-id="<?php echo $row->studentID; ?>" class="student"  value="<?php echo $row->studentID; ?>"><?php echo $row->fullname; ?></button><br>
                        <?php endforeach ?> 

                    
                        
                    </div>
                </div>
                <div class="div6">
                   
                </div>

                                            
            <?php endif;?>
        </div>

        <!-- The modal for cancellation -->

        <div id="myModalCancel" class="modalCancel">

        <!-- Modal content -->
            <form  id="formID" action="" method="POST"> 
                <div class="modalCancel-content">

                    <input type="text" name="studentID" value="" hidden>

                    <span class="closeC">&times;</span>
                    <h3>Rejection of student Request</h3><br>
                    <p class="detCancel" id="cancelName"></p>
                    <p class="detCancel" id="cancelID"></p>
                    <p class="detCancel">Reason for Rejection :</p>
                    

                    <p id="error"></p>
                    <textarea name="descC" id="textDes" placeholder="Description" rows = "15" cols = "5" class="Desc" required></textarea><br>
                
                    <button id="removeBtnC" type="submit" name="submit">Decline Request</button>
                   
                </div>
            </form>
        </div>
    
  </div>
</body>

</html>



