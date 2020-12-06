/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var clicks = 1;
function newInput() {
    if (clicks <= 9) {
        clicks++;
        z = document.createElement("tr");
        y = document.createElement("td");
        y2 = document.createElement("td");
        z.appendChild(y);
        z.appendChild(y2);
        x = document.createElement("input");
        x.setAttribute("type", "file");
        x.setAttribute("name", "userfile[]");
        y2.appendChild(x);
        document.getElementById("tabla").appendChild(z);
    }
}
function validateForm() {
    carpeta = document.getElementById("carpeta").value;
    elemento = document.getElementById("elemento").value;
    archivo = document.getElementById("archivo").value;

    if (carpeta === "" || elemento === "null" || archivo === "") {
        alert("Debe rellenar todos los campos del formulario.");
        return false;
    }
    else {
        return true;
    }
}
function mouseDown() {
    document.getElementById('boton').style.background = 'darkcyan';
}
function mouseUp() {
    document.getElementById('boton').style.background = 'dodgerblue';
}
function docType(){
    select1 = document.getElementById('carpeta').value;
    select2 = document.getElementById('doctype');
    
    if(select1 === "N/A")
        select2.removeAttribute('disabled');    
    else
        select2.disabled = true;
}
