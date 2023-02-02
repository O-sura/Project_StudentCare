function gallery(smallImg){
    var fullImg = document.getElementById("preview");
    fullImg.src = smallImg.src;
}



let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function(){
    sidebar.classList.toggle("active");
}

/* var day = document.lastModified;
document.getElementById("date").innerHTML = day; */

