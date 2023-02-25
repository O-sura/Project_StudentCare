//go back to previous page
document.getElementById("back-link").addEventListener("click", function() {
    history.go(-1);
});

//profile image update
document.getElementById("image").onchange = function(){
    document.getElementById('prof_img').submit();
}