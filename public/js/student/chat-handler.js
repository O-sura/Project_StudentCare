const chatArea = document.querySelector('.chat-area');
const messageInput = document.getElementById('message-input');
const sendButton = document.getElementById('send-btn');




let id = 790;
let senderID = 789; 






// load all the messages which have sent so far into the chat
function loadChat(){
  fetch(`http://localhost/StudentCare/Messaging/get_all?id=${id}`)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        data.forEach(message => {
          const messageElement = document.createElement('div');
          messageElement.classList.add('chat-box');
          if(message.senderID == senderID) {
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
  fetch(`fetch-message.php`)
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
  const message = messageInput.value.trim();
  if (message == '') return;

  // Make the fetch request
  fetch('send-message.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({messageBody: message})
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

  function clearmessages(){
    let posts = document.querySelectorAll('.other_comment');
    if(posts != null){
        posts.forEach((post) =>{
            post.parentNode.removeChild(post);
        })
    }
}
