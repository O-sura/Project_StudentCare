var loadFile = (e) => {
    var output = document.getElementById('output');
    var thumbnailTxt = document.getElementById('thumbnail-text');
    output.src = URL.createObjectURL(e.target.files[0]);
    thumbnailTxt.innerText = 'Change Thumbnail';
    output.onload = () => {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  var goToPrevious = () => {
    javascript:history.go(-1)
   }

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
            btnText.innerText = selectedOption;
            document.querySelector('#category').value = selectedOption;
            optionMenu.classList.remove("active");
        })
    })

    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");

    btn.onclick = function(){
        sidebar.classList.toggle("active");
    }