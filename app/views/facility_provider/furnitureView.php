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
    <script src=<?php echo URLROOT . "/public/js/facility_provider/View.js"?> defer></script>
    <title>View listings</title>
</head>
<body>
    <div class="page">

        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <button type="button" class="add"><a href="addItem">+ Add New</a></button>

            <div class="head">
                <h1>Furniture</h1>

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
                        <option value="type">Cupboard</option>
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