var ctx = document.getElementById("pieChart").getContext("2d");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3],
      backgroundColor: [
        '#87cefa',
        '#483d8b',
        '#ff7f50'
      ],
      borderColor: [
        '#87cefa',
        '#483d8b',
        '#ff7f50'
      ],
      borderWidth: 1,
      hoverOffset: 4
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'top',
    },
    title: {
      display: true,
      text: ''
    }
  }
});