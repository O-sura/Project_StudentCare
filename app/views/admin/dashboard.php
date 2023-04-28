<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/admin/new-dashboard.css"?>>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src= <?php echo URLROOT . "/public/js/dashboard.js"?> defer></script>
</head>
<body>
    <!-- <div class="section" id="sidebar">1</div> -->
    <?php include 'sidebar.php'?>
    <div class="section" id="page-content">
        <div class="greeting-container">
           <h6>Howdy,</h6>
           <h2>Admin <i class="fa-solid fa-face-smile"></i></h2>
        </div>
        <div class="div-1">
            <div class="user-stat">
                <div class="row-1">
                    <div class="card">
                        <span><?php echo $data['total_users']?></span>
                        <h2 class="card-text">Total Users</h2>
                    </div>
                    <div class="card">
                        <span><?php echo $data['counselor_req']?></span>
                        <h2 class="card-text">Counselor Requests</h2>
                    </div>
                </div>
                <div class="row-2">
                    <!-- user count chart comes here -->
                    <canvas id="users-chart"></canvas>
                </div>
                <div class="row-3">
                    <span><i class="fa-solid fa-circle-right"></i><a href="http://localhost/StudentCare/admin/user_management">Show all users</a></span>
                </div>
            </div>
            <div class="pie-chart-container">
                <h1>User Overview</h1><br>
                <canvas id="users-types"></canvas>
            </div>
        </div>
        <div class="stat-and-chart">
            <div class="stat-div">
                <h1>Community Overview</h1><br><br>
                <div class="card">
                    <h2 class="card-text">New Posts</h2>
                    <span><?php echo $data['new_posts']?></span>
                </div>
                <div class="card">
                    <h2 class="card-text">Engagement</h2>
                    <span><?php echo $data['engagement']?>%</span>
                </div>
            </div>
            <div class="chart-div">
                <h3>Community Engagement</h3><br><br>
                <canvas id="community-chart"></canvas>
            </div>
        </div>
        <div class="div-3">
            <span>Top Posts <i class="fa-sharp fa-solid fa-paper-plane"></i></span>
            <table class="stat-table">
                    <tr>
                        <th>#Votes</th>
                        <th>Title</th>
                        <th>Comments</th>
                        <th>Author</th>
                    </tr>
                   
                    <?php foreach ($data['top_posts'] as $post): ?>
                       <?php echo ' 
                                <tr>
                                    <td>'. $post->max_votes .'</td>
                                    <td>'. $post->post_title .'</td>
                                    <td>'. $post->comment_count .'</td>
                                    <td>'. $post->author .'</td>
                                    </tr>';
                        ?>      
                    <?php endforeach ?>
            </table>
        </div>
        <div class="stat-and-chart">
            <div class="stat-div">
                <h1>Listings Overview</h1><br><br>
                <div class="card">
                    <h2 class="card-text">Total Listings</h2>
                    <span><?php echo $data['total_listings']?></span>
                </div>
                <div class="card">
                    <h2 class="card-text">Average Rating</h2>
                    <span><?php echo $data['average_rating']?></span>
                </div>
            </div>
            <div class="chart-div">
                <h3>Monthly Overview</h3><br><br>
                <canvas id="total-listing"></canvas>
            </div>
        </div>
        <div class="div-3">
            <span>Top Listings <i class="fa-solid fa-house"></i></span>
            <table class="stat-table">
                    <tr>
                        <th>#Rating</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Reviews</th>
                    </tr>
                    
                    <?php foreach ($data['top_listings'] as $listing): ?>
                       <?php echo ' 
                                <tr>
                                    <td>'. $listing->rating .'</td>
                                    <td>'. $listing->topic .'</td>
                                    <td>'. $listing->category .'</td>
                                    <td>'. $listing->review_count .'</td>
                                    </tr>';
                        ?>      
                    <?php endforeach ?>
            </table>
        </div>
    </div>
</body>
</html>