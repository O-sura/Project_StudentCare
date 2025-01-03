<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/facility_provider/view.css" ?>>
    <title>Food View listings</title>
</head>

<body>
    <div class="page">

        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <button type="button" class="add"><a href="addItem">+ Add New</a></button>

            <div class="head">
                <h1>Food</h1>
            </div>

            <hr>

            <main>
                <?php foreach ($data['view'] as $view) : ?>

                    <div class="item">
                        <div class="image">
                            <?php
                            $images = json_decode($view->image);
                            ?>
                            <a href=<?php echo "viewOneListing/" . $view->listing_id; ?>><img src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>"></a>

                        </div>

                        <div class="data">
                            <p class="topic"><?php echo $view->topic; ?></p>
                            <p class="uni"> <?php foreach ($data['universities'] as $university) : ?>
                                    <?php if ($university->listing_id == $view->listing_id) : ?>
                                        <?php echo $university->distance ?> km from <?php echo $university->uni_name; ?> <br>
                                    <?php endif; ?>
                                <?php endforeach; ?></p>
                            <p class="price"><span>Rs. </span><?php echo $view->rental; ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>

            </main>
        </div>
    </div>

</body>

</html>