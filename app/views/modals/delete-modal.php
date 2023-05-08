<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/modal.css"?> >
    <script type="module" src= <?php echo URLROOT . "/public/js/modal-helper.js"?> defer></script>
</head>
<body>
    <section>
        <!-- body content should be here -->
        <span class="overlay"></span>

        <div class="modal-box-1">
            <center><h3 class="modal-title-text">Are your sure you want to delete this?</h3></center>
            <p class="modal-text">Remember, this will remove all the current data related to this which cannot be undone later</p>
            <div class="modal-button-section">
                <button class="modal-box-button" id="delete-button">Delete</button>
                <button class="modal-box-button" id="cancel-button">Cancel</button>
            </div>
        </div>
    </section>
</body>
</html>


