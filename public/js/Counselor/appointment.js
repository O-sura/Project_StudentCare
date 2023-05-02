var specialDates ;
//To highlight the dates that has appointments
fetch('http://localhost/StudentCare/CounselorAppointment/makeColoredAppointedDates')
    .then(response => response.json())
    .then(data => {
        specialDates = data;
        //console.log(specialDates);

        const currentDate = document.querySelector('.current-date');
        daysTag = document.querySelector('.days');
        prevNextIcon =  document.querySelectorAll('.icons i');
        var clickdate;
        var clickSpecial;
    
    
        //get current date
        let date = new Date();
        currYear = date.getFullYear();
        currMonth = date.getMonth();
    
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const renderCalendar = () => {
            let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(); //get first day of month
            let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();//get last day
            let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();//get last day of month
            let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();//get last day of last month
            let liTag = "";
    
            for(let i = firstDayofMonth; i>0;i--){
                liTag = liTag + `<li class="inactive">${lastDateofLastMonth-i+1}</li>`;
            }
    
            for(let i = 1; i <= lastDateofMonth; i++){
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? 'active' : 'others';
                let dateString = `${currYear}-${("0" + (currMonth + 1)).slice(-2)}-${("0" + i).slice(-2)}`;
                
    
                if (specialDates.includes(dateString) && isToday != 'active') {
                    isToday = 'special';
                  }
                  liTag = liTag + `<li class="${isToday}">${i}</li>`;
            }
    
            for(let i = lastDayofMonth;i<6;i++){
                liTag = liTag + `<li class="inactive">${i-lastDayofMonth+1}</li>`;
            }
    
    
            currentDate.innerText = `${months[currMonth]} ${currYear}`;
            daysTag.innerHTML = liTag;
            clickdate = document.querySelectorAll('.days li.others');
            clickToday = document.querySelectorAll('.days li.active');
            clickSpecial = document.querySelectorAll('.days li.special');
            
    
            clickdate.forEach(date=>{
                date.addEventListener('click', ()=>{
                    let day = date.innerText;
                    let month = currMonth + 1;
                    let year = currYear;
                    let x = year.toString() + "-" + month.toString() + "-" + day.toString(); 
                    document.getElementById("date").value = x;
                    document.getElementById("form").submit();
                    
                    
                });
    
            });
    
            clickToday.forEach(date=>{
                date.addEventListener('click', ()=>{
                    let day = date.innerText;
                    let month = currMonth + 1;
                    let year = currYear;
                    let x = year.toString() + "-" + month.toString() + "-" + day.toString();
                    document.getElementById("date").value = x;
                    document.getElementById("form").submit();
                    
                });
            
            });
    
            clickSpecial.forEach(date=>{
                date.addEventListener('click', ()=>{
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
    
    
        prevNextIcon.forEach(icon=>{
            icon.addEventListener('click', ()=>{
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
    
                if(currMonth <0 || currMonth > 11){
                    date = new Date(currYear, currMonth);
                    currYear = date.getFullYear();
                    currMonth = date.getMonth();
                }else{
                    date = new Date();
                }
                renderCalendar();
                
            });
        });
    
        function DoSubmit(){
            return true;
        }
    
    

        
    })
    .catch(error => console.error(error));

// specialDates can be accessed outside the fetch call


   




















// //
// const currentDate = document.querySelector('.current-date');
// daysTag = document.querySelector('.days');
// prevNextIcon =  document.querySelectorAll('.icons i');
// var clickdate;


// //get current date
// let date = new Date();
// currYear = date.getFullYear();
// currMonth = date.getMonth();

// const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
// const renderCalendar = () => {
//     let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(); //get first day of month
//     let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();//get last day
//     let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();//get last day of month
//     let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();//get last day of last month
//     let liTag = "";

//     for(let i = firstDayofMonth; i>0;i--){
//         liTag = liTag + `<li class="inactive">${lastDateofLastMonth-i+1}</li>`;
//     }

//     for(let i = 1; i <= lastDateofMonth; i++){
//         let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? 'active' : 'others';
//         let dateString = `${currYear}-${("0" + (currMonth + 1)).slice(-2)}-${("0" + i).slice(-2)}`;
        

//         if (specialDates.includes(dateString)) {
//             isToday = 'special';
//           }
//         liTag = liTag + `<li class="${isToday}">${i}</li>`;
//     }

//     for(let i = lastDayofMonth;i<6;i++){
//         liTag = liTag + `<li class="inactive">${i-lastDayofMonth+1}</li>`;
//     }


//     currentDate.innerText = `${months[currMonth]} ${currYear}`;
//     daysTag.innerHTML = liTag;
//     clickdate = document.querySelectorAll('.days li.others');
//     clickToday = document.querySelectorAll('.days li.active');

//     clickdate.forEach(date=>{
//         date.addEventListener('click', ()=>{
//             let day = date.innerText;
//             let month = currMonth + 1;
//             let year = currYear;
//             let x = year.toString() + "-" + month.toString() + "-" + day.toString(); 
//             document.getElementById("date").value = x;
//             document.getElementById("form").submit();
            
             
//         });

//     });

//     clickToday.forEach(date=>{
//         date.addEventListener('click', ()=>{
//             let day = date.innerText;
//             let month = currMonth + 1;
//             let year = currYear;
//             let x = year.toString() + "-" + month.toString() + "-" + day.toString();
//             document.getElementById("date").value = x;
//             document.getElementById("form").submit();
            
//         });
    
//     });
// }

// renderCalendar();


// prevNextIcon.forEach(icon=>{
//     icon.addEventListener('click', ()=>{
//         currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

//         if(currMonth <0 || currMonth > 11){
//             date = new Date(currYear, currMonth);
//             currYear = date.getFullYear();
//             currMonth = date.getMonth();
//         }else{
//             date = new Date();
//         }
//         renderCalendar();
        
//     });
// });

// function DoSubmit(){
//     return true;
// }

// btn.onclick = function(){
//     sidebar.classList.toggle("active");
//   }


