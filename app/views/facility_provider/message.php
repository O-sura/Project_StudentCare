<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/message.css"?>>
    <title>Message</title>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="container">
            <div class="yourprofile">
                <a href=<?php echo URLROOT. "/facility_provider/profile"?>>
                    <p>Profile</p>
                    <i class="fa fa-user"></i>
                </a>
            </div>
            
            <div class="wrapper">
                <div class="chats">
                    <h1>Messages</h1>
                    <div class="chat_profiles">
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                        <div class="short">
                            <p>DanieIS</p>
                            <span>what can i do for you</span>
                        </div>
                    </div>
                    <div class="chat_profiles">
                        <img src="https://images.unsplash.com/photo-1639149888905-fb39731f2e6c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=464&q=80" alt="">
                        <div class="short">
                            <p>Damien</p>
                            <span>what can i do for you</span>
                        </div>
                    </div>
                    <div class="chat_profiles">
                        <img src="https://images.unsplash.com/photo-1654110455429-cf322b40a906?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=580&q=80" alt="">
                        <div class="short">
                            <p>ScottTS</p>
                            <span>what can i do for you</span>
                        </div>
                    </div>
                </div>
            
                <hr>

                <div class="chat-area">
                    <div class="header">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
                        <div class="details">
                            <span>DanieIS</span>
                        </div>
                    </div>
                    <hr>
                    <div class="chat-box">
                        <div class="chat incoming">
                            <div class="details">
                                <p>Hello</p>
                            </div>
                        </div>
                        <div class="chat outgoing">
                            <img src="img.jpg" alt="">
                            <div class="details">
                                <p>Hey</p>
                                <p>What can i do for you?</p>
                            </div>
                        </div>
                        <div class="chat incoming">
                            <div class="details">
                                <p>Can you check the availability?</p>
                            </div>
                        </div>
                        <div class="chat outgoing">
                            <img src="img.jpg" alt="">
                            <div class="details">
                                <p>Yes we have what you asked for shall i send the details</p>
                            </div>
                        </div>
                    </div>
                    <form action="#" class="typing-area">
                        <input type="text" placeholder="Message.......">
                        <button><i class="fab fa-telegram-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>