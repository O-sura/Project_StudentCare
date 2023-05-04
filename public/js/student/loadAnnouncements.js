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
  const selectedOption = sortFilter.value;

  // Call the dropdownFilter function with the selected option value
  dropdownFilter(selectedOption);
};

//Function to filter the community posts based on the dropdown value
function dropdownFilter(option) {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/Announcements/announcement_sort_handler/?filter=" +
      option,
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
          result.profile_img,
        );

        postList += post.createDetails();
      }
      resultList.innerHTML = postList;
    }
  };
  xhr.send();
}

// const searchBtn = document.getElementById("search-btn");
// searchBtn.addEventListener("click", searchListing);

// //Search listings
// function searchListing() {
//   // Send an AJAX request to the server with the search query
//   const searchbox = document.getElementById("search-box");
//   const keyword = searchbox.value;
//   const type2 = document.getElementById("typeFilter").value;
//   var xhr = new XMLHttpRequest();
//   xhr.open(
//     "GET",
//     "http://localhost/StudentCare/Appointments/counselor_search_handler/?query=" +
//       keyword +
//       "&type=" +
//       type2,
//     true
//   );

//   xhr.onload = () => {
//     if (xhr.status === 200) {
//       //Parse the JSON response from the server
//       var searchRes = JSON.parse(xhr.responseText);
//       //console.log(searchRes)
//       // Update the contents of the page to display the search results
//       clearposts();
//       var resultList = document.getElementById("list");
//       let postList = "";

//       for (var i = 0; i < searchRes.length; i++) {
//         let result = searchRes[i];
//         //console.log(result);
//         //id,name,description,img,specialization
//         let post = new CounselorList(
//           result.userID,
//           result.fullname,
//           result.counselor_description,
//           result.profile_img,
//           result.specialization
//         );

//         postList += post.createDetails();
//       }
//       resultList.innerHTML = postList;
//     }
//   };
//   xhr.send();
// }
