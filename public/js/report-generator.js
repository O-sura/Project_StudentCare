import { Report } from "./report.js";

const optionMenu = document.querySelectorAll('.dropdown-menu');
    optionMenu.forEach(menu => {
        const selectBtn = menu.querySelector('.select-btn');
        const options = menu.querySelectorAll('.option');
        const btnText = menu.querySelector('.Sbtn-text');

        selectBtn.addEventListener("click", () => {
            menu.classList.toggle("active");
        })

        options.forEach(option => {
            option.addEventListener("click", () => {
                let selectedOption = option.innerHTML;
                btnText.innerText = selectedOption;

                menu.classList.remove("active");
            })
        })
    });

let generateBtn = document.getElementById('report-generate-button');

generateBtn.addEventListener('click', () => {
    const organizationName = "StudentCare";
    const logoURL = "http://localhost/StudentCare/public/img/StudentCare_logo.jpg";
    const chartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasetLabel: "Sales",
    datasetData: [65, 59, 80, 81, 56, 55, 40],
    datasetBackgroundColor: "rgba(255, 99, 132, 0.2)",
    datasetBorderColor: "rgba(255, 99, 132, 1)",
    };
    const tableData = [
    ["John Doe", "johndoe@example.com", "$100.00"],
    ["Jane Smith", "janesmith@example.com", "$150.00"],
    ["Bob Johnson", "bobjohnson@example.com", "$75.00"],
    ];
    const report = new Report(organizationName, logoURL, chartData, tableData);
    const html = report.generateHTML();
    generateReport(html);
})

 // function to trigger report generation request with the appropriate html template and data
  function generateReport(templateData) {
    var xhr = new XMLHttpRequest();
    var url = "http://localhost/StudentCare/admin/reports/";
    
    var params = "template=" + encodeURIComponent(templateData);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // var response = xhr.responseText;
        // console.log(response);
        console.log('Done');
      }
    };
    xhr.send(params);
  }
  
