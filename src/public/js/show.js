
function setComment(){
    localStorage.setItem('comment', 'true')
}

function getComment(){
    return localStorage.getItem('comment') === 'true';
}
