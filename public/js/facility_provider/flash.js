let alert = document.getElementsByClassName('alert')[0];
let closeBtn = document.getElementsByClassName('close-btn')[0];

closeBtn.addEventListener('click' , () => {
    alert.classList.remove('show');
    alert.classList.add('hide');
})

setTimeout(() => {
    alert.classList.remove('show');
    alert.classList.add('hide');
}, 5000);