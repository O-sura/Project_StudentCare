<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudenCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/complaint-log.css"?> >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src=<?php echo URLROOT . "/public/js/complaint-log.js"?> defer></script>
</head>
<body>
    <!-- <div class="section" id="sidebar">1</div> -->
    <?php include 'sidebar.php'?>

    <div class="section" id="page-content">
        <div class="section-header">
            <h1>Complaint Log</h1>
            <button type="submit" value="" class="mark-all" id="mark-all-1">Mark All as Read</button>
        </div>

        <div class="complaint-box-1">
           
        </div>
        
        <div class="section-header">
            <h1>Other Notifications</h1>
            <button type="submit" value="" class="mark-all" id="mark-all-2">Mark All as Read</button>
        </div>
        <div class="complaint-box-2">
            
        </div>
    </div>
</body>
</html>