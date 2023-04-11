 function getData() {
      // Send a request to the server to retrieve the data
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Display the retrieved data in the table
          var data = JSON.parse(this.responseText);
          var table = document.getElementById("user-table");
          for (var i = 0; i < data.length; i++) {
            var row = table.insertRow();
            var idCell = row.insertCell(0);
            var nameCell = row.insertCell(1);
            var emailCell = row.insertCell(2);
            idCell.innerHTML = data[i].id;
            nameCell.innerHTML = data[i].name;
            emailCell.innerHTML = data[i].email;
          }
        }
      };
      xhr.open("GET", "get_data.php", true);
      xhr.send();
    }