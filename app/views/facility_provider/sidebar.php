<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/sidebar.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/sidebar.css"?> >
    <script src=<?php echo URLROOT . "/public/js/facility_provider/sidebar.js"?> defer></script>
    <title>Document</title>
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
                <a href=<?php echo URLROOT. "/facility_provider/myListing"?>>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">My Listings</span>
                </a>
                <span class="tooltip">My Listings</span>
            </li>
            <li>
                <a href=<?php echo URLROOT. "/facility_provider/propertyView"?>>
                    <i class="fa-solid fa-house-chimney"></i>
                    <span class="links_name">Property</span>
                </a>
                <span class="tooltip">Property</span>
            </li>
            <li>
                <a href=<?php echo URLROOT. "/facility_provider/foodView"?>>
                    <i class="fa-solid fa-utensils"></i>
                    <span class="links_name">Food</span>
                </a>
                <span class="tooltip">Food</span>
            </li>
            <li>
                <a href=<?php echo URLROOT. "/facility_provider/furnitureView"?>>
                    <i class="fa-solid fa-chair"></i>
                    <span class="links_name">Furniture</span>
                </a>
                <span class="tooltip">Furniture</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=388&q=80" alt="">
                    <div class="name">
                        <?php echo $_SESSION['username']?>
                    </div>
                </div>
                <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i></a>
            </div>
        </div>
    </div>
</body>
</html>