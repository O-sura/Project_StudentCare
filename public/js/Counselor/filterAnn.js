import { CounselorAnnouncementPost } from "./announcement.js";

//JS code for dropdown menu in announcement homepage
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
        console.log(selectedOption);
        btnText.innerText = selectedOption;
        dropdownFilter(selectedOption);
        optionMenu.classList.remove("active");
    })
})



//Function to filter the announcement posts based on the dropdown value
function dropdownFilter(option){
    //Your Posts,All Posts,Saved
    // Send an AJAX request to the server with the search query
    let loggedInUser = document.getElementById('loggedInUser').innerText;

    //console.log(loggedInUser);

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/CounselorAnnouncement/dropdown_handler/?filter=" + option + '&userID=' + loggedInUser, true);
   
    xhr.onload = () => {
        if (xhr.status === 200) {
            
            //Parse the JSON response from the server
            var searchRes = JSON.parse(xhr.responseText);
            //console.log(searchRes);

            // Update the contents of the page to display the search results
            clearposts();
            var resultList = document.getElementById("search-results");
            let postList = "";
           
            for (var i = 0; i < searchRes.length; i++) {
                let result = searchRes[i];
                ///console.log(result);
                console.log(result.userID,loggedInUser);
                //id,description,date,fullname,image,loggeduser,counselor,topic
                let post = new CounselorAnnouncementPost(result.post_id,result.post_desc,result.posted_date,result.fullname,result.profile_img,loggedInUser,result.userID,result.post_head);
                // console.log(result.userID,loggedInUser);
                postList += post.createAnnouncement();
            }
            resultList.innerHTML = postList;
        }
    };
    xhr.send();
}



//Clear all the posts currently showing to the user
function clearposts(){
    let posts = document.querySelectorAll('.annDescription');
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
        xhr.open("GET", "http://localhost/StudentCare/CounselorAnnouncement/search_posts/?query=" + searchBar.value, true);
       
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
                    let post = new CounselorAnnouncementPost(result.post_id,result.post_desc,result.posted_date,result.fullname,result.profile_img,loggedInUser,result.userID,result.post_head);
                    postList += post.createAnnouncement();
                }
                resultList.innerHTML = postList;
            }
        };
        xhr.send();
    }
)


//to load the modal start meeting or cancel 
var modal = document.getElementById("myModal");
var btns = document.getElementsByClassName("btnDlt");
var span = document.getElementsByClassName("close")[0];

for (var i = 0; i < btns.length; i++) {
  btns[i].onclick = function() {
    modal.style.display = "block";
  }
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


///////////////////////////////

// get the Delete button elements
const deleteButtons = document.querySelectorAll('.btnDlt');

// add a click event listener to each Delete button
deleteButtons.forEach(btn => {
  btn.addEventListener('click', function() {
    // get the post ID value from the clicked Delete button
    const postId = this.value;

    // get the Delete announcement link element
    const deleteLink = document.getElementById('deleteLink');

    // update the href attribute of the Delete announcement link with the post ID value
    deleteLink.href = `http://localhost/StudentCare/CounselorAnnouncement/delete/${postId}`;
  });
});