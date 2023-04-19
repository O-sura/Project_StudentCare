
const blockBtns = document.querySelectorAll('.block-unblock-btn');
const deleteBtns = document.querySelectorAll('.delete-btn');
const profileBtns = document.querySelectorAll('.profile-btn');

//function for reloading the page
function reloadPage() {
    location.reload();
}

//Handle user blocking and unblocking functionality
blockBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        let userID = btn.getAttribute('class').split(" ")[0];
        fetch(`http://localhost/StudentCare/admin/block_user/${userID}`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.isBlocked) {
               //User is blocked.- Change the button text
               btn.value = "unblock";
               btn.setAttribute("id","unblock-btn");
            } else {
               //User is unblocked
               btn.value = "block";
               btn.setAttribute("id","block-btn");
            }
        });
    })
})

//Linking the stylesheet for model box
const linkElement = document.createElement('link');
linkElement.rel = 'stylesheet';
linkElement.href = 'http://localhost/StudentCare/public/css/modal.css';
document.head.appendChild(linkElement);

deleteBtns.forEach(btn=>{
    btn.addEventListener("click", ()=>{
        let userID = btn.getAttribute('class').split(" ")[0];
        
        //Handling user deletions
        const section = document.querySelector('section'),
        overlay = document.querySelector('.overlay'),
        cancelBtn = document.querySelector('#cancel-button'),
        deleteConfirm = document.querySelector('#delete-button');

        let titleText = document.querySelector('.modal-title-text');
        titleText.innerHTML = `Are your sure you want to delete the user "${userID}"?`;

        //Make the deletion popup visible
        section.classList.add("active");

        overlay.addEventListener('click', () => {
            section.classList.remove("active");
        })

        cancelBtn.addEventListener('click', () => {
            section.classList.remove("active");
        })

        //Sending AJAX request for post deletion if confirmed
        deleteConfirm.addEventListener('click', () => {
            //send the fetch request to delete the user
            fetch(`http://localhost/StudentCare/admin/delete_user/${userID}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
            linkElement.remove();
            reloadPage(); 
        })
               
        })
})

profileBtns.forEach(btn =>{
    btn.addEventListener('click', ()=>{
        let userID = btn.getAttribute('class').split(" ")[0];
        window.open(`http://localhost/StudentCare/admin/show_user/${userID}`, '_blank');
    })
})



