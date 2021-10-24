// window.onscroll = function() {
    
//     if (document.documentElement.scrollTop > 50) {
//         document.getElementById("navbar").style.background = "black";
//         document.getElementById("navbar").style.padding = "0";
//         document.getElementById("navbar").style.borderBottom = "1px solid #606060";
//     } else {
//         document.getElementById("navbar").style.background = "transparent";
//         document.getElementById("navbar").style.padding = "0 20px";
//     }
// }

window.onload = () => {
    // Ecouteur d'évènement sur scroll
    window.addEventListener("scroll", () => {
        // Calcul de la hauteur "utile" du document
        let hauteur = document.documentElement.scrollHeight - window.innerHeight
        // Récupération de la position verticale
        let position = window.scrollY
        // Récupération de la largeur de la fenêtre
        let largeur = document.documentElement.clientWidth
        // Calcul de la largeur de la barre
        let barre = position / hauteur * largeur
        // Modification du CSS de la barre
        document.getElementById("progress").style.width = barre+"px"
    })
}
(function(){
    $(document).on('scroll',function(){ // Détection du scroll
        // Calcul de la hauteur "utile"
        let hauteur = $(document).height()-$(window).height()
        // Récupération de la position verticale
        let position = $(document).scrollTop()
        // Récupération de la largeur de la fenêtre
        let largeur = $(window).width()
        // Calcul de la largeur de la barre     
        let barre = position / hauteur * largeur
        // Modification du CSS pour élargir ou réduire la barre     
        $("#progress").css("width",barre)
    });
});

function toggleDivSize(div) {
    var x = document.getElementsByClassName(div);
    x[0].classList.toggle('max-div');
}

// var clicks = 0;
// function countClick() {
//     clicks += 1;
//     console.log(clicks);
// }

// function maximizeDiv(div) {
//     if (clicks%2 != 0) {               // Si le nombre de clics est impair, alors la div est censée être petite. Donc on l'aggrandit
//         var x = document.getElementsByClassName(div);
//         x[0].style.width="100%";
//         x[0].style.height="750px";
//     }
// }

// function minimizeDiv(div) {
//     // var element = document.getElementById('maximized');
//     if (clicks%2 == 0) {               // Si le nombre de clics est pair, alors la div est censée être grande. Donc on la rétrécit
//         var x = document.getElementsByClassName(div);
//         x[0].style.width="350px";
//         x[0].style.height="350px";
//     }
// }