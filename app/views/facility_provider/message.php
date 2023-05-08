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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/message.css"?>>
    <title>Add Listings</title>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <?php include "sidebar.php"; ?>
        </div>

        <div class="home_content">
        <div class="side-list">
            <div class="header">
                Chats
            </div>

            <ul class="chat-list">
                <?php foreach ($data['chats'] as $chat) : ?>
                    <?php
                    $id = $chat->student_id;
                    if ($chat->profile_img != NULL) {
                        $image = $chat->profile_img;
                    } else {
                        $image = "avatar.jpg";
                    }
                    ?>
                    <li onclick="loadChat('<?php echo $id ?>','<?php echo $chat->username ?>','<?php echo $image ?>')">
                        <div class="pic">

                            <img src="<?php echo URLROOT . "/public/img/student/" . $image ?>" id="img2">
                        </div>
                        <div class="name">
                            <?php echo $chat->username ?>
                        </div>
                    </li>
                <?php endforeach; ?>
                <!-- more chat names here -->
            </ul>
            <input type="text" id="receiver_id">
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
            let posts = document.querySelectorAll('.chat-box');
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
            clearposts();
            fetch(`http://localhost/StudentCare/Messaging_facility/get_all?id=${id}`)
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
            if (Rid == "") {
                return;
            }
            fetch(`http://localhost/StudentCare/Messaging_facility/fetch_messages?id=${Rid}`)
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
            fetch('http://localhost/StudentCare/Messaging_facility/send_message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        messageBody: message,
                        id: id2
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
