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
        document.getElementById(text3).style.borderColor="#B3B3B3";
        
        document.getElementById(text5).style.textDecoration="line-through";
        document.getElementById(text5).style.color="#B3B3B3";
    }else{
       
        document.getElementById(text3).style.backgroundColor = color;
        document.getElementById(text3).style.border="none";

        document.getElementById(text5).style.textDecoration="none";
        document.getElementById(text5).style.color="#1A285A";
    }
    
    
}

// let btn2 = document.querySelector("#btn4");
// btn2.onclick = function(){
//     document.location.href="Addingtask.php";
// }