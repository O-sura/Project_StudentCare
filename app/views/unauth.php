<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/unauth.css"?>>
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/flash.css"?>>
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    <title>StudentCare</title>
</head>
<body>
    <?php FlashMessage::flash('verification-failed')?>
    <h1>ERROR: <?php echo $data['err_code']?></h1>
    <img src="<?php echo URLROOT . "/public/img/person.png"?>" alt="error-logo">
    <h3 class="unauth-txt"><?php echo $data['display_data']?></h3>
</body>
</html>