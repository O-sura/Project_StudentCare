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
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/stu/FoodView.css" ?> >
    <script src= <?php echo URLROOT . "/public/js/View.js" ?> defer></script>
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
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80"  >
                        <div class="name">
                            Oshada
                        </div>
                    </div>
                    <a href='<?php echo URLROOT ?>/users/logout'><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
                </div>
            </div>
        </div>
        <div class="home_content">
            <div class="container">
    
                <div class="head">
                    <h1>Food</h1>
    
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
                            <option value="type">Breakfast</option>
                            <option value="type">Lunch</option>
                            <option value="type">Dinner</option>
                        </select>
                    </div>
    
                    <div class="select-btn">
                        <select class="select">
                            <option>Price</option>
                            <option>Low to High</option>
                            <option>High to Low</option>
                        </select>
                    </div>
    
                </div>
    
                <main>
                    
    
                    <div class="item">
                        <div class="image">
                            
                            <img src="https://media.istockphoto.com/id/1346001888/photo/indian-pilau-rice.jpg?b=1&s=170667a&w=0&k=20&c=NRQ6wEU5sWpnHG4wEaUAxOvkK5x7vLk9yko4G3JoW8Y=" alt="">
                          
                        </div>
    
                        <div class="data">
                            <p class="topic">Yellow Rice</p>
                            <p class="uni"> Near to UCSC  </p>
                            <p class="price">Rs.<span> 300</span></p>
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
                            
                            <img src="https://st2.depositphotos.com/4404621/11594/i/950/depositphotos_115943092-stock-photo-sri-lankan-kottu-roti.jpg" alt="">
                          
                        </div>
    
                        <div class="data">
                            <p class="topic">Kottu</p>
                            <p class="uni">Near to UCSC </p>
                            <p class="price">Rs.<span> 200</span></p>
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
                            
                            <img src="https://images.immediate.co.uk/production/volatile/sites/30/2022/09/cropped-miguel-b9e922f.jpg?quality=90&resize=960,872" alt="">
                          
                        </div>
    
                        <div class="data">
                            <p class="topic">Noodles</p>
                            <p class="uni"> Near to UOC  </p>
                            <p class="price">Rs.<span> 150</span></p>
                            <p class="rating">User Rating<span>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
            
                            </span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">
                            
                            <img src="https://img-global.cpcdn.com/recipes/4704982898049024/1200x630cq70/photo.jpg" alt="">
                          
                        </div>
    
                        <div class="data">
                            <p class="topic">Parata</p>
                            <p class="uni"> Near to UCSC  </p>
                            <p class="price">Rs.<span> 30</span></p>
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
                            
                            <img src="https://www.topsrilankanrecipe.com/wp-content/uploads/2019/09/8a.jpg" alt="">
                          
                        </div>
    
                        <div class="data">
                            <p class="topic">String hoppers</p>
                            <p class="uni"> Near to UCSC  </p>
                            <p class="price">Rs.<span> 100 </span></p>
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
                            
                            <img src="https://www.yummytummyaarthi.com/wp-content/uploads/2019/02/1-13-500x375.jpg" alt="">
                          
                        </div>
    
                        <div class="data">
                            <p class="topic">Red rice</p>
                            <p class="uni"> Near to UCSC  </p>
                            <p class="price">Rs.<span> 150</span></p>
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
        
                   
                    
                </main>
            </div>
        </div>

    </div>
    
</body>
</html>