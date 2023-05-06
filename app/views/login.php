<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?> > -->
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/login.css"?> >
    <script src= <?php echo URLROOT . "/public/js/login.js"?> defer></script>
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login - StudentCare</title>
</head>
<body>
    <?php FlashMessage::flash('verification-success')?>
    <h1 id="sitename">StudentCare</h1>
    <div class="flex-container">
        <img src="<?php echo URLROOT . "/public/img/login-banner.jpg"?>" alt="login-image" class="login-banner">
        <div class="login-form">
            <div class="form-container">
                <center><h1>Welcome Back...</h1></center>
                <form action="./login" method="POST" class="form">
                    <?php 
                        if($data['username_err'])
                            echo '<div class="form-field" data-error=" ' . $data['username_err'] . '">';
                        else
                            echo '<div class="form-field">';
                    ?>
                        <label for="username" class="form-input-lable">Username*</label>
                        <input type="text" name="username" class="form-input">
                    </div>
                    <?php 
                        if($data['password_err'])
                            echo '<div class="form-field" data-error=" ' . $data['password_err'] . '">';
                        else
                            echo '<div class="form-field">';
                    ?>
                        <label for="password" class="form-input-lable">Password*</label>
                        <input type="password" name="password" class="form-input">
                    </div>
                    <div class="additionals">
                        <span class="remember-option">
                            <input type="checkbox" name="Remember" id="remember-check">
                            <label for="Remember">Remember Me</label>
                        </span>
                        <a href="<?php echo URLROOT ?>/users/forgot_password">Forgot Password?</a>
                    </div>
                    <input type="submit" value="Sign-in" class="button">
                    <div class="bottom-section">
                        <span class="register-text">Haven't Joined Yet? <a href="<?php echo URLROOT ?>/users/register">Register Here</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>