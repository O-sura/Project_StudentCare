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



let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function(){
    sidebar.classList.toggle("active");
}
//add image names for plus icon
/* function getImage(imagename){
    var newimg=imagename.replace(/^.*\\/,"");
    $('#display-image').html(newimg);
} */