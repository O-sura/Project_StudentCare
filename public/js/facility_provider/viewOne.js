function gallery(smallImg){
    var fullImg = document.getElementById("preview");
    fullImg.src = smallImg.src;
}

//go back to previous page
document.getElementById("back-link").addEventListener("click", function() {
    history.go(-1);
});


