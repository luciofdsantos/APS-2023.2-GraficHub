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

window.onload = function() {
    const corSalvaS = localStorage.getItem('corDeFundof');
    const corSalvaD = localStorage.getItem('corDeFundod');
    const out = localStorage.getItem('out');
    if (corSalvaS && corSalvaD && !out) {
        document.getElementById("seguindo-box").style.backgroundColor = corSalvaS;
        document.getElementById("descobrir-box").style.backgroundColor = corSalvaD;
    }else{
        document.getElementById("seguindo-box").style.backgroundColor = "#f6f6f6";
        document.getElementById("descobrir-box").style.backgroundColor = "#D9D9D9";
    }
    localStorage.setItem('corDeFundod', "#D9D9D9");
    localStorage.setItem('corDeFundof', "#f6f6f6");
};

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
