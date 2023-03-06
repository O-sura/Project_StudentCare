
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/announcement.css"?>">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/dropdownAnn.css"?>">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css"?>">
  <script type="module" src= <?php echo URLROOT . "/public/js/Counselor/filterAnn.js"?> defer></script>
  <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" defer></script>


  <title></title>
</head>

<body>
    <?php FlashMessage::flash('post_add_flash') ;?>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">  
            <div class="div4">
                <div class="topSection">
                    <input class="search" type="search" id="searchbar" name="search" placeholder="search">
                    <div class="dropdown-menu">
                            <div class="select-btn">
                                <span class="Sbtn-text">All Announcements</span>
                                <i class="fa-sharp fa-solid fa-chevron-down"></i>
                            </div>
                            <ul class="options">
                                <li class="option">All Announcements</li> 
                                <li class="option">Your Announcements</li> 
                               
                            </ul>
                    </div>
                    <!-- <input class="search" type="search" placeholder="search">
                    <select class="selector" id="annFilter" name="annFilter" onchange="filter()"> 
                        <option value="all">All announcements</option> 
                        <option value="my">My announcements</option>
                    </select> -->
                </div>
                <div class="bottomSection">
                    <div class="div5">
                        <div id="search-results"></div>
                        <?php foreach ($data['posts'] as $post ): ?>
                            <div class="annDescription">
                                    <?php if($post->userID === $_SESSION['userID']) : ?>
                                        
                                        <div class="own">
                                            <div class="descriptionOwn">
                                                <h4 class="postH"><?= $post->{'post_head'}; ?></h4>
                                                <?= $post->{'post_desc'}; ?><br><br>
                                                <span class="pdate"><?= $post->{'posted_date'} ;?> </span> <span class="puser">     Posted By :  <?= $post->{'fullname'} ;?></span>

                                                <div class="buttonU"> 
                                                    <button class="btnEdit" name="btnEdit" type="submit"><a href="<?php echo URLROOT."/CounselorAnnouncement/edit/". $post->post_id;?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
                                                        
                                                    <button class="btnDlt" name="btnDlt" type="submit" ><a href="<?php echo URLROOT."/CounselorAnnouncement/delete/". $post->post_id;?>"><i class="fa-solid fa-trash"></i></a></button>
                                                </div>
                                                
                                            </div>
                                            <div class="dpOwn">

                                                <img class="dpImgOwn" src="<?php echo URLROOT."/public/img/counselor/".$post->{'profile_img'};?>" alt=""><br>
                                                
                                            </div>
                                        </div>

                                    <?php else: ?>

                                        <div class="other">
                                            <div class="dp">
                                                <img class="dpImg" src="<?php echo URLROOT."/public/img/counselor/".$post->{'profile_img'};?>" alt=""><br>
                                            </div>

                                            <div class="description">
                                                <h4 class="postH"><?= $post->{'post_head'}; ?></h4>
                                                <?= $post->{'post_desc'}; ?><br><br>
                                                <span class="pdate"><?= $post->{'posted_date'} ;?> </span> <span class="puser">     Posted By :  <?= $post->{'fullname'} ;?></span>
                                                
                                            </div>
                                        </div>
                                    <?php endif;?>
                            </div>
                        <?php endforeach ?> 
                    </div>
                    <? if ($condition): ?>
 
                    <div class="div6">
                        <form action="<?php echo (!empty($data['action_url'])) ? $data['action_url'] : URLROOT.'/CounselorAnnouncement/add'; ?>" method="post">
                            <h3>Create an Announcement</h3>
                            <?php 
                                if($data['topic_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['topic_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <input type="text" name="topic"  class="postHead" placeholder="Head" value="<?php echo  $data['topic']; ?>"><br>
                            </div>
                            <input type="text" name="id" value="<?php if(isset($data['id'])) echo $data['id'];?>" hidden>

                            <?php 
                                if($data['body_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['body_err'] . '">';
                                else
                                    echo '<div class="form-field">';
                            ?>
                            <textarea name="body" id="" placeholder="Description" rows = "15" cols = "5" class="postDesc <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo  $data['body']; ?></textarea><br>
                        	</div>
                            <button class="postBtn" name="submit">Post announcement</button>
                        </form>
                    </div>
                </div>
            </div>
        
    </div>
</body>

</html> 