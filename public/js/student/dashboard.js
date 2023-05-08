//Javascript for chart
var xValues = [
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
  "Sunday",
];
var yValues = [5, 6, 13, 13, 1, 6, 7];
var barColors = [
  "#1A285A",
  "#1A285A",
  "#1A285A",
  "#1A285A",
  "#1A285A",
  "#1A285A",
  "#1A285A",
];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [
      {
        backgroundColor: barColors,
        data: yValues,
      },
    ],
  },
  options: {
    legend: {
      display: false,
    },
    title: {
      display: true,
      text: "Study hours this week",
    },
  },
});

var edit = document.querySelector("#edit");
var messages = document.querySelector("#messages");
var tasks = document.querySelector("#tasks");
var announcements = document.querySelector("#announcements");
var appointments = document.querySelector("#appointments");
messages.addEventListener("click", function () {
  window.location.href = "http://localhost/StudentCare/messaging/";
});
tasks.addEventListener("click", function () {
  window.location.href = "http://localhost/StudentCare/Tasks/";
});
announcements.addEventListener("click", function () {
  window.location.href = "http://localhost/StudentCare/Announcements/";
});
appointments.addEventListener("click", function () {
  window.location.href = "http://localhost/StudentCare/Appointments/";
});

edit.addEventListener("click", function () {
  window.location.href = "http://localhost/StudentCare/Student/profile";
});

function showPopup() { //show modal for cancel appointment
    var popup = document.querySelector(".overlay");
    popup.style.display = "block";
}

const overlay = document.querySelector('.overlay');
const popup = overlay.querySelector('.popup');
const exitButton = popup.querySelector('.exit-button');

function closePopup() {
    var popup = document.querySelector(".overlay");
    popup.style.display = "none";
}

exitButton.addEventListener('click', closePopup);
overlay.addEventListener('click', (event) => {
    if (event.target === overlay) {
        closePopup();
    }
});

const feedbackBtn = document.querySelector('#feedback');
feedbackBtn.addEventListener('click', () => {
    showPopup();
});