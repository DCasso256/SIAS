/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function confirmar() {
    salir = confirm("Si sale ahora se cerrará su sesión, deberá abrirla de nuevo para poder ingresar.\n\n\
                       ¿Desea salir y cerrar sesión?");
    if (salir === true) {
        location.href = 'iniciar-sesion.php';
    } else {
        return false;
    }
}
function modal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('video').stopVideo();
    player.stopVideo();
}
function selectVideo() {
    selection = document.getElementById('selection').value;
    switch (selection) {
        case '1':
            document.getElementById('video').src = 'https://www.youtube.com/embed/O9xRdrvJaH4?version=3&enablejsapi=1';
            break;
        case '2':
            document.getElementById('video').src = 'https://www.youtube.com/embed/dl1o134O9qg?version=3&enablejsapi=1';
            break;
        case '3':
            document.getElementById('video').src = 'https://www.youtube.com/embed/O3zWYeWDQtc?version=3&enablejsapi=1';
            break;
        case '4':
            document.getElementById('video').src = 'https://www.youtube.com/embed/WeNp0NR9lic?version=3&enablejsapi=1';
            break;
        case '5':
            document.getElementById('video').src = 'https://www.youtube.com/embed/m7WkBGZvPOs?version=3&enablejsapi=1';
            break;
        case '6':
            document.getElementById('video').src = 'https://www.youtube.com/embed/BSQXaPrM8iA?version=3&enablejsapi=1';
            break;
        default:
            "";
            break;
    }
}
function watchVideo() {
    document.getElementById('modal').style.display = 'block';
}

function openFAQ() {
    window.open("http://localhost/sias/faq.html", "", "width=600px, height=600px, scrollbars=yes, directories=no");
}
function openFeedback() {
    window.open("http://localhost/sias/feedback.php", "", "width=600px, height=600px, scrollbars=no, resizable=no, directories=no");
}
function openHelp() {
    window.open("http://localhost/sias/ayuda.php", "", "width=600px, height=600px, scrollbars=yes, resizable=yes, directories=no");
}

function clock() {
    var hoy = new Date();
    var h = hoy.getHours();
    var m = hoy.getMinutes();
    var s = hoy.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(clock, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    } //añade un cero frente a los números menores a 10
    return i;
}