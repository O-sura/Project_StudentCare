<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare - Community</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?> >
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/community/single-post.css"?> >
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    <script src= <?php echo URLROOT . "/public/js/single-post.js"?> defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section>
    <?php include 'sidebar.php'?>
    <?php 
        FlashMessage::flash('comment_added');
        FlashMessage::flash('comment_not_added');
        FlashMessage::flash('post_updated');
    ?>
    <div class="section" id="top">
        <div class="back-option">
            <span class="back-arrow"><i class="fa-sharp fa-solid fa-arrow-left" id="back" onclick="goToPrevious()"></i></span>
            <h5 onclick="goToPrevious()">Go Back</h5>
        </div>
    </div>
    <div class="section" id="post-content">
        <div class="title-and-buttons">
            <h3 class="title"><?= $data['post']->{'post_title'} ?></h3>
            <?php if(($data['post']->author === Session::get('username')) || Session::get('userrole') == "admin") : ?>
                <?php echo '<div class="buttons">
                    <a href='. URLROOT. "/community/update_post/" . $data['post']->{'post_id'} .' ><i class="fa-solid fa-pen-to-square" id="update-btn"></i></a>
                    <i class="fa-solid fa-trash" id="delete-btn"></i>
                </div>'?>
            <?php endif;?>
            <!-- <a href='. URLROOT. "/community/delete_post/" . $data['post']->{'post_id'} .' ><i class="fa-solid fa-trash" id="delete-btn"></i></a> -->
        </div>
        <h5 class="metadata"><?= 'Posted by ' . $data['post']->{'author'} . ' at ' . explode(" ", $data['post']->{'posted_at'})[0]?></h5>
        <div class="post">
            <img src="<?php echo URLROOT . "/public/img/community/" . $data['post']->{'post_thumbnail'} ?>" alt="" id="post-img">
            <p><?= $data['post']->{'post_desc'} ?></p>
        </div>
        <div class="analytics">
            <div class="option">
                <i class="fa-solid fa-comment"></i>
                <span><?= count($data['comments']) ?> Comments</span>
            </div>
            <div class="option" hidden>
                <i class="fa-solid fa-flag"></i>
                <span>Report</span>
            </div>
            <div class="option">
                <i class="fa-solid fa-up-long"></i>
                <span><?= $data['post']->{'votes'} ?></span>
                <i class="fa-solid fa-down-long"></i>
            </div>
        </div>
    </div>
    <div class="section" id="add-comment">
        <form action=<?php echo URLROOT. "/community/new_comment"?> method="POST">
            <span>Add your comment as <?= $data['loggedInUser'] ?></span>
            <input type="text" name="author" value=<?= $data['loggedInUser'] ?> hidden >
            <input type="text" name="post_id" value=<?= $data['post']->{'post_id'} ?> hidden >
            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Type Here..."></textarea>
            <button type="submit" name="comment-submit" id="comment-submit">Comment</button>
        </form>
    </div>
    <div class="section" id="comments">
        
        <?php foreach ($data['comments'] as $comment): ?>
        <div class="user-comments">
           <div class="info">
                <img src="<?php echo URLROOT . "/public/img/anon.jpg"  ?>" alt="" id="avatar">
                <p id="author"><?= $comment->{'author'} . " "?></p>
                <p id="date">Posted at: <?= explode(" ", $comment->{'added_date'})[0] ?></p>
           </div>
           <p class="comment-txt">
                <?= $comment->{'body'} ?>
           </p>
        </div>
        <?php endforeach ?>
        
    </div>
    <span class="overlay"></span>

    <div class="modal-box-1">
        <center><h3 class="modal-title-text">Are your sure you want to delete this?</h3></center>
        <p class="modal-text">Remember, this will remove all the current data related to this which cannot be undone later</p>
        <div class="modal-button-section">
            <button class="modal-box-button" id="delete-button">Delete</button>
            <button class="modal-box-button" id="cancel-button">Cancel</button>
        </div>
    </div>
</section>
</body>
</html>