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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/view-one.css" ?>>
    <script type="module" src=<?php echo URLROOT . "/public/js/student/loadComments.js" ?> defer></script>
    <title>Listing View</title>
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
                    <input type="text" value=<?php echo $data['viewone']->listing_id ?> id='listing_id'>
                <div class="left_side">
                    
                    <div id="image_container" align="center">
                        <br>
                        <?php
                        $images = json_decode($data['viewone']->image);
                        ?>
                        <div class="preview" align="center">
                            <!-- <img name="preview" src=""> -->
                            <img id="preview" src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>">
                        </div>
                        <br>
                        <div class="thumbnails">
                            <img name="img1" src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>" onclick="gallery(this)">
                            <img name="img2" src="<?= URLROOT . "/public/img/listing/" . $images[1] ?>" onclick="gallery(this)">
                            <img name="img3" src="<?= URLROOT . "/public/img/listing/" . $images[2] ?>" onclick="gallery(this)">
                            <img name="img4" src="<?= URLROOT . "/public/img/listing/" . $images[3] ?>" onclick="gallery(this)">
                        </div>
                    </div>

                    <div class="contact">
                        <h2>Contact Info.</h2>
                        <p><span>Contact No: </span>0777896812</p>
                        <p><span>Address: </span><?php echo $data['viewone']->address; ?></p>

                        <div class="map">
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d270201.1012553059!2d80.57066973934896!3d7.435740318327426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1668671876514!5m2!1sen!2slk" 
                            width="400" height="250" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe> -->
                            <iframe width="400" height="250" src="https://maps.google.com/maps?q=<?php echo $data['viewone']->address; ?>&output=embed"></iframe>
                        </div>
                    </div>

                </div>

                <div class="right_side">

                    <h1 class="topic"><?php echo $data['viewone']->topic; ?>
                        <span>
                            <a href=<?php echo URLROOT . "/facility_provider/editItem/" . $data['viewone']->listing_id ?>>
                            </a>
                        </span>
                    </h1>

                    <h8>Added: <h7 id="date"><?php echo $data['viewone']->added_date; ?></h7>
                    </h8>

                    <p class="description"><?php echo $data['viewone']->description; ?><br>
                        <span><?php echo $data['viewone']->special_note; ?></span><br>
                        <span> <?php foreach ($data['universities'] as $university) :
                                    echo $university->distance ?> km from <?php echo $university->uni_name; ?> <br>

                            <?php endforeach; ?></span>
                    </p>
                    <p class="rating"><i class="fa-solid fa-star fa-xs"></i> <?php echo $data['viewone']->rating ?></p>
                    <p class="price"><span>Price(Rs.): </span><?php echo $data['viewone']->rental; ?></p>

                    <div class="review">
                        <p>Reviews</p>
                        <?php
                        if ($data["studentDetails"]->profile_img != NULL) {
                            $image = $data["studentDetails"]->profile_img;
                        } else {
                            $image = "avatar.jpg";
                        }
                        ?>

                        <div class="rating">
                            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1" checked><label for="1">☆</label>
                            <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" id="myImage">
                        </div>
                        <div class="comment">
                            <textarea name="" id="review-content" cols="55" rows="5">Write your review here...</textarea>
                            <button type="submit" class="btn" id=<?php echo $data["viewone"]->listing_id ?>>Add review</button>
                        </div>

                        <div class="feedback" id="search-results">
                            <?php foreach ($data['comments'] as $comment) :
                                if ($comment->profile_img != NULL) {
                                    $image = $comment->profile_img;
                                } else {
                                    $image = "avatar.jpg";
                                }
                            ?>
                                <div class="other_comment">
                                    <div class="feedback_details">
                                        <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" id="image3">
                                        <h6><?php echo $comment->username ?></h6>
                                    </div>
                                    <div class="feedback_rating">

                                        <p><?php for ($i = 1; $i < 6; $i++) { ?>
                                                <?php
                                                if ($i <= $comment->star_rating) { ?>
                                                    <i class="fa-solid fa-star fa-xs"></i>
                                                <?php } else { ?>
                                                    <i class="fa-regular fa-star fa-xs"></i>
                                                <?php } ?>
                                            <?php
                                            } ?>
                                            <span class="posted-date">Posted on: <?php echo $comment->date_added ?> </span>
                                        </p>
                                    </div>
                                    <div class="feedback_comment">
                                        <p><?php echo $comment->feedback ?></p>
                                    </div>

                                    <div class="helpful">
                                        <p><?php echo $comment->helpful_count?> people found this review helpful</p>
                                        <div class="radio-group">
                                            <p> did you find this review helpful?
                                                <input type="radio" name="helpful" value="yes" id=<?php echo $comment->review_id ?>><label for="yes">Yes</label>
                                                <input type="radio" name="helpful" value="no" id=<?php echo $comment->review_id ?>><label for="no">No</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>

                    </div>
                </div>



            </div>

        </div>
        <script>
            function gallery(smallImg) {
                var fullImg = document.getElementById("preview");
                fullImg.src = smallImg.src;
            }

            /* var day = document.lastModified;
            document.getElementById("date").innerHTML = day; */

            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");

            btn.onclick = function() {
                sidebar.classList.toggle("active");
            }
        </script>

</body>

</html>