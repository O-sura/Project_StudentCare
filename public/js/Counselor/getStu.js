
let clickBtn = document.querySelector('#clickStu');
let containerProfile = document.querySelector('.div6');

clickBtn.addEventListener("change",function(){

    let whichStu = this.value;

    let xhr = new.XMLHttpRequest();

    xhr.open('POST',"http://localhost/StudentCare/Counsellor/selectStudent" );

    xhr.onload = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            let response = JSON.parse(xhr.responseText);

            let filling = '';

            for(let res of response){
                filling += `

                <div class="imageSection">
                    <div class="img">
                        <img class="dpImg" src="http://localhost/StudentCare/public/img/counselor/${res.profile_img}" alt=""><br>
                        </div>" alt="">
                    </div>
                    <div class="btnDiv">
                        <button class="accept"><i class="fa-solid fa-user-plus"></i>   Accept</button>
                        <button class="decline"><i class="fa-solid fa-user-minus"></i>  Decline</button>
                    </div>

                </div>
                <div class="infoSection">
                    <br><label for="name">Name  : </label>${res.studentName}<br>
                    <label for="age">Age    : </label>${res.dob}<br>
                    <label for="uni">University : </label>${res.university}<br>
                    <label for="address">Address    : </label>${res.location}<br>
                    <label for="email">University email : </label>

                    <span>
                        <h3 class="note">  Request Note : </h3>
                        <p class="noted">
                        ${res.rNote}
                        </p>
                    </span>

                </div>
                
                `;
            }

            containerProfile.innerHTML = filling;
        }
    }

    http.setRequestHeader("content-type","application/x-www-form-urlencoded");

    http.send("gotStu="+whichStu);
});