
function editInfo() {
    window.open("http://localhost/sias/edit-profile.php", "", "width=600px, height=600px, scrollbars=no");
}
function editPassword() {
    window.open("http://localhost/sias/edit-password.php", "", "width=600px, height=500px, scrollbars=no");
}
function menu() {
    list = document.getElementById('option');

    if (list.style.display === 'none') {
        list.style.display = 'block';
    } else {
        list.style.display = 'none';
    }
}

function stateToogle() {
    label = document.getElementById('displayDel');
    div = document.getElementById('divDel');
    var x = document.getElementsByClassName('delButton');
    var i;

    if (div.style.background === 'orangered') {
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "block";
        }
        label.innerHTML = 'Cancelar';
        div.style.background = 'red';
    } else {
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        label.innerHTML = 'Eliminar un archivo';
        div.style.background = 'orangered';
    }
}

