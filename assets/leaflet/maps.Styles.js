var mapStyles = null;

/*var mapStyles = [
    {"featureType": "water","stylers": [{"saturation": 43},{"lightness": -11},{"hue": "#0088ff"}]},
    {"featureType": "road","elementType": "geometry.fill","stylers": [{"hue": "#ff0000"},{"saturation": -100},{"lightness": 99}]},
    {"featureType": "road","elementType": "geometry.stroke","stylers": [{"color": "#808080"},{"lightness": 54}]},
    {"featureType": "landscape.man_made","elementType": "geometry.fill","stylers": [{"color": "#ece2d9"}]},
    {"featureType": "poi.park","elementType": "geometry.fill","stylers": [{"color": "#ccdca1"}]},
    {"featureType": "road","elementType": "labels.text.fill","stylers": [{"color": "#767676"}]},
    {"featureType": "road","elementType": "labels.text.stroke","stylers": [{"color": "#ffffff"}]},
    {"featureType": "poi","stylers": [{"visibility": "off"}]},
    {"featureType": "landscape.natural","elementType": "geometry.fill","stylers": [{"visibility": "on"},{"color": "#b8cb93"}]},
    {"featureType": "poi.park","stylers": [{"visibility": "on"}]},
    {"featureType": "poi.sports_complex","stylers": [{"visibility": "on"}]},
    {"featureType": "poi.medical","stylers": [{"visibility": "on"}]},
    {"featureType": "poi.business","stylers": [{"visibility": "simplified"}]}
];*/
/*var mapStyles = [
    {featureType:'water',elementType:'all',stylers:[{hue:'#d7ebef'},{saturation:-5},{lightness:54},{visibility:'on'}]},
    {featureType:'landscape',elementType:'all',stylers:[{hue:'#eceae6'},{saturation:-49},{lightness:22},{visibility:'on'}]},
    {featureType:'poi.park',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-81},{lightness:34},{visibility:'on'}]},
    {featureType:'poi.medical',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-80},{lightness:-2},{visibility:'on'}]},
    {featureType:'poi.school',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-91},{lightness:-7},{visibility:'on'}]},
    {featureType:'landscape.natural',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-71},{lightness:-18},{visibility:'on'}]},
    {featureType:'road.highway',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:60},{visibility:'on'}]},
    {featureType:'poi',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-81},{lightness:34},{visibility:'on'}]},
    {featureType:'road.arterial',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:37},{visibility:'on'}]},
    {featureType:'transit',elementType:'geometry',stylers:[{hue:'#c8c6c3'},{saturation:4},{lightness:10},{visibility:'on'}]}
];*/
/*var mapStyles = [
    {"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},
    {"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},
    {"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},
    {"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},
    {"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},
    {"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}
];*/
/*var mapStyles = [
    {"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},
    {"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},
    {"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},
    {"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},
    {"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},
    {"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},
    {"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},
    {"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}
];*/
/*var mapStyles = [
    {"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},
    {"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},
    {"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},
    {"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},
    {"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},
    {"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},
    {"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},
    {"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},
    {"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},
    {"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},
    {"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},
    {"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},
    {"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},
    {"featureType":"transit","stylers":[{"visibility":"off"}]},
    {"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},
    {"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},
    {"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},
    {"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},
    {"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}
];*/
/*if(userIdxz == 4) {
    var mapStyles = [
        {"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},
        {"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},
        {"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},
        {"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},
        {"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},
        {"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},
        {"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},
        {"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},
        {"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},
        {"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},
        {"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},
        {"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},
        {"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}
    ];
}*/
///////////////////////////////////////////////////////////////////////////////