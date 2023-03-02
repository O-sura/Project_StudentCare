<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post - StudentCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/community-postAdd-style.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/dropdown.css"?> >
    <script src= <?php echo URLROOT . "/public/js/community-newpost.js"?> defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- This includes the sidebar and the opening tag to home-content -->
       <?php include 'sidebar.php'?>
    
    <!-- Below here should be the content for homepage -->
        <div class="post-form">
                <div class="back-option">
                    <span class="back-arrow"><i class="fa-sharp fa-solid fa-arrow-left" id="back" onclick="goToPrevious()"></i></span>
                    <h5 onclick="goToPrevious()">Go Back</h5>
                </div>
                <form action="./new_post" method="post" enctype="multipart/form-data">
                    <input type="text" name="post-title" id="post-title" placeholder="Write a Topic....">
                    <div class="container"> 
                        <img id="output" class="preview"/>
                        <div class="file-upload">
                                <label for="post-image" class="image-upload">
                                    <i class="fa-sharp fa-solid fa-photo-film" id="media-icon"></i><p id="thumbnail-text">Add Thumbnail to Post</p>
                                </label>
                                <input type="file" name="post-image" id="post-image" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                    <textarea name="post-body" id="post-body" rows="10" placeholder="Tell Your Story..."></textarea>
                    <div class="button-section">
                        <input type="text" name="category" id="category" hidden>
                        <div class="dropdown-menu">
                            <div class="select-btn">
                                <span class="Sbtn-text">All Posts</span>
                                <i class="fa-sharp fa-solid fa-chevron-down"></i>
                            </div>
                            <ul class="options">
                                <li class="option">Education</li> 
                                <li class="option">Advice</li> 
                                <li class="option">Health</li>
                                <li class="option">Other</li>
                            </ul>
                        </div>
                        
                        <button type="submit" class="submit-button" name="submit"><i class="fa-solid fa-circle-plus"></i><p>Post</p></button>
                    </div>
                </form>
        </div>
 
</body>
</html>
