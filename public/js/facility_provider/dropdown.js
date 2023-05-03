// Wait for the page to load before attaching event listener
window.addEventListener('select', () => {
    
    // Get the select element and attach an event listener to it
    var filterSelect = document.getElementById('filterItem');
    filterSelect.addEventListener('select', () => {
        
        // Get the selected value
        var selectedValue = filterSelect.value;
        
        // Send an AJAX request to the server to get filtered items
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/StudentCare/facility_provider/dropdownfilter/?query=' + selectedValue, true);
        xhr.onload = () => {
            if (xhr.status == 200) {
                // On success, replace the contents of the item container with the filtered items
                document.getElementById('item-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
        
    });
    
});


// Wait for the page to load before attaching event listener
/* window.addEventListener('load', () => {
    
    // Get the select elements and attach an event listener to them
    var locationSelect = document.getElementById('location');
    locationSelect.addEventListener('change', filterItems);
    
    var typeSelect = document.getElementById('type');
    typeSelect.addEventListener('change', filterItems);
    
    var universitySelect = document.getElementById('university');
    universitySelect.addEventListener('change', filterItems);
    
});

function filterItems() {
    
    // Get the selected filter values
    var location = document.getElementById('location').value;
    var type = document.getElementById('type').value;
    var university = document.getElementById('university').value;
    
    // Send an AJAX request to the server to get filtered items
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/StudentCare/facility_provider/dropdownfilter/?filterItem=true&location=' + location + '&type=' + type + '&university=' + university, true);
    xhr.onload = () => {
        if (xhr.status == 200) {
            // On success, replace the contents of the item container with the filtered items
            document.getElementById('item-container').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
    
} */