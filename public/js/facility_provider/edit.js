function addAnother() {
  // Get the container element
  var container = document.querySelector('.university-adder');

  // Get the number of existing university fields
  var numFields = container.querySelectorAll('.university-field').length;

  // Clone the first university field div
  var newField = container.querySelector('.university-field').cloneNode(true);

  // Increment the ids of the select and input fields
  var select = newField.querySelector('.select');
  select.id = 'universityFilter_' + numFields;

  var input = newField.querySelector('.uniName');
  input.id = 'uniName_' + numFields;

  // Add a class to the new university field
  newField.classList.add('added-field');

  // Append the new university field to the container
  container.appendChild(newField);
}

function remove() {
  var addedFields = document.getElementsByClassName("added-field");
  if (addedFields.length > 0) {
    addedFields[addedFields.length - 1].remove();
  } else {
    var universityAdders = document.getElementsByClassName("university-adder");
    if (universityAdders.length > 1) {
      universityAdders[universityAdders.length - 1].remove();
    }
  }
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
let input = document.querySelector('select[name="uniName[]"'); // Get the input element by name
    let values = input.value.split(","); // Get the value of the input
    let container = document.querySelector('#another');
    //console.log(values)
//add more universities
var counter = 1;
var textbox = "";


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
  //console.log('hello');
});