<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/admin/counselor-admin-verify.css"?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php include 'sidebar.php'?>

    <div class="section" id="page-content">
        <div class="container">
            <div class="top-section">
                <div class="profile-info">
                    <span class="profile">Profile</span>
                    <div class="small-div"><img src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="profile-image"></div>
                </div>
            </div>
            <div class="back-option">
                <span class="back-arrow"><i class="fa-sharp fa-solid fa-arrow-left" id="back" onclick="goToPrevious()"></i></span>
                <h5 onclick="goToPrevious()">Go Back</h5>
            </div>
            <div class="mid-section">
                <div class="image-container">
                    <img src="https://cdn-icons-png.flaticon.com/512/3774/3774299.png" alt="" class="profile-image">
                </div>
                <div class="personal-info">
                    <h1>Personal Information</h2>
                    <p class="info"><b>Name:</b> <?php echo $data->fullname?></p>
                    <p class="info"><b>Age:</b> <?php echo (new DateTime())->diff(new DateTime($data->dob))->y;?></p>
                    <p class="info"><b>NIC:</b> <?php echo $data->nic?></p>
                    <p class="info"><b>DOB:</b> <?php echo $data->dob?></p>
                </div>
            </div>
            <div class="bottom-section">
                <div class="contact-info">
                    <h1>Contact Info</h2>
                    <p class="info"><b>Address:</b> <?php echo $data->home_address;?></p>
                    <p class="info"><b>Email:</b> <?php echo $data->email;?></p>
                    <p class="info"><b>Contact Number:</b>(+94) <?php echo $data->contact_no; ?></p>
                    
                </div>
                <div class="personal-info">
                    <h1>Qualifications</h2>
                    <?php foreach($data->qualifications as $q): ?>
                        <p class="info"><?php echo $q;?></p>
                    <?php endforeach?>
                    <a id="download-button" href="<?php echo URLROOT . "/admin/download_verification/" . $data->verification_doc;?>" class="download-link" download>Download Verification Document</a>
                </div>
            </div>
            <div class="button-section">
                <a href=<?php  echo URLROOT . "/admin/counselor_verify/?id=" . $data->counsellorID ."&approval=1"?>><input type="submit" value="Accept Request" id="view-button"></a>
                <a href=<?php  echo URLROOT . "/admin/counselor_verify/?id=" . $data->counsellorID ."&approval=0"?>><input type="submit" value="Decline Request" id="view-button"></a>
            </div>
        </div>
    </div>

    <script>
          var goToPrevious = () => {
                javascript:history.go(-1)
            }

            const downloadLink = document.querySelector('.download-button');
            
            downloadLink.addEventListener('click', (event) => {
                event.preventDefault();
                window.location.href = downloadLink.href;
            });
    </script>

</body>
</html>