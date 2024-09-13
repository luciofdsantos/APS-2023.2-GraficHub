let likesNumber;
let favoritesNumber;

function setFavorites(){
    let favoriteFormatted = favoritesNumber;
    if(favoritesNumber/1000000 >= 1){
        favoriteFormatted = (favoritesNumber/1000000)%1 ? (favoritesNumber/1000000).toFixed(1) : favoritesNumber/1000000;
        favoriteFormatted += 'M';
    }else if(favoritesNumber/1000 >= 1){
        favoriteFormatted = (favoritesNumber/1000)%1 ? (favoritesNumber/1000).toFixed(1) : favoritesNumber/1000;
        favoriteFormatted += 'K';
    }
    document.getElementById('favorites-number').innerText = `${favoriteFormatted}`;
}

function setLikes(){
    let likesFormatted = likesNumber;
    if(likesNumber/1000000 >= 1){
        likesFormatted = (likesNumber/1000000)%1 ? (likesNumber/1000000).toFixed(1) : likesNumber/1000000;
        likesFormatted += 'M';
    }else if(likesNumber/1000 >= 1){
        likesFormatted = (likesNumber/1000)%1 ? (likesNumber/1000).toFixed(1) : likesNumber/1000;
        likesFormatted += 'K';
    }
    document.getElementById('likes-number').innerText = `${likesFormatted}`;
}

window.addEventListener('load', () => {
    let favIcon = document.getElementById('favorite-icon');
    axios.get(`http://localhost:8000/project/favorito/${favIcon.title}`)
        .then(response => {
            if(response.data.isFavorito){
                favIcon.className = "bi bi-bookmark-fill text-warning hold";
            }
            favoritesNumber = response.data.favorites;
            setFavorites(response);
        })
        .catch((err) => console.log(err));
    let likeIcon = document.getElementById('like-icon');
    axios.get(`http://localhost:8000/project/curtido/${likeIcon.title}`)
        .then(response => {
            if(response.data.isCurtido){
                likeIcon.className = "bi bi-heart-fill text-danger hold";
            }
            likesNumber = response.data.likes;
            setLikes();
        })
        .catch(err => console.log(err));
})

function favoriteHandler(){
    let favIcon = document.getElementById('favorite-icon');
    if(favIcon.classList.contains('hold')){
        favIcon.className = "bi bi-bookmark text-warning";
        favoritesNumber--;
        setFavorites();
        axios.get(`http://localhost:8000/project/desfavoritar/${favIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }else{
        favIcon.className = "bi bi-bookmark-fill text-warning hold";
        favoritesNumber++;
        setFavorites();
        axios.get(`http://localhost:8000/project/favoritar/${favIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }
}

function likeHandler(){
    let likeIcon = document.getElementById('like-icon');
    if(likeIcon.classList.contains('hold')){
        likeIcon.className = "bi bi-heart text-danger";
        likesNumber--;
        setLikes();
        axios.get(`http://localhost:8000/project/descurtir/${likeIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }else{
        likeIcon.className = "bi bi-heart-fill text-danger hold";
        likesNumber++;
        setLikes();
        axios.get(`http://localhost:8000/project/curtir/${likeIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }
}
