<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=<?php echo URLROOT. "/public/css/landing.css"?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
</head>
<body>
<?php 
        // Has to link the css-not added because some issue
        FlashMessage::flash('message-sent-flash');
        FlashMessage::flash('message-not-sent-flash');
?>

<div class="navbar">
    <h2 class="identity">StudentCare</h2>
    <ul class="navbar-item">
        <li class="navbar-link"><a href="#about">About Us</a></li>
        <li class="navbar-link"><a href="#features">Features</a></li>
        <li class="navbar-link"><a href="#contact">Contact Us</a></li>
        <li class="navbar-link"><a href="<?php echo URLROOT ?>/users/register"><div class="joinus">Join Us</div></a></li>
    </ul>
</div>
<div class="hero" id="hero">
    <div class="hero-tag">        
        <h3 class="hero-tag-upper">We Care About</h3>
        <h1 class="hero-tag-lower">You</h1>
    </div>
    <img src=<?php echo URLROOT. "/public/img/landing-banner.jpg"?> alt="landing-banner"/>
</div>
<div class="about" id="about">
    <h1>ABOUT US</h1>
    <p class="about-text">‘Students Care’ is a platform where university students can seek guidance under several different areas via online. Everyone can register and then he/she will be directed to a personalized dashboard where everything is lined up. Starting from the basic facility needs, students can browse through several listed choices and pick the one that fits the best for them. Under the academics, students can maintain a customizable work planner to track their work while managing the time more productively.</p>
    <p class="about-text">Our platform brings all these activities and organizations to one platform, so that students can find and manage everything in one place without any hustle.</p>
</div>
<div class="features" id="features">
    <h1 class="features-title">FEATURES</h1>
    <div class="feature-list">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit iste in saepe asperiores eos repellat.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit iste in saepe asperiores eos repellat.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit iste in saepe asperiores eos repellat.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit iste in saepe asperiores eos repellat.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit iste in saepe asperiores eos repellat.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit iste in saepe asperiores eos repellat.</p>
            </div>
        </div>
        
    </div>
</div>
<div class="contact-form-container" id="contact">
    <h1>Contact Us</h1>
    <div class="form-wrapper">
        <form action="<?php echo URLROOT . "/pages/contact_us"?>" method="post">
            <div class="form-row">
                <?php 
                    if($data['fname_err'])
                        echo '<div class="form-field" data-error=" ' . $data['fname_err'] . '">';
                    else
                        echo '<div class="form-field">';
                ?>
                    <label for="fname">First Name:</label><br>
                    <input type="text" name="fname" id="fname" required>
                </div>
                <?php 
                    if($data['lname_err'])
                        echo '<div class="form-field" data-error=" ' . $data['lname_err'] . '">';
                    else
                        echo '<div class="form-field">';
                ?>
                    <label for="lname">Last Name:</label><br>
                    <input type="text" name="lname" id="lname" required>
                </div>
            </div>
            <?php 
                    if($data['email_err'])
                        echo '<div class="form-field" data-error=" ' . $data['email_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required>
            </div>
            <?php 
                    if($data['message_err'])
                        echo '<div class="form-field" data-error=" ' . $data['message_err'] . '">';
                    else
                        echo '<div class="form-field">';
            ?>
                <label for="message">Message:</label><br>
                <textarea name="message" id="message" cols="30" rows="10" required></textarea>
            </div>
            <center><input type="submit" value="Submit" class="btn" name="submit"></center>
        </form>
    </div>
</div>
<div class="footer-wrap">
    <div class="footer">
        <div class="block">
            <div class="start"></div>
            <div class="mid">
                <ul class="footer-links">
                    <li class="footer-link"><a href="#hero" class="footer-link">Home</a></li>
                    <li class="footer-link"><a href=<?php echo URLROOT . "/pages/privacy_policy"?> class="footer-link">Privacy Policy</a></li>
                    <li class="footer-link"><a href=<?php echo URLROOT . "/pages/terms_and_conditions"?> class="footer-link">Terms & Conditions</a></li>
                    <li class="footer-link"><a href=<?php echo URLROOT . "/pages/rules_and_regulations"?> class="footer-link">Rules & Regulations</a></li>
                </ul>
            </div>
        </div>
        <div class="end">
            <h3 class="social-txt">FOLLOW US</h3>
            <div class="social-links">
                <div class="social-icon"><a href="https://www.facebook.com"><i class="fa-brands fa-square-facebook"></i></a></div>
                <div class="social-icon"><a href="https://www.instagram.com"><i class="fa-brands fa-square-instagram"></i></a></div>
                <div class="social-icon"><a href="https://www.twitter.com"><i class="fa-brands fa-square-twitter"></i></a></div>
            </div>
        </div>
    </div>
    <center><p class="copyrights">StudentCare © 2023 - 2024</p></center>
</div>
</body>
</html>