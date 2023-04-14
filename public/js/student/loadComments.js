import { Comments } from "./comments.js";

const buttons = document.querySelectorAll('.btn');

buttons.forEach(button => {
  button.addEventListener('click', (event) => {
    const id = event.target.id;
    loadComments(id);
  });
});


//Function to filter the community posts based on the dropdown value
function loadComments(listing_id){

    const radioButtons = document.getElementsByName('rating');
    let selectedValue;
    for (const radioButton of radioButtons) {
        if (radioButton.checked) {
            selectedValue = radioButton.value;
            break;
        }
    }
    let listing_rating= selectedValue;
    let listing_feedback= document.getElementById('review-content').value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/Student_facility/comment_loader/?id=" + listing_id + '&rating=' + listing_rating + '&feedback=' + listing_feedback, true);
   
    xhr.onload = () => {
        if (xhr.status === 200) {
            //Parse the JSON response from the server
            var searchRes = JSON.parse(xhr.responseText);

            // Update the contents of the page to display the search results
            clearposts();
            var resultList = document.getElementById("search-results");
            let postList = "";
           
            for (var i = 0; i < searchRes.length; i++) {
                let result = searchRes[i];
                //console.log(result);
                //id,username,date,feedback,rating,image,description
                let post = new Comments(result.username,result.date_added,result.star_rating,result.profile_img,result.feedback);
                
                postList += post.createDetails();
            }
            resultList.innerHTML = postList;
        }
    };
    xhr.send();
}

function clearposts(){
    let posts = document.querySelectorAll('.other_comment');
    if(posts != null){
        posts.forEach((post) =>{
            post.parentNode.removeChild(post);
        })
    }
}

