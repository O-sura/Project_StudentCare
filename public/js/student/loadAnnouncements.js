import { Announcement } from "./announcements.js";
import { SavedAnnouncement } from "./saved_announcements.js";
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
  dropdownFilter(selectedOption, filter);
};

//Function to filter the community posts based on the dropdown value
function dropdownFilter(optionx, optiony) {
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
      // Access the announcements and savedAnnouncements arrays
      var announcements = JSON.parse(searchRes.announcements);
      var savedAnnouncements = JSON.parse(searchRes.savedAnnouncements);
      const valuesArray = savedAnnouncements.map((obj) => obj.announcement_id);
      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("list");
      let postList = "";

      for (var i = 0; i < announcements.length; i++) {
        let result = announcements[i];
        //id, head, name, date, img
        if (valuesArray.includes(result.post_id)) {
          let post = new SavedAnnouncement(
            result.post_id,
            result.post_head,
            result.fullname,
            result.posted_date,
            result.profile_img
          );
          console.log("saved");
          postList += post.createDetails();
        } else {
          let post = new Announcement(
            result.post_id,
            result.post_head,
            result.fullname,
            result.posted_date,
            result.profile_img
          );
          console.log("not saved");
          postList += post.createDetails();
        }
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
      // Get all star icon elements by their class
      var starIcons = document.getElementsByClassName("star");

      // Loop through all star icon elements and add onclick function
      for (var i = 0; i < starIcons.length; i++) {
        starIcons[i].onclick = function () {
          // Get the ID of the star icon
          var iconId = this.children[0].id;

          // Alert the ID of the star icon
          saveAnnouncement(iconId);
        };
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
      // Access the announcements and savedAnnouncements arrays
      var announcements = JSON.parse(searchRes.announcements);
      var savedAnnouncements = JSON.parse(searchRes.savedAnnouncements);
      const valuesArray = savedAnnouncements.map((obj) => obj.announcement_id);
      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("list");
      let postList = "";

      for (var i = 0; i < announcements.length; i++) {
        let result = announcements[i];
        //id, head, name, date, img
        if (valuesArray.includes(result.post_id)) {
          let post = new SavedAnnouncement(
            result.post_id,
            result.post_head,
            result.fullname,
            result.posted_date,
            result.profile_img
          );
          console.log("saved");
          postList += post.createDetails();
        } else {
          let post = new Announcement(
            result.post_id,
            result.post_head,
            result.fullname,
            result.posted_date,
            result.profile_img
          );
          console.log("not saved");
          postList += post.createDetails();
        }
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
      // Get all star icon elements by their class
      var starIcons = document.getElementsByClassName("star");

      // Loop through all star icon elements and add onclick function
      for (var i = 0; i < starIcons.length; i++) {
        starIcons[i].onclick = function () {
          // Get the ID of the star icon
          var iconId = this.children[0].id;

          // Alert the ID of the star icon
          saveAnnouncement(iconId);
        };
      }
    }
  };
  xhr.send();
}

const searchBtn = document.getElementById("search-btn");
searchBtn.addEventListener("click", searchAnnouncement);

//Search listings
function searchAnnouncement() {
  // Send an AJAX request to the server with the search query
  const searchbox = document.getElementById("search-box");
  const keyword = searchbox.value;
  const filter = document.getElementById("filter").value;
  const sort = document.getElementById("sorter").value;
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Announcements/announcement_search_handler/?query=" +
      keyword +
      "&filter=" +
      filter +
      "&sort=" +
      sort,
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      //Parse the JSON response from the server
      var searchRes = JSON.parse(xhr.responseText);
      // Access the announcements and savedAnnouncements arrays
      var announcements = JSON.parse(searchRes.announcements);
      var savedAnnouncements = JSON.parse(searchRes.savedAnnouncements);
      const valuesArray = savedAnnouncements.map((obj) => obj.announcement_id);
      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("list");
      let postList = "";

      for (var i = 0; i < announcements.length; i++) {
        let result = announcements[i];
        //id, head, name, date, img
        if (valuesArray.includes(result.post_id)) {
          let post = new SavedAnnouncement(
            result.post_id,
            result.post_head,
            result.fullname,
            result.posted_date,
            result.profile_img
          );
          console.log("saved");
          postList += post.createDetails();
        } else {
          let post = new Announcement(
            result.post_id,
            result.post_head,
            result.fullname,
            result.posted_date,
            result.profile_img
          );
          console.log("not saved");
          postList += post.createDetails();
        }
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
      // Get all star icon elements by their class
      var starIcons = document.getElementsByClassName("star");

      // Loop through all star icon elements and add onclick function
      for (var i = 0; i < starIcons.length; i++) {
        starIcons[i].onclick = function () {
          // Get the ID of the star icon
          var iconId = this.children[0].id;

          // Alert the ID of the star icon
          saveAnnouncement(iconId);
        };
      }
    }
  };
  xhr.send();
}

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

// Get all star icon elements by their class
var starIcons = document.getElementsByClassName("star");

// Loop through all star icon elements and add onclick function
for (var i = 0; i < starIcons.length; i++) {
  starIcons[i].onclick = function () {
    // Get the ID of the star icon
    var iconId = this.children[0].id;

    // Alert the ID of the star icon
    saveAnnouncement(iconId);
  };
}

//Save announcement
function saveAnnouncement(ann_id) {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Announcements/save_announcement/?id=" +
      ann_id,
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      location.reload(); //reload page after saving
    }
  };
  xhr.send();
}

