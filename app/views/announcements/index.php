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
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name"></div>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href='<?php echo URLROOT ?>/student/home'>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/community/home'>
                    <i class="fa-solid fa-users"></i>
                    <span class="links_name">Community</span>
                </a>
                <span class="tooltip">Community</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/tasks/'>
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="links_name">Schedule</span>
                </a>
                <span class="tooltip">Schedule</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/appointments/'>
                    <i class="fa-solid fa-calendar-check"></i></i>
                    <span class="links_name">Appointments</span>
                </a>
                <span class="tooltip">Appointments</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/announcements/'>
                    <i class="fa-solid fa-bullhorn"></i></i>
                    <span class="links_name">Announcements</span>
                </a>
                <span class="tooltip">Announcements</span>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/Student_facility/">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span class="links_name">Listings</span>
                </a>
                <span class="tooltip">Listings</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                    <div class="name">
                        Oshada
                    </div>
                </div>
                <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="container">
            <div class="row1">
                <h1>Announcements</h1>

                <div class="event1">

                    <select class="select">
                        <option value="none" selected disabled hidden>Sort by</option>
                        <option value="Exam">title</option>
                        <option value="Club">earliest</option>

                    </select>

                </div>
                <div class="event2">

                    <select class="select">
                        <option value="none" selected disabled hidden>filter by</option>
                        <option value="Exam">couselor</option>

                    </select>

                </div>
                <div class="add">
                    <button class="btn">Mark all as read</a></button>
                </div>

            </div>
            <div class="row2">
                <div class="topic">
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
            <?php
            foreach ($data['announcements'] as $rows) :
            ?>
                <?php
                $id = $rows->post_id;
                $subject = $rows->post_head;
                $name = $rows->fullname;
                $timestamp = strtotime($rows->posted_date);
                $date = date('Y-m-d', $timestamp);
                ?>
                <div class="row3">


                    <div class="topic" data-id="<?php echo $id; ?>">
                        <i class="icons" data-feather="star"></i>

                        <a href="<?php echo URLROOT; ?>/announcements/show/<?php echo $id; ?>"><?php echo $subject; ?></a>

                    </div>


                    <div class="details">
                        <div class="image">
                            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                        </div>
                        <div class="name">
                            <?php echo $name; ?>
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


    <script>
        feather.replace();
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

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