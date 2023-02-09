<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/view-one.css"?> >
    <script src=<?php echo URLROOT . "/public/js/facility_provider/viewOne.js"?> defer></script>
    <title>View One Property</title>
</head>
<body>
    <div class="page">

        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">

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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d270201.1012553059!2d80.57066973934896!3d7.435740318327426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1668671876514!5m2!1sen!2slk" 
                            width="400" height="250" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2603.467645889274!2d80.64027088542007!3d7.293955371034674!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8165d70ac115e887!2sSri%20Dalada%20Maligawa!5e0!3m2!1sen!2slk!4v1670742226263!5m2!1sen!2slk" 
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                                 
                    </div>
                </div>

            </div>

            <div class="right_side">
                
                <h1 class="topic"><?php echo $data['viewone']->topic; ?>
                    <span>
                        <a href=<?php echo URLROOT. "/facility_provider/editItem/" . $data['viewone']->listing_id?>>
                            <i class="fa fa-pen"></i>
                        </a>
                        
                        <i class="fa fa-trash"></i>
                    </span>
                </h1>

                <h8>Added: <h7 id="date"></h7></h8>

                <p class="description"><?php echo $data['viewone']->description; ?><br>
                    <span><?php echo $data['viewone']->special_note; ?></span><br>
                    <span>Near to <?php 
                            $uniName = json_decode($data['viewone']->uniName);
                            echo implode(' , ', $uniName);    
                    ?></span>
                </p>
                
                <p class="price"><span>Price(Rs.): </span><?php echo $data['viewone']->rental; ?></p>

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
                </div>
            </div>

           

        </div>
    </div>
    
</body>
</html>