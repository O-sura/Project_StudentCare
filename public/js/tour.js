// Get all the modal elements
var modals = document.querySelectorAll('.modal');

// Get all the "next" buttons
var nextButtons = document.querySelectorAll('.next-btn');

// Get the "skip tour" button
var skipButtons = document.querySelectorAll("#skipBtn");

// Set the current modal to the first one
var currentModal = 0;

if(modals !== null){
    // Show the first modal
    modals[currentModal].style.display = "block";

    // When the user clicks on the "next" button, show the next modal
    nextButtons.forEach(function(button) {
    button.onclick = function() {
        // Hide the current modal
        modals[currentModal].style.display = "none";
        
        // Show the next modal
        currentModal++;
        if (currentModal < modals.length) {
        modals[currentModal].style.display = "block";
        }
    }
    });

    // When the user clicks on <span> (x) or outside of the modal, close the current modal
    modals.forEach(function(modal) {
    var span = modal.querySelector('.close');
    window.onclick = function(event) {
        if (event.target == modal) {
        modal.style.display = "none";
        }
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    });

    // When the user clicks the skip button, hide the current modal and set the cookie
    skipButtons.forEach(skipBtn =>{
        skipBtn.onclick = function() {
            modals[currentModal].style.display = "none";
            document.cookie = "tour_skipped=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
        }
    })
}




