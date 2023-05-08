
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
            let div = document.createElement("div");
            div.classList.add('complaint-body')
           div.innerHTML = `
               <p>${complaint.reason}</p>
               <i class="fa-solid fa-circle-check" id="${complaint.notificationID}"></i>
           `;
            complaintBox1.appendChild(div);
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
            let div = document.createElement("div");
            div.classList.add('complaint-body')
           div.innerHTML = `
               <p>${notification.message_body}</p>
               <i class="fa-solid fa-circle-check" id="${notification.notificationID}"></i>
           `;
           complaintBox2.appendChild(div);
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
            } else {
                // Handle the error
                console.error('Failed to update notification');
            }
        })
        .catch((error) => console.error(error));
})