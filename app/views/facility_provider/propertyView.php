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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/view.css"?> >
    <script type="javaScript" src=<?php echo URLROOT . "/public/js/facility_provider/View.js"?> defer></script>
    <title>Property View listings</title>
</head>

<body>
    <div class="page">

        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <button type="button" class="add"><a href="addItem">+ Add New</a></button>

            <div class="head">
                <h1>Property</h1>

                <!-- <form class="box" method="GET" action="propertyView">
                    <button type="submit" name="search"><i class="fa-solid fa-search" aria-hidden="true"></i></button>
                    <input type="search" placeholder="Search Here" name="searchbtn" id="searchbar" class="searchbtn">
                    <div id="search-results"></div>
                </form> -->
                <input class="search" type="search" id="searchbar" name="search" placeholder="search">
            </div>

            <hr>

            <div class="wrapper">

                <div class="select-btn">
                    <select class="filter" name="filterItem" id="filterItem">
                        <option value="" selected="selected">Location</option>
                        <option value="ampara">Ampara</option>
                        <option value="anuradhapura">Anuradhapura</option>
                        <option value="badulla">Badulla</option>
                        <option value="batticaloa">Batticaloa</option>
                        <option value="colombo">Colombo</option>
                        <option value="galle">Galle</option>
                        <option value="gampaha">Gampaha</option>
                        <option value="hambantota">Hambantota</option>
                        <option value="jaffna">Jaffna</option>
                        <option value="kalutara">Kalutara</option>
                    </select>
                </div>
                <!-- <div class="select-btn">
                    <i class="fa-solid fa-location-dot fa-lg"></i>
                    <select class="select" id="universityFilter">
                        <option value="<?php echo $data['studentUni']->university ?>" selected><?php echo $data['studentUni']->university ?></option>
                        <option value="University of Colombo">University of Colombo</option>
                        <option value="University of Kelaniya">University of Kelaniya</option>
                        <option value="University of Peradeniya">University of Peradeniya</option>
                        <option value="University of Moratuwa">University of Moratuwa</option>
                        <option value="University of Moratuwa">SLIIT</option>
                    </select>
                </div> -->

                <div class="select-btn">
                    <select class="filter" name="filterItem" id="filterItem">
                        <option value="" selected="selected">Type</option>
                        <option value="house">House</option>
                        <option value="room">Room</option>
                    </select>
                </div>

                <div class="select-btn">
                    <select class="filter" name="filterItem" id="filterItem">
                        <option value="" selected="selected">University</option>
                        <option value="house">Colombo</option>
                        <option value="room">Peradeniya</option>
                    </select>
                </div>


            </div>

            <main>
                <div id="search-results"></div>
                <?php foreach($data['view'] as $view) : ?>

                    <div class="item">
                        <div class="image">
                            <?php
                            $images = json_decode($view->image);
                            ?>
                            <a href=<?php echo "viewOneListing/" . $view->listing_id; ?>><img src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>"></a>

                        </div>

                        <div class="data">
                            <p class="topic"><?php echo $view->topic; ?></p>
                            <p class="uni">
                                <?php foreach ($data['universities'] as $university) : ?>
                                    <?php if ($university->listing_id == $view->listing_id) : ?>
                                        <?php echo $university->distance ?> km from <?php echo $university->uni_name; ?> <br>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </p>
                            <p class="price"><span>Rs. </span><?php echo $view->rental; ?>/Month</p>
                        </div>
                    </div>

                <?php endforeach; ?>

            </main>
        </div>
    </div>

</body>

</html>