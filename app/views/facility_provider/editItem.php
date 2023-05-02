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
    <script src=<?php echo URLROOT . "/public/js/facility_provider/edit.js"?> defer ></script>
    <title>Edit Item</title>

</head>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>
    
        <div class="container">
            <form action=<?php echo URLROOT . "/facility_provider/editItem/" .$data['id']; ?> method="POST" enctype="multipart/form-data">
                <h1>Tell Us More About Your Listing</h1>
                
                <div class="sub">
                    <div class="sub1">
                        <?php
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                // Access the topic property of $data['viewone'] only if it exists and is not null
                                $topic = $data['viewone']->topic;
                            } else {
                                // Handle the case where $data['viewone'] is undefined or null
                                $topic = '';
                            }
                        ?>
                        <p>Topic:</p>
                        <input class="topic" name="topic" type="text" value="<?php echo $topic; ?>">


                        <?php
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $description = $data['viewone']->description;
                            } else {
                                $description = '';
                            }
                        ?>
                        <p>Description:</p>
                        <input class="description" name="description" type="text" value="<?php echo $description; ?>">


                        <?php
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $rental = $data['viewone']->rental;
                            } else {
                                $rental = '';
                            }
                        ?>
                        <p>Price(Rs.):</p>
                        <input class="price" name="rental" type="text" value="<?php echo $rental; ?>">
                    

                        <?php
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $location = $data['viewone']->location;
                            } else {
                                $location = '';
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
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $address = $data['viewone']->address;
                            } else {
                                $address = '';
                            }
                        ?>
                        <p>Address:</p>
                        <input class="address" name="address" type="text" value="<?php echo $address; ?>">


                        <?php
                            if (isset($data['viewone']) && $data['viewone'] !== null) {
                                $special_note = $data['viewone']->special_note;
                            } else {
                                $special_note = '';
                            }
                        ?>
                        <p>Special Notes:</p>
                        <input class="note" name="special_note" type="text" value="<?php echo $special_note; ?>">
                    
                
                        <p>Images:</p>
                        <label for="img"><i class="fa fa-plus"></i><br>Insert only four images</label>
                        <input type="file" class="image" name="images[]" id="img" multiple>
                        <div id="preview-container">
                            <?php
                                $images = [];
                                if(isset($data['viewone']) && $data['viewone']->image) {
                                    $images = json_decode($data['viewone']->image);
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
                        <?php if(isset($data['imagelist'])) : ?>
                            <?php foreach($data['imagelist'] as $key => $img) : ?>
                                <input class="image" name="images[]" id="img_<?php echo $key ?>" type="file" value=IMG-6450989aa9f842.87772264.jpg>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        

                        <div class="catsub">
                            <div class="sub22">
                                <p>Category:</p>
                                <div class="dropdown-menu">
                                    <div class="select-btn">
                                        <span class="Sbtn-text"><?php echo $data['viewone']->category; ?></span>
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </div>
                                    <input type="text" name="category" class="category-dropdown" value="<?php echo $data['viewone']->category; ?>" hidden>
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
                <button type="submit" class="submitbtn" name="submit">Add Listing</button>
            </form>  
        </div>

    </div>
    
</body>
</html>