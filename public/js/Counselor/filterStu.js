// select menu and student list container
let selectMenu = document.querySelector('#selector');
let container = document.querySelector('.studentList');

// function to add event listeners to student buttons
function addBtnListeners() {
  let studentBtns = document.querySelectorAll('.student');
  studentBtns.forEach((btn) => {
    btn.addEventListener('click', function() {
      let studentID = this.getAttribute('data-student-id');

      
        let statusOfSelect = selectMenu.value;

      // create an XMLHttpRequest object
      let http = new XMLHttpRequest();

      // specify the request method and URL
      http.open('POST', 'http://localhost/StudentCare/Counsellor/selectStudent');

      // set the request header
      http.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

      // define a function to handle the response
      http.onload = function() {
        if(http.readyState == 4 && http.status == 200) {
          let response = JSON.parse(http.responseText);
          let filling_0 = '';
          let filling_1 = '';
          let filling_2 = '';


          filling_0 += `
          <div class="imageSection">
            <div class="img">
              <img class="dpImg" src="http://localhost/StudentCare/public/img/counselor/${response.profile_img}" alt=""><br>
            </div>
            <div class="btnDiv">
              <form method="post" action="http://localhost/StudentCare/Counsellor/acceptRejectStudent/${response.studentID}">
                <button class="accept" name="accept"><i class="fa-solid fa-user-plus"></i>   Accept</button>
                <button class="decline" name="decline"><i class="fa-solid fa-user-minus"></i>  Decline</button>
              </form>
            </div>
          </div>
          <div class="infoSection">
            <br><label for="name">Name  : </label>${response.fullname}<br>
            <label for="age">DOB    : </label>${response.dob}<br>
            <label for="uni">University : </label>${response.university}<br>
            <label for="address">Address    : </label>${response.home_address}<br>
            <label for="email">University email : </label>

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
              <img class="dpImg" src="http://localhost/StudentCare/public/img/counselor/${response.profile_img}" alt=""><br>
            </div>
            <div class="btnDiv">
              <form method="post" action="http://localhost/StudentCare/Counsellor/removeStudent/${response.studentID}">
                <button class="remove" name="remove"><i class="fa-solid fa-user-minus"></i>   Remove</button>
              </form>
            </div>
          </div>
          <div class="infoSection">
            <br><label for="name">Name  : </label>${response.fullname}<br>
            <label for="age">DOB    : </label>${response.dob}<br>
            <label for="uni">University : </label>${response.university}<br>
            <label for="address">Address    : </label>${response.home_address}<br>
            <label for="email">University email : </label>

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
              <img class="dpImg" src="http://localhost/StudentCare/public/img/counselor/${response.profile_img}" alt=""><br>
            </div>
          </div>
          <div class="infoSection">
            <br><label for="name">Name  : </label>${response.fullname}<br>
            <label for="age">DOB    : </label>${response.dob}<br>
            <label for="uni">University : </label>${response.university}<br>
            <label for="address">Address    : </label>${response.home_address}<br>
            <label for="email">University email : </label>

            <span>
              <h3 class="note">  Request Note : </h3>
              <p class="noted">
              ${response.rNote}
              </p>
            </span>

          </div>
          `;

          let containerProfile = document.querySelector('.div6');

          if(statusOfSelect == 0){
            containerProfile.innerHTML = filling_0;
          }
          else if(statusOfSelect == 1){
            containerProfile.innerHTML = filling_1;
          }
          else{
            containerProfile.innerHTML = filling_2;
          }
          
        }
      };

      // send the request
      http.send(`gotStu=${studentID}`);
    });
  });
}

// add change event listener to select menu
selectMenu.addEventListener("change", function() {
  let statusOfSelect = this.value;

  // create an XMLHttpRequest object
  let http = new XMLHttpRequest();

  // specify the request method and URL
  http.open('POST', 'http://localhost/StudentCare/Counsellor/filterStatus');

  // set the request header
  http.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

  // define a function to handle the response
  http.onload = function() {
    if(http.readyState == 4 && http.status == 200) {
      let response = JSON.parse(http.responseText);
      let out = "";

      for(let stu of response) {
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
















































// // select menu and student list container
// let selectMenu = document.querySelector('#selector');
// let container = document.querySelector('.studentList');

// // add change event listener to select menu
// selectMenu.addEventListener("change", function() {
//     let statusOfSelect = this.value;
    
//     // create an XMLHttpRequest object
//     let http = new XMLHttpRequest();

//     // specify the request method and URL
//     http.open('POST', 'http://localhost/StudentCare/Counsellor/filterStatus');

//     // set the request header
//     http.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

//     // define a function to handle the response
//     http.onload = function() {
//         if(http.readyState == 4 && http.status == 200) {
//             let response = JSON.parse(http.responseText);
//             let out = "";

//             for(let stu of response) {
//                 out += `
//                 <button class="student" data-student-id="${stu.studentID}">${stu.studentName}</button><br>
//                 `;
//             }

//             container.innerHTML = out;
//         }
//     };

//     // send the request
//     http.send(`statusPP=${statusOfSelect}`);
// });

// // student button list
// let studentBtns = document.querySelectorAll('.student');

// // add click event listener to each student button
// studentBtns.forEach((btn) => {
//     btn.addEventListener('click', function() {
//         let studentID = this.getAttribute('data-student-id');
        
//         // create an XMLHttpRequest object
//         let http = new XMLHttpRequest();

//         // specify the request method and URL
//         http.open('POST', 'http://localhost/StudentCare/Counsellor/selectStudent');

//         // set the request header
//         http.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

//         // define a function to handle the response
//         http.onload = function() {
//             if(http.readyState == 4 && http.status == 200) {
//                 let response = JSON.parse(http.responseText);
//                 let filling = '';

//                 filling += `
//                 <div class="imageSection">
//                     <div class="img">
//                         <img class="dpImg" src="http://localhost/StudentCare/public/img/counselor/${response.profile_img}" alt=""><br>
//                     </div>
//                     <div class="btnDiv">
//                         <button class="accept"><i class="fa-solid fa-user-plus"></i>   Accept</button>
//                         <button class="decline"><i class="fa-solid fa-user-minus"></i>  Decline</button>
//                     </div>
//                 </div>
//                 <div class="infoSection">
//                     <br><label for="name">Name  : </label>${response.studentName}<br>
//                     <label for="age">Age    : </label>${response.studentID}<br>
//                     <label for="uni">University : </label><br>
//                     <label for="address">Address    : </label>${response.location}<br>
//                     <label for="email">University email : </label>

//                     <span>
//                         <h3 class="note">  Request Note : </h3>
//                         <p class="noted">
//                         ${response.rNote}
//                         </p>
//                     </span>

//                 </div>
//                 `;

//                 let containerProfile = document.querySelector('.div6');
//                 containerProfile.innerHTML = filling;
//             }
//         };

//         // send the request
//         http.send(`gotStu=${studentID}`);
//     });
// });
















































// let selectMenu = document.querySelector('#selector');
// let container = document.querySelector('.studentList');

// selectMenu.addEventListener("change", function() {
//     // optionMenu.classList.toggle("active");

//     let statusOfSelect = this.value;
//     //console.log(statusOfSelect);
    

//     let http = new XMLHttpRequest();

//     http.open('POST',"http://localhost/StudentCare/Counsellor/filterStatus" );

//     http.onload = function(){

//         if(http.readyState == 4 && http.status == 200){
//             //console.log(http.responseText);
//             let response = JSON.parse(http.responseText);
//             // console.log(response);
//             let out = "";

//             for(let stu of response){
//                 out += `
//                 <button id="clickStu" class="student"  value="${stu.studentID}">${stu.studentName}</button><br>
//                 `;
//             }

//             container.innerHTML = out;

//         }
//     }

//     http.setRequestHeader("content-type","application/x-www-form-urlencoded");

//     http.send("statusPP="+statusOfSelect);
// });


////////////////////////////////////////////////////////////////////////////////////////////////


// To get the particular student details when click on their names





