import { CommunityPost } from "./post.js";

//Calling the voting functionality providing function
votingCountHandler();

//JS code navigate into add new post page
const add_new = document.getElementsByClassName('addNew-button')[0];
add_new.addEventListener('click', newPage);

function newPage(){
    window.location.replace("./community/add_new");
}

//JS code for dropdown menu in community homepage
const optionMenu = document.querySelector('.dropdown-menu');
const selectBtn = optionMenu.querySelector('.select-btn');
const options = optionMenu.querySelectorAll('.option');
const btnText = optionMenu.querySelector('.Sbtn-text');

selectBtn.addEventListener("click", () => {
    optionMenu.classList.toggle("active");
})

options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.innerHTML;
        btnText.innerText = selectedOption;
        dropdownFilter(selectedOption);
        optionMenu.classList.remove("active");
    })
})

//Function to filter the community posts based on the dropdown value
function dropdownFilter(option){
    //Your Posts,All Posts,Saved
    // Send an AJAX request to the server with the search query
    let loggedInUser = document.getElementById('loggedInUser').innerText;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/community/dropdown_handler/?filter=" + option + '&author=' + loggedInUser, true);
   
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
                let post = new CommunityPost(result.post_id,result.post_title,result.author,result.posted_at,result.category,result.votes,result.post_thumbnail,result.post_desc,loggedInUser);
                postList += post.createPost();
            }
            resultList.innerHTML = postList;
            votingCountHandler();
            savedPostHandler();
        }
    };
    xhr.send();
}

//Clear all the posts currently showing to the user
function clearposts(){
    let posts = document.querySelectorAll('.parent');
    if(posts != null){
        posts.forEach((post) =>{
            post.parentNode.removeChild(post);
        })
    }
}


//Search community posts
let loggedInUser = document.getElementById('loggedInUser').innerText;
let searchBar = document.getElementById('searchbar');
searchBar.addEventListener('input', () => {
        // Send an AJAX request to the server with the search query
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/StudentCare/community/search_posts/?query=" + searchBar.value, true);
       
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
                    let post = new CommunityPost(result.post_id,result.post_title,result.author,result.posted_at,result.category,result.votes,result.post_thumbnail,result.post_desc,loggedInUser);
                    postList += post.createPost();
                }
                resultList.innerHTML = postList;
                votingCountHandler();
            }
        };
        xhr.send();
    }
)

//Best filter
let bestIcon = document.querySelectorAll('.best-btn');
bestIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        // Send an AJAX request to the server with the search query
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/StudentCare/community/best_posts/", true);
       
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
                    let post = new CommunityPost(result.post_id,result.post_title,result.author,result.posted_at,result.category,result.votes,result.post_thumbnail,result.post_desc,loggedInUser);
                    postList += post.createPost();
                }
                resultList.innerHTML = postList;
                votingCountHandler();
            }
        };
        xhr.send();
    })
})


//Latest Filter
let latestIcon = document.querySelectorAll('.latest-btn');
latestIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        // Send an AJAX request to the server with the search query
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/StudentCare/community/latest_posts/", true);
       
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
                    let post = new CommunityPost(result.post_id,result.post_title,result.author,result.posted_at,result.category,result.votes,result.post_thumbnail,result.post_desc,loggedInUser);
                    postList += post.createPost();
                }
                resultList.innerHTML = postList;
                votingCountHandler();
            }
        };
        xhr.send();
    })
})

//Function to provide ipvote and downvote functionality
function votingCountHandler(){
    var votingButtons = document.querySelectorAll(".icon-text-button");

    // Add event listeners to each button
    votingButtons.forEach((votingButton)  => {
        var upButton = votingButton.querySelector(".icon-btn#up");
        var downButton = votingButton.querySelector(".icon-btn#down");

        // Get the vote count element, current vote count, increase and update
        let votedPostId = parseInt(votingButton.querySelector("p#post-id").textContent);
        // Add event listeners to the buttons
        upButton.addEventListener("click", function() {
            vote(votedPostId,true);
        });

        downButton.addEventListener("click", function() {
            vote(votedPostId,false);
        });
    });

}

//Function for voting community posts
function vote(postId, action){
        // Encode parameters as query string(action=true means it is for upvote)
        let params = (action)? "post_id=" + postId + "&flag=1" : "post_id=" + postId;

        // Send an AJAX request to the server to check if the user has already voted
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/StudentCare/community/check_vote/", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
          if (xhr.status === 200) {
            // If the user has not voted, send another AJAX request to upvote
            var xhr2 = new XMLHttpRequest();
            xhr2.open("POST", "http://localhost/StudentCare/community/vote/", true);
            xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr2.onload = function() {
              if (xhr2.status === 200) {
                // Update the votes count on the fontend page
                let voteCount = document.getElementById("vote-count-"+ postId);
                voteCount.innerText = JSON.parse(xhr2.responseText).votes;
              }
            };
            xhr2.send(params);
          } else {
            // If the user has already voted, display an error message
            alert("You have already voted on this post.");
          }
        };
        xhr.send(params);
}

//Save Post Functionality
function savedPostHandler(){
    let savePostBtn = document.querySelectorAll('#save-button');
    savePostBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            // Send an AJAX request to the server to check if the user has already voted
            let parentDiv = btn.parentElement.parentElement.parentElement.parentElement;
            let votedPostId = parseInt(parentDiv.querySelector("p#post-id").textContent);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/StudentCare/community/save_post/", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
            if (xhr.status === 200) {
                if(xhr.responseText == "Saved"){
                    alert('Post added to the Saved List');
                }
                if(xhr.responseText == "Unsaved"){
                    //Refresh the saved posts list and load
                    dropdownFilter("Saved");
                    alert('Post Successfully Unsaved');
                }
            } else {
                // If something went wrong, notify users about them
                alert("Something went wrong when saving the post. Try again later.");
            }
            };
            xhr.send("post_id=" + votedPostId);
        })
    })
}

  