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
        const url = 'http://localhost/StudentCare/Facility_Provider/deleteItem'; 
        const options = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        fetch(url, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log('Listing deleted successfully');
                
            })
            .catch(error => {
                console.error('There was a problem deleting the listing:', error);
                
            });
    });
}