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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/counselorListStyle.css" ?>>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name"></div>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href='<?php echo URLROOT ?>/student/home'>
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/community/home'>
                    <i class="fa-solid fa-users"></i>
                    <span class="links_name">Community</span>
                </a>
                <span class="tooltip">Community</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/tasks/'>
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="links_name">Schedule</span>
                </a>
                <span class="tooltip">Schedule</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/appointments/'>
                    <i class="fa-solid fa-calendar-check"></i></i>
                    <span class="links_name">Appointments</span>
                </a>
                <span class="tooltip">Appointments</span>
            </li>
            <li>
                <a href='<?php echo URLROOT ?>/announcements/'>
                    <i class="fa-solid fa-bullhorn"></i></i>
                    <span class="links_name">Announcements</span>
                </a>
                <span class="tooltip">Announcements</span>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/Student_facility/">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span class="links_name">Listings</span>
                </a>
                <span class="tooltip">Listings</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80">
                    <div class="name">
                        Oshada
                    </div>
                </div>
                <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="container">
            <div class="row1">
                <h1>Counselors</h1>
            </div>
            <div class="row2">
                <div class="col1">
                    <div class="topic">
                        <h3><a href="<?php echo URLROOT ?>/appointments/">Appointments</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col2">
                    <div class="topic">
                        <h3><a href="<?php echo URLROOT ?>/appointments/list">Counselors</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col3">
                    <div class="topic">
                        <h3><a href="<?php echo URLROOT ?>/appointments/requests">Requests</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col4">
                    <div class="topic">
                        <h3>dff</h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row3">
                <div class="search">
                    <div class="search-bar">
                        <input type="text" id="search-input" placeholder="Search topic">
                        <button type="button" id="search-button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="sort">
                        <select class="select">

                            <option value="All">All</option>
                            <option value="Academic">Academic Counselors</option>
                            <option value="Career">Career Counselors</option>
                            <option value="Mental Health">Mental Health Counselors</option>
                            <option value="Financial Aid">Financial Aid Counselors</option>
                            <option value="Relationship">Relationship Counselors</option>
                            <option value="Disability Services">Disability Services Counselors</option>
                            <option value="Residential Life">Residential Life Counselors</option>
                        </select>
                    </div>
                </div>
                <div class="list" id="list">
                    <?php
                    if (count($data['counselors']) == 0) {
                        echo "<h1>No Counselors Found</h1>";
                    } else {
                        foreach ($data['counselors'] as $counselor) : ?>
                            <?php
                            $counselorId = $counselor->userID;
                            $counselorName = $counselor->fullname;
                            $counselorDescription = $counselor->counselor_description;
                            $format_description = nl2br($counselorDescription);
                            $counselorSpecialization = $counselor->specialization;
                            if ($counselor->profile_img != NULL) {
                                $image = $counselor->profile_img;
                            } else {
                                $image = "avatar.jpg";
                            }
                            ?>

                            <div class="list-item">
                                <div class="prof-image">
                                    <img src="<?php echo URLROOT . "/public/img/counselor/" . $image; ?>" id="image3">
                                </div>
                                <div class="details">
                                    <div class="name">
                                        Dr. <?php echo $counselorName; ?>
                                    </div>
                                    <div class="specialization">
                                        <?php echo $counselorSpecialization; ?>
                                    </div>
                                    <div class="info">
                                        <?php echo $format_description; ?>
                                    </div>
                                    <div class="buttons">
                                        <button class="btn2" onclick="window.location.href='<?php echo URLROOT ?>/appointments/profile/<?php echo $counselorId; ?>'">View Profile</button>
                                    </div>
                                </div>
                            </div>


                    <?php endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>


    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        var profile = document.querySelector('.btn1');
        profile.addEventListener('click', function() {
            window.location.href = '<?php echo URLROOT ?>/appointments/profile';
        });
        // Get the search input and search button
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        // Get the list element
        const list = document.getElementById('list');

        // Function to filter the list items based on the search input
        function filterList() {
            // Get the search query
            const query = searchInput.value.toLowerCase();

            // Get all the list items
            const listItems = list.querySelectorAll('.list-item');

            // Loop through the list items and hide those that don't match the search query
            listItems.forEach(item => {
                const name = item.querySelector('.name').textContent.toLowerCase();
                const specialization = item.querySelector('.specialization').textContent.toLowerCase();
                const info = item.querySelector('.info').textContent.toLowerCase();

                if (query === '') {
                    // Show all items if the search query is empty
                    item.style.display = 'grid';
                } else if (name.includes(query) || specialization.includes(query) || info.includes(query)) {
                    // Show the item if it matches the search query
                    item.style.display = 'grid';
                } else {
                    // Hide the item if it doesn't match the search query
                    item.style.display = 'none';
                }
            });
        }

        // Add an event listener to the search button
        searchButton.addEventListener('click', filterList);

        // Add an event listener to the search input to filter the list as the user types
        searchInput.addEventListener('input', filterList);
    </script>
</body>

</html>