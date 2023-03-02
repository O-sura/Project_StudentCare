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
    <script src=<?php echo URLROOT . "/public/js/facility_provider/View.js"?> defer></script>
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

                <form class="box" method="POST" action="propertyView">
                    <button type="submit" name="search"><i class="fa-solid fa-search" aria-hidden="true"></i></button>
                    <input type="text" placeholder="Search Here" name="searchbtn" class="searchbtn">
                </form>

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

                <!-- <div class="dropdown-menu">
                    <div class="select-btn">
                        <span class="Sbtn-text">Location</span>
                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    </div>
                    <input type="text" name="topic" class="location-dropdown" hidden>
                    <ul class="options">
                        <li class="option">Anuradhapura</li> 
                        <li class="option">Colombo</li> 
                        <li class="option">Kandy</li>
                    </ul>
                </div> -->
        
               <!--  <div class="dropdown-menu">
                    <div class="select-btn">
                        <span class="Sbtn-text">Type</span>
                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    </div>
                    <input type="text" name="topic" class="type-dropdown" hidden>
                    <ul class="options">
                        <li class="option">House</li> 
                        <li class="option">Room</li> 
                    </ul>
                </div>

                <div class="dropdown-menu">
                    <div class="select-btn">
                        <span class="Sbtn-text">University</span>
                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    </div>
                    <input type="text" name="uniName" class="university-dropdown" hidden>
                    <ul class="options">
                        <li class="option">University of Colombo</li> 
                        <li class="option">University of Peradeniya</li> 
                        <li class="option">NIBM</li>
                    </ul>
                </div> -->
            </div>

            <main>
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
                        <p class="uni">Near to <?php 
                            $uniName = json_decode($view->uniName);
                            foreach($uniName as $name) {
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
    
</body>
</html>