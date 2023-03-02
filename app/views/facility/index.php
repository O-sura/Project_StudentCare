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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/PropertyView.css" ?>>
    <script src=<?php echo URLROOT . "/public/js/View.js" ?> defer></script>
    <title>Food View listings</title>
</head>

<body>
    <div class="page">

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
                    <a href="<?php echo URLROOT ?>/users/logout"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
                </div>
            </div>
        </div>
        <div class="home_content">
            <div class="container">

                <div class="head">
                    <h1>Property</h1>

                    <form class="box" method="POST" action="propertyView">
                        <button type="submit" name="search"><i class="fa-solid fa-search" aria-hidden="true"></i></button>
                        <input type="text" placeholder="Search Here" name="searchbtn" class="searchbtn">
                    </form>

                </div>
                <div class="sliders">
                    <div class="food"><a href="<?php echo URLROOT ?>/Student_facility/food">Food</a></div>
                    <div class="property"><a href="<?php echo URLROOT ?>/Student_facility/">Property</a></div>
                    <div class="furniture"><a href="<?php echo URLROOT ?>/Student_facility/furniture">Furniture</a></div>
                </div>
                <hr>

                <div class="wrapper">

                    <div class="select-btn">
                        <select class="select" name="filterItem" id="filterItem">
                            <option value="" selected="selected">Location</option>
                            <option value="Ampara">Ampara</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kalutara">Kalutara</option>
                        </select>
                    </div>

                    <div class="select-btn">
                        <select class="select">
                            <option>Type</option>
                            <option value="type">House</option>
                            <option value="type">Room</option>
                        </select>
                    </div>

                    <div class="select-btn">
                        <select class="select">
                            <option>Price</option>
                            <option>Low to High</option>
                            <option>High to Low</option>
                        </select>
                    </div>
                    <div class="select-btn">
                        <select class="select">
                            <option>University</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Japura">Sri Jayawardhanapura</option>
                            <option value="Peradeniya">Peradeniya</option>
                        </select>
                    </div>

                </div>

                <main>


                    <div class="item">
                        <div class="image">
                            <a href="<?php echo URLROOT ?>/Student_facility/viewProperty">
                                <img src="https://i.ikman-st.com/kaamr-phsukm-aet-for-rent-colombo-1/069352fb-3d4b-4088-b7b3-74ec7b0e6479/620/466/fitted.jpg" alt="">
                            </a>
                        </div>

                        <div class="data">
                            <p class="topic">Annex for Rent</p>
                            <p class="uni"> Near to UCSC </p>
                            <p class="price">Rs.<span> 8000</span>/Month</p>
                            <p class="rating">User Rating<span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">

                            <img src="https://ceylonproperty.lk/imagesPosts/8411640922949uB1EQKHuk9zVX9p.jpeg" alt="">

                        </div>

                        <div class="data">
                            <p class="topic">House for rent</p>
                            <p class="uni">Near to UCSC </p>
                            <p class="price">Rs.<span> 2000</span>/Month</p>
                            <p class="rating">User Rating<span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">

                            <img src="https://images.olx.com.pk/thumbnails/328947427-240x180.jpeg" alt="">

                        </div>

                        <div class="data">
                            <p class="topic">Room for students</p>
                            <p class="uni"> Near to UOC </p>
                            <p class="price">Rs.<span> 15000</span>/Month</p>
                            <p class="rating">User Rating<span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">

                            <img src="https://siyaluma.lk/storage/products/1569657975_2.jpeg" alt="">

                        </div>

                        <div class="data">
                            <p class="topic">Room for 3 girls</p>
                            <p class="uni"> Near to UCSC </p>
                            <p class="price">Rs.<span> 8000</span>/Month</p>
                            <p class="rating">User Rating<span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">

                            <img src="https://www.ceylonproperty.lk/imagesPosts/441597669552W7cPPtkGEIeChZJ.jpg" alt="">

                        </div>

                        <div class="data">
                            <p class="topic">Annex for rent</p>
                            <p class="uni"> Near to UCSC </p>
                            <p class="price">Rs.<span> 10000</span>/Month</p>
                            <p class="rating">User Rating<span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">

                            <img src="https://www.lankaholidays.com/pics/23483/LG%20phone%20%202014%20May%20595.jpg" alt="">

                        </div>

                        <div class="data">
                            <p class="topic">Room for 2</p>
                            <p class="uni"> Near to UCSC </p>
                            <p class="price">Rs.<span> 13000</span>/Month</p>
                            <p class="rating">User Rating<span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>



                </main>
            </div>
        </div>

    </div>

</body>

</html>