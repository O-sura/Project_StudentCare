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
    <script type="module" src=<?php echo URLROOT . "/public/js/student/loadCounselor-list.js" ?> defer></script>
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/counselorListStyle.css" ?>>
</head>

<body>
    <?php
    require_once '../app/views/counselor_stu/sidebar.php';
    ?>
    <div class="home_content">
        <div class="container">
            <div class="row1">
                <h1>Counselors</h1>
            </div>
            <div class="row2">
                <div class="col1">
                    <div class="topic1">
                        <h3><a href="<?php echo URLROOT ?>/appointments/">Appointments</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col2">
                    <div class="topic1">
                        <h3><a href="<?php echo URLROOT ?>/appointments/list">Counselors</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col3">
                    <div class="topic1">
                        <h3><a href="<?php echo URLROOT ?>/appointments/requests">Requests</a></h3>
                    </div>
                    <div class="slider">
                        <hr>
                    </div>
                </div>
                <div class="col4">
                    <div class="topic1">
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
                        <div class="search-container">

                            <input type="text" placeholder="Search..." id="search-box">
                            <button id="search-btn">Search</button>

                        </div>
                    </div>
                    <div class="sort">
                        <div>
                            <h3>Filter by : </h3>
                        </div>
                        <div>
                            <select class="select" id="typeFilter">
                                <option value="All">All</option>
                                <option value="Academic Support">Academic Counselors</option>
                                <option value="Career Guidence">Career Guidence</option>
                                <option value="Mental Health">Mental Health Counselors</option>
                                <option value="Financial Aid">Financial Aid Counselors</option>
                                <option value="Relationship">Relationship Counselors</option>
                                <option value="Disability Services">Disability Services Counselors</option>
                                <option value="Residential Life">Residential Life Counselors</option>
                            </select>
                        </div>

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