
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/fp-register.css"?> >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src= <?php echo URLROOT . "/public/js/fp_register.js"?> defer></script>
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
        <h1>Registering as a Facility Provider</h1>
        <form action="./facility_provider_register" method="post">
            <?php 
                if($data['type_err'])
                    echo '<div class="form-field" id="type" data-error=" ' . $data['type_err'] . '">';
                else
                    echo '<div class="form-field" id="type">';
            ?>
                <label for="types">What will you provide:</label><br>
                <div class="option">
                    <input type="checkbox" name="facility" id="terms" class="form-input">
                    <span class="option">Faciliy(Boarding Places, House for Rent, etc.)</span>
                </div>
                <div class="option">
                    <input type="checkbox" name="food" id="terms" class="form-input">
                    <span class="option">Food</span>
                </div>
                <div class="option">
                    <input type="checkbox" name="furniture" id="terms" class="form-input">
                    <span class="option">Furniture and Supplies</span>
                </div>
            </div>
        <input type="submit" value="Register Me" class="button" name="register">
    </form>
    </div>
    <img src=<?php echo URLROOT . "/public/img/facility.jpg"?> alt="background" id="background">
</body>
</html>