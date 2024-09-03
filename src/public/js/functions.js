
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

function openModal(name){
    document.getElementById(name).showModal();
}
function closeModal(name){
    document.getElementById(name).close();
}

function setModal(name){
    localStorage.setItem('lastModal',name);
}

window.addEventListener('load', () => {
    let favoriteBox = document.getElementById('favorite-checkbox');
    axios.get(`http://localhost:8000/project/favorito/${favoriteBox.name}`)
        .then(response => {
            if(response.data === 1){
                favoriteBox.checked = true;
            }
        })
        .catch((err) => console.log(err));
    let likeBox = document.getElementById('like-checkbox');
    axios.get(`http://localhost:8000/project/curtido/${likeBox.name}`)
        .then(response => {
            if(response.data === 1){
                likeBox.checked = true;
            }
        })
        .catch(err => console.log(err));
})

document.getElementById('favorite-checkbox').addEventListener('change', () => {
    let id = event.target.name;
    if(event.target.checked){
        axios.get(`http://localhost:8000/project/favoritar/${id}`)
            .then()
            .catch((err) => console.log(err));
    }else{
        axios.get(`http://localhost:8000/project/desfavoritar/${id}`)
            .then()
            .catch((err) => console.log(err));
    }
})

document.getElementById('like-checkbox').addEventListener('change', () => {
    let id = event.target.name;
    if(event.target.checked){
        axios.get(`http://localhost:8000/project/curtir/${id}`)
            .then()
            .catch((err) => console.log(err));
    }else{
        axios.get(`http://localhost:8000/project/descurtir/${id}`)
            .then()
            .catch((err) => console.log(err));
    }
})
