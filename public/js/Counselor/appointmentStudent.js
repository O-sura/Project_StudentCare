//to get the particular student details when clicking on the image 
let clickDivs = document.querySelectorAll('#stu');
let containerProfile = document.querySelector('.right');

clickDivs.forEach((div) => {
    div.addEventListener("click", function() {
        let whichStu = this.value;
        let whichDate = this.nextElementSibling.value;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', "http://localhost/StudentCare/CounselorAppointment/selectAppointedStudent");

        xhr.onload = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                //console.log(xhr.responseText);
                let response = JSON.parse(xhr.responseText);
                let filling = '';

                filling += `
                    <div class="stu" id="stu">
                        <div class="imagePP">
                            <img class="imggPPP" src="http://localhost/StudentCare/public/img/avatar.jpg" alt=""> 
                        </div>
                        <p class="fname">${response.fullname}</p>
                        <p class="address">${response.home_address}</p>
                        <hr class="hr2">
                        <p class="detail">Student Details</p>
                        <p class="dob">DOB  : ${response.dob}</p>
                        <p class="email">Email  : ${response.email}</p>
                        <p class="uni">University   : ${response.university}</p>
                        <p class="note">Notice  : ${response.appointmentDescription}</p>
                    </div>
                `;
                containerProfile.innerHTML = filling;
            }
        };

        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xhr.send(`gotStu=${whichStu}&gotDate=${whichDate}`);
    });
});

//to load the modal start meeting or cancel 
var modal = document.getElementById("myModal");
var btns = document.getElementsByClassName("btn");
var span = document.getElementsByClassName("close")[0];

for (var i = 0; i < btns.length; i++) {
  btns[i].onclick = function() {
    modal.style.display = "block";
  }
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//to load the meeting cancellation modal

var modalCancel = document.getElementById("myModalCancel");
var rbtns = document.getElementsByClassName("rbtn");
var spanC = document.getElementsByClassName("closeC")[0];

for (var i = 0; i < rbtns.length; i++) {
  rbtns[i].onclick = function() {
    modalCancel.style.display = "block";
  }
}

spanC.onclick = function() {
  modalCancel.style.display = "none";
  modal.style.display = "none";
  
}

window.onclick = function(event) {
  if (event.target == modalCancel) {
    modalCancel.style.display = "none";
    modal.style.display = "none";
  }
}

//to cancel the appointment

// get all the buttons with class 'btn'
let buttons = document.querySelectorAll('.btn');

let cancelName = document.querySelector('#cancelName');
let cancelDate = document.querySelector('#cancelDate');
let cancelTime = document.querySelector('#cancelTime');
let myForm = document.querySelector('#formID');

// loop through each button and add a click event listener
buttons.forEach((button) => {
  button.addEventListener('click', function() {
    // get the student ID value from the button clicked
    let studentId = this.value;
   
    const completeAppLink = document.getElementById('completedApp');

    // get the appointment date value from the hidden input field within the button
    let appointmentDate = this.querySelector('#getAppTime').value;

    // create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // set the URL for the AJAX request
    xhr.open('POST', 'http://localhost/StudentCare/CounselorAppointment/selectAppointedStudent');

    // set the onload function for the AJAX request
    xhr.onload = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let response = JSON.parse(xhr.responseText);
        console.log(response);
    
        let c1 = `Student Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ${response.fullname}`;
        let c2 = `Appointment Date : ${response.appointmentDate}`;
        let c3 = `Appointment Time : ${response.appointmentTime}`;

        completeAppLink.href = `http://localhost/StudentCare/CounselorAppointment/completeAppointment/?appdate=${response.appointmentDate}&appID=${response.appointmentID}`;
        myForm.action = `http://localhost/StudentCare/CounselorAppointment/cancellationOfAppointment/?appdate=${response.appointmentDate}&appID=${response.appointmentID}`;
        cancelName.innerHTML = c1;
        cancelDate.innerHTML = c2;
        cancelTime.innerHTML = c3;
      }
    };

    // set the content type for the AJAX request
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // send the AJAX request with the student ID and appointment date values as data
    xhr.send('gotStu=' + encodeURIComponent(studentId) + '&gotDate=' + encodeURIComponent(appointmentDate));
  });
});





