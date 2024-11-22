<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Calendar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/calendar.css" ?>>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
  <?php
  require_once '../app/views/tasks/sidebar.php';
  ?>
  <div class="home_content">

    <div class="row1">
      <h1>Personal Schedule</h1>
    </div>
    <div class="row2">
      <div class="flex">
        <div class="month">
          <h3><a href="<?php echo URLROOT ?>/tasks/">Monthly</a></h3><br>
          <hr>
        </div>
        <div class="week">
          <h3><a href="<?php echo URLROOT ?>/tasks/weekly">Weekly</a></h3><br>
          <hr class="rest">
        </div>
        <div class="day">
          <h3><a href="<?php echo URLROOT ?>/tasks/today">Daily</a></h3><br>
        </div>
      </div>

    </div>
    <div class="row3">
      <div class="wrap">
        <div class="wrapper">
          <header>
            <p class="current-date"></p>
            <div class="icons">
              <i id="prev" class="fa-solid fa-chevron-left"></i>
              <i id="next" class="fa-solid fa-chevron-right"></i>
            </div>
          </header>
          <div class="calendar">
            <ul class="weeks">
              <li>Sun</li>
              <li>Mon</li>
              <li>Tue</li>
              <li>Wed</li>
              <li>Thu</li>
              <li>Fri</li>
              <li>Sat</li>
            </ul>
            <form id="form" method="post" action="<?php echo URLROOT; ?>/tasks/view">
              <ul class=" days">

              </ul>
              <input type="text" id="date" name="date">

            </form>
          </div>
        </div>
      </div>
      <div class="column">

        <div class="topic2">
          <h3>Tasks left today</h3>
        </div>

        <div class="task-topic">
          <?php
          if (count($data['all']) == 0) { ?>

            <div class="todayTasks">
              There are no tasks today
            </div>
          <?php }
          ?>
          <?php
          if (count($data['all']) > 0) {
          ?>
            <?php foreach ($data['notStarted'] as $task) { ?>

              <div class="todayTasks" style="background-color:<?php echo $task->task_color; ?>;">
                <?php echo $task->task_description; ?>
              </div>
            <?php
            }
            ?>
            <?php foreach ($data['inProgress'] as $task) { ?>

              <div class="todayTasks" style="background-color:<?php echo $task->task_color; ?>;">
                <?php echo $task->task_description; ?>
              </div>
            <?php
            }
            ?>
          <?php } ?>

        </div>


      </div>
      <div class="stats">
        <div class="task-chart">
          <canvas id="myChart" style="height:40vh; width:20vw"></canvas>
        </div>
        <div class="percentage">
          <h1>60%</h1>
        </div>
      </div>
   
      
    </div>

  </div>



  <script>
    const specialDates = <?php echo json_encode($data['taskDates']) ?>;
            

    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");



    const currentDate = document.querySelector('.current-date');
    daysTag = document.querySelector('.days');
    prevNextIcon = document.querySelectorAll('.icons i');
    var clickdate;


    //get current date
    let date = new Date();
    currYear = date.getFullYear();
    currMonth = date.getMonth();
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const renderCalendar = () => {
      let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(); //get first day of month
      let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(); //get last day
      let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(); //get last day of month
      let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); //get last day of last month
      let liTag = "";

      for (let i = firstDayofMonth; i > 0; i--) {
        liTag = liTag + `<li class="inactive">${lastDateofLastMonth-i+1}</li>`;
      }

      for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? 'active' : 'others';
        let dateString = `${currYear}-${("0" + (currMonth + 1)).slice(-2)}-${("0" + i).slice(-2)}`;

        if (specialDates.includes(dateString)) {
          isToday = 'special';
        }
        liTag = liTag + `<li class="${isToday}">${i}</li>`;
      }

      for (let i = lastDayofMonth; i < 6; i++) {
        liTag = liTag + `<li class="inactive">${i-lastDayofMonth+1}</li>`;
      }


      currentDate.innerText = `${months[currMonth]} ${currYear}`;
      daysTag.innerHTML = liTag;
      clickdate = document.querySelectorAll('.days li.others');
      clickToday = document.querySelectorAll('.days li.special');

      clickdate.forEach(date => {
        date.addEventListener('click', () => {
          let day = date.innerText;
          let month = currMonth + 1;
          let year = currYear;
          let x = year.toString() + "-" + month.toString() + "-" + day.toString();
          document.getElementById("date").value = x;
          document.getElementById("form").submit();


        });

      });

      clickToday.forEach(date => {
        date.addEventListener('click', () => {
          let day = date.innerText;
          let month = currMonth + 1;
          let year = currYear;
          let x = year.toString() + "-" + month.toString() + "-" + day.toString();
          document.getElementById("date").value = x;
          document.getElementById("form").submit();

        });

      });
    }

    renderCalendar();


    prevNextIcon.forEach(icon => {
      icon.addEventListener('click', () => {
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
          date = new Date(currYear, currMonth);
          currYear = date.getFullYear();
          currMonth = date.getMonth();
        } else {
          date = new Date();
        }
        renderCalendar();

      });
    });

    function DoSubmit() {
      return true;
    }

    btn.onclick = function() {
      sidebar.classList.toggle("active");
    }
    var total_task_count =  <?php echo $data['tasks']?>;
    var completed_task_count = <?php echo $data['tasksCompleted']?>;
    var xValues = ["Tasks completed"];
    var yValues = [completed_task_count, total_task_count - completed_task_count];
    var percentage = (completed_task_count / total_task_count) * 100;
    document.querySelector('.percentage h1').innerHTML = percentage.toFixed(0) + "%";
    var barColors = [
      "#1A285A",
      "#f5f5f5"
    ];

    new Chart("myChart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
          text: "Percentage of tasks completed"
        }
      }
    });
  </script>
</body>

</html>