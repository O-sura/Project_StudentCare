//generating a summary report about a user
let summaryBtn = document.getElementById('get-summary');
summaryBtn.addEventListener('click', () => {
    let classes = Array.from(summaryBtn.classList);
    let userID = classes[classes.length - 1];
    window.location.href = `http://localhost/StudentCare/admin/getSummary/${userID}`;
})