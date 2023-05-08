<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/dashboard.css"?>">
  <script src= <?php echo URLROOT . "/public/js/Counselor/dashboardCharts.js"?> defer></script>

  <title></title>
</head>

<body>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">
        
            <div class="divSection" >
                <div class="row1">
                    <div class="row1div1">
                        <h3 class="subb">Appointment Stats</h3>
                        <div class="pie" style="width:65%; height:65% ">
                            <canvas id="pieChart" class="piechart"></canvas>
                        </div>
                        <!-- <img class="piechart" src="<?php echo URLROOT."/public/img/free-pie-chart-icon-683-thumb.png"?>"> -->
                    </div>
                    <div class="row1div2">
                        <h3 class="subb">Next Appointment</h3><br>
                        <i class="fa-regular fa-calendar-check" style="font-size: 3em"></i><br><br>
                        <?php if(!empty($data['rowNext'])) : ?>

                            <p class="cont">Name : <?php echo $data['rowNext']['studentName'] ?></p><br>
                            <p class="cont">Time : <?php echo date("g:i  A", strtotime($data['rowNext']['appointmentTime'])); ?></P>

                        <?php else: ?>
                            <p class="noappP">No appointments</p>
                        <?php endif ;?>
                    </div>
                    <div class="row1div3">
                        <h3 class="subb">Students Stats</h3>
                        <div class="graph">
                            <canvas id="myChart" style="width:80%;"></canvas>
                        </div>
                        <!-- <img class="piechart" src="<?php echo URLROOT."/public/img/Blue_bar_graph.png"?>"> -->
                    </div>
                </div>
               
                <h2 class="subTopic">Daily Appointments</h2><br>
                <div class="row2">
                    <?php if(count($data['row']) > 0) : ?>

                        <?php foreach ($data['row'] as $row ): ?>

                            <div class="row2div1"><?php echo date("g:i  A", strtotime($row['appointmentTime'])); ?></div>
                            
                        <?php endforeach ?> 
                    
                    <?php else: ?>
                        <div class="noappR"><p class="noappP"><?php echo "There is no any appointment yet for today" ?></p></div>
                    <?php endif ;?>
                    
                </div>
           
                <h2 class="subTopic">Daily Notifications</h2><br>
                <div class="row3">
                    <div class="row3div1">
                        <?php if(!empty($data['recentNoti'])) :?>
                            <?php foreach ($data['recentNoti'] as $recN ): ?>
                        
                                    <?php  if($recN->statusPP == 0 && $recN->appointmentStatus == 0): ?>                      

                                        <span><i class="fa-regular fa-circle-dot" style="color:grey;"></i><div class="row3div2">You have new student request from <?php echo $recN->fullname ;?></div></span>
                                               
                                    
                                    <?php else :?>   

                                        <span><i class="fa-regular fa-circle-dot" style="color:grey;"></i><div class="row3div2"><?php echo $recN->fullname;?> has requested to cancel the appointment on <?php echo $recN->appointmentDate ;?></div></span>
                                        
                                    <?php endif ;?>
                                <?php endforeach  ?>
                                
                                

                            <?php else : ?>

                                <div class="noNotifi"><?php echo "You dont have any notification yet" ;?></div>

                            <?php endif ; ?>
                    </div>
                </div>
            </div>
            
        
    </div>

</body>

</html>
