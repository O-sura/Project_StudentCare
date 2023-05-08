<?php

use function PHPSTORM_META\type;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare - Community</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/community.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/dropdown.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/modal.css"?> >
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src= <?php echo URLROOT . "/public/js/community.js"?> defer></script>
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
</head>
<body>
    <!-- This includes the sidebar and the opening tag to home-content -->
    <?php include 'sidebar.php'?>
    <?php 
        // Has to link the css-not added because some issue
        FlashMessage::flash('post_reported');
        FlashMessage::flash('post_not_reported');
        FlashMessage::flash('post_deleted');
        FlashMessage::flash('post_not_deleted');
    ?>
    
    <!-- Below here should be the content for homepage -->
    <section>
    <div class="content-section">
            <div class="upper-row">
                <input type="search" name="search" id="searchbar" placeholder="Search Here">
                <div class="post-category">
                    <div class="dropdown-menu">
                        <div class="select-btn">
                            <span class="Sbtn-text">All Posts</span>
                            <i class="fa-sharp fa-solid fa-chevron-down"></i>
                        </div>
                        <ul class="options">
                            <li class="option">All Posts</li> 
                            <li class="option">Your Posts</li> 
                            <li class="option">Saved</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="secondary-row">
            <div class="filters">
                <div class="best-filter">
                    <i class="fa-solid fa-rocket best-btn" id="best"></i>
                    <h5 class="button-text best-btn">Best</h5>
                </div>
                <div class="latest-filter">
                    <i class="fa-solid fa-clock latest-btn" class="latest"></i>
                    <h5 class="button-text latest-btn">Latest</h5>
                </div>
            </div>
            <a href=<?php echo URLROOT . "/community/new_post"?>><button type="submit" class="addNew-button"><i class="fa-solid fa-circle-plus"></i><p>Add New</p></button></a>
            </div>
            <hr/>

            <div id="search-results"></div>
            <?php foreach ($data['posts'] as $post): ?>
            <div class="parent">
                    <div class="icon-text-button">
                        <button class="icon-btn" id="up"><i class="fa-solid fa-up-long"></i></button>
                        <p id="<?= "vote-count-" . $post->post_id ?>"><?= $post->votes ?></p>
                        <p id="post-id" hidden><?= $post->post_id ?></p>
                        <button class="icon-btn" id="down"><i class="fa-solid fa-down-long"></i></button>
                    </div>
                    <div class="div1">
                        <img src="<?php echo URLROOT . "/public/img/community/" . $post->{'post_thumbnail'} ?>"  alt="thumbnail" class="thumbnail">
                    </div>
                    <div class="div2">
                        <div class="top">
                            <h1><?= $post->{'post_title'} ?></h1>
                        </div>
                        <div class="meta-data">
                            <h4>By: <?= $post->{'author'} ?></h4>
                            <h4><?= explode(" ", $post->{'posted_at'})[0] ?></h4>
                            <h4>Category: <?= $post->{'category'} ?></h4>
                        </div>
                        <div class="content">
                            <?= $post->{'post_desc'} ?>
                        </div>
                        <div class="options">
                            <a href=<?php echo URLROOT . "/community/view_post/" . $post->post_id ?>><input type="button" value="Read More" class="button"></a>
                            <div class="bottom">
                                <div class="option" id="save-button">
                                    <i class="fa-regular fa-bookmark"></i>
                                    <span>Save</span>
                                </div>
                                <div class="option" id="report-button">
                                    <i class="fa-solid fa-flag"></i>
                                    <span>Report</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <?php endforeach ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                    <?php if ($i == $data['current_page']): ?>
                        <span class="active"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="<?php echo URLROOT. "/community/home/?page=" .  $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
    <!-- Above here should be the content for homepage -->
    </div>
    <span class="overlay"></span>

    <div class="modal-box-3">
            <center><h3 class="modal-title-text">Reason for Reporting?</h3></center>
            <form method="POST" class="report-form">
                <label for="reason">Tell Us Why:</label><br>
                <input type="text" name="userID" value=<?php echo Session::get('userID')?> hidden>
                <textarea name="reason" id="reason" cols="20" rows="5" maxlength="255"></textarea>
                <input type="submit" value="Continue" class="continue-button" name="report">
            </form>
    </div>  
    </section>                         
</body>
</html>