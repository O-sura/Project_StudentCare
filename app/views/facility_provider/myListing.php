<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/my-listing.css"?> >
    <script src= <?php echo URLROOT . "/public/js/facility_provider/View.js"?> defer></script>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?>>
    <script src=<?php echo URLROOT . "/public/js/flash.js"?> defer ></script>
    <title>My Listings</title>
    
</head>
<body>
    <?php FlashMessage::flash('edit_flash') ;?>
    <?php FlashMessage::flash('delete_item_flash') ;?>
    
    <div class="page">
        
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
        
        <div class="container">
            <div class="yourprofile">
                <a href=<?php echo URLROOT. "/facility_provider/profile"?>>     <!-- link to the profile page -->
                    <p>Profile</p>
                    <i class="fa fa-user"></i>
                </a>
            </div>

            <div class="count">
                <label>Total Listings</label>
                <p><?php echo (count($data['myview']) < 10)? "0" . count($data['myview']) : count($data['myview'])?></p>
                <!-- count the elements inside the $data['myview'] array. If the count is less than 0 concat with the count, else print the count-->
            </div>
            
            <div class="head">
                <h1>All Listings</h1>
                <button type="button" class="add"><a href="addItem">+ Add New</a></button>      <!-- link to the form page -->
            </div>

            <hr>    <!-- draw a horizontal line -->

            <main>
                <?php foreach($data['myview'] as $myview) : ?>      <!-- start foreach loop for all the elements in $data['myview'] array as $myview -->

                    <div class="item">
                        <div class="image">
                            <?php
                                $images = json_decode($myview->image);  //convert json string into php data structure
                                //JSON string stored in $myview->image and store the resulting PHP data structure in the variable $images

                            ?>

                            <a href=<?php echo "viewOneListing/" . $myview->listing_id; ?>><img src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>"></a>
                            <!-- view the relevent data for one listing from the listing_id -->     <!-- load the first image from the relevent file -->

                        </div>

                        <div class="data">
                            <p class="topic"><?php echo $myview->topic; ?></p>
                            <p class="uni">
                            <?php foreach ($data['universities'] as $university) : ?>
                                <?php if ($university->listing_id == $myview->listing_id) : ?>      <!-- take the relevent universities by comparing the listing ids -->
                                    <?php echo $university->distance ?> km from <?php echo $university->uni_name; ?> <br>       <!-- print relevent distances and university names -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </p>
                            <p class="price"><span>Rs. </span><?php echo $myview->rental; ?>/Month</p>
                        </div>
                    </div>
    
                <?php endforeach; ?>

            </main>
        </div>
    </div>
    
</body>
</html>