<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudenCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/counsellor-request.css"?> >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- <div class="section" id="sidebar">1</div> -->
    <?php include 'sidebar.php'?>

    <div class="section" id="page-content">
        <h1>New Requests (<?php echo count($data)?>)</h1>
        <hr>
        <?php if(count($data) == 0):?>
            <center><span class="empty-txt">You're All Set</span></center>
        <?php endif?>
        <div class="request-container">
                <?php foreach ($data as $request): ?>
                    <div class="container">
                        <div class="image-container">
                            <img src="https://cdn-icons-png.flaticon.com/512/3774/3774299.png" alt="" class="profile-image">
                        </div>
                        <div class="details">
                            <p class="name-txt"><?php echo $request->fullname?></p>
                            <p class="specilization"><?php echo "Specialized in " . $request->specialization ?></p>
                            <a href=<?php echo URLROOT . "/admin/view_counselor_profile/" . $request->counsellorID ?>><input type="submit" value="View Full Profile" id="view-button"></a>
                        </div>
                    </div>
                <?php endforeach ?>
        </div>
    </div>

</body>
</html>