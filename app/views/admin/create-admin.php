<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/admin_edit.css"?> >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include 'sidebar.php'?>
    <div class="section" id="page-content">
        <h1>New Admin Profile</h1>
        <hr>
        <div class="row-section">
            
            <img src="<?php echo URLROOT . "/public/img/avatar.jpg" ?>" class="profile-pic">
        </div>
        <form method="post" action=<?php echo URLROOT . "/admin/create_admin"?>>
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
                if($data['email_err'])
                    echo '<div class="form-field" data-error=" ' . $data['email_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Email:</label>
                <input type="text" id="field1" name="email" value="<?php echo $data["email"] ?>">
            </div>
            <?php 
                if($data['password_err'])
                    echo '<div class="form-field" data-error=" ' . $data['password_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Password:</label>
                <input type="password" id="field1" name="password" value="<?php echo $data["password"] ?>">
            </div>
            <?php 
                if($data['repassword_err'])
                    echo '<div class="form-field" data-error=" ' . $data['repassword_err'] . '">';
                else
                    echo '<div class="form-field">';
            ?>
                <label for="field1">Retype-Password:</label>
                <input type="password" id="field1" name="repassword" value="<?php echo $data["repassword"] ?>">
            </div>
            <br><div></div>
            <input type="submit" value="Create" class="save-btn">
        </form>
    </div>

    <script>
        document.querySelectorAll('input').forEach(e => {
            e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
        })
    </script>
</body>
</html>