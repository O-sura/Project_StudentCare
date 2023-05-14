<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?> >
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
    <a href="#" class="toggle-btn" id="menu-btn">
        <i class="fa-solid fa-bars"></i>
    </a>
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
<hr class="divider left">
<div class="about" id="about">
    <h1>ABOUT US</h1>
    <p class="about-text">StudentCare: Your All-in-One Student Support Platform. 
        Connect, Thrive, Succeed!
        Join a vibrant student community, share experiences, and receive valuable feedback.</p>
    <p class="about-text">Boost productivity and stay organized with our intuitive mobile app. Track your progress, manage study time, and set helpful reminders.
        Prioritize your mental well-being with free counseling sessions by industry professionals via secure video calling.
        Find nearby food and utility options effortlessly. Discover suitable accommodation and everyday essentials with direct connections to listing owners and student reviews.
        Experience 24x7 support and access to resources that drive academic and personal success.
        Join StudentCare today and unlock your full potential!</p>
</div>
<hr class="divider right"><br><br>
<div class="features" id="features">
    <h1 class="features-title">FEATURES</h1>
    <div class="feature-list">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-users icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Community Support</h4>
                <p>Engage with a community of like-minded students, share experiences, post articles, ask questions, and get answers from others.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-brands fa-android icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Mobile App</h4>
                <p>Keep track of your study time, analyze your progress, create to-do lists, and set reminders to stay organized and focused.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-user-doctor icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Counseling Sessions</h4>
                <p>Get access to free counseling sessions from professional counselors in the industry via video calling, available at your convenience.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-house icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Boarding Places and Utilities</h4>
                <p>Find what matchs your preferences with the ability to browse reviews, ratings, and communicate directly with the listing owners for any additional information.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-lock icon"></i>
            </div>
            <div class="feature-desc">
                <h4>Safe Space</h4>
                <p>We value your privacy and all your information are kept confidential. Users can feel comfortable knowing that they are in a judgment-free and safe space.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-headset icon"></i>
            </div>
            <div class="feature-desc">
                <h4>24x7 Support</h4>
                <p>Ensures users receive immediate assistance from a support team whenever they need it, regardless of the time of day or night.</p>
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

<script>
    let menuBtn = document.getElementById('menu-btn');
    let navLinks = document.querySelectorAll('.navbar-link');

    menuBtn.addEventListener('click', ()=>{
        navLinks.forEach(link => link.classList.toggle('active'))
    })
</script>
</body>
</html>