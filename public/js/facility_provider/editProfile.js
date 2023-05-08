let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function(){
  sidebar.classList.toggle("active");
}

//go back to previous page
document.getElementById("back-link").addEventListener("click", function() {
  history.go(-1);
});
