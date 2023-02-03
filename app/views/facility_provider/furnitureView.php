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
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/view.css"?> >
    <script src=<?php echo URLROOT . "/public/js/facility_provider/propertyView.js"?> defer></script>
    <title>View listings</title>
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
                    <a href=<?php echo URLROOT. "/facility_provider/myListing"?>>
                        <i class="fa-solid fa-gauge"></i>
                        <span class="links_name">My Listings</span>
                    </a>
                    <span class="tooltip">My Listings</span>
                </li>
                <li>
                    <a href=<?php echo URLROOT. "/facility_provider/propertyView"?>>
                        <i class="fa-solid fa-house-chimney"></i>
                        <span class="links_name">Property</span>
                    </a>
                    <span class="tooltip">Property</span>
                </li>
                <li>
                    <a href=<?php echo URLROOT. "/facility_provider/foodView"?>>
                        <i class="fa-solid fa-utensils"></i>
                        <span class="links_name">Food</span>
                    </a>
                    <span class="tooltip">Food</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-chair"></i>
                        <span class="links_name">Furniture</span>
                    </a>
                    <span class="tooltip">Furniture</span>
                </li>
            </ul>
            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=388&q=80" alt="">
                        <div class="name">
                            Nimali
                        </div>
                    </div>
                    <i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i>
                </div>
            </div>
        </div>

        <!-- <script>
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");

            btn.onclick = function(){
                sidebar.classList.toggle("active");
            }
        </script> -->


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
                    <select class="filter">
                        <option>Type</option>
                        <option value="type">Table</option>
                        <option value="type">Chair</option>
                        <option value="type">cupboard</option>
                    </select>
                </div>

                <div class="select-btn">
                    <select class="filter">
                        <option>Price</option>
                    </select>
                </div>

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