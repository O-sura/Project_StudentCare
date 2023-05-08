//Javascript for chart
var xValues = [
  "1",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
  "10",
  "11",
  "12",
  "13",
  "14",
  "15",
  "16",
  "17",
  "18",
  "19",
  "20",
  "21",
  "22",
  "23",
  "24",
  "25",
  "26",
  "27",
  "28",
  "29",
  "30",
];
var yValues = [
  1, 4, 2, 3, 2, 4, 3, 2, 3, 4, 1, 2, 3, 4, 2, 1, 2, 3, 4, 5, 3, 2, 1, 2, 3, 4,
  5, 4, 3, 2, 1,
];
var barColors = [
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
  "#d1e189",
];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [
      {
        backgroundColor: barColors,
        data: yValues,
        hoverOffset: 4,
      },
    ],
  },

  options: {
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
