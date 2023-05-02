<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/admin/user-management.css"?>>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src= <?php echo URLROOT . "/public/js/user-management.js"?> defer></script>
</head>
<body>
    <section>
        <!-- <div class="section" id="sidebar">1</div> -->
        <?php include 'sidebar.php'?>

        <div class="section" id="page-content"><br><br>
            <span class="heading">All Users  <i class="fa-solid fa-users"></i></span>
            <div class="div-3">
                <input type="search" name="search" id="searchbar" placeholder="Search Here">
                <table class="stat-table">
                        <tr>
                            <th>#UserID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            <!-- Ommit showing th logged in users profile among the profile list -->
                            <?php foreach ($data as $user): ?>
                                <?php if($user->userID != Session::get('userID')){
                                    echo ' 
                                    <tr>
                                        <td>'. $user->userID .'</td>
                                        <td>'. $user->username .'</td>
                                        <td>'. $user->user_role .'</td>';
                                if($user->isBlocked == 0){
                                        echo '
                                            <td class="btn-row">
                                                <input type="submit" class="'.$user->userID . ' block-unblock-btn"  id="block-btn" value="block">
                                                <input type="submit" class="'.$user->userID . ' delete-btn" value="delete">
                                                <input type="submit" class="'.$user->userID . ' profile-btn" value="view profile">
                                            </td>
                                        </tr>';
                                    }else{
                                        echo '
                                            <td class="btn-row">
                                                <input type="submit" class="'.$user->userID . ' block-unblock-btn" id="unblock-btn" value="unblock">
                                                <input type="submit" class="'.$user->userID . ' delete-btn" value="delete">
                                                <input type="submit" class="'.$user->userID . ' profile-btn" value="view profile">
                                            </td>
                                        </tr>';
                                    }
                                }?>
                            <?php endforeach ?>
                        </tbody>
                </table>
            </div>
        </div>
        
        <span class="overlay"></span>

        <div class="modal-box-1">
            <center><h3 class="modal-title-text"></h3></center>
            <p class="modal-text">Remember, this will remove all the current data related to this user which cannot be undone later</p>
            <div class="modal-button-section">
                <button class="modal-box-button" id="delete-button">Delete</button>
                <button class="modal-box-button" id="cancel-button">Cancel</button>
            </div>
        </div>
    </section>
</body>
</html>