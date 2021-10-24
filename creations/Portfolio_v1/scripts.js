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
        letlargeur = $(window).width()
        // Calcul de la largeur de la barre     
        let barre = position / hauteur * largeur
        // Modification du CSS pour élargir ou réduire la barre     
        $("#progress").css("width",barre)
    });
});