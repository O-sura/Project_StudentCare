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
    <title>My Listings</title>
    
</head>
<body>
    <div class="page">
        
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
        
        <div class="container">
            <div class="yourprofile">
                <a href=<?php echo URLROOT. "/facility_provider/profile"?>>
                    <p>Profile</p>
                    <i class="fa fa-user"></i>
                </a>
            </div>

            <div class="count">
                <label>Total Listings</label>
                <p>02</p>
            </div>
            
            <div class="head">
                <h1>All Listings</h1>
                <button type="button" class="add"><a href="addItem">+ Add New</a></button>
            </div>

            <hr>

            <main>
                <?php foreach($data['myview'] as $myview) : ?>

                <div class="item">
                    <div class="image">
                        <?php
                            $images = json_decode($myview->image); 
                        ?>
                        <a href=<?php echo "viewOneListing/" . $myview->listing_id; ?>><img src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>"></a>
                    </div>

                    <div class="data">
                        <p class="topic"><?php echo $myview->topic; ?></p>
                        <p class="uni">Near to <?php 
                            $uniName = json_decode($myview->uniName);
                            foreach($uniName as $name) {
                                echo $name;
                                echo '<br>';
                            }
                        ?></p>
                        <p class="price"><span>Rs. </span><?php echo $myview->rental; ?>/Month</p>
                    </div>
                </div>
    
                <?php endforeach; ?>

            </main>
        </div>
    </div>
    
</body>
</html>