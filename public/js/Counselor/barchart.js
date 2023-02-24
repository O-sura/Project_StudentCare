 //Javascript for chart
 var xValues = ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun"];
 var yValues = [1, 4, 2, 3, 2, 4, 3];
 var barColors = ["#483d8b", "#ff7f50", "#87cefa", "#483d8b", "#ff7f50", "#87cefa", "#483d8b"];

 new Chart("myChart", {
     type: "bar",
     data: {
         labels: xValues,
         datasets: [{
             backgroundColor: barColors,
             data: yValues,
             hoverOffset: 4
         }]
     },
    
     options: {
         legend: {
             display: false
         },
         title: {
             display: true,
             text: ""
         },
         scales:{
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    gridLines: {
                        display: false
                    }
                }
            }],
            xAxes: [{
                ticks: {
                    gridLines: {
                        display: false
                    }
                }
            }]
         }
     }
 });

