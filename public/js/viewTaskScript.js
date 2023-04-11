let btn = document.querySelector("#btn");
  let sidebar = document.querySelector(".sidebar");

  btn.onclick = function(){
    sidebar.classList.toggle("active");
  }
function dropDown(id,color)
{
    
    var e = document.getElementById(id);
    var value = e.value;
    var text1 = "_";
    var text2 = id;
    var text3 = text1.concat(text2);
    var text4 = "__";
    var text5 = text4.concat(text2);
   
    
    if(value=="completed"){
       
        document.getElementById(text3).style.backgroundColor = "white";
        document.getElementById(text3).style.border="solid";
        document.getElementById(text3).style.borderWidth="1px";
        document.getElementById(text3).style.borderColor="#1A285A";
        
        document.getElementById(text5).style.textDecoration="line-through";
        document.getElementById(text5).style.color="#1A285A";
    }else{
       
        document.getElementById(text3).style.backgroundColor = color;
        document.getElementById(text3).style.border="none";

        document.getElementById(text5).style.textDecoration="none";
        document.getElementById(text5).style.color="#1A285A";
    }

    var selectElement = document.getElementById(id);
    var newStatus = selectElement.options[selectElement.selectedIndex].value;

  // Send AJAX request to update task status
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/StudentCare/Tasks/status_handler", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Handle successful response from server
        var response = xhr.responseText;
        console.log(response);
      } else {
        // Handle error response from server
        alert("Error: " + xhr.responseText);
      }
    }
  };
  xhr.send("taskId=" + encodeURIComponent(id) + "&newStatus=" + encodeURIComponent(newStatus));
    
    
}

// let btn2 = document.querySelector("#btn4");
// btn2.onclick = function(){
//     document.location.href="Addingtask.php";
// }