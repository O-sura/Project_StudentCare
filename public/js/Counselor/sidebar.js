//Handling the collapsing and opening of the menu
let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function () {
  sidebar.classList.toggle("active");
};

const navLinks = document.querySelectorAll(".nav_list a");
const currentUrl = window.location.href;
navLinks.forEach((link) => {
  if (link.href === currentUrl) {
    link.closest("li").classList.add("active");
  }
});
