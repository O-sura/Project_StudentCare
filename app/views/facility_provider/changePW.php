
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/changepw.css"?> >
    <script src= <?php echo URLROOT . "/public/js/"?> defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Change Password</title>
</head>
<body>
    <div class="section">
        <i class="fa-solid fa-key" id="main-logo"></i>
        <h1>Set New Password</h1>
        <p>Your password should be different form your previous one</p>
        <form method="post" action="./changeCurrentPassword">
            <!-- <input type="hidden" name="token" value="<?= $data['token'] ?>"> -->
          
            <?php 
                if($data['currentPW_err'])
                    echo '<div class="form-field" data-error=" ' . $data['currentPW_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?><br>   
                <label for="current-password">Current-Password:</label><br>
                <input type="password" id="current-password" name="current-password" ><br>
            </div>
            <?php 
                if($data['password_err'])
                    echo '<div class="form-field" data-error=" ' . $data['password_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?><br>
                <label for="password">New-Password:</label><br>
                <input type="password" id="password" name="password" ><br>
            </div>
            <?php 
                if($data['confirmPW_err'])
                    echo '<div class="form-field" data-error=" ' . $data['confirmPW_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?> <br> 
                <label for="password-verify">Confirm-Password:</label><br>
                <input type="password" id="password" name="password-confirm" ><br>
            </div>
            <input type="submit" value="Change Password" name="change-password">
        </form> 
        <div class="back-btn">
            <a href=<?php echo URLROOT . "/users/login"?>><i class="fa-solid fa-arrow-left"></i></a>
            <span class="btn-text"><a href=<?php echo URLROOT . "/facility_provider/editprofile"?>>Go Back to EditProfile</a></span>
        </div>
    </div>
</body>
</html>