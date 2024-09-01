
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

function setFavoritado() {
    let favoriteWrapper = document.getElementById('favorite-wrapper');
    favoriteWrapper.innerHTML =
        `<form id="form-desfavoritar" class="favorite-form" id="favoritarForm">
            <button class="favorite-btn" type="submit"><img src="/img/marca-paginas-full.png"/></button>
        </form>`;
    document.getElementById('form-desfavoritar').addEventListener('submit', () => {
        event.preventDefault();
        let id = favoriteWrapper.title;
        axios.get(`http://localhost:8000/project/desfavoritar/${id}`)
            .then()
            .catch((err) => console.log(err));
        setDesfavoritado();
    });
}

function setDesfavoritado() {
    let favoriteWrapper = document.getElementById('favorite-wrapper');
    favoriteWrapper.innerHTML =
        `<form id="form-favoritar" class="favorite-form" id="favoritarForm">
            <button class="favorite-btn" type="submit"><img src="/img/marca-paginas.png"/></button>
        </form>`;
    document.getElementById('form-favoritar').addEventListener('submit', () =>{
        event.preventDefault();
        let id = favoriteWrapper.title;
        axios.get(`http://localhost:8000/project/favoritar/${id}`)
            .then()
            .catch((err) => console.log(err));
        setFavoritado();
    });
}

let formDesfavoritar = document.getElementById('form-desfavoritar');

if (formDesfavoritar) {
    formDesfavoritar.addEventListener('submit', () => {
        event.preventDefault();
        let id = event.target.name;
        axios.get(`http://localhost:8000/project/desfavoritar/${id}`)
            .then()
            .catch((err) => console.log(err));
        setDesfavoritado();
    });
}

let formFavoritar = document.getElementById('form-favoritar')

if (formFavoritar){
    formFavoritar.addEventListener('submit', () =>{
        event.preventDefault();
        let id = event.target.name;
        axios.get(`http://localhost:8000/project/favoritar/${id}`)
            .then()
            .catch((err) => console.log(err));
        setFavoritado();
    });
}
