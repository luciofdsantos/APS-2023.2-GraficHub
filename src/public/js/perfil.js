document.getElementById("btn-create-project").onclick = function (){
    document.getElementById("box-create-project").showModal();
}

document.getElementById("btn-edit-profile").onclick = function (){
    document.getElementById("box-edit-profile").showModal();
}

document.getElementById("btn-show-followeds").onclick = function (){
    document.getElementById("box-show-followeds").showModal();
}

document.getElementById("btn-show-followers").onclick = function (){
    document.getElementById("box-show-followers").showModal();
}

function exibeContato(elemento, texto){

    document.getElementById(elemento).innerHTML = `<div  onmouseover="showMessage()" onmouseout="hideMessage()" style=" padding: 20px"></div>`

}
