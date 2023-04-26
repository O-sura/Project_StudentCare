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
    //make the request to teh backend to delete the listing
}