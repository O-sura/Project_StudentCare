<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/profileStyle.css" ?>>
</head>

<body>
    <?php
    require_once '../app/views/student_dashboard/sidebar.php';
    ?>

    <div class="home_content">
        <div class="container">


            <div class="row1">
                <h1>Edit Profile</h1>
                <hr>
            </div>

            <form class="" action="<?php echo URLROOT; ?>/student/profile " method="post" enctype="multipart/form-data">
                <div class="row2">

                    <div class="col-1">
                        <?php
                        if ($data["userDetails"]->profile_img != NULL) {
                            $image = $data["userDetails"]->profile_img;
                        } else {
                            $image = "avatar.jpg";
                        }
                        ?>
                        <div class="prof-image">
                            <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" id="image2">
                            <div class="username">
                                <?php echo $data["userDetails"]->username ?>
                            </div>
                            <div class="btn2">
                                <label for="inputTag" style="cursor:pointer;">
                                    <h3> <i class="fa-solid fa-image-portrait fa-fade"></i> Change profile pic</h3>
                                    <input id="inputTag" type="file" name="file" style="display:none;" accept="image/*" onchange="loadFile(event)" />
                                </label>
                            </div>
                            <div class="change_password">
                                <button class="btn2">
                                    <h3><i class="fa-solid fa-key"></i> Change password</h3>
                                </button>
                            </div>
                            <div class="feedback">
                                <button class="btn2">
                                    <h3><i class="fa-regular fa-comment-dots"></i> Give feedback</h3>
                                </button>
                            </div>

                        </div>


                    </div>

                    <div class="col2">
                        <div class="details-form">
                            <div class="labels">

                                <div class="label1">
                                    <label for="name">Name:</label>
                                </div>

                                <div class="label2">
                                    <label for="uname">Username:</label>
                                </div>

                                <div class="label3">
                                    <label for="address">Address:</label>
                                </div>

                                <div class="label4">
                                    <label for="phone">Phone No:</label>
                                </div>
                                <div class="label5">
                                    <label for="nic">NIC:</label>
                                </div>
                                <div class="label6">
                                    <label for="uni">University:</label>
                                </div>
                                <div class="label7">
                                    <label for="dob">DOB:</label>
                                </div>
                                <div class="label7">
                                    <label for="email">E-mail:</label>
                                </div>
                            </div>
                            <div class="inputs">
                                <?php
                                if ($data['name_err'])
                                    echo '<div class="form-field" data-error=" ' . $data['name_err'] . '">';
                                else
                                    echo '<div class="input1">';
                                ?>
                                <input type="text" name="name" id="name" value="<?php echo $data["userDetails"]->fullname ?>">
                            </div>
                            <?php
                            if ($data['username_err'])
                                echo '<div class="form-field" data-error=" ' . $data['username_err'] . '">';
                            else
                                echo '<div class="input2">';
                            ?>
                            <input type="text" name="uname" id="uname" value="<?php echo $data["userDetails"]->username ?>">
                        </div>
                        <?php
                        if ($data['address_err'])
                            echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                        else
                            echo '<div class="input3">';
                        ?>
                        <textarea name="address" id="address" rows="5" cols="60"><?php echo $data["userDetails"]->home_address ?></textarea>
                    </div>
                    <?php
                    if ($data['contact_err'])
                        echo '<div class="form-field" data-error=" ' . $data['contact_err'] . '">';
                    else
                        echo '<div class="input4">';
                    ?>
                    <input type="text" name="phone" id="phone" value="<?php echo $data["userDetails"]->contact_no ?>">
                </div>

                <div class="input5">
                    <input type="text" name="nic" id="nic" value="<?php echo $data["userDetails"]->nic ?>" disabled>
                </div>

                <div class="input6">
                    <input type="text" name="uni" id="uni" value="<?php echo $data["userDetails"]->university ?>" disabled>
                </div>

                <div class="input7">
                    <input type="text" name="dob" id="dob" value="<?php echo $data["userDetails"]->dob ?>" disabled>
                </div>

                <div class="input8">
                    <input type="text" name="email" id="email" value="<?php echo $data["userDetails"]->email ?>" disabled>
                </div>
        </div>

    </div>

    <div class="submit-changes">
        <button class="btn" type="submit">Submit Changes</button>
    </div>
    </div>
    </div>
    </form>
    </div>
    </div>
    <!-- </form> -->

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        //To load the profile image as soon as it changed
        var loadFile = (e) => {
            var output = document.getElementById('image2');

            output.src = URL.createObjectURL(e.target.files[0]);

            output.onload = () => {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
</body>

</html>