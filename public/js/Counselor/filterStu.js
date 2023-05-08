function getPopupForDecline() {
  var decbtns = document.getElementById("decline");
  var modalCancel = document.getElementById("myModalCancel");
  var spanC = document.getElementsByClassName("closeC")[0];

  if (decbtns !== null) {
    decbtns.addEventListener("click", function () {
      modalCancel.style.display = "block";

      spanC.onclick = function () {
        modalCancel.style.display = "none";
      };

      window.onclick = function (event) {
        if (event.target == modalCancel) {
          modalCancel.style.display = "none";
        }
      };
    });
  }
}

function getPopupForRemove() {
  var rbtns = document.getElementById("remove");
  var modalCancel = document.getElementById("myModalCancel");
  var spanC = document.getElementsByClassName("closeC")[0];

  if (rbtns !== null) {
    rbtns.addEventListener("click", function () {
      modalCancel.style.display = "block";

      spanC.onclick = function () {
        modalCancel.style.display = "none";
      };

      window.onclick = function (event) {
        if (event.target == modalCancel) {
          modalCancel.style.display = "none";
        }
      };
    });
  }
}

// select menu and student list container
let selectMenu = document.querySelector("#selector");
let container = document.querySelector(".studentList");
let cancelName = document.querySelector("#cancelName");
let cancelID = document.querySelector("#cancelID");
let myForm = document.querySelector("#formID");

// function to add event listeners to student buttons
function addBtnListeners() {
  let studentBtns = document.querySelectorAll(".student");
  studentBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      let studentID = this.getAttribute("data-student-id");

      let statusOfSelect = selectMenu.value;

      // create an XMLHttpRequest object
      let http = new XMLHttpRequest();

      // specify the request method and URL
      http.open(
        "POST",
        "http://localhost/StudentCare/Counsellor/selectStudent"
      );

      // set the request header
      http.setRequestHeader(
        "content-type",
        "application/x-www-form-urlencoded"
      );

      // define a function to handle the response
      http.onload = function () {
        if (http.readyState == 4 && http.status == 200) {
          let response = JSON.parse(http.responseText);
          let filling_0 = "";
          let filling_1 = "";
          let filling_2 = "";

          let c1 = `Student Name : ${response.fullname}`;
          let c2 = `Student ID : ${response.studentID}`;

          filling_0 += `
          <div class="imageSection">
            <div class="img">
              ${
                response.profile_img == ""
                  ? `<img class="dpImg" src="http://localhost/StudentCare/public/img/student/avatar.jpg" alt=""><br>`
                  : `<img class="dpImg" src="http://localhost/StudentCare/public/img/student/${response.profile_img}" alt=""><br>`
              }
            </div>
            <div class="btnDiv">
              <form method="post" action="http://localhost/StudentCare/Counsellor/acceptRejectStudent/${
                response.studentID
              }">
                <button class="accept" name="accept"><i class="fa-solid fa-user-plus"></i>   Accept</button>
                
              </form>
              <button class="decline" id="decline" name="decline"><i class="fa-solid fa-user-minus"></i>  Decline</button>
            </div>
          </div>
          <div class="infoSection">
            <br><label for="name">Name  : </label>${response.fullname}<br>
            <label for="age">DOB    : </label>${response.dob}<br>
            <label for="uni">University : </label>${response.university}<br>
            <label for="address">Address    : </label>${
              response.home_address
            }<br>
            <label for="email">University email : </label>${response.unimail}

            <span>
              <h3 class="note">  Request Note : </h3>
              <p class="noted">
              ${response.rNote}
              </p>
            </span>

          </div>
          `;

          filling_1 += `
          <div class="imageSection">
            <div class="img">
            ${
              response.profile_img == ""
                ? `<img class="dpImg" src="http://localhost/StudentCare/public/img/student/avatar.jpg" alt=""><br>`
                : `<img class="dpImg" src="http://localhost/StudentCare/public/img/student/${response.profile_img}" alt=""><br>`
            }
            </div>
            <div class="btnDiv">
              <form method="post" action="http://localhost/StudentCare/Counsellor/removeStudent/${
                response.studentID
              }">
                
              </form>
              <button class="remove"id="remove" name="remove"><i class="fa-solid fa-user-minus"></i>   Remove</button>
            </div>
          </div>
          <div class="infoSection">
            <br><label for="name">Name  : </label>${response.fullname}<br>
            <label for="age">DOB    : </label>${response.dob}<br>
            <label for="uni">University : </label>${response.university}<br>
            <label for="address">Address    : </label>${
              response.home_address
            }<br>
            <label for="email">University email : </label>${response.unimail}

            <span>
              <h3 class="note">  Request Note : </h3>
              <p class="noted">
              ${response.rNote}
              </p>
            </span>

          </div>
          `;

          filling_2 += `
          <div class="imageSection">
            <div class="img">
            ${
              response.profile_img == ""
                ? `<img class="dpImg" src="http://localhost/StudentCare/public/img/student/avatar.jpg" alt=""><br>`
                : `<img class="dpImg" src="http://localhost/StudentCare/public/img/student/${response.profile_img}" alt=""><br>`
            }
            </div>
          </div>
          <div class="infoSection">
            <br><label for="name">Name  : </label>${response.fullname}<br>
            <label for="age">DOB    : </label>${response.dob}<br>
            <label for="uni">University : </label>${response.university}<br>
            <label for="address">Address    : </label>${
              response.home_address
            }<br>
            <label for="email">University email : </label>${response.unimail}

            <span>
              <h3 class="note">  Request Note : </h3>
              <p class="noted">
              ${response.rNote}
              </p>
            </span>

          </div>
          `;

          let containerProfile = document.querySelector(".div6");

          if (statusOfSelect == 0) {
            containerProfile.innerHTML = filling_0;
            myForm.action = `http://localhost/StudentCare/Counsellor/acceptRejectStudent/${response.studentID}`;
            cancelName.innerHTML = c1;
            cancelID.innerHTML = c2;
            getPopupForDecline();
          } else if (statusOfSelect == 1) {
            containerProfile.innerHTML = filling_1;
            myForm.action = `http://localhost/StudentCare/Counsellor/removeStudent/${response.studentID}`;
            cancelName.innerHTML = c1;
            cancelID.innerHTML = c2;
            getPopupForRemove();
          } else {
            containerProfile.innerHTML = filling_2;
          }
        }
      };

      http.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );

      // send the request
      http.send(`gotStu=` + encodeURIComponent(studentID));
    });
  });
}

// add change event listener to select menu
selectMenu.addEventListener("change", function () {
  let statusOfSelect = this.value;

  // create an XMLHttpRequest object
  let http = new XMLHttpRequest();

  // specify the request method and URL
  http.open("POST", "http://localhost/StudentCare/Counsellor/filterStatus");

  // set the request header
  http.setRequestHeader("content-type", "application/x-www-form-urlencoded");

  // define a function to handle the response
  http.onload = function () {
    if (http.readyState == 4 && http.status == 200) {
      let response = JSON.parse(http.responseText);
      let out = "";

      for (let stu of response) {
        out += `
        <button class="student" data-student-id="${stu.studentID}">${stu.fullname}</button><br>
        `;
      }

      container.innerHTML = out;

      // add event listeners to student buttons
      addBtnListeners();
    }
  };

  // send the request
  http.send(`statusPP=${statusOfSelect}`);
});

// add event listeners to student buttons initially
addBtnListeners();
