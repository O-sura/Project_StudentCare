// Get form element
const form = document.querySelector('form');

// Get input fields
const dobField = document.getElementById('dob');
const universityField = document.getElementById('university');
const locationsField = document.getElementById('locations');
const unimailField = document.getElementById('unimal');
const termsCheckbox = document.getElementById('terms');

// Add submit event listener to form
form.addEventListener('submit', function(event) {
  // Prevent form submission
  event.preventDefault();

  // Initialize error flag
  let hasError = false;

  // Clear error messages
  const errorMessages = form.querySelectorAll('.error-message');
  errorMessages.forEach((message) => {
    message.remove();
  });

  // Validate date of birth
  if (!dobField.value) {
    hasError = true;
    dobField.parentElement.classList.add('error');
    dobField.insertAdjacentHTML('afterend', '<span class="error-message">Please enter your date of birth.</span>');
  } else {
    dobField.parentElement.classList.remove('error');
  }

  // Validate university
  if (!universityField.value) {
    hasError = true;
    universityField.parentElement.classList.add('error');
    universityField.insertAdjacentHTML('afterend', '<span class="error-message">Please enter your university.</span>');
  } else {
    universityField.parentElement.classList.remove('error');
  }

  // Validate location preferences
  if (!locationsField.value) {
    hasError = true;
    locationsField.parentElement.classList.add('error');
    locationsField.insertAdjacentHTML('afterend', '<span class="error-message">Please enter your location preferences.</span>');
  } else {
    locationsField.parentElement.classList.remove('error');
  }

  // Validate university email
  const allowedDomains = ['stu.ucsc.cmb.ac.lk', 'my.sliit.lk'];
  const emailDomain = unimailField.value.split('@')[1];
 
  if (!unimailField.value) {
    hasError = true;
    unimailField.parentElement.classList.add('error');
    unimailField.insertAdjacentHTML('afterend', '<span class="error-message">Please enter your university email.</span>');
  } else if (!allowedDomains.includes(emailDomain)) {
    hasError = true;
    unimailField.parentElement.classList.add('error');
    unimailField.insertAdjacentHTML('afterend', '<span class="error-message">Please enter a valid university email address.</span>');
  } else {
    unimailField.parentElement.classList.remove('error');
  }

  // Validate terms checkbox
  if (!termsCheckbox.checked) {
    hasError = true;
    termsCheckbox.parentElement.classList.add('error');
    termsCheckbox.insertAdjacentHTML('afterend', '<span class="error-message">Please confirm that the entered details are valid.</span>');
  } else {
    termsCheckbox.parentElement.classList.remove('error');
  }

  // Submit the form if there are no errors
  if (!hasError) {
    form.submit();
  }
});
