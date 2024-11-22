var specialDates; // Declare specialDates as a global variable

window.onload = function() {
  loadDates();
};


function loadDates() {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Tasks/get_task_dates",
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      // Parse the JSON response from the server
      var searchRes = JSON.parse(xhr.responseText);
      var taskDates = JSON.parse(searchRes.dates);
      const valuesArray = taskDates.map((obj) => obj.task_date);

      specialDates = valuesArray; // Assign valuesArray to specialDates global variable

      const currentDate = document.querySelector('.current-date');
      daysTag = document.querySelector('.days');
      prevNextIcon = document.querySelectorAll('.icons i');
      var clickdate;


      //get current date
      let date = new Date();
      currYear = date.getFullYear();
      currMonth = date.getMonth();
      const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      const renderCalendar = () => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(); //get first day of month
        let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(); //get last day
        let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(); //get last day of month
        let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); //get last day of last month
        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) {
          liTag = liTag + `<li class="inactive">${lastDateofLastMonth-i+1}</li>`;
        }

        for (let i = 1; i <= lastDateofMonth; i++) {
          let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? 'active' : 'others';
          let dateString = `${currYear}-${("0" + (currMonth + 1)).slice(-2)}-${("0" + i).slice(-2)}`;

          if (specialDates.includes(dateString)) {
            isToday = 'special';
          }
          liTag = liTag + `<li class="${isToday}">${i}</li>`;
        }

        for (let i = lastDayofMonth; i < 6; i++) {
          liTag = liTag + `<li class="inactive">${i-lastDayofMonth+1}</li>`;
        }


        currentDate.innerText = `${months[currMonth]} ${currYear}`;
        daysTag.innerHTML = liTag;
        clickdate = document.querySelectorAll('.days li.others');
        clickToday = document.querySelectorAll('.days li.special');

        clickdate.forEach(date => {
          date.addEventListener('click', () => {
            let day = date.innerText;
            let month = currMonth + 1;
            let year = currYear;
            let x = year.toString() + "-" + month.toString() + "-" + day.toString();
            document.getElementById("date").value = x;
            document.getElementById("form").submit();


          });

        });

        clickToday.forEach(date => {
          date.addEventListener('click', () => {
            let day = date.innerText;
            let month = currMonth + 1;
            let year = currYear;
            let x = year.toString() + "-" + month.toString() + "-" + day.toString();
            document.getElementById("date").value = x;
            document.getElementById("form").submit();

          });

        });
      }

      renderCalendar();


      prevNextIcon.forEach(icon => {
        icon.addEventListener('click', () => {
          currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

          if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth);
            currYear = date.getFullYear();
            currMonth = date.getMonth();
          } else {
            date = new Date();
          }
          renderCalendar();

        });
      });
    }
  };

  xhr.send();
}


function DoSubmit() {
  return true;
}

btn.onclick = function() {
  sidebar.classList.toggle("active");
}

var xValues = ["Tasks completed"];
var yValues = [55, 100];
var barColors = [
  "#1A285A",
  "#f5f5f5"
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Percentage of tasks completed"
    }
  }
});