<?php
echo '<h1>TEST PAGE</h1>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?> >
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    <title>Document</title>
</head>
<body>
    <?php  print_r($data['myview'])  ?>
</body>
</html>

 
