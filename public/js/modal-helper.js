const section = document.querySelector('section'),
overlay = document.querySelector('.overlay'),
showBtn = document.querySelector('.trigger'),
cancelBtn = document.querySelector('#cancel-button'),
closeBtn = document.querySelector('#close-button');

showBtn.addEventListener('click', ()=> {
    section.classList.add("active");
})

overlay.addEventListener('click', () => {
    section.classList.remove("active");
})

cancelBtn.addEventListener('click', () => {
    section.classList.remove("active");
})

// closeBtn.addEventListener('click', () => {
//     section.classList.remove("active");
// })