export class Report {
    constructor(organizationName, logoURL, chartData, tableData) {
      this.organizationName = organizationName;
      this.logoURL = logoURL;
      this.chartData = chartData;
      this.tableData = tableData;
    }
  
    generateHTML() {
      return `
        <!DOCTYPE html>
        <html>
          <head>
            <meta charset="UTF-8">
            <title>${this.organizationName} Report</title>
            <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
            <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.7">
          </head>
          <body>
            <header>
              <div class="logo">
                <img src="${this.logoURL}" alt="${this.organizationName} Logo">
              </div>
              <h1>${this.organizationName} Report</h1>
            </header>
            <main>
              <div class="chart">
                <canvas id="myChart"></canvas>
              </div>
              <div class="table">
                <table>
                  <thead>
                    <tr>
                      <th>Column 1</th>
                      <th>Column 2</th>
                      <th>Column 3</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${this.tableData.map(row => `
                      <tr>
                        <td>${row[0]}</td>
                        <td>${row[1]}</td>
                        <td>${row[2]}</td>
                      </tr>
                    `).join('')}
                  </tbody>
                </table>
              </div>
            </main>
            <script>
              /* JavaScript code for the charts */
              var ctx = document.getElementById('myChart').getContext('2d');
              var chartData = ${JSON.stringify(this.chartData)};
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: chartData.labels,
                  datasets: [{
                    label: chartData.datasetLabel,
                    data: chartData.datasetData,
                    backgroundColor: chartData.datasetBackgroundColor,
                    borderColor: chartData.datasetBorderColor,
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true
                      }
                    }]
                  }
                }
              });
            </script>
          </body>
        </html>
      `;
    }
    
    //Function to return html template code for generating report - Role[Student]
    generateHTMLTemplateStudent(){}

    //Function to return html template code for generating report - Role[Counselor]
    generateHTMLTemplateCounselor(){}

    //Function to return html template code for generating report - Role[Facility_Provider]
    generateHTMLTemplateFP(){}


  }
  