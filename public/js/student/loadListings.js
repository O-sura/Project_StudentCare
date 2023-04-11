import { ListingDetails } from "./listings.js";

//JS code for dropdown menu in community homepage
// Get the select element
const universityFilter = document.getElementById('universityFilter');
//Clear all the posts currently showing to the user
function clearposts(){
    let posts = document.querySelectorAll('.item');
    if(posts != null){
        posts.forEach((post) =>{
            post.parentNode.removeChild(post);
        })
    }
}
// Add onchange event listener to the select element
universityFilter.onchange = () => {
    // Get the selected option value
    const selectedOption = universityFilter.value;
    
    // Call the dropdownFilter function with the selected option value
    dropdownFilter(selectedOption);
};

const priceFilter = document.getElementById('priceSorter');

// Add onchange event listener to the select element
priceFilter.onchange = () => {
    // Get the selected option value
    const uni2 = document.getElementById('universityFilter').value;
    const selectedOption2 = priceFilter.value;
    
    // Call the dropdownFilter function with the selected option value
    dropDownPrice(uni2,selectedOption2);
};

const ratingFilter = document.getElementById('ratingSorter');

// Add onchange event listener to the select element
ratingFilter.onchange = () => {
    // Get the selected option value
    const uni3 = document.getElementById('universityFilter').value;
    const selectedOption3 = ratingFilter.value;

    // Call the dropdownFilter function with the selected option value
    dropDownRating(uni3,selectedOption3);
};

const dateFilter = document.getElementById('dateSorter');

// Add onchange event listener to the select element
dateFilter.onchange = () => {
    // Get the selected option value
    const uni4 = document.getElementById('universityFilter').value;
    const selectedOption4 = dateFilter.value;
    
    // Call the dropdownFilter function with the selected option value
    dropDownDate(uni4,selectedOption4);
};




//Function to filter the community posts based on the dropdown value
function dropdownFilter(option){

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/Student_facility/uni_filter_handler/?filter=" + option , true);
   
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
                //id,title,author,postedTime,category,votes,thumbnail,body
                let post = new ListingDetails(result.listing_id,result.first_image,result.topic,result.uni_name,result.distance,result.rating,result.rental,result.location);
                
                postList += post.createDetails();
            }
            resultList.innerHTML = postList;
        }
    };
    xhr.send();
}

//Function to filter the community posts based on the dropdown value
function dropDownPrice(uni,sort){

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/Student_facility/price_sorter_handler/?sort=" + sort + '&uni=' + uni, true);
   
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
                //id,title,author,postedTime,category,votes,thumbnail,body
                let post = new ListingDetails(result.listing_id,result.first_image,result.topic,result.uni_name,result.distance,result.rating,result.rental,result.location);
                
                postList += post.createDetails();
            }
            resultList.innerHTML = postList;
        }
    };
    xhr.send();
}

//Function to filter the community posts based on the dropdown value
function dropDownRating(uni,sort){

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/Student_facility/rating_sorter_handler/?sort=" + sort + '&uni=' + uni, true);
   
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
                //id,title,author,postedTime,category,votes,thumbnail,body
                let post = new ListingDetails(result.listing_id,result.first_image,result.topic,result.uni_name,result.distance,result.rating,result.rental,result.location);
                
                postList += post.createDetails();
            }
            resultList.innerHTML = postList;
        }
    };
    xhr.send();
}

//Function to filter the community posts based on the dropdown value
function dropDownDate(uni,sort){

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/StudentCare/Student_facility/date_sorter_handler/?sort=" + sort + '&uni=' + uni, true);
   
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
                let post = new ListingDetails(result.listing_id,result.first_image,result.topic,result.uni_name,result.distance,result.rating,result.rental,result.location);
                
                postList += post.createDetails();
            }
            resultList.innerHTML = postList;
        }
    };
    xhr.send();
}

//Search community posts
let searchBar = document.getElementById('searchbar');
searchBar.addEventListener('input', () => {
        // Send an AJAX request to the server with the search query
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/StudentCare/Student_facility/search_listing/?query=" + searchBar.value, true);
       
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
                    let post = new ListingDetails(result.listing_id,result.first_image,result.topic,result.uni_name,result.distance,result.rating,result.rental,result.location);
                
                    postList += post.createDetails();
                }
                resultList.innerHTML = postList;
                //votingCountHandler();
            }
        };
        xhr.send();
    }
)





