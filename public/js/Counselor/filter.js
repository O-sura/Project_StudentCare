//Search community posts
let loggedInUser = document.getElementById("loggedInUser").innerText;
let searchBar = document.getElementById("searchbar");
searchBar.addEventListener("input", () => {
  // Send an AJAX request to the server with the search query
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost/StudentCare/community/search_posts/?query=" +
      searchBar.value,
    true
  );

  xhr.onload = () => {
    if (xhr.status === 200) {
      //Parse the JSON response from the server
      var searchRes = JSON.parse(xhr.responseText);
      //console.log(searchRes)
      // Update the contents of the page to display the search results
      clearposts();
      var resultList = document.getElementById("search-results");
      let postList = "";

      for (var i = 0; i < searchRes.length; i++) {
        let result = searchRes[i];
        //id,title,author,postedTime,category,votes,thumbnail,body
        let post = new CommunityPost(
          result.post_id,
          result.post_title,
          result.author,
          result.posted_at,
          result.category,
          result.votes,
          result.post_thumbnail,
          result.post_desc,
          loggedInUser
        );
        postList += post.createPost();
      }
      resultList.innerHTML = postList;
      votingCountHandler();
    }
  };
  xhr.send();
});
