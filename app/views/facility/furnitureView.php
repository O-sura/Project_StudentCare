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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/furnitureView.css" ?>>
    <script src=<?php echo URLROOT . "/public/js/View.js" ?> defer></script>
    <title>Food View listings</title>
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
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80">
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

                <div class="head">
                    <h1>Furniture</h1>

                    <form class="box" method="POST" action="propertyView">
                        <button type="submit" name="search"><i class="fa-solid fa-search" aria-hidden="true"></i></button>
                        <input type="text" placeholder="Search Here" name="searchbtn" class="searchbtn">
                    </form>

                </div>
                <div class="sliders">
                    <div class="food"><a href="<?php echo URLROOT ?>/Student_facility/food">Food</a></div>
                    <div class="property"><a href="<?php echo URLROOT ?>/Student_facility/">Property</a></div>
                    <div class="furniture"><a href="<?php echo URLROOT ?>/Student_facility/furniture">Furniture</a></div>
                </div>
                <hr>

                <div class="wrapper">

                    <div class="select-btn">
                        <select class="select" name="filterItem" id="filterItem">
                            <option value="" selected="selected">Location</option>
                            <option value="Ampara">Ampara</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kalutara">Kalutara</option>
                        </select>
                    </div>

                    <div class="select-btn">
                        <select class="select">
                            <option>Type</option>
                            <option value="type">Table</option>
                            <option value="type">Chair</option>
                            <option value="type">Cupboard</option>
                        </select>
                    </div>

                    <div class="select-btn">
                        <select class="select">
                            <option>Price</option>
                            <option>Low to High</option>
                            <option>High to Low</option>
                        </select>
                    </div>

                </div>

                <main>
                    <?php foreach ($data['listings'] as $view) : ?>

                        <div class="item">
                            <div class="image">
                                <?php
                                $images = json_decode($view->image);
                                ?>
                                <a href="<?php echo URLROOT; ?>/student_facility/viewOneListing/<?php echo $view->listing_id; ?>"><img src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>"></a>

                            </div>

                            <div class="data">
                                <p class="topic"><?php echo $view->topic; ?></p>
                                <p class="uni">Near to <?php
                                                        $uniName = json_decode($view->uniName);
                                                        foreach ($uniName as $name) {
                                                            echo $name;
                                                            echo '<br>';
                                                        }
                                                        ?></p>
                                <p class="price"><span>Rs. </span><?php echo $view->rental; ?>/Month</p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </main>
            </div>
        </div>

    </div>

</body>

</html>