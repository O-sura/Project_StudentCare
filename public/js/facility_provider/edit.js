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

//category select dropdown
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


//image preview
const inputimg = document.getElementById('img');
const previewContainer = document.getElementById('preview-container');

inputimg.addEventListener('change', function() {
  // Remove any existing previews
  previewContainer.innerHTML = '';

  // Loop through each selected file
  for (const file of this.files) {
    // Create a new FileReader object
    const reader = new FileReader();

    // Set up the reader to read the current file
    reader.readAsDataURL(file);

    // When the reader has finished reading the file
    reader.onload = function() {
      // Create a new <img> element
      const img = document.createElement('img');
      img.src = reader.result;
      img.classList.add('preview-image');

      // Add the image to the preview container
      previewContainer.appendChild(img);
    }
  }
});