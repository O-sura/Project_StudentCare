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
                        <span>1221</span>
                        <h2 class="card-text">Total Users</h2>
                    </div>
                    <div class="card">
                        <span>04</span>
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
                    <span>18</span>
                </div>
                <div class="card">
                    <h2 class="card-text">New Comments</h2>
                    <span>10</span>
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
                    <tr>
                        <td>21</td>
                        <td>Why Mental health is important</td>
                        <td>12</td>
                        <td>OsuraV</td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>Why Free Education?</td>
                        <td>10</td>
                        <td>Praveen</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>Best Courses to Follow</td>
                        <td>10</td>
                        <td>KaviN</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>20 Ace your Assignments</td>
                        <td>7</td>
                        <td>OsuraV</td>
                    </tr>
            </table>
        </div>
        <div class="stat-and-chart">
            <div class="stat-div">
                <h1>Community Overview</h1><br><br>
                <div class="card">
                    <h2 class="card-text">New Posts</h2>
                    <span>18</span>
                </div>
                <div class="card">
                    <h2 class="card-text">New Comments</h2>
                    <span>10</span>
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
                    <tr>
                        <td>5.0</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit</td>
                        <td>12</td>
                        <td>OsuraV</td>
                    </tr>
                    <tr>
                        <td>4.8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                        <td>10</td>
                        <td>Praveen</td>
                    </tr>
                    <tr>
                        <td>4.5</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>10</td>
                        <td>KaviN</td>
                    </tr>
                    <tr>
                        <td>4.2</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam, laboriosam.</td>
                        <td>7</td>
                        <td>OsuraV</td>
                    </tr>
            </table>
        </div>
    </div>
</body>
</html>