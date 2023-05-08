<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/notification.css"?>">
  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    
    <div class="home_content">

        <div class="topicHead">
            <span><h1 class="headApp">Notifications</h1></span>
        </div>
        <hr class="hrbar">

           
            <div class="div5">

                <?php if($data['rowcount'] != 0 ) : ?>
                    
                    <?php foreach ($data['row'] as $row ): ?>
                        
                        <?php  if ($row->statusPP == 0 && $row->appointmentStatus == 0): ?>                      

                            <div  class="noti">
                                <div class="intro"></div>
                                <div class="dp">
                                    <?php if(!empty($row->profile_img)) : ?>
                                            <img class="dpImg" src="http://localhost/StudentCare/public/img/student/<?php echo $row->profile_img; ?>" alt=""> 
                                    <?php else :?>
                                            <img class="dpImg" src="http://localhost/StudentCare/public/img/student/avatar.jpg" alt=""> 
                                    <?php endif ; ?>
                                </div>
                                <div class="desc">
                                    <h4 class="topic">New Student Request</h4>
                                    <p class="para">Name : <?php echo $row->fullname ;?> &nbsp;&nbsp; </p>
                                    <p class="time">Date : <?php echo date('Y:m:d',strtotime($row->requested_on)) ;?>&nbsp;&nbsp; <?php echo date('H:i a',strtotime($row->requested_on)) ;?></p>
                                </div>
                                <div class="btns">
                                    <button class="right" name="mark"><i class="fa-regular fa-square-check"></i></button>
                                    <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </div>            
                        
                        <?php elseif ($row->statusPP == 0 && $row->appointmentStatus == 0 && $row->counselor_seen == 1): ?>                      

                            <div  class="Readnoti">
                                <div class="intro"></div>
                                <div class="dp">
                                    <?php if(!empty($row->profile_img)) : ?>
                                            <img class="dpImg" src="http://localhost/StudentCare/public/img/student/<?php echo $row->profile_img; ?>" alt=""> 
                                    <?php else :?>
                                            <img class="dpImg" src="http://localhost/StudentCare/public/img/student/avatar.jpg" alt=""> 
                                    <?php endif ; ?>
                                </div>
                                <div class="desc">
                                    <h4 class="topic">New Student Request</h4>
                                    <p class="para">Name : <?php echo $row->fullname ;?> &nbsp;&nbsp; </p>
                                    <p class="time">Date : <?php echo date('Y:m:d',strtotime($row->requested_on)) ;?>&nbsp;&nbsp; <?php echo date('H:i a',strtotime($row->requested_on)) ;?></p>
                                </div>
                                <div class="btns">
                                    <button class="right" name="mark"><i class="fa-regular fa-square-check"></i></button>
                                    <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </div>           
                       
                        <?php else :?>   

                            <div  class="noti">
                                <div class="intro"></div>
                                <div class="dp">
                                    <?php if(!empty($row->profile_img)) : ?>
                                            <img class="dpImg" src="http://localhost/StudentCare/public/img/student/<?php echo $row->profile_img; ?>" alt=""> 
                                    <?php else :?>
                                            <img class="dpImg" src="http://localhost/StudentCare/public/img/student/avatar.jpg" alt=""> 
                                    <?php endif ; ?>
                                </div>
                                <div class="desc">
                                    <h4 class="topic">Cancellation of an Appointment</h4>
                                    <div class="para"><div class=paraX>Name : &nbsp;</div><?php echo $row->fullname ;?></div>
                                    <div class="para"><div class=paraX>Reason : &nbsp;</div><?php echo $row->cancellationReason ;?> </div>
                                    <div class="para"><div class=paraX>Appointment Date : &nbsp;</div><?php echo $row->appointmentDate ;?> </div>
                                    <div class="para"><div class=paraX>Appointment Time : &nbsp;</div><?php echo date('H:i a',strtotime($row->appointmentTime)) ;?> </div>
                                    <p class="time">Date : <?php echo date('Y:m:d',strtotime($row->requested_on)) ;?>&nbsp;&nbsp; <?php echo date('H:i a',strtotime($row->requested_on)) ;?></p>
                                </div>
                                <div class="btns">
                                    <button class="right"><i class="fa-regular fa-square-check"></i></button>
                                    <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </div>
                        
                        <?php endif ;?>
                    <?php endforeach  ?>
                    
                    

                <?php else : ?>

                    <div class="noNoti"> <p class="noNotiState"><?php echo "There is no any notification yet" ;?></p></div>

                <?php endif ; ?>
                <!-- <div  class="noti">
                    <div class="intro"></div>
                    <div class="dp"><img class="dpImg" src="<?php echo URLROOT."/public/img/img1.jpg"?>" alt=""></div>
                    <div class="desc">
                        <h4 class="topic">User 01</h4>
                        <p class="para">You have a new student request. You have a new suggestion, respond now or later.</p>
                        <p class="time">2 hours ago</p>
                    </div>
                    <div class="btns">
                        <button class="right"><i class="fa-regular fa-square-check"></i></button>
                        <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                    </div>
                </div>
                <div  class="noti">
                    <div class="intro"></div>
                    <div class="dp"><img class="dpImg" src="<?php echo URLROOT."/public/img/img2.jpg"?>" alt=""></div>
                    <div class="desc">
                        <h4 class="topic">User 01</h4>
                        <p class="para">You have a new student request. You have a new suggestion, respond now or later.</p>
                        <p class="time">9 hours ago</p>
                    </div>
                    <div class="btns">
                        <button class="right"><i class="fa-regular fa-square-check"></i></button>
                        <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                    </div>
                    
                </div>
                <div  class="noti">
                    <div class="intro"></div>
                    <div class="dp"><img class="dpImg" src="<?php echo URLROOT."/public/img/img6.jpg"?>" alt=""></div>
                    <div class="desc">
                        <h4 class="topic">User 01</h4>
                        <p class="para">You have a new student request. You have a new suggestion, respond now or later.</p>
                        <p class="time">16 hours ago</p>
                    </div>
                    <div class="btns">
                        <button class="right"><i class="fa-regular fa-square-check"></i></button>
                        <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                    </div>
                </div> -->
            </div>
    
    </div>

</body>

</html>






 <!-- <?php foreach ($data['row1'] as $row1 ): ?>

                        <div  class="noti">
                            <div class="intro"></div>
                            <div class="dp"><img class="dpImg" src="<?php echo URLROOT."/public/img/img1.jpg"?>" alt=""></div>
                            <div class="desc">
                                <h4 class="topic">New Student Request</h4>
                                <p class="para">Name : <?php echo $row1->fullname ;?> &nbsp;&nbsp; </p>
                                <p class="time">Date : <?php echo date('Y:m:d',strtotime($row1->requested_on)) ;?>&nbsp;&nbsp; <?php echo date('H:i a',strtotime($row1->requested_on)) ;?></p>
                            </div>
                            <div class="btns">
                                <button class="right"><i class="fa-regular fa-square-check"></i></button>
                                <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </div>

                        <?php endforeach  ?>

<?php foreach ($data['row2'] as $row1 ): ?>

    <div  class="noti">
        <div class="intro"></div>
        <div class="dp"><img class="dpImg" src="<?php echo URLROOT."/public/img/img1.jpg"?>" alt=""></div>
        <div class="desc">
            <h4 class="topic">Cancellation of Request</h4>
            <div class="para"><div class=paraX>Name : &nbsp;</div><?php echo $row1->fullname ;?></div>
            <div class="para"><div class=paraX>Reason : &nbsp;</div><?php echo $row1->reason ;?> </div>
            <p class="time">Date : <?php echo date('Y:m:d',strtotime($row1->requested_on)) ;?>&nbsp;&nbsp; <?php echo date('H:i a',strtotime($row1->requested_on)) ;?></p>
        </div>
        <div class="btns">
            <button class="right"><i class="fa-regular fa-square-check"></i></button>
            <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
        </div>
    </div>

<?php endforeach  ?>


<?php foreach ($data['row3'] as $row1 ): ?>

    <div  class="noti">
        <div class="intro"></div>
        <div class="dp"><img class="dpImg" src="<?php echo URLROOT."/public/img/img1.jpg"?>" alt=""></div>
        <div class="desc">
            <h4 class="topic">Cancellation of Request</h4>
            <div class="para"><div class=paraX>Name : &nbsp;</div><?php echo $row1->fullname ;?></div>
            <div class="para"><div class=paraX>Reason : &nbsp;</div><?php echo $row1->cancellationReason ;?> </div>
            <div class="para"><div class=paraX>Appointment Date : &nbsp;</div><?php echo $row1->appointmentDate ;?> </div>
            <div class="para"><div class=paraX>Appointment Time : &nbsp;</div><?php echo date('H:i a',strtotime($row1->appointmentTime)) ;?> </div>
            <p class="time">Date : <?php echo date('Y:m:d',strtotime($row1->appointmentDate)) ;?>&nbsp;&nbsp; <?php echo date('H:i a',strtotime($row1->appointmentTime)) ;?></p>
        </div>
        <div class="btns">
            <button class="right"><i class="fa-regular fa-square-check"></i></button>
            <button class="btnDel"><i class="fa-regular fa-trash-can"></i></button>
        </div>
    </div>

<?php endforeach  ?> -->

