document.querySelectorAll('input').forEach(e => {
    e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
})

document.querySelectorAll('textarea').forEach(e => {
    e.addEventListener('input', () => e.parentElement.removeAttribute('data-error'));
})