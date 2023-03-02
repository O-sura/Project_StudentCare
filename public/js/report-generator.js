const optionMenu = document.querySelectorAll('.dropdown-menu');
    optionMenu.forEach(menu => {
        const selectBtn = menu.querySelector('.select-btn');
        const options = menu.querySelectorAll('.option');
        const btnText = menu.querySelector('.Sbtn-text');

        selectBtn.addEventListener("click", () => {
            menu.classList.toggle("active");
        })

        options.forEach(option => {
            option.addEventListener("click", () => {
                let selectedOption = option.innerHTML;
                btnText.innerText = selectedOption;

                menu.classList.remove("active");
            })
        })
    });