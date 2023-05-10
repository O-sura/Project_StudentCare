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
        <h1>Admin Profile</h1>
        <hr>
        <div class="row-section">
            
            <img src="<?php echo URLROOT . "/public/img/avatar.jpg" ?>" class="profile-pic">
        </div>
        <form>
            <div class="form-field">
                <label for="field1">Name:</label>
                <input type="text" id="field1" name="name" value="<?php echo $data["name"] ?>" disabled>
            </div>
            <div class="form-field">
                <label for="field1">Username:</label>
                <input type="text" id="field1" name="username" value="<?php echo $data["username"] ?>"  disabled>
            </div>
            <div class="form-field">
                <label for="field1">Address:</label>
                <input type="text" id="field1" name="address" value="<?php echo $data["address"] ?>"  disabled>
            </div>
            <div class="form-field">
                <label for="field1">Contact No:</label>
                <input type="text" id="field1" name="phone" value="<?php echo $data["contact"] ?>"  disabled>
            </div>
            <div class="form-field">
                <label for="field1">NIC:</label>
                <input type="text" id="field1" name="nic" value="<?php echo $data["nic"] ?>"  disabled>
            </div>
           
            <div class="form-field">
                <label for="field1">Email:</label>
                <input type="text" id="field1" name="email" value="<?php echo $data["email"] ?>"  disabled>
            </div>
            
            <br><div></div>
            
        </form>
    </div>

    <script>
        document.querySelectorAll('input').forEach(e => {
            e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
        })
    </script>
</body>
</html>