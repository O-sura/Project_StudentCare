
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/common-register.css"?> >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src= <?php echo URLROOT . "/public/js/common-register.js"?> defer></script>
</head>
<body>
    <div class="top-bar">
        <span id="sitename">StudentCare</span>
        <div class="header">
            <span>Already have an Account? </span>
            <a href="<?php echo URLROOT ?>/users/login"><div class="login">Login Here</div></a>
        </div>
    </div>
    <div class="form-container">
        <h1>Create an Account</h1>
        <form action="./register" method="POST">
                <?php 
                    if($data['name_err'])
                        echo '<div class="form-field" data-error=" ' . $data['name_err'] . '">';
                    else
                        echo '<div class="form-field">';
                ?>
                    <label for="name" class="lable">Name:</label><br>
                    <input type="text" name="name" id="name" class="form-input" value=<?php echo $data['name']; ?>>
                </div>
                <?php 
                    if($data['username_err'])
                        echo '<div class="form-field" data-error=" ' . $data['username_err'] . '">';
                    else
                        echo '<div class="form-field">';
                ?>
                    <label for="username" class="lable">Username:</label><br>
                    <input type="text" name="username" id="username" class="form-input" value=<?php echo $data['username']; ?>>
                </div>
            <div class="special-field">
                <?php 
                    if($data['email_err'])
                        echo '<div class="form-field" data-error=" ' . $data['email_err'] . '">';
                    else
                        echo '<div class="form-field">';
                ?>
                    <label for="email" class="lable">Email:</label><br>
                    <input type="email" name="email" id="email" class="form-input" value=<?php echo $data['email']; ?>>
                </div>
                <?php 
                    if($data['nic_err'])
                        echo '<div class="form-field"  id="special" data-error=" ' . $data['nic_err'] . '">';
                    else
                        echo '<div class="form-field" id="special">';
                ?>
                    <label for="nic" class="lable">NIC:</label><br>
                    <input type="text" name="nic" id="nic" class="form-input" value=<?php echo $data['nic']; ?>>
                </div>
            </div>
            <?php 
                    if($data['address_err'])
                        echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="address" class="lable">Address:</label><br>
                <textarea name="address" id="address" class="form-input" cols="30" rows="5"><?php echo $data['address']; ?></textarea>
            </div>
            <?php 
                    if($data['password_err'])
                        echo '<div class="form-field" data-error=" ' . $data['password_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="passwprd" class="lable">Password:</label><br>
                <input type="password" name="password" id="password" class="form-input" value=<?php echo $data['password']; ?>>
            </div>
            <?php 
                    if($data['contact_err'])
                        echo '<div class="form-field" data-error=" ' . $data['contact_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="contact" class="lable">Contact Number:</label><br>
                <input type="text" name="contact" id="contact" class="form-input" value=<?php echo $data['contact']; ?>>
            </div>
            <?php 
                    if($data['confirm_password_err'])
                        echo '<div class="form-field" data-error=" ' . $data['confirm_password_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="password-confirm" class="lable">Confirm Password:</label><br>
                <input type="password" name="password-confirm" id="re-password" class="form-input">
            </div>
            <?php 
                    if($data['terms_err'])
                        echo '<div class="form-field" id="checkbox-container" data-error=" ' . $data['terms_err'] . '">';
                    else
                        echo '<div class="form-field" id="checkbox-container">';
            ?>
                <input type="checkbox" name="terms" id="terms" class="form-input" <?php if($data['terms']) echo ('checked');  ?>>
                <span class="note">I agree with all <a href="#">Terms and Conditions</a>, <a href="#">Rules and Regulations</a> and <a href="#">Privacy Policies</a> of StudentCare</span>
            </div>
            <input type="submit" value="Continue" class="button" name="continue">
        </form>
    </div>
</body>
</html>