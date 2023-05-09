
let blockBtns = document.querySelectorAll('.block-unblock-btn');
let deleteBtns = document.querySelectorAll('.delete-btn');
let profileBtns = document.querySelectorAll('.profile-btn');

//function for reloading the page
function reloadPage() {
    location.reload();
}

if(blockBtns){
    blockUserHandler();
}

if(deleteBtns){
    deleteUserHandler();
}

if(profileBtns){
    userProfileHandler();
}


function blockUserHandler(){
    //Handle user blocking and unblocking functionality
    blockBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            let userID = btn.getAttribute('class').split(" ")[0];
            fetch(`http://localhost/StudentCare/admin/block_user/${userID}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.isBlocked) {
                //User is blocked.- Change the button text
                btn.value = "unblock";
                btn.setAttribute("id","unblock-btn");
                } else {
                //User is unblocked
                btn.value = "block";
                btn.setAttribute("id","block-btn");
                }
            });
        })
    })
}

//Linking the stylesheet for model box
const linkElement = document.createElement('link');
linkElement.rel = 'stylesheet';
linkElement.href = 'http://localhost/StudentCare/public/css/modal.css';
document.head.appendChild(linkElement);

function deleteUserHandler(){
    deleteBtns.forEach(btn=>{
        btn.addEventListener("click", ()=>{
            let userID = btn.getAttribute('class').split(" ")[0];
            
            //Handling user deletions
            const section = document.querySelector('section'),
            overlay = document.querySelector('.overlay'),
            cancelBtn = document.querySelector('#cancel-button'),
            deleteConfirm = document.querySelector('#delete-button');
    
            let titleText = document.querySelector('.modal-title-text');
            titleText.innerHTML = `Are your sure you want to delete the user "${userID}"?`;
    
            //Make the deletion popup visible
            section.classList.add("active");
    
            overlay.addEventListener('click', () => {
                section.classList.remove("active");
            })
    
            cancelBtn.addEventListener('click', () => {
                section.classList.remove("active");
            })
    
            //Sending AJAX request for post deletion if confirmed
            deleteConfirm.addEventListener('click', () => {
                //send the fetch request to delete the user
                fetch(`http://localhost/StudentCare/admin/delete_user/${userID}`, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                });
                linkElement.remove();
                reloadPage(); 
            })
                   
            })
    })
}

//function for loading the profile of the corresponding user
function userProfileHandler(){
    profileBtns.forEach(btn =>{
        btn.addEventListener('click', ()=>{
            let userID = btn.getAttribute('class').split(" ")[0];
            window.location.href = `http://localhost/StudentCare/admin/show_user/${userID}`;
        })
    })
}

//navigating the user to add new admin
let newAdminBtn = document.getElementById('new-admin');
newAdminBtn.addEventListener('click', ()=>{
    window.location.href = `http://localhost/StudentCare/admin/create_admin`;
})


// Get references to the search input and results div
const searchBar = document.getElementById('searchbar');

// Attach an event listener to the search input to trigger the search
//searchBar.addEventListener('input', search(searchBar.value));
searchBar.addEventListener('input', () =>{
    fetch("http://localhost/StudentCare/admin/search_user/?query=" + searchBar.value)
      .then(response => response.json())
      .then(data => {
        let table = document.querySelector('.stat-table')
        const rowCount = table.rows.length;
        // Start from the last row to avoid issues with index shifting
        for (let i = rowCount - 1; i > 0; i--) {
        table.deleteRow(i);
        }
        table.innerHTML = "";
        //add tabel header back into the table - Code is missing!!
        let tr = document.createElement('tr');
        let th1 = document.createElement('th');
        let th2 = document.createElement('th');
        let th3 = document.createElement('th');
        let th4 = document.createElement('th');
        th1.textContent = '#UserID';
        th2.textContent = 'Username';
        th3.textContent = 'Role';
        th4.textContent = 'Action';
        tr.appendChild(th1);
        tr.appendChild(th2);
        tr.appendChild(th3);
        tr.appendChild(th4);
        table.appendChild(tr);

        data.forEach(row => {
          const tr = document.createElement("tr");
          const td1 = document.createElement("td");
          const td2 = document.createElement("td");
          const td3 = document.createElement("td");
          const td4 = document.createElement("td");
          td1.textContent = row.userID;
          td2.textContent = row.username;
          td3.textContent = row.user_role;

          td4.classList.add('btn-row');
          const deleteBtn = document.createElement('input');
          deleteBtn.setAttribute('type', 'submit');
          deleteBtn.setAttribute('class', row.userID + ' delete-btn');
          deleteBtn.setAttribute('value', 'delete');

          const profileBtn = document.createElement('input');
          profileBtn.setAttribute('type', 'submit');
          profileBtn.setAttribute('class', row.userID + ' profile-btn');
          profileBtn.setAttribute('value', 'view profile');

          if(row.isBlocked == 0){
            const blockBtn = document.createElement('input');
            blockBtn.setAttribute('type', 'submit');
            blockBtn.setAttribute('class', row.userID + ' block-unblock-btn');
            blockBtn.setAttribute('id', 'block-btn');
            blockBtn.setAttribute('value', 'block');

            td4.appendChild(blockBtn);

          }else if(row.isBlocked == 1){
            const unblockBtn = document.createElement('input');
            unblockBtn.setAttribute('type', 'submit');
            unblockBtn.setAttribute('class', row.userID + ' block-unblock-btn');
            unblockBtn.setAttribute('id', 'unblock-btn');
            unblockBtn.setAttribute('value', 'block');

            td4.appendChild(unblockBtn);
          }
          td4.appendChild(deleteBtn);
          td4.appendChild(profileBtn);

          tr.appendChild(td1);
          tr.appendChild(td2);
          tr.appendChild(td3);
          tr.appendChild(td4);
          table.appendChild(tr);
        });

        blockBtns = document.querySelectorAll('.block-unblock-btn');
        deleteBtns = document.querySelectorAll('.delete-btn');
        profileBtns = document.querySelectorAll('.profile-btn');
        blockUserHandler();
        deleteUserHandler();
        userProfileHandler();

      });
});

