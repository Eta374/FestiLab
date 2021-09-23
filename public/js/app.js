window.addEventListener('scroll', () => { /* récuperation de la valeur du scroll) */
    const body = document.querySelector("body"); /* selec balise (body) */
    const nav = document.querySelector("nav");
    const logo = document.querySelector("#logo"); /* selec balise (id="logo") */
    if(window.scrollY > 5 ){ /* Si la valeur du scroll est supperrieur à 30px */
        nav.classList.add("bg-glass");
    }
    else{
        nav.classList.remove( "bg-glass");
    }
})

