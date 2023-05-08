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
