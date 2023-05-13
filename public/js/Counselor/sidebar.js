//Handling the collapsing and opening of the menu
let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function () {
  sidebar.classList.toggle("active");
};

let navlink = document.querySelector(".navtag");
const links = document.querySelectorAll(".nav_list a");
links.forEach(link => {
  const words = link.href.split('/');
  let curr_controller = "/" + words[words.length - 2] + "/" + words[words.length - 1];
  if(navlink.id === curr_controller){
    link.id = "chosen";
    console.log("Match")
  }
})

const navLinks = document.querySelectorAll(".nav_list a");
const currentUrl = window.location.href;
navLinks.forEach((link) => {
  if (link.href === currentUrl) {
    link.closest("li").classList.add("active");
  }
});
