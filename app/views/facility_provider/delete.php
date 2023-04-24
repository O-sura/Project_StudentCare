<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/delete.css"?>>
    <script src=<?php echo URLROOT . "/public/js/facility_provider/delete.js"?> defer></script>
    <script src= <?php echo URLROOT . "/public/js/flash.js"?> defer></script>
    
    <title>DeleteItem</title>
</head>
<body>
    <section>
        <button class="trigger">Click Me</button>
        <span class="overlay"></span>

        <div class="modal-box-1">
            <center><h2 class="modal-title-text">Are your sure you want to delete this listing?</h2></center>
            <div class="modal-button-section">
                <button class="modal-box-button" id="delete-button">Delete</button>
                <button class="modal-box-button" id="cancel-button">Cancel</button>
            </div>
        </div>
    </section>
    
</body>
</html>