let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function(){
  sidebar.classList.toggle("active");
}

//go back to previous page
document.getElementById("back-link").addEventListener("click", function() {
  history.go(-1);
});


//to load the modal start delete profile
var modal = document.getElementById("myModal");
var btns = document.getElementsByClassName("dlt");
var span = document.getElementsByClassName("close")[0];
var noBtn = document.getElementsByClassName("btnCan")[0];

for (var i = 0; i < btns.length; i++) {
  btns[i].onclick = function () {
    modal.style.display = "block";
  };
}

span.onclick = function () {
  modal.style.display = "none";
};

noBtn.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};