function getDayBefore(day){
  let beforeDay = null;
  switch(day){
    case "Sunday":
      beforeDay = "Saturday";
      break;
    case "Monday":
      beforeDay = "Sunday";
      break;
    case "Tuesday":
      beforeDay = "Monday";
      break;
    case "Wednesday":
      beforeDay = "Tuesday";
      break;
    case "Thursday":
      beforeDay = "Wednesday";
      break;
    case "Friday":
      beforeDay = "Thursday";
      break;
    case "Saturday":
      beforeDay = "Friday";
      break;
  }
  return beforeDay;
}

//function for arranging the data returned by the fetch into proper order
//to be used for creating the charts
function getSortedData(data,labelColName,countColName){
  let reg_date = data.map(obj => obj[labelColName]);
  let count = data.map(obj => obj[countColName]);

  let lDate = [];
  // Create an array with the names of the days
  const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  // Create a new Date object
  const today = new Date();

  // Get the day of the week (0-6)
  const dayIndex = today.getDay();

  // Get the name of the day
  const dayName = days[dayIndex];
  lDate.push(dayName);

  //For all the unpresent days with 0 registered users, add them to the data as well
  while(lDate.length < 7){
    let fdate = lDate[0];
    lDate.unshift(getDayBefore(fdate));
  }
  
  // Create an object to hold the count for each day
  const dayList = {};
  lDate.forEach(day => dayList[day] = 0);

  data.forEach(item => {
    dayList[item[labelColName]] = item[countColName];
  });
  
  // Sort chartData by the order of daysOfWeek
  const sortedData = Object.entries(dayList).sort(([day1, count1], [day2, count2]) => {
    return lDate.indexOf(day1) - lDate.indexOf(day2);
  });

  return sortedData;
}


//function for handling and displaying the last-7 days registered user chart
var ctx = document.getElementById('users-chart').getContext('2d');

fetch('http://localhost/StudentCare/admin/get_lastweek_users')
  .then(response => response.json())
  .then(data => {
    
    const sortedData = getSortedData(data,"reg_date","count");

    let labels = sortedData.map(([day, count]) => day);
    let dataValues = sortedData.map(([day, count]) => count);

    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'New Users',
          data: dataValues,
          backgroundColor: 'rgba(0, 237, 156, 0.8)',
          borderColor: 'rgba(0, 237, 156, 0.8)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      },
      
    });    

  })
  .catch(error => console.error(error));


//Js code for the chart represents the count of the users based on their role
var ctx2 = document.getElementById('users-types');

fetch('http://localhost/StudentCare/admin/get_role_data')
  .then(response => response.json())
  .then(data => {
    let role_count = data.map(obj => obj.count);
    let userroles = data.map(obj => obj.user_role);

    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: userroles,
        datasets: [{
          label: '# of Votes',
          data: role_count,
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

  })
  .catch(error => console.error(error));


  var ctx3 = document.getElementById('community-chart').getContext('2d');

  fetch('http://localhost/StudentCare/admin/get_post_data')
  .then(response => response.json())
  .then(data => {
    
     let sortedPostData = getSortedData(data,"posted_date","count");
     
     if(sortedPostData){
      fetch('http://localhost/StudentCare/admin/get_comment_data')
      .then(response => response.json())
      .then(data => {
        let sortedCommentData = getSortedData(data,"posted_date","count");
        let labels = sortedPostData.map(([day, count]) => day);
        let postValues = sortedPostData.map(([day, count]) => count);
        let commentValues = sortedCommentData.map(([day, count]) => count);

        new Chart(ctx3, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{ 
                data: postValues,
                label: "Posts",
                borderColor: "rgb(62,149,205)",
                backgroundColor: "rgb(62,149,205,0.1)",
                fill: true
              }, { 
                data: commentValues,
                label: "Comments",
                borderColor: "rgb(255,165,0)",
                backgroundColor:"rgb(255,165,0,0.1)",
                fill: true
              },
            ]
          },
        });
            

      })
      .catch(error => console.error(error));
      }
  })
  .catch(error => console.error(error));

  

    var ctx4 = document.getElementById('total-listing').getContext('2d');

    fetch('http://localhost/StudentCare/admin/get_listing_data')
    .then(response => response.json())
    .then(data => {
      
      const sortedData = getSortedData(data,"posted_date","count");

      let labels = sortedData.map(([day, count]) => day);
      let dataValues = sortedData.map(([day, count]) => count);

      new Chart(ctx4, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{ 
              data: dataValues,
              label: "Listings",
              borderColor: "rgb(62,149,205)",
              backgroundColor: "rgb(62,149,205,0.1)",
              fill: true
            }
          ]
        },
      });  

    })
    .catch(error => console.error(error));
