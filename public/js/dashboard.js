var ctx = document.getElementById('users-chart').getContext('2d');

// Create random data set
var data = [];
for (var i = 0; i < 10; i++) {
  data.push(Math.floor(Math.random() * 100));
}

var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
    datasets: [{
      label: 'New Users',
      data: data,
      backgroundColor: 'rgba(0, 237, 156, 0.8)',
      borderColor: 'rgba(0, 237, 156, 0.8)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      xAxes: [{
        barThickness: 0.3,
        scaleLabel: {
          display: false
        },
        gridLines: {
          offsetGridLines: true
        }
      }],
      yAxes: [{
        scaleLabel: {
          display: false
        }
      }]
    }
  }
});

var ctx2 = document.getElementById('users-types');

new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Counselors', 'Students', 'Facility-Providers'],
      datasets: [{
        label: '# of Votes',
        data: [17,42,41],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  var ctx3 = document.getElementById('community-chart').getContext('2d');
  new Chart(ctx3, {
      type: 'line',
      data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{ 
            data: [86,114,106,106,107,111,133],
            label: "Posts",
            borderColor: "rgb(62,149,205)",
            backgroundColor: "rgb(62,149,205,0.1)",
            fill: true
          }, { 
            data: [10,21,60,44,17,21,17],
            label: "Comments",
            borderColor: "rgb(255,165,0)",
            backgroundColor:"rgb(255,165,0,0.1)",
            fill: true
          },
        ]
      },
    });

    var ctx4 = document.getElementById('total-listing').getContext('2d');
    new Chart(ctx4, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{ 
              data: [86,114,106,106,107,111,133],
              label: "Listings",
              borderColor: "rgb(62,149,205)",
              backgroundColor: "rgb(62,149,205,0.1)",
              fill: true
            }
          ]
        },
      });

var ctx5 = document.getElementById('listings-category');

new Chart(ctx5, {
    type: 'doughnut',
    data: {
      labels: ['Property', 'Food', 'Furniture and Equip.'],
      datasets: [{
        label: '# of Votes',
        data: [17,42,41],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
});