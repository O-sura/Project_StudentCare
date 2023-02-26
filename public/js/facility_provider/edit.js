//add more universities
var counter = 1;
var textbox = "";
var another = document.getElementById("another");
function addAnother(){
    var div = document.createElement("div");
    div.setAttribute("class", "sub22");
    div.setAttribute("id","");

    var textbox = "<input class='uniName' name='uniName[]' id='uniName_"+counter+"' type='text'>";

    div.innerHTML = textbox;
    another.appendChild(div);
    counter++;
}

const optionMenu = document.querySelector('.dropdown-menu');
const selectBtn = optionMenu.querySelector('.select-btn');
const options = optionMenu.querySelectorAll('.option');
const btnText = optionMenu.querySelector('.Sbtn-text');
const category = optionMenu.querySelector('.category-dropdown');
selectBtn.addEventListener("click", () => {
    optionMenu.classList.toggle("active");
})
options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.innerHTML;
        btnText.innerText = selectedOption;
        category.value = selectedOption;
        optionMenu.classList.remove("active");
    })
})

//edit university names

let input = document.querySelector('input[name="uniName[]"'); // Get the input element by name
    let values = input.value.split(","); // Get the value of the input
    let container = document.querySelector('#another');
    console.log(values)

    values.forEach(v => {
        let input = document.createElement('input'); // Create a new input element
        input.value = v; // Set the value of the input
        container.appendChild(input); // Add the input to the container
});