// profile panelde alert için 
    $("#alert-remove-3x").hide(5000);

    // profil resmini yüklemeden ön izlemek için
    var upload_avatar_preview = $(".upload_avatar_preview");
    $(".files").change(function(){
        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();
        reader.onload = function(e){
            image_base64 = e.target.result;
            upload_avatar_preview.append('<img src="' + image_base64 + '" class="img-thumbnail img-responsive"/>');
        };
        reader.readAsDataURL(file);
    });
    
/* Profile için Benim Lokasyonum Uygulaması */
function initMap() {
    var myLatLng = {lat: __longitude, lng: __latitude};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('atcpanel-maps-x'), {
        center: myLatLng,
        scrollwheel: true,
        zoomControl: true,
        panControl: false,
        streetViewControl: false,
        //styles: mapStyles,
        //mapTypeId: google.maps.MapTypeId.SATELLITE,
        zoom: 7
    });
    //map.setTilt(45);

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
      map: map,
      position: myLatLng,
      icon: yol + 'assets/img/flags/maps-flag.png',
      labelAnchor: new google.maps.Point(50, 0),
      draggable: true,
      //title: 'Hello World!'
    });
    map.panTo(marker.getPosition());
    marker.addListener('dblclick', function() {
        map.setZoom(17);
        map.setCenter(marker.getPosition());
    });

    google.maps.event.addListener(marker, "mouseup", function (event) {
    var latitude = this.position.lat();
    var longitude = this.position.lng();
    $('#latitude').val( longitude );
    $('#longitude').val( latitude );
    });

    /* fullscreen */
    $('#profile-fullscreen').click(function(){
        if($('#atcpanel-maps-x').height() > 300) {
            $('#atcpanel-maps-x').attr({
               id: 'atcpanel-maps-x-' 
            });
            $('#profile-maps-xx').attr({
                class: 'fa fa-minus fa-lg fa-red'
            });
            console.log("maps büyüt");
        } else {
            $('#atcpanel-maps-x-').attr({
               id: 'atcpanel-maps-x' 
            });
            $('#profile-maps-xx').attr({
                class: 'glyphicon glyphicon-fullscreen fa-lg'
            });
            console.log("maps küçült");
        }
    });
}
initMap();