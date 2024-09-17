function setFormattedNumber(number, element){
    let numberFormatted = number;
    if(number/1000000 >= 1){
        numberFormatted = (number/1000000)%1 ? (number/1000000).toFixed(1) : number/1000000;
        numberFormatted += 'M';
    }else if(number/1000 >= 1){
        numberFormatted = (number/1000)%1 ? (number/1000).toFixed(1) : number/1000;
        numberFormatted += 'K';
    }
    console.log(numberFormatted);
    element.innerText = `${numberFormatted}`;
}

window.addEventListener('load', ()=>{
    let likeNumbers = document.getElementsByClassName('project-likes-number');
    for(let i=0; i<likeNumbers.length; ++i){
        setFormattedNumber(likeNumbers[i].title, likeNumbers[i])
    }
    let favoriteNumbers = document.getElementsByClassName('project-favorites-number');
    for(let i=0; i<favoriteNumbers.length; ++i){
        setFormattedNumber(favoriteNumbers[i].title, favoriteNumbers[i])
    }
})
