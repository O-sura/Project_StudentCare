// get all the buttons with class 'right'
let buttons = document.querySelectorAll(".right");

// loop through each button and add a click event listener
buttons.forEach((button) => {
  button.addEventListener("click", function () {
    location.reload();

    // Get the class list of the button element
    const classList = button.classList;

    // Convert the classList into an array
    const classArray = Array.from(classList);

    // Log the array to the console
    console.log(classArray);

    // Access each individual class
    const stuid = classArray[1];
    const R_A_ID = classArray[2];

    // Log the values to the console
    console.log(stuid);
    console.log(R_A_ID);

    // create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // set the URL for the AJAX request
    xhr.open(
      "POST",
      `http://localhost/StudentCare/Counsellor/markAsReadNotifications?stuID=${stuid}&R_A_ID=${R_A_ID}`
    );

    // set the onload function for the AJAX request
    xhr.onload = function () {
      if (xhr.status == 200) {
        let responseText = xhr.responseText.trim();
        if (responseText) {
          let response = JSON.parse(xhr.responseText);
          console.log(response);
        }
      }
    };

    // set the content type for the AJAX request
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // send the AJAX request with the student ID and appointment or request ID values as data
    xhr.send(
      "stuID=" +
        encodeURIComponent(stuid) +
        "R_A_ID" +
        encodeURIComponent(R_A_ID)
    );
  });
});
