
//Handling the collapsing and opening of the menu
let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function(){
    sidebar.classList.toggle("active");
}

//Highlight the current page we are in
// Get all the sidebar links
const navLinks = document.querySelectorAll('.nav_list a');
const currentUrl = window.location.href;

/*
Note for me:
closest() method searches up the DOM tree for elements which matches a specified CSS selector.
It starts at the element itself, then the anchestors (parent, grandparent, ...) until a match is found.
returns null() if no match is found.
*/

navLinks.forEach(link => {
  if (link.href === currentUrl) {
    link.closest('li').classList.add('active');
  }
});
