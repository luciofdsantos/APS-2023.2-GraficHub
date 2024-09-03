
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

function setFavoritos(response){
    let favorites = response.data.favorites;
    let favoriteFormatted = favorites;
    if(favorites/1000000 >= 1){
        favoriteFormatted = (favorites/1000000)%1 ? (favorites/1000000).toFixed(1) : favorites/1000000;
        favoriteFormatted += 'M';
    }else if(favorites/1000 >= 1){
        favoriteFormatted = (favorites/1000)%1 ? (favorites/1000).toFixed(1) : favorites/1000;
        favoriteFormatted += 'K';
    }
    document.getElementById('favorites-number').innerText = `${favoriteFormatted}`;
}

function setLikes(response){
    let likes = response.data.likes;
    let likesFormatted = likes;
    if(likes/1000000 >= 1){
        likesFormatted = (likes/1000000)%1 ? (likes/1000000).toFixed(1) : likes/1000000;
        likesFormatted += 'M';
    }else if(likes/1000 >= 1){
        likesFormatted = (likes/1000)%1 ? (likes/1000).toFixed(1) : likes/1000;
        likesFormatted += 'K';
    }
    document.getElementById('likes-number').innerText = `${likesFormatted}`;
}

window.addEventListener('load', () => {
    let favoriteBox = document.getElementById('favorite-checkbox');
    axios.get(`http://localhost:8000/project/favorito/${favoriteBox.name}`)
        .then(response => {
            favoriteBox.checked = response.data.isFavorito;
            setFavoritos(response);
        })
        .catch((err) => console.log(err));
    let likeBox = document.getElementById('like-checkbox');
    axios.get(`http://localhost:8000/project/curtido/${likeBox.name}`)
        .then(response => {
            likeBox.checked = response.data.isCurtido;
            setLikes(response);
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
    let favoriteBox = document.getElementById('favorite-checkbox');
    axios.get(`http://localhost:8000/project/favorito/${favoriteBox.name}`)
        .then(response => {
            setFavoritos(response);
        })
        .catch((err) => console.log(err));
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
    let likeBox = document.getElementById('like-checkbox');
    axios.get(`http://localhost:8000/project/curtido/${likeBox.name}`)
        .then(response => {
            setLikes(response);
        })
        .catch(err => console.log(err));
})

function setDirectionFollow(followdirect){
    localStorage.setItem('followdirection',followdirect);
    console.log( localStorage.getItem('followdirection'));
}
function resetDirectionFollow(){
    localStorage.setItem('followdirection','null');
}
