<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/admin_edit.css"?>>
    <script src=<?php echo URLROOT . "/public/js/summary_report.js"?> defer></script>
    <title>StudentCare</title>
</head>
<body>
    <?php include 'sidebar.php'?>
    <div class="section" id="page-content">
        <div class="top-section">
            <div class="section-title">
                <h1>Customize Profile</h1>
            </div>
            <div class="get-summary <?php echo $data['userID']?>" id="get-summary" hidden>
                <i class="fa-solid fa-print"></i>
                <span class="btn-txt">Generate Summary</span>
            </div>
        </div>
        <hr>
        <div class="row-section">
            <?php
                if ($data["profile_img"] != NULL) {
                    $image = $data["profile_img"];
                } else {
                    $image = "avatar.jpg";
                }
            ?>
            <img src="<?php echo URLROOT . "/public/img/student/" . $image; ?>" class="profile-pic">
        </div>
        <form method="post" action=<?php echo URLROOT . "/admin/update_student/" . $data['userID']?>>
             <?php 
                if($data['name_err'])
                    echo '<div class="form-field" data-error=" ' . $data['name_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Name:</label>
                <input type="text" id="field1" name="name" value="<?php echo $data["name"] ?>">
            </div>
            <?php 
                if($data['username_err'])
                    echo '<div class="form-field" data-error=" ' . $data['username_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Username:</label>
                <input type="text" id="field1" name="username" value="<?php echo $data["username"] ?>">
            </div>
            <?php 
                if($data['address_err'])
                    echo '<div class="form-field" data-error=" ' . $data['address_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Address:</label>
                <input type="text" id="field1" name="address" value="<?php echo $data["address"] ?>">
            </div>
            <?php 
                if($data['contact_err'])
                    echo '<div class="form-field" data-error=" ' . $data['contact_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Contact No:</label>
                <input type="text" id="field1" name="phone" value="<?php echo $data["contact"] ?>">
            </div>
            <?php 
                if($data['nic_err'])
                    echo '<div class="form-field" data-error=" ' . $data['nic_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">NIC:</label>
                <input type="text" id="field1" name="nic" value="<?php echo $data["nic"] ?>">
            </div>
            <?php 
                if($data['university_err'])
                    echo '<div class="form-field" data-error=" ' . $data['university_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">University:</label>
                <input type="text" id="field1" name="university" value="<?php echo $data["university"] ?>">
            </div>
            <?php 
                if($data['dob_err'])
                    echo '<div class="form-field" data-error=" ' . $data['dob_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">DOB:</label>
                <input type="text" id="field1" name="dob" value="<?php echo $data["dob"] ?>">
            </div>
            <?php 
                if($data['email_err'])
                    echo '<div class="form-field" data-error=" ' . $data['email_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Email:</label>
                <input type="text" id="field1" name="email" value="<?php echo $data["email"] ?>">
            </div>
            <br><div></div>
            <input type="submit" value="Save Changes" class="save-btn">
        </form>
    </div>
</body>
</html>