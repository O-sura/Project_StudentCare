<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/announcementStyle.css" ?>>
    <script type="module" src=<?php echo URLROOT . "/public/js/student/loadAnnouncements.js" ?> defer></script>
</head>

<body>
    <?php
    require_once '../app/views/announcements/sidebar.php';
    ?>
    
    <div class="home_content">
        <div class="container">
            <div class="row1">
                <h1>Announcements</h1>

                <div class="event1">
                    <div>
                        <h3>Sort by : </h3>
                    </div>
                    <div>
                        <select class="select" id="sorter">
                            <option value="latest" selected>Latest</option>
                            <option value="earliest">Earliest</option>

                        </select>
                    </div>


                </div>
                <div class="event2">
                    <div>
                        <h3>Filter by : </h3>
                    </div>
                    <div>
                        <select class="select" id="filter">
                            <option value="all" selected>All</option>
                            <option value="starred">Starred</option>
                        </select>
                    </div>
                </div>
                <div class="add">
                    <div class="search-container">

                        <input type="text" placeholder="Search..." id="search-box">
                        <button id="search-btn">Search</button>

                    </div>
                </div>

            </div>
            <div class="row2">
                <div class="topic2">
                    <h3>Topic</h3>
                </div>
                <div class="postedBy">
                    <h3>Posted by</h3>
                </div>
                <div class="postedOn">
                    <h3>Posted on</h3>
                </div>
            </div>
            <hr>
            <div class="announcements" id="list">
                <?php
                foreach ($data['announcements'] as $rows) :
                ?>
                    <?php
                    $id = $rows->post_id;
                    $counselorID = $rows->userID;
                    $subject = $rows->post_head;
                    $name = $rows->fullname;
                    $timestamp = strtotime($rows->posted_date);
                    $date = date('Y-m-d', $timestamp);
                    $saved = 'regular';
                    if ($rows->profile_img != NULL) {
                        $image = $rows->profile_img;
                    } else {
                        $image = "avatar.jpg";
                    }

                    ?>
                    <div class="row3">


                        <div class="topic" data-id="<?php echo $id; ?>">
                            <?php foreach ($data['savedAnnouncements'] as $announcement) : ?>
                                <?php if ($announcement->announcement_id == $id) {
                                    $saved = 'solid';
                                    break;
                                } ?>
                            <?php endforeach; ?>
                            <span class="star"><i class="fa-<?php echo $saved ?> fa-star" id='<?php echo $id ?>'></i></span>

                            <a href="<?php echo URLROOT; ?>/announcements/show/<?php echo $id; ?>"><?php echo $subject; ?></a>

                        </div>


                        <div class="details">
                            <div class="image">
                                <img src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" alt="">
                            </div>
                            <div class="name">
                                <a href="<?php echo URLROOT; ?>/appointments/profile/<?php echo $counselorID; ?>"><?php echo $name; ?></a>
                            </div>
                        </div>

                        <div class="postedOn">
                            <?php echo $date; ?>
                        </div>
                    </div>
                    <hr>
                <?php
                endforeach;
                ?>
            </div>

        </div>
    </div>


    <script>
        // Get the list of clicked posts from the cookie
        var clickedPosts = (function() {
            var cookie = document.cookie.match(/(^|;)\s*clickedPosts\s*=\s*([^;]+)/);
            return cookie ? JSON.parse(decodeURIComponent(cookie[2])) : [];
        })();

        // Iterate through the posts
        var posts = document.querySelectorAll(".topic");
        for (var i = 0; i < posts.length; i++) {
            (function(post) {
                var postId = post.getAttribute("data-id");

                // Check if the post has already been clicked
                if (clickedPosts.indexOf(postId) !== -1) {
                    // Fade out the post
                    post.style.opacity = 0.5;
                }

                // Attach a click event to the post
                post.addEventListener("click", function() {
                    // Add the post to the list of clicked posts
                    clickedPosts.push(postId);
                    document.cookie = "clickedPosts=" + encodeURIComponent(JSON.stringify(clickedPosts)) + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";

                    // Fade out the post
                    post.style.opacity = 0.5;
                });
            })(posts[i]);
        }
    </script>
</body>

</html>