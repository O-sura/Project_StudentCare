//To load the profile image as soon as it changed

const inpuTag = document.getElementById("inputTag");

var loadFile = (e) => {
  var output = document.getElementById("image2");

  output.src = URL.createObjectURL(e.target.files[0]);

  output.onload = () => {
    URL.revokeObjectURL(output.src); // free memory
  };
};

//onChange event
inpuTag.addEventListener("change", loadFile);

var password = document.getElementById("change_pw");


password.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent form submission
  window.location.href = "http://localhost/StudentCare/Student/changeCurrentPassword";

  // Your custom logic or actions here
  
  // For example, you can perform an AJAX request or any other operations
  
  // You can also submit the form programmatically if needed
  // document.getElementById('myForm').submit();
});

function showPopup() { //show modal for cancel appointment
  var popup = document.querySelector(".overlay");
  popup.style.display = "block";
}

const overlay = document.querySelector('.overlay');
const popup = overlay.querySelector('.popup');
const exitButton = popup.querySelector('.exit-button');
const noButton = popup.querySelector('#no');

function closePopup() {
  var popup = document.querySelector(".overlay");
  popup.style.display = "none";
}
noButton.addEventListener('click', closePopup);
noButton.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent form submission
  closePopup();
});
exitButton.addEventListener('click', closePopup);
overlay.addEventListener('click', (event) => {
  if (event.target === overlay) {
      closePopup();
  }
});
const deactivateBtn = document.querySelector('#deactivate');
deactivateBtn.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent form submission
  showPopup();
});



