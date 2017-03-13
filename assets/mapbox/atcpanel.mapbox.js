/*
 * mapbox harita oluşturma kodları
 * Listing markers in view eklenecek
 * Distance between two markers eklenecek
 * Toggling UI eklenecek
 * Leaflet Label eklenecek
 * Driving directions eklenecek
 * Toggle marker color on click eklenecek
 * Marker movement eklenecek
 * Display marker tooltip onload eklenecek
 * worldCopyJump option eklenecek
 * Live collaborative editing with Firebase eklenecek
 * Display latitude longitude on marker movement eklenecek
 * Leaflet Markercluster eklenecek
 * Listing markers in clusters eklenecek
 * Clusters with custom polygon appearance eklenecek
 * Markercluster with Mapbox marker data eklenecek
 * Animate a marker along line eklenecek
 */
//var __Lat = 29.387508; // enlem
//var __Lng = 40.782277; // boylam
//var __zoom = 3; // zoom
var __Lat = __latitude == 0 ? '35.5297287' : __latitude; // enlem
var __Lng = __longitude == 0 ? '38.9744732' : __longitude; // boylam
var __zoom = 11; // zoom
var __MarkerLng = 38.965; // merkez marker
var __MarkerLat = 35.565; // merkez marker
var __ZoomClock = 1;

    L.mapbox.accessToken = 'pk.eyJ1IjoibWl6cmFrbGFyIiwiYSI6IlVyZjhEeGsifQ.pYhDWD4JZ6F0XP9FWJH-yw';
        if (__ZoomClock) {

            var map = L.mapbox.map('atcpanel-maps', mapsStyle,{
                center: [__Lng, __Lat],
                //fullscreenControl: false,
                zoomControl: true,
                touchZoom: true, // mobil aygıtlarda dokunmatik zoomlamayı kapatıyor ve açıyor.
                minZoom: 3, // maxsimum uzaklaşma
                maxZoom: 17 // maxsimum yakınlaşma
            })
            .addControl(L.mapbox.geocoderControl('mapbox.places', {
                autocomplete: true
            }))
            .setView([__Lng, __Lat], __zoom);

        } else {

            var map = L.mapbox.map('atcpanel-maps', mapsStyle,{
                center: [__Lng, __Lat],
                zoomControl: true,
                minZoom: 3, // maxsimum uzaklaşma
                maxZoom: 20 // maxsimum yakınlaşma
            })
            .addControl(L.mapbox.geocoderControl('mapbox.places', {
                autocomplete: true
            }))
            .setView([__Lng, __Lat], __zoom);

        } 

    L.control.fullscreen().addTo(map);

    var osm             = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    var basarlabel      = new L.TileLayer("http://www.basartrafik.com/wmsbsrLabel/tile21.ashx?z={z}&x={x}&y={y}");
    var basarmap        = new L.TileLayer("http://www.basartrafik.com/WMSBasarsoft/tile21.ashx?z={z}&x={x}&y={y}");
    var googleRoadMap   = new L.Google('ROADMAP');
    var googleSatellite = new L.Google('SATELLITE');
    var googleHybrid    = new L.Google('HYBRID');
    var googleTerrain   = new L.Google('TERRAIN');
    var googleTrafic    = new L.Google('ROADMAP', '', 'trafficLayer');
    var yndx            = new L.Yandex();

    var mapsStyle = L.control.layers({
        'Google Road Map': 	googleRoadMap,
        'Google Hybrid': 	googleHybrid,
        'Google Satellite': 	googleSatellite,
        'Google Terrain': 	googleTerrain,
        'Google Trafik':        googleTrafic,
        'Mapbox Maps':          L.mapbox.tileLayer('mizraklar.lb3eik9m'),
        'Open Street Map':      osm,
        'Yandex Map (Trafik)':  yndx,
        'Başar Map':            basarmap
    },
    {
        'Başar Map Etiketleri': basarlabel
    }).addTo(map);

    // Harita Zoom Göstergesi
    map.on('mouseover', function(){
        $('.zoom-level').html('<strong>Zoom Level : ' + map.getZoom() + '</strong>');
    });
    map.on('zoomend', function(){
        $('.zoom-level').html('<strong>Zoom Level : ' + map.getZoom() + '</strong>');
    });
map.addLayer(googleRoadMap);

//##############################################################################
//##############################################################################
//##############################################################################
//##################### BURADAN ASAGISI REAL TIME ATC KODLARI ICIN #############
//##############################################################################

var clusterGroup = new L.MarkerClusterGroup({
    zoomToBoundsOnClick: true,
    iconCreateFunction: function(cluster) {
        return new L.DivIcon({
            //id: 'id',
            //className: 'cls',
            //iconAnchor: [-5, 16],
            //iconSize: [0, 0],
            //popupAnchor: [0, -10],
            //labelAnchor: [3, -4],
            html: '<strong class="fa-text-shadow fa-red fa-2x" style="display: block; position: absolute; margin-top: 17px; margin-left: 10px; z-index: 999;">'  + cluster.getChildCount() + '</strong>' +
                  '<i class="pinoranges fa-white icon-bluetooth fa-3x" style="z-index: 799;"></i>' +
                  '<div class="pinoranges"></div>' +
                  '<div class="pulseoranges"></div>'
        });
    }
});


var standartIcon = L.mapbox.marker.icon({
    "marker-color": "#f86767",
    "marker-size":"large",
    "marker-symbol":"car"
});
var xstandartIcon = L.mapbox.marker.icon({
    "marker-color": "#f86767",
    "marker-size":"small"
});

/* özel marker sıfırlama markeri */

var sifirlama = L.marker([84.938342, -179.438163],{
    icon: xstandartIcon
}).addTo(map);
sifirlama.bindPopup("Özel Marker Sıfırlama Aracı");

// Global değişkenlerimiz ve arrayler
var AtcInfo = {};
var kmInfo = {};
var markers = [];
var marker, iconsx;