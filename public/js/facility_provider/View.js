/* const locationFilter = document.querySelector("#filterItem")

locationFilter.addEventListener("change", (e) => {
    const selectedLocation = e.target.value || "all"
    console.log(selectedLocation)
    const query = new URLSearchParams({
        location: selectedLocation
    })

    console.log(query.toString())
    console.log(document.location)
    document.location.href = document.location.href + "?" + query.toString()
})
 */


const optionMenu = document.querySelector('.dropdown-menu');
const selectBtn = optionMenu.querySelector('.select-btn');
const options = optionMenu.querySelectorAll('.option');
const btnText = optionMenu.querySelector('.Sbtn-text');
const location = optionMenu.querySelector('.location-dropdown');
const type = optionMenu.querySelector('.type-dropdown');
const univesity = optionMenu.querySelector('.university-dropdown');
selectBtn.addEventListener("click", () => {
    optionMenu.classList.toggle("active");
})
options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.innerHTML;
        btnText.innerText = selectedOption;
        location.value = selectedOption;
       /*  type.value = selectedOption;
        univesity.value = selectedOption; */
        optionMenu.classList.remove("active");
    })
})

