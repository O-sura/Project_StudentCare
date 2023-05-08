let addNewBtn = document.getElementById('add-new');
let field = document.getElementById('qualification');
let deleteIcon = document.getElementById('delete-icon');
let counter = 1;

addNewBtn.addEventListener('click', (e) => {
    e.preventDefault(); 
    addNewBtn.insertAdjacentHTML('afterend', 
        '<div class="input-container"> <input class="form-input" type="text" name="qualifications[]"> <i class="fa-solid fa-trash" id="delete-icon" onclick = "deleteField(this)"></i></div>');
    counter += 1;   

               
})

function deleteField(input){
    input.parentNode.remove();
}

document.querySelectorAll('input').forEach(e => {
    e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
})

document.querySelectorAll('textarea').forEach(e => {
    e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
})