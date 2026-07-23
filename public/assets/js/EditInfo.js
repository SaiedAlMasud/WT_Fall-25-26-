//Switch between view and edit mode
document.getElementById('editBtn').addEventListener('click', function() {
    const viewelements = document.querySelectorAll('.view-mode');
    for(let i = 0; i < viewelements.length; i++) {
        viewelements[i].style.display = 'none';
    }

    const editelements = document.querySelectorAll('.edit-mode');
    for(let i = 0; i < editelements.length; i++) {
        editelements[i].style.display = 'block';
    }

    document.getElementById('editBtn').style.display = 'none';
    document.getElementById('saveBtn').style.display = 'block';
});



