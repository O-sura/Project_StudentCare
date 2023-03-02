<?php

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- This includes the sidebar and the opening tag to home-content -->
    <?php include 'sidebar.php'?>
    
    <!-- Below here should be the content for homepage -->

    <h1>Welcome, <?php echo $data['username'] ?></h1>

    <!-- Above here should be the content for homepage -->
    <script src= <?php echo URLROOT . "/public/js/community.js"?>></script>
</body>
</html>