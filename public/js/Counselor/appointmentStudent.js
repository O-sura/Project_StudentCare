
// To get the particular student details when click on their names
let clickDivs = document.querySelectorAll('#stu');
let containerProfile = document.querySelector('.right');

clickDivs.forEach((div) =>{
    div.addEventListener("click",function(){
         //console.log("Hello");

    let whichStu = this.value;
    //console.log(whichStu);

    let xhr = new XMLHttpRequest();

    xhr.open('POST',"http://localhost/StudentCare/CounselorAppointment/selectAppointedStudent" );

    xhr.onload = function(){

       // console.log(xhr.readyState)

        if(xhr.readyState == 4 && xhr.status == 200){
            
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);
            
    
            let filling = '';

            //for(let res of response){
                filling += `

                <div class="stu" id="stu">

                    <div class="imagePP">
                        <img class="imggPPP" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt=""> 
                    </div>

                    <p class="fname">${response.fullname}</p>
                    <p class="address">${response.home_address}</p>
                    <hr class="hr2">
                    <p class="detail">Student Details</p>
                    <p class="dob">DOB  : ${response.dob}</p>
                    <p class="email">Email  : ${response.email}
                    <p class="uni">University   : ${response.university}</p>
                    <p class="note">Notice  : Get some advices for studies</p>


                </div>
                
                `;
            //}

            containerProfile.innerHTML = filling;
        }
    }

    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");

    xhr.send("gotStu="+whichStu);
    });
});
