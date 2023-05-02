document.querySelectorAll('input').forEach(e => {
    e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
})

document.querySelectorAll('textarea').forEach(e => {
    e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
})

/*
function validateForm() {
    const name = document.getElementById("name").value.trim();
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const nic = document.getElementById("nic").value.trim();
    const address = document.getElementById("address").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("re-password").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const terms = document.getElementById("terms").checked;
  
    let isValid = true;
  
    // Name validation
    if (!name) {
      showError("name", "Please enter your name");
      isValid = false;
    }
  
    // Username validation
    if (!username) {
      showError("username", "Please enter a username");
      isValid = false;
    }
  
    // Email validation
    if (!email) {
      showError("email", "Please enter your email address");
      isValid = false;
    } else if (!isValidEmail(email)) {
      showError("email", "Please enter a valid email address");
      isValid = false;
    }
  
    // NIC validation
    if (!nic) {
      showError("nic", "Please enter your NIC number");
      isValid = false;
    } else if (!isValidNIC(nic)) {
      showError("nic", "Please enter a valid NIC number");
      isValid = false;
    }
  
    // Address validation
    if (!address) {
      showError("address", "Please enter your address");
      isValid = false;
    }
  
    // Password validation
    if (!password) {
      showError("password", "Please enter a password");
      isValid = false;
    } else if (!isValidPassword(password)) {
      showError("password", "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number");
      isValid = false;
    }
  
    // Confirm Password validation
    if (!confirmPassword) {
      showError("re-password", "Please confirm your password");
      isValid = false;
    } else if (password !== confirmPassword) {
      showError("re-password", "Passwords do not match");
      isValid = false;
    }
  
    // Contact validation
    if (!contact) {
      showError("contact", "Please enter your contact number");
      isValid = false;
    } else if (!isValidContact(contact)) {
      showError("contact", "Please enter a valid contact number");
      isValid = false;
    }
  
    // Terms and Conditions validation
    if (!terms) {
      showError("terms-cond", "Please accept the terms and conditions");
      isValid = false;
    }
  
    return isValid;
  }
  
  function showError(id, errorMessage) {
    const formField = document.getElementById(id).parentElement;
    formField.classList.add("error");
    formField.dataset.error = errorMessage;
  }
  
  function removeError(id) {
    const formField = document.getElementById(id).parentElement;
    formField.classList.remove("error");
    formField.removeAttribute("data-error");
  }
  
  function isValidEmail(email) {
    // Regular expression to validate email address
    const emailRegExp = /^\S+@\S+\.\S+$/;
    return emailRegExp.test(email);
  }
  
  function isValidNIC(nic) {
    const nicLength = nic.length;
    // Regular expression to validate NIC number with length 9 and ends with V or v
    const nicRegExp1 = /^[0-9]{9}[vV]$/i;
    // Regular expression to validate NIC number with length 10 and ends with V or v
    const nicRegExp2 = /^[0-9]{9}[vVxX]$/i;
    // Regular expression to validate NIC number with length 12
    const nicRegExp3 = /^[0-9]{12}$/;
    
    if (nicLength === 10) {
      return nicRegExp2.test(nic);
    } else if (nicLength === 12) {
      return nicRegExp3.test(nic);
    } else {
      return nicRegExp1.test(nic);
    }
  }

  function isValidPassword(password) {
    // Regular expression to validate password
    const passwordRegExp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d!@#$%^&*()_+]{8,}$/;
  
    // Test if the password matches the regular expression
    return passwordRegExp.test(password);
  }
  
  
  

  function isValidContact(phoneNumber) {
    // Regular expression to validate phone number
    const phoneRegExp = /^\d{10}$/;
    return phoneRegExp.test(phoneNumber);
  }

// const regForm = document.getElementById("registerForm");

// regForm.addEventListener("continue", function(event) {
//   // Prevent the form from submitting automatically
//   event.preventDefault();

//   // Call the validateForm() function to validate the form fields
//   if (validateForm()) {
//     // Submit the form if it's valid
//     regForm.submit();
//   }
// });

*/