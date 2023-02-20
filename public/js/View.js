/* const locationFilter = document.querySelector("#filterItem")

locationFilter.addEventListener("change", (e) => {
    const selectedLocation = e.target.value || "all"
    console.log(selectedLocation)
    const query = new URLSearchParams({
        location: selectedLocation
    })

    console.log(query.toString())
    console.log(document.location)
    document.location.href = document.location.href + "?" + query.toString()
}) */ 



let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");
    
            btn.onclick = function() {
                sidebar.classList.toggle("active");
            }