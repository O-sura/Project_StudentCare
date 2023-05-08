// Wait for the page to load before attaching event listener
window.addEventListener('load', () => {
    
    // Get the select element and attach an event listener to it
    var filterSelect = document.getElementById('filterItem1');
    filterSelect.addEventListener('change', () => {
        
        // Get the selected value
        var selectedValue = filterSelect.value;
        console.log(selectedValue);
        
        // Send an AJAX request to the server to get filtered items
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/StudentCare/facility_provider/dropdownfilter/?query=' + selectedValue, true);
        xhr.onload = () => {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                // On success, replace the contents of the item container with the filtered items
                document.getElementById('item-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
        
    });
    
});




/* const filterItem = document.getElementById('filterItem1'); // get the dropdown element by its ID
filterItem.addEventListener('change', (event) => { // add a change event listener
    const selectedValue = event.target.value; // get the selected value
    console.log(`Selected value is ${selectedValue}`); // do something with the selected value
}) */;

