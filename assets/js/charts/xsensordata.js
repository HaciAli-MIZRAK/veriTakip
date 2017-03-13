/* Global Değişkenler */
var IsiGostergesi1, IsiGostergesi2, IsiGostergesi3, xSensorDataInterval;
var markerId = null;
var ImeiId, CihazId;
var veriTakipRadar;
var arrayPoint = [];
var divIdx, veriTakipData;
var IsiGsotergesiColor1 = ["#06069e", "#3c3ce8", "#e4f70b", "#d50c0c"];
var IsiGsotergesiColor2 = ["#06069e", "#3c3ce8", "#e4f70b", "#d50c0c"];
var IsiGsotergesiColor3 = ["#06069e", "#3c3ce8", "#e4f70b", "#d50c0c"];
var userIdxz = $('#userIdxz').attr('title');
/* ısı göstergeleri */
IsiGostergesi1 = new JustGage({
    id: "IsiGostergesi1", 
    value: 0, 
    min: -60,
    max: 100,
    title: "Isı Göstergesi 1",
    label: "°C"
}, IsiGsotergesiColor1);

IsiGostergesi2 = new JustGage({
    id: "IsiGostergesi2", 
    value: 0, 
    min: -60,
    max: 100,
    title: "Isı Göstergesi 2",
    label: "°C"
}, IsiGsotergesiColor2);

IsiGostergesi3 = new JustGage({
    id: "IsiGostergesi3", 
    value: 0, 
    min: -60,
    max: 100,
    title: "Isı Göstergesi 3",
    label: "°C"
}, IsiGsotergesiColor3);

/* radar grafik verileri */
/*if(userIdxz == 4) {
divIdx = document.getElementById("veriTakipRadar").getContext("2d");
veriTakipData = {
    labels: ["veriTakip"],
    datasets: [
        {
            label: "veriTakip Panel",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [100]
        },
        {
            label: "veriTakip Panel",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [100]
        }
    ]
};
veriTakipRadar = new Chart(divIdx);//.Radar(data1);
veriTakipRadar = veriTakipRadar.Radar(veriTakipData);
}
/**
 * 
 * @param {type} item
 * @returns {undefined}
 *//*
function veriTakipRadarx( item )
{
    
    for(var i = 0;i < item.xSensorData.Sensor12.data.length;i++){
        label = item.xSensorData.Sensor12.data[i].label;
        value = item.xSensorData.Sensor12.data[i].value;
    }
    toplam = veriTakipRadar.datasets[0].points.length;
    arrayPoint.splice(0, toplam);
    for(var j = 0;j < veriTakipRadar.datasets[0].points.length;j++){
        arrayPoint.push(veriTakipRadar.datasets[0].points[j].label);
        mevcut = veriTakipRadar.datasets[0].points[j].value;
    }
    idx = arrayPoint.indexOf(label);
    if (idx != -1) {
        veriTakipRadar.datasets[0].points[idx].value = value;
    } else {
        veriTakipRadar.addData([mevcut, value], label);
    }
    veriTakipRadar.update();
}
*/

function xRawData( item )
{
    if (item.xRawData) {
        $('input#xRawDataMessage').attr('value', item.xRawDataId);
        if(item){
            $('.xRawData').show();
            $('#xRawData-veri').append(item.xRawData + '\n');
            $('#xRawData-veri').animate({ 
                scrollTop: '+=300px' 
            });
        } else {}
    }
} // end xRawData( item )

/* AtcPhoto Panel */
function xAtcPhotoModalPanel( item )
{
    if(item.length > 0){
        $('#atcPhoto').show(function(){
            $('span#xAtcPhotoModalCount').attr({
                class: 'fa-green'
            });
            $('#atcPhoto').attr({
                class: 'fa fa-picture-o fa-lg fa-green faa-flash animated'
            });
            $('span#xAtcPhotoModalCount').text(item.length);
            $('span#xAtcModalPanelImei').text(item[0].imeiid);
        });
        
        var photoitem = '';
        photoitem += '<div class="carousel slide" id="atcPhotoModal" data-ride="carousel">';
            photoitem += '<ol class="carousel-indicators" id="loliid">';
            for (var i = 0;i < item.length;i++){
                if (i == 0) {
                    var classxs = 'class="active"';
                } else {
                    var classxs = '';
                }
                photoitem += '<li data-target="#atcPhotoModal" data-slide-to="' + i + '"' + classxs + '></li>';
            }
            photoitem += '</ol>';
            photoitem += '<div class="carousel-inner" role="listbox">';
                for (var j = 0;j < item.length;j++){
                    if (j == 0){
                        itemclass = 'class="item active"'; 
                    } else {
                        itemclass = 'class="item"';
                    }
                    photoitem += '<div ' + itemclass + '>';
                        photoitem += '<img src="http://www.datatakip.net/~ekolfoto/' + item[j].photoname + '" alt="" style="width: 100%; max-height: 480px;" />';
                        photoitem += '<div class="carousel-caption">';
                            photoitem += '<h2>' + DateParser(item[j].linuxdate) + '</h2>';
                        photoitem += '</div>';
                    photoitem += '</div>';
                }
            photoitem += '</div>';
            photoitem += '<a class="left carousel-control" href="#atcPhotoModal" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>';
            photoitem += '<a class="right carousel-control" href="#atcPhotoModal" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
        photoitem += '</div>';
        $('#photoitemid').html(photoitem);
    } else {
        $('#atcPhoto').hide(); 
    }
}

/* xSensorData verileri */
/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function xSensorData( item )
{
    $('#xSensorDatauyari').empty();
    if(item.xSensorData == 0) {
        $('#satelliteCount').hide('slow');
        $('#bateryStatus').hide('slow');
        $(".xSensor04-01").hide();
        $(".xSensor04-02").hide();
        $(".xSensor04-03").hide();
        $('.xSensor12').hide();
        clearInterval(xSensorDataInterval);
    } else {
        /* CAN 02 PGN */
        if(item.xSensorData.Sensor02 == undefined) {
            /* CAN 02 Speed Yoksa işlem yap */
        } else {
            $CAN02654 = '';
            $CAN0242E = '';
            for (var i = 42;i < 52;i++)
            {
                $CAN02654 += item.xSensorData.Sensor02.CAN02PGN.CAN02654[i]; 
            }
            for (var jx = 31;jx < 44;jx++)
            {
                $CAN0242E += item.xSensorData.Sensor02.CAN02PGN.CAN0242E[jx]; 
            }
           $('#canSpeedTest').html('<i class="fa fa-dashboard"></i> ' + parseInt($CAN02654, 2) + ' KM Range<br /><i class="fa fa-dashboard"></i>' + item.xSensorData.Sensor02.CAN02PGN.CAN0242E + ' % SOC' ); 
        }
//##############################################################################
//############## Birden fazla sıcaklık sensörü işlemek #########################
//##############################################################################        
        if(item.xSensorData.Sensor04 == undefined){
            $(".xSensor04-01").hide();
            $(".xSensor04-02").hide();
            $(".xSensor04-03").hide();
        } else {
            /* xSensörData veri kontrolü ve hata alıklama */
            if(item.xSensorData.Sensor04.Sensor1 == undefined){ $(".xSensor04-01").hide(); } else {
                if(item.xSensorData.Sensor04.Sensor1.sensorsorun){
                    $(".xSensor04-01").show();
                    $('#IsiGostergesi1').hide();
                    $('#xSensor04-01-warning').show();
                    $('#xSensor04-01-warning').html('1. ' + item.xSensorData.Sensor04.Sensor1.sensorsorun);
                }
                if (item.xSensorData.Sensor04.Sensor1.SensorDeger){
                    $('#xSensor04-01-warning').hide();
                    $(".xSensor04-01").show();
                    $('#IsiGostergesi1').show();
                    $('.isideger04-01hiden').text(item.xSensorData.Sensor04.Sensor1.SensorDeger + '°C');
                    IsiGostergesi1.refresh(item.xSensorData.Sensor04.Sensor1.SensorDeger, 100);
                }
            }
            if(item.xSensorData.Sensor04.Sensor2 == undefined){ $(".xSensor04-02").hide(); } else {
                if(item.xSensorData.Sensor04.Sensor2.sensorsorun){
                    $(".xSensor04-02").show();
                    $('#IsiGostergesi2').hide();
                    $('#xSensor04-02-warning').show();
                    $('#xSensor04-02-warning').html('2. ' + item.xSensorData.Sensor04.Sensor2.sensorsorun);
                }
                if (item.xSensorData.Sensor04.Sensor2.SensorDeger){
                    $('#xSensor04-02-warning').hide();
                    $(".xSensor04-02").show();
                    $('#IsiGostergesi2').show();
                    $('.isideger04-02hiden').text(item.xSensorData.Sensor04.Sensor2.SensorDeger + '°C');
                    IsiGostergesi2.refresh(item.xSensorData.Sensor04.Sensor2.SensorDeger, 100);
                }
            }
            if(item.xSensorData.Sensor04.Sensor3 == undefined){ $(".xSensor04-03").hide(); } else {
                if(item.xSensorData.Sensor04.Sensor3.sensorsorun){
                    $(".xSensor04-03").show();
                    $('#IsiGostergesi3').hide();
                    $('#xSensor04-03-warning').show();
                    $('#xSensor04-03-warning').html('3. ' + item.xSensorData.Sensor04.Sensor3.sensorsorun);
                }
                if (item.xSensorData.Sensor04.Sensor3.SensorDeger){
                    $('#xSensor04-03-warning').hide();
                    $(".xSensor04-03").show();
                    $('#IsiGostergesi3').show();
                    $('.isideger04-03hiden').text(item.xSensorData.Sensor04.Sensor3.SensorDeger + '°C');
                    IsiGostergesi3.refresh(item.xSensorData.Sensor04.Sensor3.SensorDeger, 100);
                }
            }
        }
//##############################################################################
//############################ Satellitte Count ################################
//##############################################################################
        /* Satallitte Count */
        if(item.xSensorData.Sensor0E == undefined){ $('#satelliteCount').hide(); } else {
            $('#satelliteCount').show();
            $('#satelliteCount span').text('x' + item.xSensorData.Sensor0E.SatelliteCount);
            if(item.xSensorData.Sensor0E.SatelliteCount > 9){
                $('#satelliteCount').attr({
                    class: 'icon-satellitedish-remotemysql fa-green fa-lg'
                });
            } else {
               $('#satelliteCount').attr({
                    class: 'icon-satellitedish-remotemysql fa-red fa-lg'
                }); 
            }
        } /* Satallitte Count */
        
        /* Transparan Mod */
        if(item.xSensorData.Sensor12 == undefined){ } else {
            //veriTakipRadarx( item );  
        }
        
        /* Batery Seviyesi */
        if(item.xSensorData.Sensor19 == undefined){ $('#bateryStatus').hide(); } else {
            $('#bateryStatus').show();
            $('#bateryStatus span').text(item.xSensorData.Sensor19.BateryPercentage + '%');
            if(item.xSensorData.Sensor19.BateryPercentage <= 0){
                $('#bateryStatus').attr({
                    class: 'fa fa-battery-empty fa-red fa-lg'
                });
            } else if(item.xSensorData.Sensor19.BateryPercentage <= 25){
                $('#bateryStatus').attr({
                    class: 'fa fa-battery-quarter fa-orange fa-lg'
                });
            } else if(item.xSensorData.Sensor19.BateryPercentage <= 50){
                $('#bateryStatus').attr({
                    class: 'fa fa-battery-half fa-orange fa-lg'
                });
            } else if(item.xSensorData.Sensor19.BateryPercentage <= 75){
                $('#bateryStatus').attr({
                    class: 'fa fa-battery-three-quarters fa-blue-primary fa-lg'
                });
            } else if(item.xSensorData.Sensor19.BateryPercentage <= 97){
                $('#bateryStatus').attr({
                    class: 'fa fa-battery-full fa-green fa-lg'
                });
            } else if(item.xSensorData.Sensor19.BateryPercentage >= 99){
                $('#bateryStatus').attr({
                    class: 'fa fa-battery-full fa-green fa-lg'
                });
            }
        } /* Batery Seviyesi */
    }
}

/* xSensorData ve veriTakipRadar verilerini güncelleme alanı */
/**
 * 
 * @param {type} plaka
 * @returns {undefined}
 */
function ustNavbarx( plaka ){ 
    window.setTimeout(function(){
        ajaxJSONParser( yol + 'webservis/xsensordata', {imeiid: ImeiId}, "xSensorData( item )" );
        ajaxJSONParser( yol + 'webservis/xatcphotomodal', {imeiid: ImeiId}, "xAtcPhotoModalPanel( item )" );
        ajaxJSONParser( yol + 'webservis/xdevicecontrol', {imeiid: ImeiId}, "DeviceControl( item )" );
        ajaxJSONParser( yol + 'webservis/xaddresscheckinfo', {imeiid: ImeiId}, "xAddressCheckInfo( item )" );
        $('#divecePlate').text(plaka);
    }, 3000);
    myModalAlarmClose = window.setInterval(function(){
	ajaxJSONParser( yol + 'webservis/atcalarminfo', {imeiid: ImeiId}, "AtcAlarmInfo( item )" );
    }, 15000);
    xSensorDataInterval = window.setInterval(function(){
        ajaxJSONParser( yol + 'webservis/xsensordata', {imeiid: ImeiId}, "xSensorData( item )" );
        var xRawDataId = $('input#xRawDataMessage').attr('value');
        ajaxJSONParser( yol + 'webservis/xrawdata', {imeiid: ImeiId, xrawdataid: xRawDataId}, "xRawData( item )" );
    }, 25000);
    window.setInterval(function(){
        ajaxJSONParser( yol + 'webservis/xaddresscheckinfo', {imeiid: ImeiId}, "xAddressCheckInfo( item )" );
    }, 60000);
    window.setInterval(function(){
        ajaxJSONParser( yol + 'webservis/xatcphotomodal', {imeiid: ImeiId}, "xAtcPhotoModalPanel( item )" );
    }, 180000);
    window.setInterval(function(){
        ajaxJSONParser( yol + 'webservis/xdevicecontrol', {imeiid: ImeiId}, "DeviceControl( item )" );
    }, 670000);
}

/**
 * Buradan Aşağıda Küçük pencere buton olayları mevcut.
 * @param {type} param
 */
$(".xSensor04-01").mouseover(function(){
    $(this).attr({
            id: 'mouseoveron'
        });
}).mouseout(function(){
    $(this).attr({
            id: 'mouseoveroff'
        });
});
$(".xSensor04-02").mouseover(function(){
    $(this).attr({
            id: 'mouseoveron'
        });
}).mouseout(function(){
    $(this).attr({
            id: 'mouseoveroff'
        });
});
$(".xSensor04-03").mouseover(function(){
    $(this).attr({
            id: 'mouseoveron'
        });
}).mouseout(function(){
    $(this).attr({
            id: 'mouseoveroff'
        });
});
$(".xSensor12").mouseover(function(){
    $(this).attr({
            id: 'mouseoveron'
        });
}).mouseout(function(){
    $(this).attr({
            id: 'mouseoveroff'
        });
});

$(".btn-minimize04-01").click(function(){
    if($(".xSensor04-01").height() == 254){
        $(this).toggleClass('btn-plus04-01');
        $(".xSensor04-01-widget-content").slideToggle();
        $(".xSensor04-01").animate({
            "marginTop": "5px",
            height: "-=230"
        });
        $('.ucnokta04-01').toggleClass('ucnoktax');
        $('.isideger04-01').toggleClass('fa-pull-right isideger04-01hiden');
    } else {
        $('.isideger04-01hiden').text('');
        $('.ucnokta04-01').removeClass('ucnoktax');
        $('.isideger04-01').removeClass('fa-pull-right isideger04-01hiden');
        $(".xSensor04-01").animate({
            "marginTop": "5px",
            height: "+=230"
        });
        $(".xSensor04-01-widget-content").slideToggle();
    }
});

/**
 * 
 */
$(".btn-minimize04-02").click(function(){
    if($(".xSensor04-02").height() == 254){
        $(this).toggleClass('btn-plus04-02');
        $(".xSensor04-02-widget-content").slideToggle();
        $(".xSensor04-02").animate({
            "marginTop": "5px",
            height: "-=230"
        });
        $('.ucnokta04-02').toggleClass('ucnoktax');
        $('.isideger04-02').toggleClass('fa-pull-right isideger04-02hiden');
    } else {
        $('.isideger04-02hiden').text('');
        $('.ucnokta04-02').removeClass('ucnoktax');
        $('.isideger04-02').removeClass('fa-pull-right isideger04-02hiden');
        $(".xSensor04-02").animate({
            "marginTop": "5px",
            height: "+=230"
        });
        $(".xSensor04-02-widget-content").slideToggle();
    }
});

/**
 * 
 */
$(".btn-minimize04-03").click(function(){
    if($(".xSensor04-03").height() == 254){
        $(this).toggleClass('btn-plus04-03');
        $(".xSensor04-03-widget-content").slideToggle();
        $(".xSensor04-03").animate({
            "marginTop": "5px",
            height: "-=230"
        });
        $('.ucnokta04-03').toggleClass('ucnoktax');
        $('.isideger04-03').toggleClass('fa-pull-right isideger04-03hiden');
    } else {
        $('.isideger04-03hiden').text('');
        $('.ucnokta04-03').removeClass('ucnoktax');
        $('.isideger04-03').removeClass('fa-pull-right isideger04-03hiden');
        $(".xSensor04-03").animate({
            "marginTop": "5px",
            height: "+=230"
        });
        $('#isideger04-03').text('');
        $(".xSensor04-03-widget-content").slideToggle();
    }
});

/**
 * 
 */
$(".btn-minimize12").click(function(){
    if($(".xSensor12").height() == 495){
        $(this).toggleClass('btn-plus12');
        $(".xSensor12-widget-content").slideToggle();
        $(".xSensor12").animate({
            "marginTop": "5px",
            height: "-=475"
        });
    } else {
        $(".xSensor12").animate({
            "marginTop": "5px",
            height: "+=475"
        });
        $(".xSensor12-widget-content").slideToggle();
    }
});

/**
 * @L Mesaj için panel geçici düzeltilecek.
 */
$(".btn-minimize-xRawData").click(function(){
    if($(".xRawData").height() == 395){
        $(this).toggleClass('btn-plus-xRawData');
        $(".xRawData-widget-content").slideToggle();
        $(".xRawData").animate({
            "marginTop": "5px",
            height: "-=375"
        });
    } else {
        $(".xRawData").animate({
            "marginTop": "5px",
            height: "+=375"
        });
        $(".xRawData-widget-content").slideToggle();
    }
});

/* xSensorData Penceresi altında slider button alanları */
$('.xSensorDataSliderButton04-01').click(function(){
    var index = $('.xSensorDataSlider04-01 div').index();
    $('.xSensorDataSlider04-01 div:eq('+index+')').slideToggle();
});
$('.xSensorDataSliderButton04-02').click(function(){
    var index = $('.xSensorDataSlider04-02 div').index();
    $('.xSensorDataSlider04-02 div:eq('+index+')').slideToggle();
});
$('.xSensorDataSliderButton04-03').click(function(){
    var index = $('.xSensorDataSlider04-03 div').index();
    $('.xSensorDataSlider04-03 div:eq('+index+')').slideToggle();
});

/* fotoğraf çekme paneli */
$('button#fotografCheck').click(function(){
    if(this) {
        $('button#fotografCheck').attr("disabled", true);
        $('button#fotografCheck2').attr("disabled", true);
        $('#disabled').attr({
            class: 'glyphicon glyphicon-camera fa-lg',
        });
        AltStatus = $('#disabled').attr('alt');
    }
    ajaxJSONParser( yol + 'cpanel/fotografcheck', {imeiid: ImeiId, status: '200ok', camno: AltStatus}, "FotografCheck( item )" );
});

$('button#fotografCheck2').click(function(){
    if(this) {
        $('button#fotografCheck2').attr("disabled", true);
        $('button#fotografCheck').attr("disabled", true);
        $('#disabled2').attr({
            class: 'glyphicon glyphicon-camera fa-lg',
        });
        AltStatus = $('#disabled2').attr('alt');
    }
    ajaxJSONParser( yol + 'cpanel/fotografcheck', {imeiid: ImeiId, status: '200ok', camno: AltStatus}, "FotografCheck( item )" );
});

function FotografCheck( item )
{
    if(item.successful == 'ok700') {
        alert('Fotoğraf Çekimi Başarılı Ortala 3 Dakika içinde Fotoğrafı Görebilirsiniz. Tekrar Çekim Yapabilmek için 5 Dakika Beklemelisiniz.');
    } else
    if(item.successful == 'ok100') {
        alert('Fotoğraf Çekimi Başarısız. Lütfen Tekrar Deneyin');
        $('button#fotografCheck').attr("disabled", false);
        $('#disabled').attr({
            class: 'glyphicon glyphicon-camera fa-green fa-lg',
        });
        
    } 
}

/* ATC AlarmInfo Bilgileri */
function AtcAlarmInfo( item )
{
    if (item.AlarmInfoData == '-1') {} else {
	$("#myModalAlarmText").html("<h2>" + item.AlarmInfoData + "</h2>");
	$("#myModalAlarm").modal('show'); 
	clearInterval(myModalAlarmClose);
    }
}

/* Cihaz Bağlantı Kontrolü */
function DeviceControl( item )
{
    if(item.ButtonStatus == 'buttondeActive'){
        $('button#fotografCheck2').attr("disabled", true);
        $('button#fotografCheck').attr("disabled", true);
        $('#DeviceControl').text(item.DeviceControl);
    } else {
        $('button#fotografCheck2').attr("disabled", false);
        $('button#fotografCheck').attr("disabled", false);
        $('#DeviceControl').empty();
    }
}

/* özel function lar */
function DateParser( xDate )
{
    if (xDate) {
        $Date = xDate.split(' ');
        $par = $Date[0].split('-');
        return $par[2] + '/' + $par[1] + '/' + $par[0] + ' - ' + $Date[1];
    }
}

/* Address Bilgisi Çek */
function xAddressCheckInfo( item )
{
    $('#AddessInfoPanel').text(item.display_name);
}
