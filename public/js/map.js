 // Initialisation et ajout de la map
 function initMap() {
    // Localisation du campus Labège
    var cesi = {
        lat: 43.548492,
        lng: 1.503044
    };
    // Description du campus
    var contentString = '<div id="content">' +
        '<div id="siteNotice">' +
        '</div>' +
        '<h1 id="firstHeading" class="firstHeading">Campus CESI</h1>' +
        '<div id="bodyContent">' +
        '<p><b>Campus CESI</b>, Batiment Alpha, 16 Rue Magellan, 31670 Labège</p>' +
        '</div>' +
        '</div>';
    //Fenêtre popup contenant la description
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    // La map centré sur le campus
    var map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 17,
            center: cesi
        });

    // Marqueur positionné sur le campu
    var marker = new google.maps.Marker({
        position: cesi,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        title: 'Campus CESI'
    });
    //Listenert qui quand on click sur le marqueur une fenêtre s'affiche
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });
}