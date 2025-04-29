   
    // function initMap() {
    //     var input = document.getElementById('google_location');
    //     var autocomplete = new google.maps.places.Autocomplete(input);

    //     var mapOptions = {
    //         center: { lat: 0, lng: 0 },
    //         zoom: 2
    //     };
    //     var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    //     var marker = new google.maps.Marker({
    //         map: map,
    //         draggable: true
    //     });

    //     autocomplete.addListener('place_changed', function () {
    //         var place = autocomplete.getPlace();

    //         if (place.geometry) {
    //             map.setCenter(place.geometry.location);
    //             map.setZoom(15);
    //             marker.setPosition(place.geometry.location);
    //         }
    //     });

    //     marker.addListener('dragend', function () {
    //         var position = marker.getPosition();
    //         map.setCenter(position);
    //         map.setZoom(15);
    //         autocomplete.set('place', null);
    //         autocomplete.set('location', position);
    //     });
    // }

    // google.maps.event.addDomListener(window, 'load', initMap);
