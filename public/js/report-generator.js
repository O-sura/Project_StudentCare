let  roleInput = document.getElementById('role');
let  typeInput = document.getElementById('type');
let  durationInput = document.getElementById('duration');

function ReportInputHandler(dropdownID, dropdownValue){
  switch (dropdownID){
    case "userrole-dropdown":
      roleInput.value = dropdownValue
      break;
    case "type-dropdown":
      typeInput.value = dropdownValue
      break;
    case "duration-dropdown":
      durationInput.value = dropdownValue
      break;
  }
}


let generateBtn = document.getElementById('report-generate-button');
let repoertInputForm = document.getElementById('report-input-form');

generateBtn.addEventListener('click', (event) =>{
  event.preventDefault();
  repoertInputForm.submit();
})

//syncing the options in the first two dropdowns based on the options they select
const dropdown1 = document.getElementById("dropdown-1");
const dropdown2 = document.getElementById("dropdown-2");
const dropdown3 = document.getElementById("dropdown-3");
const input1 = document.getElementById("input-1");
const input2 = document.getElementById("input-2");
const input3 = document.getElementById("input-3");

// Options for the second dropdown based on the value of the first dropdown
const options = {
  Admin: ["System Overview"],
  Counselor: ["Session Details"],
  Facility_Provider: ["Listing Overview"],
};

// Event listener for the first dropdown
dropdown1.addEventListener("change", function () {
  // Remove all options from the second dropdown
  dropdown2.innerHTML = "";

  // Add options to the second dropdown based on the selected value of the first dropdown
  const selectedValue = dropdown1.value;
  const subOptions = options[selectedValue];

  if (subOptions) {
    subOptions.forEach(function (option) {
      const newOption = document.createElement("option");
      newOption.text = option;
      dropdown2.add(newOption);
    });
  }
  if(subOptions.length == 1){
    input2.value = options[selectedValue][0];
  }
  input1.value = dropdown1.value;
});

// Event listener for the second dropdown
dropdown2.addEventListener("change", function () {
  input2.value = dropdown2.value;
  console.log(dropdown2.value);
});

// Event listener for the second dropdown
dropdown3.addEventListener("change", function () {
  input3.value = dropdown3.value;
});

// Set initial values for input fields
input1.value = dropdown1.value;
input2.value = dropdown2.value
input3.value = dropdown3.value





