var goToPrevious = () => {
    javascript:history.go(-1)
}

function createModal(type){
    if(type === 'delete'){
        return `
        <section>
    
            <span class="overlay"></span>

            <div class="modal-box-1">
                <center><h3 class="modal-title-text">Are your sure you want to delete this?</h3></center>
                <p class="modal-text">Remember, this will remove all the current data related to this which cannot be undone later</p>
                <div class="modal-button-section">
                    <button class="modal-box-button" id="delete-button">Delete</button>
                    <button class="modal-box-button" id="cancel-button">Cancel</button>
                </div>
            </div>
        </section>
        `
    }
    
}

function createNodeFromString(str) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(str, 'text/html');
    return doc.body.firstChild;
  }

//add event lisner to the delete button
let deleteBtn = document.getElementById('delete-btn');

if(deleteBtn !== null){
    // let deleteDiv = createNodeFromString(createModal('delete'));
    // console.log(deleteDiv)

    // const body = document.querySelector("body");
    // body.appendChild(deleteDiv);

    const linkElement = document.createElement('link');
    linkElement.rel = 'stylesheet';
    linkElement.href = 'http://localhost/StudentCare/public/css/modal.css';
    document.head.appendChild(linkElement);


    const section = document.querySelector('section'),
    overlay = document.querySelector('.overlay'),
    //showBtn = document.querySelector('.trigger'),
    cancelBtn = document.querySelector('#cancel-button'),
    deleteConfirm = document.querySelector('#delete-button');
    //closeBtn = document.querySelector('#close-button');

    // showBtn.addEventListener('click', ()=> {
    //     section.classList.add("active");
    // })

    deleteBtn.addEventListener('click', () => {
        section.classList.add("active");
    })

    overlay.addEventListener('click', () => {
        section.classList.remove("active");
    })

    cancelBtn.addEventListener('click', () => {
        section.classList.remove("active");
    })

    //Sending AJAX request for post deletion if confirmed
    deleteConfirm.addEventListener('click', () => {
        
        // Get the current page URL
        const url = window.location.href;

        // Extract the post id from the URL
        const postId = url.substring(url.lastIndexOf('/') + 1);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost/StudentCare/community/delete_post/${postId}`);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // The post was deleted successfully
                //alert('Post deleted successfully!');
                console.log('Post deleted successfully!');
                window.location.href = 'http://localhost/StudentCare/community/home';
            } else {
                // There was an error deleting the post
                //alert('There was an error deleting the post.');
                console.log('There was an error deleting the post.');
            }
        };

        xhr.send();
    })
}
