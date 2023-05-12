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