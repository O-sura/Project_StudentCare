import { Announcement } from "./announcements.js";

//Clear all the posts currently showing to the user
function clearposts() {
  let posts = document.querySelectorAll(".row3");
  if (posts != null) {
    posts.forEach((post) => {
      post.parentNode.removeChild(post);
    });
  }
}

// Get the select element
const sortFilter = document.getElementById("sorter");
// Add onchange event listener to the select element
sortFilter.onchange = () => {
  // Get the selected option value
  const filter = document.getElementById("filter").value;
  const selectedOption = sortFilter.value;

  // Call the dropdownFilter function with the selected option value
  dropdownFilter(selectedOption,filter);
};

//Function to filter the community posts based on the dropdown value
function dropdownFilter(optionx,optiony) {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Announcements/announcement_sort_handler/?sort=" +
    optionx +
    "&filter=" +
    optiony,
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      //Parse the JSON response from the server
      var searchRes = JSON.parse(xhr.responseText);

      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("list");
      let postList = "";

      for (var i = 0; i < searchRes.length; i++) {
        let result = searchRes[i];
        //console.log(result);
        //id, head, name, date, img
        let post = new Announcement(
          result.post_id,
          result.post_head,
          result.fullname,
          result.posted_date,
          result.profile_img
        );

        postList += post.createDetails();
      }
      resultList.innerHTML = postList;
      // Iterate through the posts
      var posts = document.querySelectorAll(".topic");
      for (var i = 0; i < posts.length; i++) {
        (function (post) {
          var postId = post.getAttribute("data-id");

          // Check if the post has already been clicked
          if (clickedPosts.indexOf(postId) !== -1) {
            // Fade out the post
            post.style.opacity = 0.5;
          }

          // Attach a click event to the post
          post.addEventListener("click", function () {
            // Add the post to the list of clicked posts
            clickedPosts.push(postId);
            document.cookie =
              "clickedPosts=" +
              encodeURIComponent(JSON.stringify(clickedPosts)) +
              "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";

            // Fade out the post
            post.style.opacity = 0.5;
          });
        })(posts[i]);
      }
    }
  };
  xhr.send();
}

// Get the select element
const starFilter = document.getElementById("filter");
// Add onchange event listener to the select element
starFilter.onchange = () => {
  // Get the selected option value
  const sort = document.getElementById("sorter").value;
  const selectedOption2 = starFilter.value;

  // Call the dropdownFilter function with the selected option value
  dropdownFilter2(sort, selectedOption2);
};

//Function to filter the community posts based on the dropdown value
function dropdownFilter2(option1, option2) {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Announcements/announcement_filter_handler/?sort=" +
      option1 +
      "&filter=" +
      option2,
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      //Parse the JSON response from the server
      var searchRes = JSON.parse(xhr.responseText);

      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("list");
      let postList = "";

      for (var i = 0; i < searchRes.length; i++) {
        let result = searchRes[i];
        //console.log(result);
        //id, head, name, date, img
        let post = new Announcement(
          result.post_id,
          result.post_head,
          result.fullname,
          result.posted_date,
          result.profile_img
        );

        postList += post.createDetails();
      }
      resultList.innerHTML = postList;
      // Iterate through the posts
      var posts = document.querySelectorAll(".topic");
      for (var i = 0; i < posts.length; i++) {
        (function (post) {
          var postId = post.getAttribute("data-id");

          // Check if the post has already been clicked
          if (clickedPosts.indexOf(postId) !== -1) {
            // Fade out the post
            post.style.opacity = 0.5;
          }

          // Attach a click event to the post
          post.addEventListener("click", function () {
            // Add the post to the list of clicked posts
            clickedPosts.push(postId);
            document.cookie =
              "clickedPosts=" +
              encodeURIComponent(JSON.stringify(clickedPosts)) +
              "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";

            // Fade out the post
            post.style.opacity = 0.5;
          });
        })(posts[i]);
      }
    }
  };
  xhr.send();
}

const searchBtn = document.getElementById("search-btn");
searchBtn.addEventListener("click", searchListing);

//Search listings
function searchListing() {
  // Send an AJAX request to the server with the search query
  const searchbox = document.getElementById("search-box");
  const keyword = searchbox.value;
  const filter = document.getElementById("filter").value;
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Announcements/announcement_search_handler/?query=" +
      keyword +
      "&filter=" +
      filter,
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      //Parse the JSON response from the server
      var searchRes = JSON.parse(xhr.responseText);
      //console.log(searchRes)
      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("list");
      let postList = "";

      for (var i = 0; i < searchRes.length; i++) {
        let result = searchRes[i];
        //console.log(result);
        //id,name,description,img,specialization
        let post = new CounselorList(
          result.userID,
          result.fullname,
          result.counselor_description,
          result.profile_img,
          result.specialization
        );

        postList += post.createDetails();
      }
      resultList.innerHTML = postList;
    }
  };
  xhr.send();
}

feather.replace();
let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function () {
  sidebar.classList.toggle("active");
};

// Get the list of clicked posts from the cookie
var clickedPosts = (function () {
  var cookie = document.cookie.match(/(^|;)\s*clickedPosts\s*=\s*([^;]+)/);
  return cookie ? JSON.parse(decodeURIComponent(cookie[2])) : [];
})();
