
function showMessage(){

    document.getElementById("disp-info-text").innerHTML = `<div  onmouseover="showMessage()" onmouseout="hideMessage()" style=" padding: 20px">O estado de disponibilidade informa a outros usuários a sua disponibilidade em aceitar trabalhos. Clique para alterar.</div>`
}

function hideMessage(){

    document.getElementById("disp-info-text").innerHTML = ""
}

function confirmDeletion() {
    Swal.fire({
        title: "Deseja excluir o projeto?",
        text: "Você não poderá reverter isso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    });

}

function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
        title: "Deseja deslogar?",
        text: "Você será desconectado!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, desconectar!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

function setModal(name){
    localStorage.setItem('lastModal',name);
}
function resetModal(){
    localStorage.setItem('lastModal','null');
}
function getCurrentURL () {
    return window.location.href
}
function setNavbar(activate){
    let elH =document.getElementById('homeSelect');
    let elS =document.getElementById('searchSelect');
    if(activate == 'home'){
        elH.classList.add('active');
        elS.classList.remove('active');
    } else if(activate == 'pesquisar'){
        elS.classList.add('active');
        elH.classList.remove('active');

    }else if(activate == 'none'){
        elH.classList.remove('active');
        elS.classList.remove('active');
    }
}
function setPerfil(feedaAcess){

}
function getPage(){
    // home
    if(getCurrentURL())
    else if(getCurrentURL().indexOf('user')!= -1){
        let elP =document.getElementById('my-project');
        let elF =document.getElementById('fav');
        if(getCurrentURL().indexOf('favoritos') != -1){
            setNavbar('none');
            elP.classList.remove('active');
            elF.classList.add('active');
        }
        else{
            setNavbar('none');
            elF.classList.remove('active');
            elP.classList.add('active');
        }
    }


}
