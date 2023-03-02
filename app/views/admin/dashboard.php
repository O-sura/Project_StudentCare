<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCare</title>
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/admin/dashboard.css"?> >
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src= <?php echo URLROOT . "/public/js/dashboard.js"?> defer></script>
</head>
<body>
    <!-- <div class="section" id="sidebar"></div> -->
    <?php include 'sidebar.php'?>
    
    <div class="section" id="page-content">

        <div class="dashboard-section">
            <h1 class="title-texts">Users Overview</h1>
            <div class="stat-card-holder">
                <div class="card">
                    <h2 class="card-text">Total Users</h2>
                    <span>1221</span>
                </div>
                <div class="card">
                    <h2 class="card-text">New Users</h2>
                    <span>24</span>
                </div>
                <div class="card">
                    <h2 class="card-text">Counselor Requests</h2>
                    <span>04</span>
                </div>
            </div>
            <div class="stat-chart-holder">
                <div class="users-chart-container">
                    <!-- Chart comes here -->
                    <canvas id="users-chart"></canvas>
                </div>
                <div class="doughnut-chart-container">
                    <!-- Doughnut Chart Comes Here -->
                    <canvas id="users-types"></canvas>
                </div>
            </div>
        </div>

        <div class="dashboard-section">
            <h1 class="title-texts">Community Overview</h1>
            <div class="stat-card-holder">
                <div class="card">
                    <h2 class="card-text">New Posts</h2>
                    <span>18</span>
                </div>
                <div class="card">
                    <h2 class="card-text">New Comments</h2>
                    <span>08</span>
                </div>
                <div class="card">
                    <h2 class="card-text">Engagement</h2>
                    <span>33.2%</span>
                </div>
            </div>
            <div class="stat-chart-holder">
                <div class="community-chart-container">
                    <!-- Chart comes here -->
                    <canvas id="community-chart"></canvas>
                </div>
                <div class="doughnut-chart-container">
                    <!-- Doughnut Chart Comes Here -->
                    <table id="top-posts-table">
                            <tr>
                                <th><i class="fa-solid fa-arrow-up-arrow-down"></i> Votes</th>
                                <th>Title</th>
                                <th>Author</th>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>Why Mental health is important</td>
                                <td>OsuraV</td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Why Free Education?</td>
                                <td>Praveen</td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>Best Courses to Follow</td>
                                <td>KaviN</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>20 Ace your Assignments</td>
                                <td>OsuraV</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="dashboard-section">
            <h1 class="title-texts">Listings Overview</h1>
            <div class="stat-card-holder">
                <div class="card">
                    <h2 class="card-text">Total Listings</h2>
                    <span>18</span>
                </div>
                <div class="card">
                    <h2 class="card-text">New Listings</h2>
                    <span>02</span>
                </div>
                <div class="card">
                    <h2 class="card-text">Average Rating</h2>
                    <span>3.67</span>
                </div>
            </div>
            <div class="listing-overview-area-chart">
                <h3>Monthly Overview</h3>
                <canvas id="total-listing"></canvas>
            </div>
            <div class="stat-chart-holder">
                <div class="chart-container">
                    <!-- Chart comes here -->
                    <canvas id="listings-category"></canvas>
                </div>
                <div class="doughnut-chart-container">
                    <!-- Doughnut Chart Comes Here -->
                    <table id="top-posts-table">
                        <tr>
                            <th>Rating</th>
                            <th>Title</th>
                            <th>Category</th>
                        </tr>
                        <tr>
                            <td>4.8</td>
                            <td>House For Rend</td>
                            <td>Property</td>
                        </tr>
                        <tr>
                            <td>4.4</td>
                            <td>WOODEN DINING TABLE WITH 4 CHAIRS</td>
                            <td>Furniture & Equip.</td>
                        </tr>
                        <tr>
                            <td>3.9</td>
                            <td>Room for One</td>
                            <td>Property</td>
                        </tr>
                        
                </table>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>