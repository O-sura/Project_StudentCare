<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/view-one.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/delete.css"?> >
    <script src=<?php echo URLROOT . "/public/js/facility_provider/viewOne.js"?> defer></script>
    <script src=<?php echo URLROOT . "/public/js/facility_provider/delete.js"?> defer></script>
    <title>View One Property</title>
</head>
<body>
    <section>
    <div class="page">

        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <a id="back-link">
                <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
            </a>
            
            <div class="left_side">
                <div id="image_container" align="center">
                    <br>
                    <?php
                        $images = json_decode($data['viewone']->image); //convert json string into php data structure
                        //JSON string stored in array $data['viewone']->image and store the resulting PHP data structure in the variable $images

                    ?>
                    <div class="preview" align="center">
                        <img id="preview" src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>">       <!-- load the first image -->
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
                    <p><span>Contact No: </span><?php echo $data['facilityProviderDetails']->contact_no; ?></p>
                    <p><span>Address: </span><?php echo $data['viewone']->address; ?></p>
                    
                    <!-- google map link -->
                    <div class="map">
                        <iframe width="400" height="250" src="https://maps.google.com/maps?q=<?php echo $data['viewone']->address ; ?>&output=embed"></iframe>
                    </div>
                </div>

            </div>

            <div class="right_side">
                
                <h1 class="topic"><?php echo $data['viewone']->topic; ?>
                    <span>
                        <?php
                            if($data['facilityProviderDetails']->userID == $_SESSION['userID']){
                                echo '<a href="' . URLROOT . '/facility_provider/editItem/' . $data['viewone']->listing_id . '"><i class="fa fa-pen"></i></a>';
                                echo '<i class="fa-solid fa-trash" id="deleteBtn"></i>';
                            }
                        ?>
                        
                    </span>
                </h1>

                <h8>Added: <h7 id="date"><?php echo $data['viewone']->added_date; ?></h7></h8>

                <p class="description"><?php echo $data['viewone']->description; ?><br>
                    <span><?php echo $data['viewone']->special_note; ?></span><br>
                    <span><?php foreach ($data['universities'] as $university) :        //load the details of universities
                                echo $university->distance ?> km from <?php echo $university->uni_name; ?> <br>
                            <?php endforeach; ?></span>
                </p>
                
                <p class="price"><span>Price(Rs.): </span><?php echo $data['viewone']->rental; ?></p>
                    

                <!-- load the ratings and comments -->
                <div class="review">
                    <p>Reviews</p>

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
                                    <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" id="image3">    <!-- display the student image -->
                                    <h6><?php echo $comment->username ?></h6>           <!-- display the username -->
                                </div>
                                <div class="feedback_rating">                           <!-- display the star ratings -->
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
                                    <p><?php echo $comment->feedback ?></p>             <!-- display the comments -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
    <span class="overlay"></span>
    <div class="modal-box-1">
            <center><h2 class="modal-title-text">Are your sure you want to delete this listing?</h2></center>
            <div class="modal-button-section">
                <button class="<?php echo $data['viewone']->listing_id?> modal-box-button" id="delete-button">Delete</button>
                <button class="modal-box-button" id="cancel-button">Cancel</button>
            </div>
    </div>
    </section>
</body>
</html>