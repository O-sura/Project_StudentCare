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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/foodView.css" ?>>
    <script src=<?php echo URLROOT . "/public/js/View.js" ?> defer></script>
    <script type="module" src=<?php echo URLROOT . "/public/js/student/loadFoodListings.js" ?> defer></script>
    <title>Food View listings</title>
</head>

<body>
    <div class="page">

        <?php
        require_once '../app/views/facility/sidebar.php';
        ?>
        <div class="home_content">
            <div class="container">

                <div class="head">
                    <h1>Food</h1>

                </div>
                <div class="sliders">
                    <div class="food"><a href="<?php echo URLROOT ?>/Student_facility/food">Food</a></div>
                    <div class="property"><a href="<?php echo URLROOT ?>/Student_facility/">Property</a></div>
                    <div class="furniture"><a href="<?php echo URLROOT ?>/Student_facility/furniture">Furniture</a></div>
                </div>
                <hr>

                <div class="wrapper">
                    <h3>Sort by:</h3>
                    <div class="select-btn">
                        <i class="fa-solid fa-dollar-sign fa-lg"></i>
                        <select class="select" id="priceSorter">
                            <option>Price</option>
                            <option value="asc">Low to High</option>
                            <option value="desc">High to Low</option>
                        </select>
                    </div>
                    <div class="select-btn" id="rating-filter">
                        <i class="fa-solid fa-star-half-stroke fa-lg"></i>
                        <select class="select" id="ratingSorter">
                            <option>Rating</option>
                            <option value="asc">Low to High</option>
                            <option value="desc">High to Low</option>
                        </select>
                    </div>
                    <div class="select-btn" id="date-filter">
                        <i class="fa-regular fa-calendar fa-lg"></i>
                        <select class="select" id="dateSorter">
                            <option>Date</option>
                            <option value="desc">Newest</option>
                            <option value="asc">Oldest</option>
                        </select>
                    </div>
                    <h3>Filter by:</h3>
                    <div class="select-btn">
                        <i class="fa-solid fa-location-dot fa-lg"></i>
                        <select class="select" id="universityFilter">
                            <option value="<?php echo $data['studentUni']->university ?>" selected><?php echo $data['studentUni']->university ?></option>
                            <option value="University of Colombo">University of Colombo</option>
                            <option value="University of Kelaniya">University of Kelaniya</option>
                            <option value="University of Peradeniya">University of Peradeniya</option>
                            <option value="University of Moratuwa">University of Moratuwa</option>
                            <option value="University of Moratuwa">SLIIT</option>
                        </select>
                    </div>
                    <div class="search-container">

                        <input type="text" placeholder="Search..." id="search-box">
                        <button id="search-btn">Search</button>

                    </div>

                </div>

                <main id="search-results">
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
                                <p class="uni">
                                    <?php foreach ($data['universities'] as $university) : ?>
                                        <?php if ($university->listing_id == $view->listing_id) : ?>
                                            <?php echo $university->distance ?> km from <?php echo $university->uni_name; ?> <br>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </p>
                                <p class="rating"><i class="fa-solid fa-star fa-xs"></i> <?php echo $view->rating ?></p>
                                <p class="price"><span>Rs. </span><?php echo $view->rental; ?>/Month</p>
                                <p class="location"><?php echo $view->location; ?></p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </main>
            </div>
        </div>

    </div>

</body>

</html>