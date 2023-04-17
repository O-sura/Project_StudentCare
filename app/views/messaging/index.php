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
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/stu/messagingStyle.css" ?>>
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
                <a href="<?php echo URLROOT . "/users/logout" ?>"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="side-list">
            <div class="header">
                Chats
            </div>

            <ul class="chat-list">
                <?php foreach ($data['chats'] as $chat) : ?>
                    <?php if ($_SESSION['userID'] == 789) {
                        $id = 790;
                    } else {
                        $id = 789;
                    } ?>
                    <li onclick="loadChat('<?php echo $id ?>','<?php echo $chat->username ?>','<?php echo $chat->profile_img ?>')">
                        <div class="pic">

                            <img src="<?php echo URLROOT . "/public/img/student/" . $chat->profile_img ?>" id="img2">
                        </div>
                        <div class="name">
                            <?php echo $chat->username ?>
                        </div>
                    </li>
                <?php endforeach; ?>
                <!-- more chat names here -->
            </ul>
            <input type="text" id = "receiver_id">
        </div>
        <div class="chat-container">
            <div class="header">
                <img src="" id="chat-header-img">
                <span id="chat-header-username"></span>
                <!-- <p id="senderID" hidden>1002</p> -->
            </div>
            <div class="chat-area">

                <!-- when new messages were sent and received, they should be added here -->
            </div>
            <div class="input-area">
                <input type="text" placeholder="Type a message..." id="message-input">
                <button id="send-btn"><i class="fa-solid fa-paper-plane fa-lg"></i></button>
            </div>

        </div>


    </div>


    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        const chatList = document.querySelector('.chat-list');
        const chatItems = chatList.querySelectorAll('li');

        chatItems.forEach((item) => {
            item.addEventListener('click', () => {
                // remove the active class from all chat items
                chatItems.forEach((item) => {
                    item.classList.remove('active');
                });
                // add the active class to the clicked item
                item.classList.add('active');
            });
        });

        const chatArea = document.querySelector('.chat-area');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-btn');




        let senderID = <?php echo json_encode($_SESSION['userID']); ?>;

        function clearposts() {
            let posts = document.querySelectorAll('.other_comment');
            if (posts != null) {
                posts.forEach((post) => {
                    post.parentNode.removeChild(post);
                })
            }
        }



        let URLROOT = 'http://localhost/StudentCare';

        // load all the messages which have sent so far into the chat
        function loadChat(id, username, profileImg) {
            document.getElementById("chat-header-img").src = URLROOT + "/public/img/student/" + profileImg;
            document.getElementById("chat-header-username").innerText = username;
            document.getElementById("chat-header-img").style.display = "block";
            document.getElementById("receiver_id").value = id;
            fetch(`http://localhost/StudentCare/Messaging/get_all?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    data.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('chat-box');
                        if (message.senderID == senderID) {
                            messageElement.classList.add('outgoing');
                        } else {
                            messageElement.classList.add('incoming');
                        }
                        messageElement.innerHTML = `
            <p>${message.message}</p>
            <span class="time">${message.received_at}</span>
          `;
                        chatArea.appendChild(messageElement);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Function to fetch new messages
        function fetchMessages() {
            let Rid = document.getElementById("receiver_id").value;
            if (Rid=="") {
                return;
            }
            fetch(`http://localhost/StudentCare/Messaging/fetch_messages?id=${Rid}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    data.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('chat-box');
                        if (message.senderID == senderID) {
                            messageElement.classList.add('outgoing');
                        } else {
                            messageElement.classList.add('incoming');
                        }
                        messageElement.innerHTML = `
          <p>${message.message}</p>
          <span class="time">${message.received_at}</span>
        `;
                        chatArea.appendChild(messageElement);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }


        // function for sending the message
        function sendMessage() {
            // Get the input value
            const id2 = document.getElementById("receiver_id").value;
            const message = messageInput.value.trim();
            if (message == '') return;

            // Make the fetch request
            fetch('http://localhost/StudentCare/Messaging/send_message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        messageBody: message,
                        id:id2
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    fetchMessages();
                })
                .catch(error => {
                    console.log(error);
                });

            // Clear the input field
            messageInput.value = '';
        }



        // Event listener for when the user clicks the send button
        sendButton.addEventListener('click', () => {
            sendMessage();
        });

        // Event listener for when the user presses Enter key
        messageInput.addEventListener('keydown', (event) => {
            if (event.key == 'Enter') {
                sendMessage();
            }
        });

        //Fetch new messages every 0.5s
        setInterval(() => {
            fetchMessages();
        }, 500);
    </script>
</body>

</html>