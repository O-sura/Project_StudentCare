<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/student-register.css"?>>
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
    <div class="form-container">
        <h1>Registering as a Student</h1>
        <form action="./student_register" method="post">
            <?php 
                    if($data['dob_err'])
                        echo '<div class="form-field" data-error=" ' . $data['dob_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="dob" class="lable">Date of Birth:</label><br>
                <input type="date" name="dob" id="dob" class="form-input" max=<?php echo date('Y-m-d');?> >
            </div>
            <?php 
                    if($data['university_err'])
                        echo '<div class="form-field" id="uni-field" data-error=" ' . $data['university_err'] . '">';
                    else
                        echo '<div class="form-field" id="uni-field">';
            ?>
                <label for="university" class="lable">University:</label><br>
                <input type="" name="university" id="university" class="form-input" readonly>
                <select class="select">
                    <option value="University of Colombo">University of Colombo</option>
                    <option value="University of Peradeniya">University of Peradeniya</option>
                    <option value="University of Moratuwa">University of Moratuwa</option>
                    <option value="University of Ruhuna">University of Ruhuna</option>
                    <option value="University of Jaffna">University of Jaffna</option>
                    <option value="University of SJP">University of SJP</option>
                    <option value="University of Kelaniya">University of Kelaniya</option>
                    <option value="Sabaragamuwa University">Sabaragamuwa University</option>
                    <option value="NIBM">NIBM</option>
                    <option value="SLIIT">SLIIT</option>
                    <option value="IIT">IIT</option>
                </select>
            </div>
            <div class="form-field">
                <label for="locations" class="lable">Lcation Prefrence(s):</label><br>
                <textarea name="locations" id="locations" class="form-input" cols="30" rows="5" placeholder="Enter Comma Seperated
                (Ex: Colombo, Boralesgamuwa,...)"></textarea>
                <p class="helper">(This will be only used for providing better experience while using certain
                    features given in our platform and all these information will be private)</p>
            </div>
                <div>
                    <?php 
                            if($data['unimail_err'])
                                echo '<div class="form-field" data-error=" ' . $data['unimail_err'] . '">';
                            else
                                echo '<div class="form-field">';
                    ?>
                    <label for="university" class="lable">University Email:</label><br>
                    <input type="email" name="unimail" id="unimal" class="form-input">
                    </div>
                    <?php 
                        if($data['terms_err'])
                            echo '<div class="form-field" id="checkbox-container" data-error=" ' . $data['terms_err'] . '">';
                        else
                            echo '<div class="form-field"  id="checkbox-container">';
                    ?>
                        <input type="checkbox" name="terms" id="terms" class="form-input">
                        <span class="note">I hereby declare that the information given above is true and accurate to the best of my knowledge</span>
                    </div>
                </div>

            
            <input type="submit" value="Register Me" class="button" name="register">
        </form>
    </div>

    <script>
        let dropdown = document.querySelector('select');
         let input = document.getElementById('university');
         dropdown.addEventListener('change', () => {
           console.log(dropdown.value);
           input.value = dropdown.value;
         })
   </script>
</body>
</html>