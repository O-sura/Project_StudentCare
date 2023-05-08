//go back to previous page
document.getElementById("back-link").addEventListener("click", function () {
  history.go(-1);
});

//To load the profile image as soon as it changed
var loadFile = (e) => {
  var output = document.getElementById("output");

  output.src = URL.createObjectURL(e.target.files[0]);

  output.onload = () => {
    URL.revokeObjectURL(output.src); // free memory
  };
};

//To add another field for qualification
var counter = 1;
var textbox = "";
var another = document.getElementById("input-container");
function addAnother() {
  var div = document.createElement("div");
  div.setAttribute("class", "qualiD");
  div.setAttribute("id", "");

  var textbox =
    "<input class='quali' name='qualifications[]' id='qualification_" +
    counter +
    "' type='text'>";

  div.innerHTML = textbox;
  another.appendChild(div);
  counter++;
}
