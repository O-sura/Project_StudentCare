

//JS code for dropdown menu in community homepage
const optionMenu = document.querySelector('.dropdown-menu');
const selectBtn = optionMenu.querySelector('.select-btn');
const options = optionMenu.querySelectorAll('.option');
const btnText = optionMenu.querySelector('.Sbtn-text');

selectBtn.addEventListener("click", () => {
    optionMenu.classList.toggle("active");
})

options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.innerHTML;
        //console.log(selectedOption);
        btnText.innerText = selectedOption;
        dropdownFilter(selectedOption);
        optionMenu.classList.remove("active");
    })
})
