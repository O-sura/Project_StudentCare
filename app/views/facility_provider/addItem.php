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
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?>>
    <script src=<?php echo URLROOT . "/public/js/flash.js"?> defer ></script>
    <title>Add Listings</title>
</head>
<body>

    <?php FlashMessage::flash('added_flash') ;?>

    <div class="page">

        <!-- sidebar load -->
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
    
        <div class="container">

            <!-- pages back link -->
            <a id="back-link">
                <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
            </a>

            <!-- form data sending as POST method and encrypt the data with files and images-->
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
                       
                    
                        <?php 
                            if($data['uniName_err'])
                                echo '<div class="form-field" data-error=" ' . $data['uniName_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
                        <div class="unisub">
                            <p>Universities/Institutions Nearby:</p>
                            <div class="university-adder">
                                <div class = "university-field">
                                    <select name="uniName[]" class="select" id="universityFilter_0">
                                        <option value="Eastern University">Eastern University</option>
                                        <option value="Rajarata University">Rajarata University</option>
                                        <option value="Sabaragamuwa University">Sabaragamuwa University</option>
                                        <option value="South Eastern University">South Eastern University</option>
                                        <option value="The Open University">The Open University</option>
                                        <option value="University of Colombo">University of Colombo</option>
                                        <option value="University of Jaffna">University of Jaffna</option>
                                        <option value="University of Kelaniya">University of Kelaniya</option>
                                        <option value="University of Moratuwa">University of Moratuwa</option>
                                        <option value="University of Peradeniya">University of Peradeniya</option>
                                        <option value="University of Ruhuna">University of Ruhuna</option>
                                        <option value="University of Sri Jayewardenepura">University of Sri Jayewardenepura</option>
                                        <option value="Uva wellassa University">Uva wellassa University</option>
                                        <option value="University of Vavuniya">University of Vavuniya</option>
                                        <option value="University of the Visual & Performing Arts">University of the Visual & Performing Arts</option>
                                        <option value="Wayamba University">Wayamba University</option>
                                        <option value="KDU">KDU</option>
                                        <option value="CINEC">CINEC</option>
                                        <option value="Esoft Metro Campus">Esoft Metro Campus</option>
                                        <option value="Horizon Campus">Horizon Campus</option>
                                        <option value="IIT">IIT</option>
                                        <option value="NIBM">NIBM</option>
                                        <option value="NSBM">NSBM</option>
                                        <option value="SLIIT">SLIIT</option>
                                        <option value="SLTC">SLTC</option>
                                    </select>

                                    <input class="uniName" name="uniDistance[]" id="uniName_0" type="number" min="1" max="10"><p>Km</p>
                                </div>
                            </div>

                            <button type="button" class="addAnother" onclick="addAnother()">+ Add</button>
                        </div>
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


                        <?php 
                            if($data['category_err'])
                                echo '<div class="form-field" data-error=" ' . $data['category_err'] . '">';
                            else
                                echo '<div class="form-field">';
                        ?>
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
                </div>
         
               <button type="submit" class="submitbtn" name="submit">Add Listing</button>
                
            </form>  
        </div>

    </div>
    
</body>
</html>