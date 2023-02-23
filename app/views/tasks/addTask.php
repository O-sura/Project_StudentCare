<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Adding task</title>
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/task.css" ?>>
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
      <div class="grid-1">
        <p>Add tasks</p>
      </div>

      <div class="grid-2">

        <form class="" action="<?php echo URLROOT; ?>/tasks/add " method="post">


          <label for="tname">Name of the task</label><br><br>
          <input type="text" name="tname" id="tname" required value=""><br><br>
          <label for="tdate">Due date</label><br><br>
          <input type="date" name="tdate" id="tdate" required><br><br>
          <label for="ttime">Due time</label><br><br>
          <input type="time" id="ttime" name="ttime" required><br><br>
          <label>Task color</label><br><br>
          <div class="buttons">
            <button class="btn1" type="none"></button>
            <button class="btn2" type="none"></button>
            <button class="btn3" type="none"></button>
            <button class="btn4" type="none"></button>
          </div>

          <input type="text" id="tcolor" name="tcolor">
          <br><br>
          <hr>
          <br>
          <label for="reminder"><b>Add a reminder</b></label>
          <i class="fa-regular fa-bell"></i>
          <input type="checkbox" id="reminder" name="reminder" value="1"><br><br>
          <label for="rdate">Due date </label><br><br>
          <input type="date" name="rdate" id="rdate" required value="" disabled><br><br>
          <label for="rtime">Due time</label><br><br>
          <input type="time" id="rtime" name="rtime" required disabled><br><br>

          <div class="grid-5">
            <button class="btn" type="submit" name="submit">Add task</button>
          </div>


        </form>
      </div>
    </div>
  </div>


  <script>
    document.getElementById('reminder').onchange = function() {
      document.getElementById('rdate').disabled = !this.checked;
      document.getElementById('rtime').disabled = !this.checked;
    };
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");

    btn.onclick = function() {
      sidebar.classList.toggle("active");
    }

    document.querySelector(".btn1").onclick = function() {
      event.preventDefault();
      document.querySelector(".btn1").style.border = "2px solid #1A285A";
      document.querySelector(".btn2").style.border = "none";
      document.querySelector(".btn3").style.border = "none";
      document.querySelector(".btn4").style.border = "none";
      document.querySelector("#tcolor").value = "#FEAEAE";
    }

    document.querySelector(".btn2").onclick = function() {
      event.preventDefault();
      document.querySelector(".btn2").style.border = "2px solid #1A285A";
      document.querySelector(".btn1").style.border = "none";
      document.querySelector(".btn3").style.border = "none";
      document.querySelector(".btn4").style.border = "none";
      document.querySelector("#tcolor").value = "#BBF3C0";
    }

    document.querySelector(".btn3").onclick = function() {
      event.preventDefault();
      document.querySelector(".btn3").style.border = "2px solid #1A285A";
      document.querySelector(".btn2").style.border = "none";
      document.querySelector(".btn1").style.border = "none";
      document.querySelector(".btn4").style.border = "none";
      document.querySelector("#tcolor").value = "#A3A2EA";
    }

    document.querySelector(".btn4").onclick = function() {
      event.preventDefault();
      document.querySelector(".btn4").style.border = "2px solid #1A285A";
      document.querySelector(".btn2").style.border = "none";
      document.querySelector(".btn3").style.border = "none";
      document.querySelector(".btn1").style.border = "none";
      document.querySelector("#tcolor").value = "#E28FEF";
    }
  </script>
</body>

</html>