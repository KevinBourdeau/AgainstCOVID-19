var searchInput = 'form_nomEtablissement';

$(document).ready(function () {
    var input = document.getElementById(searchInput);
    var options = {
        componentRestrictions: {country: 'fr'}
    };

    autocomplete = new google.maps.places.SearchBox(input, options);
	
});