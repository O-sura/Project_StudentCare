//go back to previous page
document.getElementById("back-link").addEventListener("click", function() {
  history.go(-1);
});


//add more universities
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

  // Append the new university field to the container
  container.appendChild(newField);
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

//image preview
const input = document.getElementById('img');
const previewContainer = document.getElementById('preview-container');

input.addEventListener('change', function() {
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

