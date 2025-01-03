<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/error404.css"?>>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?> >
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    <title>StudentCare</title>
</head>
<body>
    <?php FlashMessage::flash('verification-failed')?>
    <img src="<?php echo URLROOT . "/public/img/404-error.png"?>" alt="">
    <div class="text-container">
        <p id="line-1">Oops!</p>
        <p id="line-2">Looks like something went wrong!</p>
    </div>
</body>
</html>