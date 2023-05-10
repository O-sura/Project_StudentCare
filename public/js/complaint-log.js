
const complaintBox1 = document.querySelector('.complaint-box-1');
const complaintBox2 = document.querySelector('.complaint-box-2');

const MarkAllBtn1 = document.querySelector('#mark-all-1');
const MarkAllBtn2 = document.querySelector('#mark-all-2');



//load the post reported notifications into the page
fetch('http://localhost/StudentCare/admin/get_post_reports')
.then(response => response.json())
.then(data => {
    //console.log(data);
    if(data.length === 0){
        let text = document.createElement('h4');
        text.innerText = "All caught up!"
        complaintBox1.appendChild(text);
    }
    else{
        data.forEach(complaint => {

            //creating new complaint component and adding the data
            const complaintBody = document.createElement('div');
            complaintBody.className = 'complaint-body';

            const leadingIcon = document.createElement('i');
            leadingIcon.className = 'fa-solid fa-circle';
            leadingIcon.id = 'leading-icon';
            complaintBody.appendChild(leadingIcon);

            const messageDiv = document.createElement('div');
            messageDiv.className = 'message';
            complaintBody.appendChild(messageDiv);

            const messageP = document.createElement('p');
            messageP.innerHTML = `User <b>"${complaint.username}"</b> reported the post <b>"${complaint.title}"</b> with the reason <b>"${complaint.reason}" (<a href="http://localhost/StudentCare/community/view_post/${complaint.postID}">View Post</a>)</b>`;
            messageDiv.appendChild(messageP);

            const metaDataSpan = document.createElement('span');
            metaDataSpan.className = 'meta-data';
            metaDataSpan.innerHTML = `Reported Date: ${complaint.reportedAt}`;
            messageDiv.appendChild(metaDataSpan);

            const checkIcon = document.createElement('i');
            checkIcon.className = 'fa-solid fa-circle-check';
            checkIcon.id = complaint.notificationID;
            complaintBody.appendChild(checkIcon);

            if(complaint.admin_seen == 1){
                checkIcon.parentElement.style.pointerEvents = 'none';
                checkIcon.parentElement.style.opacity = '0.5';
                checkIcon.parentElement.style.transition = 'opacity 0.5s ease-in-out';
            }

            complaintBox1.appendChild(complaintBody);

       })
       markReaderHelper(1);
    }
    
})
.catch(error => console.error(error));

//load any messages dropped by outsiders via the contact us form
fetch('http://localhost/StudentCare/admin/get_contact_notifications')
.then(response => response.json())
.then(data => {
    //console.log(data);
    if(data.length === 0){
        let text = document.createElement('h4');
        text.innerText = "All caught up!"
        complaintBox2.appendChild(text);
    }else{
        data.forEach(notification => {
            //creating new complaint component and adding the data
            const complaintBody = document.createElement('div');
            complaintBody.className = 'complaint-body';

            const leadingIcon = document.createElement('i');
            leadingIcon.className = 'fa-solid fa-circle';
            leadingIcon.id = 'leading-icon';
            complaintBody.appendChild(leadingIcon);

            const messageDiv = document.createElement('div');
            messageDiv.className = 'message';
            complaintBody.appendChild(messageDiv);

            const messageP = document.createElement('p');
            messageP.innerHTML = `${notification.fname} ${notification.lname} via(<b>${notification.email}</b>) have sent a message "<b>${notification.message_body}</b>"`;
            messageDiv.appendChild(messageP);

            const metaDataSpan = document.createElement('span');
            metaDataSpan.className = 'meta-data';
            metaDataSpan.innerHTML = `Received at: ${notification.reported_at}`;
            messageDiv.appendChild(metaDataSpan);

            const checkIcon = document.createElement('i');
            checkIcon.className = 'fa-solid fa-circle-check';
            checkIcon.id = notification.notificationID;
            complaintBody.appendChild(checkIcon);

            if(notification.admin_seen == 1){
                checkIcon.parentElement.style.pointerEvents = 'none';
                checkIcon.parentElement.style.opacity = '0.5';
                checkIcon.parentElement.style.transition = 'opacity 0.5s ease-in-out';
            }

            complaintBox2.appendChild(complaintBody);
       })
       markReaderHelper(0);
    }
    
})
.catch(error => console.error(error));


//function for mark a specific notification as read
//type defines which tabel, complaint notification or contact us notification
//Also helps to add event listners accordingly to the correct section
function markReaderHelper(type){
    let btns;
    if(type === 1){
        btns = complaintBox1.querySelectorAll('.fa-circle-check');
    }
    if(type === 0){
        btns = complaintBox2.querySelectorAll('.fa-circle-check');
    }
    
    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            //console.log(btn.id);
              // Get the notification ID from the button ID
            const notificationId = btn.id;
            console.log(notificationId);
            
            fetch(`http://localhost/StudentCare/admin/mark_as_read/?id=${notificationId}&type=${type}`)
                .then((response) => {
                    if (response.ok) {
                        // Update the UI to indicate that the notification was marked as read
                        btn.parentElement.style.pointerEvents = 'none';
                        btn.parentElement.style.opacity = '0.5';
                        btn.parentElement.style.transition = 'opacity 0.5s ease-in-out';
                    } else {
                        // Handle the error
                        console.error('Failed to update notification');
                    }
                })
                .catch((error) => console.error(error));
        })
    })
}



//handling mark all as read functionality
MarkAllBtn1.addEventListener('click', () => {
    let type = 1;
    fetch(`http://localhost/StudentCare/admin/mark_all_as_read/?type=${type}`)
        .then((response) => {
            if (response.ok) {
               console.log('Marked as read')
               location.reload();
            } else {
                // Handle the error
                console.error('Failed to update notification');
            }
        })
        .catch((error) => console.error(error));
})

//handling mark all as read functionality
MarkAllBtn2.addEventListener('click', () => {
    let type = 0;
    fetch(`http://localhost/StudentCare/admin/mark_all_as_read/?type=${type}`)
        .then((response) => {
            if (response.ok) {
                console.log('Marked as read')
                location.reload();
            } else {
                // Handle the error
                console.error('Failed to update notification');
            }
        })
        .catch((error) => console.error(error));
})