const btn = document.getElementById('add-new');
const field = document.getElementById('qualification');
const deleteIcon = document.getElementById('delete-icon');
let counter = 1;

btn.addEventListener('click', (e) => {
    e.preventDefault(); 
    field.insertAdjacentHTML('afterend', 
        '<div class="input-container"> <input class="form-input" type="text" name="qualification'+ counter + '"> <i class="fa-solid fa-trash" id="delete-icon" onclick = "deleteField(this)"></i></div>');
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