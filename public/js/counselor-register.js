const form = document.querySelector('form');
const dob = document.querySelector('#dob');
const specialization = document.querySelector('#specialization');
const qualifications = document.querySelectorAll('#qualifications input');
const verification = document.querySelector('#verification');
const terms = document.querySelector('#terms');


//THIS NEED TO BE CHECKED AGAIN & ADD PROPER ERROR MESSAGES

form.addEventListener('submit', function(event) {
  let error = false;

  // Validate date of birth
  const dobValue = dob.value;
  const dobDate = new Date(dobValue);
  const nowDate = new Date();
  const age = Math.floor((nowDate - dobDate) / (365.25 * 24 * 60 * 60 * 1000));
  if (age < 18) {
    dob.classList.add('error');
    error = true;
  } else {
    dob.classList.remove('error');
  }

  // Validate specialization
  if (specialization.value.trim() === '') {
    specialization.classList.add('error');
    error = true;
  } else {
    specialization.classList.remove('error');
  }

  // Validate qualifications
  let qualificationsValid = true;
  qualifications.forEach(function(qualification) {
    if (qualification.value.trim() === '') {
      qualification.classList.add('error');
      qualificationsValid = false;
      error = true;
    } else {
      qualification.classList.remove('error');
    }
  });
  if (!qualificationsValid) {
    error = true;
  }

  // Validate verification document
  const verificationValue = verification.value.trim();
  const verificationExt = verificationValue.split('.').pop().toLowerCase();
  if (verificationValue === '' || verificationExt !== 'pdf') {
    verification.classList.add('error');
    error = true;
  } else {
    verification.classList.remove('error');
  }

  // Validate terms checkbox
  if (!terms.checked) {
    terms.classList.add('error');
    error = true;
  } else {
    terms.classList.remove('error');
  }

  if (error) {
    event.preventDefault();
  }
});
