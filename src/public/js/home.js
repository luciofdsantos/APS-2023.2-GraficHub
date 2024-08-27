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
