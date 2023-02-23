
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/announcement.css"?>">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/flash.css"?>">
  <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
  

  <title></title>
</head>

<body>
    <?php FlashMessage::flash('post_add_flash')?>
    <?php 
      require_once '../app/views/counselor/sidebar.php';
    ?>
    <div class="home_content">  
            <div class="div4">
                <div class="topSection">
                    <input class="search" type="search" placeholder="search">
                    <select class="selector" id="ann-filter" onchange="filterAnnouncements()"> 
                        <option value="all">All announcements</option> 
                        <option value="my">My announcements</option>
                    </select>
                </div>
                <div class="bottomSection">
                    <div class="div5">
                        <?php foreach ($data['posts'] as $post ): ?>
                            <div class="annDescription">
                                    <?php if($post->username === $_SESSION['username']) : ?>
                                        
                                        <div class="own">
                                            <div class="descriptionOwn">
                                                <?= $post->{'post_desc'}; ?><br><br><br>
                                                <span class="pdate"><?= $post->{'posted_date'} ;?> </span> <span class="puser">     Posted By :  <?= $post->{'fullname'} ;?></span>

                                                <div class="buttonU"> 
                                                    <button class="btnEdit" name="btnEdit" type="submit"><a href="./CounselorAnnouncement/edit/<?php echo $post->post_id;?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
                                                        
                                                    <button class="btnDlt" name="btnDlt" type="submit" ><a href="./CounselorAnnouncement/delete/<?php echo $post->post_id;?>"><i class="fa-solid fa-trash"></i></a></button>
                                                </div>
                                                
                                            </div>
                                            <div class="dpOwn">

                                                <img class="dpImgOwn" src="<?php echo URLROOT."/public/img/img6.jpg"?>" alt=""><br>
                                                
                                            </div>
                                        </div>

                                    <?php else: ?>

                                        <div class="other">
                                            <div class="dp">
                                                <img class="dpImg" src="<?php echo URLROOT."/public/img/img2.jpg"?>" alt=""><br>
                                            </div>

                                            <div class="description">
                                                <?= $post->{'post_desc'}; ?><br><br><br>
                                                <span class="pdate"><?= $post->{'posted_date'} ;?> </span> <span class="puser">     Posted By :  <?= $post->{'fullname'} ;?></span>
                                                
                                            </div>
                                        </div>
                                    <?php endif;?>
                            </div>
                        <?php endforeach ?> 
                    </div>
                    <? if ($condition): ?>
 
                    <div class="div6">
                        <form action="<?php echo (!empty($data['action_url'])) ? $data['action_url'] : './add'; ?>" method="post">
                            <h3>Create a post</h3>
                            <input type="text" name="id" value="<?php if(isset($data['id'])) echo $data['id'];?>" hidden>
                            <textarea name="body" id="" placeholder="Description" rows = "15" cols = "5" class="postDesc <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo  $data['body']; ?></textarea>
                            <button class="postBtn" name="submit">Post announcement</button>
                        </form>
                    </div>
                </div>
            </div>
        
    </div>
</body>

</html> 