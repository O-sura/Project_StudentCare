import { CounselorDetails } from "./counselors.js";

//JS code for dropdown menu in community homepage
const counselorNames = document.querySelectorAll(".counselor-name");

counselorNames.forEach(counselorName => {
  counselorName.addEventListener("click", () => {
    let id = counselorName.getAttribute("id");
    counselorSelector(id);
  });
});


//Function to filter the community posts based on the dropdown value
function counselorSelector(counselorID){
    //Your Posts,All Posts,Saved
    // Send an AJAX request to the server with the search query

    //console.log(loggedInUser);

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/Appointments/counselor_handler/?counselorID=" + counselorID, true);
   
    xhr.onload = () => {
        if (xhr.status === 200) {
            //console.log(xhr.responseText);
            //Parse the JSON response from the server
            var searchRes = JSON.parse(xhr.responseText);
        
            
            

            // Update the contents of the page to display the search results

            var resultList = document.getElementById("search-results");
            let postList = "";
           
           
            let result = searchRes;
                //console.log(result);
                //id,title,author,postedTime,category,votes,thumbnail,body
            let post = new CounselorDetails(result.userID,result.fullname,result.counselor_description,result.profile_img,result.specialization,result.home_address,result.age,result.qualifications);
                
            postList = post.createDetails();
            
            resultList.innerHTML = postList;
            // votingCountHandler();
            // savedPostHandler();
        }
    };
    xhr.send();
}






