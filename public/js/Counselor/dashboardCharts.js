//For Pie chart
var ctx = document.getElementById("pieChart").getContext("2d");

fetch("http://localhost/StudentCare/Counsellor/getAppointmentStats")
  .then((response) => response.json())
  .then((data) => {
    //console.log(data);
    let pending = 0;
    let completed = 0;
    let requested = 0;
    let cancelled = 0;

    data.forEach((obj) => {
      if (obj.appointmentStatus == 0) {
        pending = obj.count === undefined || obj.count === null ? 0 : obj.count;
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

    let labels = ["Pending", "Completed", "Requested_to_Cancel", "Cancelled"];

    var myPieChart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: labels,
        datasets: [
          {
            label: labels,
            data: [pending, completed, requested, cancelled],
            backgroundColor: ["#87cefa", "#483d8b", "#ff7f50", "#e1c827"],
            borderColor: ["#87cefa", "#483d8b", "#ff7f50", "#e1c827"],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: "",
        },
        labels: {
          boxWidth: 5,
          fontSize: 12,
          fontColor: "black",
        },
        legend: {
          display: false, // set display to false to hide the legend
        },
      },
    });
  })
  .catch((error) => console.error(error));

// For bar chart

var ctx1 = document.getElementById("myChart").getContext("2d");

fetch("http://localhost/StudentCare/Counsellor/getDatailForBarChart")
  .then((response) => response.json())
  .then((data) => {
    let sunCount = 0;
    let monCount = 0;
    let tueCount = 0;
    let wedCount = 0;
    let thurCount = 0;
    let friCount = 0;
    let satCount = 0;

    data.forEach((obj) => {
      if (obj.dayOfWeek == 1) {
        sunCount = obj.count;
      } else if (obj.dayOfWeek == 2) {
        monCount = obj.count;
      } else if (obj.dayOfWeek == 3) {
        tueCount = obj.count;
      } else if (obj.dayOfWeek == 4) {
        wedCount = obj.count;
      } else if (obj.dayOfWeek == 5) {
        thurCount = obj.count;
      } else if (obj.dayOfWeek == 6) {
        friCount = obj.count;
      } else if (obj.dayOfWeek == 7) {
        satCount = obj.count;
      }
    });

    console.log(satCount);

    var xValues = ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"];
    var barColors = [
      "#483d8b",
      "#ff7f50",
      "#87cefa",
      "#483d8b",
      "#ff7f50",
      "#87cefa",
      "#483d8b",
    ];

    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [
          {
            backgroundColor: barColors,
            data: [
              sunCount,
              monCount,
              tueCount,
              wedCount,
              thurCount,
              friCount,
              satCount,
            ],
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
                },
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
            },
          ],
        },
      },
    });
  })
  .catch((error) => console.error(error));
