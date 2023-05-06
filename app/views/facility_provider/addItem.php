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
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/item.css"?>>
    <script src=<?php echo URLROOT . "/public/js/facility_provider/addItem.js"?> defer ></script>
    <title>Add Listings</title>

</head>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
    
        <div class="container">
            <a id="back-link">
                <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
            </a>
            <form action="" method="POST" enctype="multipart/form-data">
                <h1>Tell Us More About Your Listing</h1>

                <div class="sub">
                    <div class="sub1">
                        <?php 
                            if($data['topic_err'])
                                echo '<div class="form-field" data-error=" ' . $data['topic_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Topic:</p>
                        <input class="topic" name="topic" type="text">
                        </div>


                        <?php 
                            if($data['description_err'])
                                echo '<div class="form-field" data-error=" ' . $data['description_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Description:</p>
                        <input class="description" name="description" type="text">
                        </div>


                        <?php 
                            if($data['rental_err'])
                                echo '<div class="form-field" data-error=" ' . $data['rental_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Price(Rs.):</p>
                        <input class="price" name="rental" type="text">
                        </div>


                        <?php 
                            if($data['location_err'])
                                echo '<div class="form-field" data-error=" ' . $data['location_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Nearest Town:</p>
                        <input class="town" name="location" type="text">
                        </div>


                        <div class="unisub">
                            <p>Universities/Institutions Nearby:</p>
                            <div class="university-adder">
                                <div class = "university-field">
                                    <select name="uniName[]" class="select" id="universityFilter_0">
                                        <option value="University of Ruhuna">University of Ruhuna</option>
                                        <option value="University of Colombo">University of Colombo</option>
                                        <option value="University of Kelaniya">University of Kelaniya</option>
                                        <option value="University of Peradeniya">University of Peradeniya</option>
                                        <option value="University of Moratuwa">University of Moratuwa</option>
                                        <option value="SLIIT">SLIIT</option>
                                    </select>
                                    <input class="uniName" name="uniDistance[]" id="uniName_0" type="number" min="1" max="10"><p>Km</p>
                                </div>
                            </div>

                            <button type="button" class="addAnother" onclick="addAnother()">+ Add</button>
                        </div>
                    </div>
                    
                    <div class="sub2">
                        <?php 
                            if($data['address_err'])
                                echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Address:</p>
                        <input class="address" id="my-input" name="address" type="text">
                        </div>


                        <?php 
                            if($data['special_note_err'])
                                echo '<div class="form-field" data-error=" ' . $data['special_note_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Special Notes:</p>
                        <input class="note" name="special_note" type="text">
                        </div>


                        <?php 
                            if($data['images_err'])
                                echo '<div class="form-field" data-error=" ' . $data['images_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <p>Images:</p>
                        <label for="img"><i class="fa fa-plus"></i><br>Insert only four images</label>
                        <input type="file" class="image" name="images[]" id="img" multiple>
                        </div>


                        <div class="catsub">
                            <div class="sub22">
                                <p>Category:</p>
                                <div class="dropdown-menu">
                                    <div class="select-btn">
                                        <span class="Sbtn-text">Property</span>
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </div>
                                    <input type="text" name="category" class="category-dropdown" hidden>
                                    <ul class="options">
                                        <li class="option">Property</li> 
                                        <li class="option">Food</li> 
                                        <li class="option">Furniture</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         
                <!-- onchange = "getImage(this.value);" -->
                <!-- <div id="display-image"></div> -->
  
                <button type="submit" class="submitbtn" name="submit">Add Listing</button>
                
            </form>  
        </div>

    </div>
    
</body>
</html>