<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudenCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/complaint-log.css"?> >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- <div class="section" id="sidebar">1</div> -->
    <?php include 'sidebar.php'?>

    <div class="section" id="page-content">
        <div class="section-header">
            <h1>Complaint Log</h1>
            <button type="submit" value="" id="mark-all">Mark All as Read</button>
        </div>
        <div class="complaint">
            <h4 class="date">10-February</h4>
            <div class="complaint-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="complaint-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="complaint">
            <h4 class="date">09-February</h4>
            <div class="complaint-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="complaint-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="complaint-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
    </div>
</body>
</html>