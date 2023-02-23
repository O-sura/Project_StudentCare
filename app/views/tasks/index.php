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
          <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
          <div class="name">
            Oshada
          </div>
        </div>
        <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
      </div>
    </div>
  </div>
  <div class="home_content">
    <div class="container">
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
          <div class="buttons">
            <div class="topic">
              <h3>Choose Event</h3>
            </div>
            <div class="event">

              <select class="select">

                <option value="Exam">Exam</option>
                <option value="Club">Club</option>
                <option value="Gym">Gym</option>
              </select>

            </div>
            <div class="add">
              <button class="btn"><a href="AddEvent.php">Add new</a></button>
            </div>

          </div>
          <div class="horizontal">
            <hr class="new">
          </div>
          <div class="tasks">
            <div class="topic">
              <h3>Tasks today</h3>
            </div>

            <div class="task">
              <?php
              if (count($data['all']) == 0) { ?>

                <div class="todayTasks" style="color:white">
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
        </div>

      </div>
    </div>
  </div>



  <script>
    let specialDates = <?php echo json_encode($data['taskDates']) ?>;


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
  </script>
</body>

</html>