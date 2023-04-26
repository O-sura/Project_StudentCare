import {propertyitem} from "./listing.js";
//JS code for dropdown menu in community homepage
// Get the select element
//const universityFilter = document.getElementById('universityFilter');
//Clear all the posts currently showing to the user
/* function clearposts(){
    let posts = document.querySelectorAll('.item');
    if(posts != null){
        posts.forEach((post) =>{
            post.parentNode.removeChild(post);
        })
    }
} */
// Add onchange event listener to the select element
// universityFilter.onchange = () => {
//     // Get the selected option value
//     const selectedOption = universityFilter.value;
    
//     // Call the dropdownFilter function with the selected option value
//     dropdownFilter(selectedOption);
// };





//Search listings
function clearlistings(){
    let listings = document.querySelectorAll('.parent'); //is line gets all the HTML elements with a class of "parent" and stores them in the listings variable
    if(listings != null){   //checks if the listings variable is not null. If there are no search results on the page, listings will be null.
        listings.forEach((view) =>{
            view.parentNode.removeChild(view);
        })
    }
}

let searchBar = document.getElementById('searchbar');
searchBar.addEventListener('input', () => {
    // Send an AJAX request to the server with the search query
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/facility_provider/propertysearch/?query=" + searchBar.value, true);
    
    xhr.onload = () => {
        if (xhr.status === 200) {
            //Parse the JSON response from the server
            var searchRes = JSON.parse(xhr.responseText);
            //console.log(searchRes)
            //console.log(xhr.responseText)
            // Update the contents of the page to display the search results
            clearlistings();
            var resultList = document.getElementById("search-results");
            let itemList = "";
            
            
            for (var i = 0; i < searchRes.length; i++) {
                let result = searchRes[i];
                let item = new propertyitem(result.topic,result.uniName,result.rental);
                itemList += item.createItem();
            }
            //console.log(propertyitem);
            resultList.innerHTML = itemList;
        }
    };
    xhr.send();
})