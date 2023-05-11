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
  <?php
  require_once '../app/views/tasks/sidebar.php';
  ?>

  <div class="home_content">
    <div class="container">
      <div class="grid-1">
        <p>Add tasks</p>
      </div>

      <div class="grid-2">

        <form class="" action="<?php echo URLROOT; ?>/tasks/add" method="post">


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
          <br>
          <div class="grid-5">
            <button class="btn" type="submit" name="submit">Add task</button>
          </div>


        </form>
      </div>
    </div>
  </div>


  <script>
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