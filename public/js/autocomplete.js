/**
 * Script permmettant l'autocomplétion et la recherche de lieus ou bâtiments grâce à l'API Places de Google
 */

 /*On récupère l'id de notre formulaire */
var searchInput = 'form_nomEtablissement'; 

/*Initialisation du DOM */
$(document).ready(function () {
    /*On récupère ici tout les éléments en fonction de ce que l'utilisateur a tapé dans l'entrée */
    var input = document.getElementById(searchInput);
    /*On restreint les résultats qu'en France */
    var options = {
        componentRestrictions: {country: 'fr'}
    };
    /*On fait appel ici à la méthode SearchBox de l'API avec en nos deux paramètres précédent */
    autocomplete = new google.maps.places.SearchBox(input, options);
	
});