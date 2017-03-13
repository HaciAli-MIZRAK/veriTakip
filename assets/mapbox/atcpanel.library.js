/*
 onEnd: function(){
    if (item.Ignition == 0) {
        this.options.iconUrl = "http://a.tiles.mapbox.com/v4/marker/pin-l-car+adff2f.png?access_token=pk.eyJ1IjoibWl6cmFrbGFyIiwiYSI6IlVyZjhEeGsifQ.pYhDWD4JZ6F0XP9FWJH-yw"; 
    }
    if(item.Ignition == 1) {
        this.options.iconUrl = "http://a.tiles.mapbox.com/v4/marker/pin-l-car+d10707.png?access_token=pk.eyJ1IjoibWl6cmFrbGFyIiwiYSI6IlVyZjhEeGsifQ.pYhDWD4JZ6F0XP9FWJH-yw"; 
    }
    if(item.Rolante == 1) {
        this.options.iconUrl = "http://a.tiles.mapbox.com/v4/marker/pin-l-car+ffa500.png?access_token=pk.eyJ1IjoibWl6cmFrbGFyIiwiYSI6IlVyZjhEeGsifQ.pYhDWD4JZ6F0XP9FWJH-yw"; 
    }
}
 */

// Atc data Parser
function AtcInfoParse( item ){
    if(item.API_KEY) {
    } else {
        if (item.ozellikler.length > 0) {
            for (var i = 0;i < item.ozellikler.length;i++) {
                RealTimeData = item.ozellikler[i];
                AtcInfo.InfoId      = i;
                AtcInfo.Coordinates = RealTimeData.geometry.coordinates;
                AtcInfo.CihazId     = RealTimeData.geometry.cihazId;
                AtcInfo.Plaka       = RealTimeData.geometry.plaka;
                AtcInfo.Ignition    = 1;
                AtcInfo.Rolante     = 1;
                $('#maps-loading-atc').show();
                if($('#userIdxz').attr('rel') == '4'){
                    Assan_createAnimatedMarker( AtcInfo );  
                } else {
                    createAnimatedMarker( AtcInfo ); 
                }
                
            } // end for();
            $('.total-car').html(i);
        } else {
            $("#myModalUyari").modal('show'); 
        }
    }
}

// Marker Create
function createAnimatedMarker( item ){
    marker = L.animatedMarker(L.polyline(item.Coordinates).getLatLngs(),{
        icon: standartIcon,
        draggable: true,
        autoStart: true,
        InfoId: item.InfoId,
        CihazId: item.CihazId,
        Plaka: item.Plaka
    })
    .on('click', function(e){
        markerId = this.options.InfoId;
        ImeiId = this.options.CihazId.substring(4);
        map.panTo(e.latlng);
        ustNavbarx( this.options.Plaka );
        MovingVehicles( ImeiId );
    })
    .bindLabel(item.Plaka);
    marker.addTo(map);
    markers.push(marker);
    $('#maps-loading-atc').hide('slow');
}

// Hareketli Araçları Alıyoruz.
function HareketliAraclar( item ) {
    if (markerId == null) {} else {
        if (ImeiId == item.AktiveData.imeiId.substring(4)) {
            m = markers[markerId];
            myLatlngNew = new L.LatLng(item.AktiveData.coordinate[0], item.AktiveData.coordinate[1]);
            m.animateTo(myLatlngNew);
            /////////////////////////
            $('.AlarmMerkeziKoordinat').html("B: " + item.AktiveData.coordinate[0] + ", E: " + item.AktiveData.coordinate[1]); // bu kısım geçici olarak eklenmiştir.
            m.options.Speed = item.AktiveData.Speed;
            m.options.Ignition = item.AktiveData.Ignition[3];
            m.options.Rolante = item.AktiveData.Ignition[16];
            m.options.EngineBlock = item.AktiveData.Ignition[14];
            m.options.Sensor12 = item.AktiveData.Sensor12;
            m.options.xSensor12Data = item.AktiveData.xSensor12;
            /* Status */
            if (item.AktiveData.Ignition[4] == 0) {
                $('#power-voltaj').show();
            } else 
            if (item.AktiveData.Ignition[4] == 1) {
                $('#power-voltaj').hide();
            }
            // Motor Blokaj Button
            if(item.AktiveData.Ignition[14] == 0){
                $('#AtcMotorBlokajButton').show();
                //$('#AtcMotorBlokaj').attr({
                //    'class': 'icon-motorblokaj-icon-siyah2 fa-green fa-3x'
                //});
            } else
            if(item.AktiveData.Ignition[14] == 1) {
                $('#AtcMotorBlokaj').attr({
                    'class': 'icon-motorblokaj-icon-siyah2 fa-red fa-3x'
                });
            }
            /* Hardwarex */
            if(item.AktiveData.Hardware[14] == 1) {
                $('#fotografCheck').show();
                $('#fotografCheck2').show();
            } else
            if (item.AktiveData.Hardware[14] == 0) {
                $('#fotografCheck').hide();
                $('#fotografCheck2').hide();
            }
            /////////////////////////
            m.setPulsing(true);
            m.on('dblclick', function(e){
                map.setView(e.latlng, 17);
            });
            map.addLayer(m);
        }
    }
}

$('#DeviceSearch').keyup(DeviceSearch).keyup();
/**
 * Arama Alanı Tamamlandı Aranan Marker Rengi Değişiyor ve Aranan Marker Üste Çıkıyor.
 * @returns {undefined}
 */
function DeviceSearch () {
    for (var i = 0;i < markers.length;i++){
        mx = markers[i];
        if(mx.options.Plaka == $('#DeviceSearch').val()){
            mx.deviceSearchZoom(true);
            mx._icon.src = "http://a.tiles.mapbox.com/v4/marker/pin-l-car+073530.png?access_token=pk.eyJ1IjoibWl6cmFrbGFyIiwiYSI6IlVyZjhEeGsifQ.pYhDWD4JZ6F0XP9FWJH-yw"; 
            //var $styleZIndex = mx._icon.style.zIndex;
            mx._icon.style.zIndex = mx._icon.style.zIndex + 9999;
            mx._zIndex = mx._zIndex + 9999;
        }
    }
}
$('[data-toggle="tooltip"]').tooltip('show'); 
// Hareketli Araç Gösterge Paneli
/*function AtcDasboard( item ){
    if (item.AktiveData.Speed == null) {} else {
	$('#gaugeContainer').on('valueChanging', function (e) {
            $('#gaugeValue').text(Math.round(e.args.value) + ' kmh');
        });
        $('#gaugeContainer').jqxGauge({ caption: { value: item.AktiveData.Plaka }});
        $('#gaugeContainer').jqxGauge('value', item.AktiveData.Speed);
        $('#gaugeValuex').text(item.AktiveData.Distance + ' km');
    }
}*/

/*############################################################################*/
/*############################################################################*/
/*############################################################################*/
function Assan_BluetoothBeaconMarker( item )
{
    console.log(item);
}

function Assan_createAnimatedMarker( item ){
    marker = L.marker([item.Coordinates[0][0], item.Coordinates[1][1]],{
        icon: standartIcon,
        draggable: true,
        autoStart: true,
        InfoId: item.InfoId,
        CihazId: item.CihazId,
        Plaka: item.Plaka
    })
    .on('click', function(e){
        markerId = this.options.InfoId;
        ImeiId = this.options.CihazId.substring(4);
        map.panTo(e.latlng);
        ustNavbarx( this.options.Plaka );
        MovingVehicles( ImeiId );
    })
    .bindLabel(item.Plaka);
    clusterGroup.addLayer(marker);
    //marker.addTo(map);
    markers.push(marker);
    $('#maps-loading-atc').hide('slow');
}
map.addLayer(clusterGroup);


