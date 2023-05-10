//Javascript for chart
//Function to filter the community posts based on the dropdown value

window.onload = function () {
  getStudyTimeDetails();
}

function getStudyTimeDetails(){
  //Your Posts,All Posts,Saved
  // Send an AJAX request to the server with the search query

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/StudentCare/Student/get_event_data/?filter=this", true);
 
  xhr.onload = () => {
      if (xhr.status === 200) {
          //console.log(xhr.responseText);
          //Parse the JSON response from the server
          var mondayHrs, tuesdayHrs, wednesdayHrs, thursdayHrs, fridayHrs, saturdayHrs, sundayHrs;
          var searchRes = JSON.parse(xhr.responseText);
          
          var daysOfWeek = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
          var dayHours = {};
          
          daysOfWeek.forEach(function(day) {
            var studyData = JSON.parse(searchRes[day]);
            dayHours[day] = studyData && studyData.studied_time ? parseInt(studyData.studied_time)/600000 : 0;
          });
          
          // Access the hours for each day using dayHours object
          var mondayHrs = dayHours["monday"];
          var tuesdayHrs = dayHours["tuesday"];
          var wednesdayHrs = dayHours["wednesday"];
          var thursdayHrs = dayHours["thursday"];
          var fridayHrs = dayHours["friday"];
          var saturdayHrs = dayHours["saturday"];
          var sundayHrs = dayHours["sunday"];
          
          var xValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday",
          ];
          var yValues = [mondayHrs, tuesdayHrs, wednesdayHrs, thursdayHrs, fridayHrs, saturdayHrs, sundayHrs];
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
                text: "Study minutes this week",
              },
            },
          });
      }
  };
  xhr.send();
}

  const chartFilter = document.getElementById("filter");
  chartFilter.onchange = () =>{
    const filter = chartFilter.value;
    if(filter == "this"){
      getStudyTimeDetails();
    }else if(filter == "14"){
      getDayStudyTimeDetails(14);
    }else{
      getDayStudyTimeDetails(30);
    }
  };

function getDayStudyTimeDetails(num){
  //Your Posts,All Posts,Saved
  // Send an AJAX request to the server with the search query

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/StudentCare/Student/get_event_data/?filter="+num, true);
 
  xhr.onload = () => {
      if (xhr.status === 200) {
          //console.log(xhr.responseText);
          //Parse the JSON response from the server
          var searchRes = JSON.parse(xhr.responseText);
          var today = new Date();
          var pastDays = [];
          for (var i = 0; i < num; i++) {
            var day = new Date(today);
            day.setDate(day.getDate() - i);
            var formattedDate = day.toISOString().split('T')[0];
           pastDays.push(formattedDate);
          }
          var dayHours = {};
         pastDays.forEach(function(day) {
            var studyData = JSON.parse(searchRes[day]);
            dayHours[day] = studyData && studyData.studied_time ? parseInt(studyData.studied_time)/600000 : 0;
          });

          var xValues = pastDays.reverse();
          var yValues = [];
          xValues.forEach(function(day) {
            yValues.push(dayHours[day]);
          });
          var barColors = [];
          yValues.forEach(function(hours) {
            
              barColors.push("#1A285A");
            
             
            
          });
          new Chart("myChart", {
            type: "line",  // Changed the chart type to "line"
            data: {
              labels: xValues,
              datasets: [
                {
                  borderColor: "#1A285A",  // Set the line color
                  backgroundColor: "rgba(26, 40, 90, 0.4)", // Add a blue shadingine
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
                text: "Study minutes past week",
              },
              scales: {
                x: {
                  display: true,
                  title: {
                    display: true,
                    text: "Days",
                  },
                },
                y: {
                  display: true,
                  title: {
                    display: true,
                    text: "Minutes",
                  },
                },
              },
            },
          });


       
      }
  };
  xhr.send();
}



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