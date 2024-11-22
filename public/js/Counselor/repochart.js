const yearDropdown = document.querySelector("#year");
const monthDropdown = document.querySelector("#month");

let allAppointments = document.querySelector("#total");
let completedAppointments = document.querySelector("#completed");
let cancelledAppointmnets = document.querySelector("#cancelled");

// Add event listener to year dropdown
yearDropdown.addEventListener("change", () => {
  const selectedYear = yearDropdown.value;
  // console.log(`Selected year: ${selectedYear}`);
  // console.log(`Selected year : ${monthDropdown.value}`);
  // Call the fetch function with selected year and month
  fetchTilesData(selectedYear, monthDropdown.value);
  fetchData(selectedYear, monthDropdown.value);
});

// Add event listener to month dropdown
monthDropdown.addEventListener("change", () => {
  const selectedMonth = monthDropdown.value;
  // console.log(`Selected month: ${selectedMonth}`);
  // console.log(`Selected year : ${yearDropdown.value}`);
  // Call the fetch function with selected year and month
  fetchTilesData(yearDropdown.value, selectedMonth);
  fetchData(yearDropdown.value, selectedMonth);
});

function fetchTilesData(year, month) {
  fetch(
    `http://localhost/StudentCare/CounselorReport/appMonthStatsForTiles?year=${year}&month=${month}`
  )
    .then((response) => response.json())
    .then((data) => {
      //console.log(data);
      let pending = 0;
      let completed = 0;
      let requested = 0;
      let cancelled = 0;

      data.forEach((obj) => {
        if (obj.appointmentStatus == 0) {
          pending =
            obj.count === undefined || obj.count === null ? 0 : obj.count;
        } else if (obj.appointmentStatus == 1) {
          completed =
            obj.count === undefined || obj.count === null ? 0 : obj.count;
        } else if (obj.appointmentStatus == 2) {
          requested =
            obj.count === undefined || obj.count === null ? 0 : obj.count;
        } else if (obj.appointmentStatus == 3) {
          cancelled =
            obj.count === undefined || obj.count === null ? 0 : obj.count;
        }
      });

      let allApp =
        Number(pending) +
        Number(completed) +
        Number(requested) +
        Number(cancelled);
      //console.log(allApp);

      allAppointments.innerHTML = `${allApp}`;
      completedAppointments.innerHTML = `${completed}`;
      cancelledAppointmnets.innerHTML = `${cancelled}`;
    })
    .catch((error) => console.error(error));
}

var ctx1 = document.getElementById("myChart").getContext("2d");

// Fetch function to get data for selected year and month
function fetchData(year, month) {
  fetch(
    `http://localhost/StudentCare/CounselorReport/appMonthStats?year=${year}&month=${month}`
  )
    .then((response) => response.json())
    .then((data) => {
      //console.log(data);

      // Create a new date object with the last day of the previous month
      const lastDayOfPrevMonth = new Date(year, month, 0);

      // Get the number of days in the original month
      const numberOfDays = lastDayOfPrevMonth.getDate();

      //console.log(numberOfDays);
      const appDays = new Array(numberOfDays).fill(0);

      //console.log(numberOfDays);

      const xValues = [];

      for (let i = 1; i <= numberOfDays; i++) {
        xValues.push(i);
      }

      //To assign the number of appointments on corresponding day of each month
      for (const obj of data) {
        const day = parseInt(obj.dayOfMonth);
        const count = parseInt(obj.count);
        appDays[day - 1] += count;
      }

      //console.log(appDays);

      var barColors = "#87cefa";

      new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [
            {
              backgroundColor: barColors,
              data: appDays,
              hoverOffset: 1,
            },
          ],
        },

        options: {
          responsive: true,
          legend: {
            display: false,
          },
          title: {
            display: true,
            text: "",
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  min: 0,
                  max: 5,
                  beginAtZero: true,
                  gridLines: {
                    display: false,
                  }
                },
                
              },
            ],
            xAxes: [
              {
                ticks: {
                  gridLines: {
                    display: false,
                  },
                },
                gridLines: {
                  display: false,
                }
              },
            ],
          },
        },
      });
    })
    .catch((error) => console.error(error));
}
