//To load the profile image as soon as it changed

const inpuTag = document.getElementById("inputTag");

var loadFile = (e) => {
  var output = document.getElementById("image2");

  output.src = URL.createObjectURL(e.target.files[0]);

  output.onload = () => {
    URL.revokeObjectURL(output.src); // free memory
  };
};

//onChange event
inpuTag.addEventListener("change", loadFile);
