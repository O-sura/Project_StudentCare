
 let btn = document.querySelector("#btn");
 let sidebar = document.querySelector(".sidebar");

 btn.onclick = function(){
   sidebar.classList.toggle("active");
 }

// adding more qualification input fields
let inputContainer = document.getElementById("input-container");
let addButton = document.getElementById("add-button");
let inputFieldCount = 1;

addButton.addEventListener("click", function() {
  inputFieldCount++;
  let newInputField = document.createElement("input");
  newInputField.setAttribute("type", "text");
  newInputField.setAttribute("class", `quali`);
  inputContainer.appendChild(newInputField);
});