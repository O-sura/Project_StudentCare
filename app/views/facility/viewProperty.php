<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/stu/view-one.css" ?> >
    <script src= <?php echo URLROOT . "/public/js/viewOne.js" ?> defer></script>
    <title>View One Property</title>
</head>
<body>
    <div class="page">

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

            <div class="left_side">
                <div id="image_container" align="center">
                    <br>
                    
                    <div class="preview" align="center">
                        <!-- <img name="preview" src=""> -->
                        <img id="preview" src="https://i.ikman-st.com/kaamr-phsukm-aet-for-rent-colombo-1/069352fb-3d4b-4088-b7b3-74ec7b0e6479/620/466/fitted.jpg">
                    </div>
                    <br>
                    <div class="thumbnails">
                        <img name="img1" src="https://i.ikman-st.com/kaamr-phsukm-aet-for-rent-colombo-1/8ca54d35-0e52-49c7-adbd-a5ea1bac6111/620/466/fitted.jpg" onclick="gallery(this)">
                        <img name="img2" src="https://i.ikman-st.com/kaamr-phsukm-aet-for-rent-colombo-1/44674bb2-b4e9-4ce2-869c-77c9d21f6919/620/466/fitted.jpg" onclick="gallery(this)">
                        <img name="img3" src="https://i.ikman-st.com/kaamr-phsukm-aet-for-rent-colombo-1/7b229e61-f861-4d22-bdb3-7878e0f99510/620/466/fitted.jpg" onclick="gallery(this)">
                        <img name="img4" src="https://i.ikman-st.com/kaamr-phsukm-aet-for-rent-colombo-1/fdd8e544-b351-456b-ace7-61892ec56585/620/466/fitted.jpg" onclick="gallery(this)">
                    </div>
                </div>

                <div class="contact">
                    <h2>Contact Info.</h2>
                    <p><span>Contact No: </span>0777896812</p>
                    <p><span>Address: </span>No.88 Battiyawatta road, Thumbowila, Piliyandala</p>

                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d270201.1012553059!2d80.57066973934896!3d7.435740318327426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1668671876514!5m2!1sen!2slk" 
                            width="400" height="250" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2603.467645889274!2d80.64027088542007!3d7.293955371034674!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8165d70ac115e887!2sSri%20Dalada%20Maligawa!5e0!3m2!1sen!2slk!4v1670742226263!5m2!1sen!2slk" 
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                                 
                    </div>
                </div>

            </div>

            <div class="right_side">
                
                <h1 class="topic">Annex for Rent in Homagama
                    
                </h1>

                <h8>Added: <h7 id="date">09 Feb 9:02 pm</h7></h8>

                <p class="description">
                  <pre>
Property type:Annex
Address:පිටිපන.
Beds: 2
Baths:2</pre>
                  <br>
                    <span>Only for girls</span><br>
                    <span>Near to UCSC
                    </span>
                </p>
                
                <p class="price"><span>Price(Rs.): </span>8000</p>

                <div class="review">
                    <p>Reviews</p>
                    <div class="rating">
                        <input type="radio" name="star" id="star1"><label for="star1"></label>
                        <input type="radio" name="star" id="star2"><label for="star2"></label>
                        <input type="radio" name="star" id="star3"><label for="star3"></label>
                        <input type="radio" name="star" id="star4"><label for="star4"></label>
                        <input type="radio" name="star" id="star5"><label for="star5"></label>
                    </div>

                    <input type="text" value="Highly recommend." class="feedback">
                    <input type="text" value="This is situated in safe area." class="feedback">
                    <input type="text" value="Write a review...." class="feedback2">
                </div>
            </div>

           

        </div>
        </div>
        
    </div>
    
</body>
</html>