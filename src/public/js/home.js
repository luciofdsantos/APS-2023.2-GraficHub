let out = false;
function followBGcolor() {
    document.getElementById("seguindo-box").style.backgroundColor = "#D9D9D9";
    document.getElementById("descobrir-box").style.backgroundColor = "#f6f6f6";
    localStorage.setItem('corDeFundof', "#D9D9D9");
    localStorage.setItem('corDeFundod', "#f6f6f6");

}
function discBGcolor() {
    document.getElementById("seguindo-box").style.backgroundColor = "#f6f6f6";
    document.getElementById("descobrir-box").style.backgroundColor = "#D9D9D9";
    localStorage.setItem('corDeFundod', "#D9D9D9");
    localStorage.setItem('corDeFundof', "#f6f6f6");

}
function setOut(){
    out = true;
}

// window.onload = function() {
//     const corSalvaS = localStorage.getItem('corDeFundof');
//     const corSalvaD = localStorage.getItem('corDeFundod');
//     const out = localStorage.getItem('out');
//     if (corSalvaS && corSalvaD && !out) {
//         document.getElementById("seguindo-box").style.backgroundColor = corSalvaS;
//         document.getElementById("descobrir-box").style.backgroundColor = corSalvaD;
//     }else{
//         document.getElementById("seguindo-box").style.backgroundColor = "#f6f6f6";
//         document.getElementById("descobrir-box").style.backgroundColor = "#D9D9D9";
//     }
//     localStorage.setItem('corDeFundod', "#D9D9D9");
//     localStorage.setItem('corDeFundof', "#f6f6f6");
// };

// This is "probably" IE9 compatible but will need some fallbacks for IE8
// - (event listeners, forEach loop)

// wait for the entire page to finish loading
window.addEventListener('load', function() {

    // setTimeout to simulate the delay from a real page load
    setTimeout(lazyLoad, 1000);

});

function lazyLoad() {
    var card_images = document.querySelectorAll('.card-image');

    // loop over each card image
    card_images.forEach(function(card_image) {
        var image_url = card_image.getAttribute('data-image-full');
        var content_image = card_image.querySelector('img');

        // change the src of the content image to load the new high res photo
        content_image.src = image_url;

        // listen for load event when the new photo is finished loading
        content_image.addEventListener('load', function() {
            // swap out the visible background image with the new fully downloaded photo
            card_image.style.backgroundImage = 'url(' + image_url + ')';
            // add a class to remove the blur filter to smoothly transition the image change
            card_image.className = card_image.className + ' is-loaded';
        });

    });

}

function setFavoritesFeed(favoritesNumber, projectId){
    let favoriteFormatted = favoritesNumber;
    if(favoritesNumber/1000000 >= 1){
        favoriteFormatted = (favoritesNumber/1000000)%1 ? (favoritesNumber/1000000).toFixed(1) : favoritesNumber/1000000;
        favoriteFormatted += 'M';
    }else if(favoritesNumber/1000 >= 1){
        favoriteFormatted = (favoritesNumber/1000)%1 ? (favoritesNumber/1000).toFixed(1) : favoritesNumber/1000;
        favoriteFormatted += 'K';
    }
    document.getElementById(`favorites-number-${projectId}`).title = `${favoritesNumber}`;
    document.getElementById(`favorites-number-${projectId}`).innerText = `${favoriteFormatted}`;
}

function setLikesFeed(likesNumber, projectId){
    let likesFormatted = likesNumber;
    if(likesNumber/1000000 >= 1){
        likesFormatted = (likesNumber/1000000)%1 ? (likesNumber/1000000).toFixed(1) : likesNumber/1000000;
        likesFormatted += 'M';
    }else if(likesNumber/1000 >= 1){
        likesFormatted = (likesNumber/1000)%1 ? (likesNumber/1000).toFixed(1) : likesNumber/1000;
        likesFormatted += 'K';
    }
    document.getElementById(`likes-number-${projectId}`).title = `${likesNumber}`;
    document.getElementById(`likes-number-${projectId}`).innerText = `${likesFormatted}`;

}

window.addEventListener('load', () => {
    let favIcons = document.getElementsByClassName('fav-icon');
    for(let i=0; i<favIcons.length; ++i){
        let projectId = favIcons[i].title;
        axios.get(`http://localhost:8000/project/favorito/${projectId}`)
            .then(response => {
                console.log(response)
                if(response.data.isFavorito){
                    favIcons[i].className = "fav-icon bi bi-bookmark-fill text-warning hold";
                }
                setFavoritesFeed(response.data.favorites, projectId);
            })
            .catch((err) => console.log(err));
    }
    let likeIcons = document.getElementsByClassName('like-icon');
    for(let i=0; i<likeIcons.length; ++i){
        let projectId = likeIcons[i].title;
        axios.get(`http://localhost:8000/project/curtido/${projectId}`)
            .then(response => {
                if(response.data.isCurtido){
                    likeIcons[i].className = "like-icon bi bi-heart-fill text-danger hold";
                }
                setLikesFeed(response.data.likes, projectId);
            })
            .catch((err) => console.log(err));
    }
})

function favoriteHandlerFeed(target){
    event.preventDefault()
    let favIcon = document.getElementById(`favorite-icon-${target.title}`);
    let favoritesNumber = document.getElementById(`favorites-number-${target.title}`).title;
    if(favIcon.classList.contains('hold')){
        favIcon.className = "bi bi-bookmark text-warning";
        favoritesNumber--;
        setFavoritesFeed(favoritesNumber, target.title);
        axios.get(`http://localhost:8000/project/desfavoritar/${favIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }else{
        favIcon.className = "bi bi-bookmark-fill text-warning hold";
        favoritesNumber++;
        setFavoritesFeed(favoritesNumber, target.title);
        axios.get(`http://localhost:8000/project/favoritar/${favIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }
}

function likeHandlerFeed(target){
    event.preventDefault()
    let likeIcon = document.getElementById(`like-icon-${target.title}`);
    let likesNumber = document.getElementById(`likes-number-${target.title}`).title
    if(likeIcon.classList.contains('hold')){
        likeIcon.className = "bi bi-heart text-danger";
        likesNumber--;
        setLikesFeed(likesNumber, target.title);
        axios.get(`http://localhost:8000/project/descurtir/${likeIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }else{
        likeIcon.className = "bi bi-heart-fill text-danger hold";
        likesNumber++;
        setLikesFeed(likesNumber, target.title);
        axios.get(`http://localhost:8000/project/curtir/${likeIcon.title}`)
            .then()
            .catch((err) => console.log(err));
    }
}
