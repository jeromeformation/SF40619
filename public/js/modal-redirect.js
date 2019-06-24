$(document).ready(function() {
    // Activation de la modale
    $('.modal').modal('show');
    // Récuparation protocole + nom de domaine
    const baseUrl = window.location.origin;
    // On met en place le timer pour 5 secondes
    setTimeout(function () {
        // On redirige l'utilisateur
        window.location.replace(baseUrl + '/inscription');
    }, 5000);
});

