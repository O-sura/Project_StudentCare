const section = document.querySelector('section'),
overlay = document.querySelector('.overlay'),
deleteBtn = document.querySelector('#deleteBtn'),
cancelBtn = document.querySelector('#cancel-button')

if(deleteBtn){
    deleteBtn.addEventListener('click', ()=> {
        section.classList.add("active");
        
    })
}

overlay.addEventListener('click', () => {
    section.classList.remove("active");
})

cancelBtn.addEventListener('click', () => {
    section.classList.remove("active");
})


const deleteConfirmBtn = document.querySelector('#delete-button');
if(deleteConfirmBtn){
    //make the request to the backend to delete the listing
    deleteConfirmBtn.addEventListener('click', () => {
        let listingID = deleteConfirmBtn.getAttribute('class').split(" ")[0];
        fetch(`http://localhost/StudentCare/facility_provider/deleteItem/${listingID}`, {
                method: 'POST'
            })
            .then(response => {
                if (response.ok) {
                        // Update the UI to indicate that the notification was marked as read
                        location.replace("http://localhost/StudentCare/facility_provider/");
                    } else {
                        // Handle the error
                        console.error('Failed to update notification');
                    }
            })
            
    });
}
