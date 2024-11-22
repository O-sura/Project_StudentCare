
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/userrole-pick.css"?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="top-bar">
        <span id="sitename">StudentCare</span>
        <div class="header">
            <span>Already have an Account? </span>
            <a href="<?php echo URLROOT ?>/users/login"><div class="login">Login Here</div></a>
        </div>
    </div>
    <h1>JUST FEW MORE STEPS...</h1>
        <div class="container">
            <h1>Pick Your Role</h1>
            <form action="./pick_userrole" method="post">
                <div class="role-wrapper">
                    <button class="role-container" name="role" value="1">
                        <img src="<?php echo URLROOT . "/public/img/student.jpg"?>" alt="student-logo" class="icon">
                        <p class="rolename">I'm a Student</p>
                    </button>
                    <button class="role-container" name="role" value="2">
                        <img src="<?php echo URLROOT . "/public/img/counsellor-banner.jpg"?>" alt="counsellor-logo" class="icon">
                        <p class="rolename">I'm a Counsellor</p>
                    </button>
                    <button class="role-container" name="role" value="3">
                        <img src="<?php echo URLROOT . "/public/img/facility.jpg"?>" alt="fp-logo" class="icon">
                        <p class="rolename">I'm a Facility Provider</p>
                    </button>
                </div>
            </form>
        </div>
</body>
</html>