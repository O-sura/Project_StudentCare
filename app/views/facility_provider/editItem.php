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
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/edit.css"?>>
    <script src=<?php echo URLROOT . "/public/js/facility_provider/edit.js"?> defer ></script>
    <title>Edit Item</title>

</head>
<body>
    
    <div class="page">

        <!-- load the sidebar -->
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
    
        <div class="container">
            <a id="back-link">
                <i class="fa-sharp fa-solid fa-left-long"><span>  Go Back</span></i>
            </a>

            <form action=<?php echo URLROOT . "/facility_provider/editItem/" .$data['id']; ?> method="POST" enctype="multipart/form-data">
                <h1>Tell Us More About Your Listing</h1>
                
                <div class="sub">
                    <div class="sub1">
                        
                        
                        <?php
                            $topic = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $topic = $data['viewone']->topic;
                            }else if($data['topic_err']){
                                echo '<div class="form-field" data-error=" ' . $data['topic_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <p>Topic:</p>
                        <input class="topic" name="topic" type="text" value="<?php echo $topic; ?>">
                        

                        
                        <?php
                            $description = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $description = $data['viewone']->description;
                            } else if($data['description_err']){
                                echo '<div class="form-field" data-error=" ' . $data['description_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <p>Description:</p>
                        <input class="description" name="description" type="text" value="<?php echo $description; ?>">
                        

                        
                        <?php
                            $rental = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $rental = $data['viewone']->rental;
                            } else if($data['rental_err']){
                                echo '<div class="form-field" data-error=" ' . $data['rental_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <p>Price(Rs.):</p>
                        <input class="price" name="rental" type="text" value="<?php echo $rental; ?>">
                        
                    
                        
                        <?php
                            $location = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $location = $data['viewone']->location;
                            } else if($data['location_err']){
                                echo '<div class="form-field" data-error=" ' . $data['location_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <p>Nearest Town:</p>
                        <input class="town" name="location" type="text" value="<?php echo $location; ?>">
                       
                        
 
                        <div class="unisub">                       
                            <p>Universities/Institutions Nearby:</p>
                            <?php if (isset($data['unilist']) && (is_array($data['unilist']) || is_object($data['unilist']))) : ?>
                                <?php foreach($data['unilist'] as $uni) : ?>
                                    <div class="university-adder">
                                        <div class = "university-field">
                                            <select name="uniName[]" class="select" id="universityFilter_0">
                                                <?php
                                                    foreach($data['universities'] as $university) :
                                                        if($university == $uni->uni_name) {
                                                ?>
                                                            <option value="<?php echo $university ?>" selected><?php echo $university ?></option>
                                                <?php
                                                        } else {
                                                ?>
                                                            <option value="<?php echo $university ?>"><?php echo $university ?></option>
                                                <?php
                                                        }
                                                    endforeach; 
                                                ?>
                                            </select>
                                            <input class="uniName" name="uniDistance[]" id="uniName_0" value=<?php echo $uni->distance ?> type="number" min="1" max="10"><p>Km</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <button type="button" class="addAnother" onclick="addAnother()">Add</button>
                            <button type="button" class="addAnother" onclick="remove()">Remove</button>
                        </div>
                    </div>        

                    <div class="sub2">
                        
                        <?php
                            $address = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $address = $data['viewone']->address;
                            } else if($data['address_err']){
                                echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <p>Address:</p>
                        <input class="address" name="address" type="text" value="<?php echo $address; ?>">
                        

                        
                        <?php
                            $special_note = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $special_note = $data['viewone']->special_note;
                            } else if($data['special_note_err']){
                                echo '<div class="form-field" data-error=" ' . $data['special_note_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <p>Special Notes:</p>
                        <input class="note" name="special_note" type="text" value="<?php echo $special_note; ?>">
                        
                        
                    
                        <p>Images:</p>
                        
                        <label for="img"><i class="fa fa-plus"></i><br>Insert only four images</label>
                        <input type="file" class="image" name="images[]" id="img" multiple>   <!-- allow to select and upload multiple files -->
                        <div id="preview-container">
                            <?php
                                $images = [];       //define the array of images
                                if(isset($data['viewone']) && $data['viewone']->image) {    //check if the images are set 
                                    $images = json_decode($data['viewone']->image);     //then decode the image and save them in the images array
                                }
                            ?>
                            <br>
                            <div class="thumbnails">
                                <img name="img1" src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>">
                                <img name="img2" src="<?= URLROOT . "/public/img/listing/" . $images[1] ?>">
                                <img name="img3" src="<?= URLROOT . "/public/img/listing/" . $images[2] ?>">
                                <img name="img4" src="<?= URLROOT . "/public/img/listing/" . $images[3] ?>">
                            </div>
                        </div>
                        <?php if(isset($data['imagelist'])) : ?>        <!-- check if the $data['imagelist'] is set -->
                            <?php foreach($data['imagelist'] as $key => $img) : ?>
                                <input class="image" name="images[]" id="img_<?php echo $key ?>" type="file" value=<?php echo $img ?>>
                                <!-- a unique ID generated by concatenating "img_" with the current $key value. 
                                The value attribute of the input element is set to the current $img value from the loop. -->
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        

                        <?php
                            $category = '';
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $category = $data['viewone']->category;
                            } else if($data['category_err']){
                                echo '<div class="form-field" data-error=" ' . $data['category_err'] . '">';
                            }else{
                                echo '<div class="form-field">';
                            }
                        ?>
                        <div class="catsub">
                            <div class="sub22">
                                <p>Category:</p>
                                <div class="dropdown-menu">
                                    <div class="select-btn">
                                        <span class="Sbtn-text"><?php echo $data['viewone']->category; ?></span>
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </div>
                                    <?php if (isset($data['viewone']) && $data['viewone'] !== null) : ?>
                                        <input type="text" name="category" class="category-dropdown" value="<?php echo $data['viewone']->category; ?>" hidden>
                                    <?php endif; ?>
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
                
                <input type="text" name="id" value=<?php echo $data['id']?> hidden>
                <button type="submit" class="submitbtn" name="submit">Save</button>
                
            </form>  
        </div>
    </div>
    
</body>
</html>