////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Assan Kroki Panel Bluetooth //////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var $Bluetooth = {};
var $AssanPanelBluetooth = '';
var $BletoohBeaconMoneyCar = '';
var $AssanPanelDoor01 = '';
var $AssanPanelDoor02 = '';
var $AssanPanel01a  = '';
var $AssanPanel01b = '';
var $AssanPanel02a = '';
var $AssanPanel02b = '';
var $AssanPanelWater = '';
var $AssanPanelfire = '';
var $AssanPanelMus01 = '';
var $AssanPanelMus02 = '';
var $AssanPanelUretim01 = '';
var $AssanPanelUretim02 = '';
var $AssanPanelUretim03 = '';
var $AssanPanelUretim04 = '';
var $AssanPanelPersonel01 = '';
var $AssanPanelPersonel02 = '';
var $AssanPanelAnaDepo01 = '';
var $AssanPanelAnaDepo02 = '';
var $AssanPanelAnaDepo03 = '';
var $AssanPanelAnaDepo04 = '';
var $AssanPanelAnaDepo05 = '';
var $AssanRightNotifications = '';
var IDarray = [];
var ImeiIdx = [];
var DataId = [];
var labelArray = [];
var valueArray = [];
var arrayPoint = [];
var dataxId = [];
var $AssanBrunt01, $AssanBrunt02, $AssanBrunt03, $GeneraleCount, $AssanAlarmCount, $AlarmName, $AlarmColor;
var userId = $('#userIdxz').attr('rel');
var AssanPaneleAlarmsArray = [];
var $HouseDate = new Date();

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelBluetooth( item )
{
    toplamx = ImeiIdx.length;
    ImeiIdx.splice(0, toplamx);
    if(item.imeiid.length > 0) {
        for (var i = 0;i < item.imeiid.length;i++) {
            $Bluetooth.id = i;
            $Bluetooth.imeiid = item.imeiid[i];
            IDarray.push($Bluetooth.imeiid.substring(7));
            DataId.push(i);
            ImeiIdx.push($Bluetooth.imeiid.substring(7));
            $AssanPanelBluetooth += '<div class="bletooh-beacon-' + $Bluetooth.imeiid.substring(7) + '" value="' + item.DataxId[i] + '" id="' + $Bluetooth.imeiid.substring(7) + '" style="top: -740px; left: 1040px;"><div class="marker-etiket-assan">' + $Bluetooth.imeiid.substring(7) + '</div><div class="marker-etiket-assan-tabela"><span class="macid-' + $Bluetooth.imeiid.substring(7) + '"></span></div><i class="pin icon-bluetooth"></i><div id="tabela-' + $Bluetooth.imeiid.substring(7) + '" class="pulse"></div></div>';
            $('#bletooh-beacon').html($AssanPanelBluetooth);
        }
        DraggableAssan( IDarray );
        Accessory( item, IDarray );
    }
} // end AssanPanelBluetooth( item )

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelBluetoothData( item )
{
    if(item.hata == 'undefined')
	{
        
    } else {
        if(item.xSensorData[0].xSensorData.Sensor12 == undefined)
        {

        } else {
            imeiid = item.xSensorData[0].imeiid;
            $('#' + imeiid.substring(7)).attr('value', item.xSensorData[0].DataxId);
            if(item.xSensorData[0].xSensorData.Sensor12.Sensor12 == 0)
            {
                $('#tabela-' + imeiid.substring(7)).addClass('pulsered');
            } else {
                for(var xi = 0;xi < item.xSensorData[0].xSensorData.Sensor12.data.length;xi++){
                    label = item.xSensorData[0].xSensorData.Sensor12.data[xi].label;
                    value = item.xSensorData[0].xSensorData.Sensor12.data[xi].value;
                    divClassAnimation( imeiid, label, value );
                    labelArray.push(label);
                }
            }
        }
    }
}

/**
 * 
 * @param {type} value
 * @param {type} label
 * @param {type} valueArray
 * @returns {undefined}
 */
function divClassAnimation( imeiid, label, value )
{
    /* araba için bluetooth sinyal mesafesini ayarlıyoruz */
    $mesafe = ( ( ( value ) * 10 ) ) + 'px';
    
    /* mesafeye göre isimlendirme yapıyoruz */
    if (value <= 0) {
        $deger = '<font color="red"><b>Ç.U</b></font>';
    }
    if (value <= 25) {
        $deger = '<font color="#0487fb"><b>U</b></font>';
    }
    if (value <= 35) {
        $deger = '<font color="orange"><b>O</b></font>';
    }
    if (value <= 50) {
        $deger = '<font color="orange"><b>O</b></font>';
    }
    if (value <= 75) {
        $deger = '<font color="#b3b4b5"><b>Y</b></font>';
    }
    if (value <= 85) {
        $deger = '<font color="#b3b4b5"><b>Y</b></font>';
    }
    if (value >= 95) {
        $deger = '<font color="#fdfefe"><b>Ç.Y</b></font>';
    }
    
    /* Bluetooth Göstergelerine veri ekliyoruz. */
    $('.macid-' + imeiid.substring(7)).prepend(label + "-|-" + $deger + '&' + value + "\n");
} // end divClassAnimation( item, label )

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function DraggableAssan( item )
{
    var $genislik = ($(window).width() - 215); // 230 en ideali ama bu proje için 215 yazdım
    var $yukseklik = ($(window).height() - 75);
    $('#denemesinirx').width($genislik);
    $('#denemesinirx').height($yukseklik);
    for (var i = 0;i < item.length;i++) {
        if (userId == 6) {
            $('#' + item[i]).draggable({
                containment: "#denemesinirx",
                scroll: false,
                // sürükleme başladığında işlem yapılacak function
                start: function(event,ui){
                },
                // sürükleme bittiğinde işlem yapılacak function
                stop: function(){
                    $Top = $(this).css('top');
                    $Left = $(this).css('left');
                    $Class = $(this).attr('id');
                    $.get( yol + 'cpanel/accessorysave',{_top: $Top, _left: $Left, _imeiid: $Class}, function( data ) {});
                    sweetAlert("İşlem Başarılı", "Cihaz İçin Yeni Konum Kayıt Edildi..", "success");
                }
            });
        } else {
            $('#' + item[i]).draggable({
                handle: "span",
                cancel: "span.macid-" + item[i],
                containment: "#denemesinirx",
                scroll: false,
                // sürükleme başladığında işlem yapılacak function
                start: function(event,ui){ 
                    sweetAlert("Hata", "Bu İşlem için Yetkiniz Yok", "error");
                },
                // sürükleme sonrası nesne eski konumuna gider
                revert: "invalid"
         }); 
        }
    }
} // end DraggableAssan( item )

/**
 * 
 * @param {type} item
 * @param {type} IDarray
 * @returns {undefined}
 */
function Accessory( item, IDarray )
{
    if (item.accessory.length > 0) {
        for (var i = 0;i < item.accessory.length;i++){
            item.accessory[i][0].metavalue;
            item.accessory[i][1].metavalue;
            item.accessory[i][2].metavalue;
            $('#' + IDarray[i]).css({
                'top': item.accessory[i][1].metavalue,
                'left': item.accessory[i][0].metavalue
            });
            $('#86107402992669175').css({
                'top': item.accessory[i][1].metavalue,
                'left': item.accessory[i][2].metavalue
            });
        }
    }
} // end Accessory( item, IDarray )

////////////////////////////////////////////////////////////////////////////////
////////////////// ASSAN ÜRETİM KAPILAR ////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/**
 * Assan Üretim Depo Dip Kapılar
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor01JS( item )
{
    /**
     * Depo Dip Taraf üretim kısmı
     */
    if(item.doorAlarm[2] == 1)
    {
        $AssanPanelDoor01 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 648px; left: 110px;"></div>';
    } else {
        $AssanPanelDoor01 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 660px; left: 120px;"></div>';
        $AlarmName = 'Depo Dip Sol Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Depo Dip Taraf Orta Depo Kısmı
     */
    if(item.doorAlarm[19] == 1)
    {
        $AssanPanelDoor02 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 453px; left: 110px;"></div>';
    } else {
        $AssanPanelDoor02 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 465px; left: 120px;"></div>';
        $AlarmName = 'Depo Dip Sag Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    $('#AssanPanelDoorG').html($AssanPanelDoor01 + $AssanPanelDoor02);
}

/**
 * Assan Üretim Bilgiİşlem Odası
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor02JS( item )
{
    /*
     * Giriş1 Kapı1-A Sıfır "0" ise Kapalı 1 ise Açık
     */
    if(item.doorAlarm[0] == 0)
    {
        $AssanPanel01a = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 168px; left: 1216px;"></div>';
    } else {
        $AssanPanel01a = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 180px; left: 1216px;"></div>';
        $AlarmName = 'Bilgiislem Kapı1-A';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Giriş2 Kapı1-B Sıfır "0" ise Kapalı 1 ise Açık
     */
    if(item.doorAlarm[1] == 0)
    {
        $AssanPanel01b = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 198px; left: 1216px;"></div>';
    } else {
        $AssanPanel01b = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 210px; left: 1216px;"></div>';
        $AlarmName = 'Bilgiislem Kapı1-B';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Kontak Kapı2-B Sıfır "0" ise Kapalı 1 ise Açık
     */
    if(item.doorAlarm[3] == 0)
    {
        $AssanPanel02b = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 198px; left: 1248px;"></div>';
    } else {
        $AssanPanel02b = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 198px; left: 1248px;"></div>';
        $AlarmName = 'Bilgiislem Kapı2-B';
        AssanPaneleAlarmsArray.push($AlarmName);
    }

    /**
     * Giriş4 Kapı2-A Sıfır "0" ise Kapalı 1 ise Açık
     */
    if(item.doorAlarm[18] == 0)
    {
        $AssanPanel02a = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 168px; left: 1248px;"></div>';
    } else {
        $AssanPanel02a = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 180px; left: 1248px;"></div>';
        $AlarmName = 'Bilgiislem Kapı2-A';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Giriş3 Su Baskını Sıfır "0" ise Su var 1 ise Su Yok
     */
    if(item.doorAlarm[2] == 1)
    {
        $AssanPanelWater = '<div class="vt-su vt-green fa-2x" style="display: block; position: absolute; top: 189px; left: 1275px;"></div>';
    } else {
        $AssanPanelWater = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 201px; left: 1275px;"></div>';
        $AlarmName = 'Su Baskını Sıfır';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Giriş5 Yangın Alarmı Sıfır "0" ise Açık 1 ise Kapalı
     */
    if(item.doorAlarm[19] == 1)
    {
        $AssanPanelfire = '<div class="vt-yangin vt-green fa-2x" style="display: block; position: absolute; top: 128px; left: 1250px;"></div>';
    } else {
        $AssanPanelfire = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 140px; left: 1250px;"></div>';
        $AlarmName = 'Yangın Alarmı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    $('#AssanPanelDoorH').html($AssanPanel01a + $AssanPanel01b + $AssanPanel02a + $AssanPanel02b + $AssanPanelWater + $AssanPanelfire);
}

/**
 * Assan Üretim Müşteri Bekleme Alanı
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor03JS( item )
{
    /**
     * Müşteri Bekleme Alanı Kapı
     */
    if(item.doorAlarm[0] == 0)
    {
        $AssanPanelMus01 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 428px; left: 1800px;"></div>';
    } else {
        $AssanPanelMus01 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 440px; left: 1800px;"></div>';
        $AlarmName = 'Müşteri Bekleme Alanı Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Pır dedektörü
     */
    if(item.doorAlarm[1] == 0)
    {
        $AssanPanelMus02 = '<div class="vt-hareket-deprem vt-green fa-2x" style="display: block; position: absolute; top: 413px; left: 1705px;"></div>';
    } else {
        if ($HouseDate.getHours() >= 8 && $HouseDate.getHours() < 18)
        {
            $AlarmColor = 'vt-orange';
        } else {
            $AlarmColor = 'vt-red';
        }
        $AssanPanelMus02 = '<div class="vt-alarm ' + $AlarmColor + ' fa-2x" style="display: block; position: absolute; top: 425px; left: 1705px;"></div>';
        $AlarmName = 'Müşteri Bekleme Pır Dedektörü';
        AssanPaneleAlarmsArray.push($AlarmName);
    }

    $('#AssanPanelDoorI').html($AssanPanelMus01 + $AssanPanelMus02);
}

/**
 * Assan Üretim Alanı Ofislerin Kapıları
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor04JS( item )
{
    /**
     * Üretim Tarafı ofis1 Soldan 1. Kapı
     */
    if(item.doorAlarm[18] == 0)
    {
        $AssanPanelUretim01 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 753px; left: 1610px;"></div>';
    } else {
        $AssanPanelUretim01 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 765px; left: 1615px;"></div>';
        $AlarmName = 'Üretim Tarafı ofis1 Soldan 1. Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Üretim Tarafı Ofis2 Soldan 2. Kapı
     */
    if(item.doorAlarm[1] == 0)
    {
        $AssanPanelUretim02 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 818px; left: 1610px;"></div>';
    } else {
        $AssanPanelUretim02 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 820px; left: 1615px;"></div>';
        $AlarmName = 'Üretim Tarafı ofis2 Soldan 2. Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Üretim Tarafı Ofis3 Soldan 3. Kapı
     */
    if(item.doorAlarm[0] == 0)
    {
        $AssanPanelUretim03 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 898px; left: 1610px;"></div>';
    } else {
        $AssanPanelUretim03 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 910px; left: 1615px;"></div>';
        $AlarmName = 'Üretim Tarafı ofis3 Soldan 3. Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Üretim Tarafı Sol Başda Yangın Çıkışı
     */
    if(item.doorAlarm[2] == 1)
    {
        $AssanPanelUretim04 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 678px; left: 1795px;"></div>';
    } else {
        $AssanPanelUretim04 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 690px; left: 1790px;"></div>';
        $AlarmName = 'Üretim Tarafı Sol Başda Yangın Çıkışı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    $('#AssanPanelDoorK').html($AssanPanelUretim01 + $AssanPanelUretim02 + $AssanPanelUretim03 + $AssanPanelUretim04);
}

/**
 * Assan Üretim Personel Giriş, Ofis Pır Dedektörü ve Koridor Pır Dedektörü
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor05JS( item )
{
    /**
     * Personel Girişi Sipariş Ofis Pır Dedektörü
     */
    if(item.doorAlarm[0] == 0)
    {
        $AssanPanelPersonel01 = '<div class="vt-checkmark vt-green fa-2x" style="display: block; position: absolute; top: 340px; left: 1663px;"></div>';
    } else {
        if ($HouseDate.getHours() >= 8 && $HouseDate.getHours() < 18)
        {
            $AlarmColor = 'vt-orange';
        } else {
            $AlarmColor = 'vt-red';
        }
        $AssanPanelPersonel01 = '<div class="vt-alarm ' + $AlarmColor + ' fa-2x" style="display: block; position: absolute; top: 340px; left: 1663px;"></div>';
        $AlarmName = 'Sipariş Ofis Pır Dedektörü';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Personel Giriş Kapısı
     */
    if(item.doorAlarm[3] == 0)
    {
        $AssanPanelPersonel02 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 258px; left: 1620px;"></div>';
    } else {
        $AssanPanelPersonel02 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 270px; left: 1625px;"></div>';
        $AlarmName = 'Personel Giriş Kapısı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    $('#AssanPanelDoorL').html($AssanPanelPersonel01 + $AssanPanelPersonel02);
}

/**
 * Assan Üretim Depo Orta Kapılar
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor06JS( item )
{
    /**
     * Sevikiyat Depo Soldan 1. Kapı
     */
    if(item.doorAlarm[0] == 0)
    {
        $AssanPanelAnaDepo01 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 470px; left: 1029px;"></div>';
    } else {
        $AssanPanelAnaDepo01 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 482px; left: 1029px;"></div>';
        $AlarmName = 'Sevikiyat Depo Soldan 1. Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Yarı Mamul Depo Soldan 2. Kapı
     */
    if(item.doorAlarm[1] == 0)
    {
        $AssanPanelAnaDepo02 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 440px; left: 1029px;"></div>';
    } else {
        $AssanPanelAnaDepo02 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 452px; left: 1041px;"></div>';
        $AlarmName = 'Yarı Mamul Depo Soldan 2. Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Yarı Mamul Depo Sagdan 1. Kapı Cam Kapı
     */
    if(item.doorAlarm[19] == 1)
    {
        $AssanPanelAnaDepo03 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 322px; left: 1029px;"></div>';
    } else {
        $AssanPanelAnaDepo03 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 334px; left: 1029px;"></div>';
        $AlarmName = 'Yarı Mamul Depo Sagdan 1. Kapı Cam Kapı';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Yarı Mamul Depo Sagdan 2. Kapı Fire Yönetimi
     */
    if(item.doorAlarm[2] == 1)
    {
        $AssanPanelAnaDepo05 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 120px; left: 1029px;"></div>';
    } else {
        $AssanPanelAnaDepo05 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 120px; left: 1041px;"></div>';
        $AlarmName = 'Yarı Mamul Depo Sagdan 2. Kapı Fire Yönetimi';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    
    /**
     * Streçleme Alanı Pır Dedektörü
     */
    if(item.doorAlarm[3] == 0)
    {
        $AssanPanelAnaDepo04 = '<div class="vt-hareket-deprem vt-green fa-2x" style="display: block; position: absolute; top: 634px; left: 1044px;"></div>';
    } else {
        $AssanPanelAnaDepo04 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 646px; left: 1044px;"></div>';
        $AlarmName = 'Streçleme Alanı Pır Dedektörü';
        AssanPaneleAlarmsArray.push($AlarmName);
    }
    $('#AssanPanelDoorM').html($AssanPanelAnaDepo01 + $AssanPanelAnaDepo02 + $AssanPanelAnaDepo03 + $AssanPanelAnaDepo04 + $AssanPanelAnaDepo05);
}

/**
 * Assan Üretim Sevkiyat Ana Kapı Yanı Acil Çıkış
 * @param {type} item
 * @returns {undefined}
 */
function AssanPanelDoor07JS( item )
{
    /**
     * Sevkiyat Ana Kapı Yanı Acil Çıkış
     */
    if(item.doorAlarm[2] == 1)
    {
        $AssanPanelAcilCikis01 = '<div class="vt-opendoor vt-green fa-2x" style="display: block; position: absolute; top: 470px; left: 1800px;"></div>';
    } else {
        $AssanPanelAcilCikis01 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 482px; left: 1800px;"></div>';
        $AlarmName = 'Sevkiyat Ana Kapı Yanı Acil Çıkış';
        AssanPaneleAlarmsArray.push($AlarmName);
    }

    $('#AssanPanelDoorN').html($AssanPanelAcilCikis01);
}

/**
 * Assan Üretim Depo Duvar Darbe
 * @param {type} item
 * @returns {undefined}
 */
var $Brunt01 = '';
function AssanPanelBrunt01JS( item )
{
    if(item.Brunt)
    {
        $('#AssanPanelDoorO').attr('rel', item.xDataId);
        $Brunt01 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 370px; left: 80px;"></div>';
        $AlarmName = 'Duvarda Darbe1 Algılandı';
        AssanPaneleAlarmsArray.push($AlarmName);
    } else 
    if(item.error)
    {
        $Brunt01 = '<div class="vt-checkmark vt-green fa-2x" style="display: block; position: absolute; top: 370px; left: 80px;"></div>';
    }
    
    $('#AssanPanelDoorO').html($Brunt01);
}

var $Brunt02 = '';
function AssanPanelBrunt02JS( item )
{
    if(item.Brunt)
    {
        $('#AssanPanelDoorP').attr('rel', item.xDataId);
        $Brunt02 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 580px; left: 80px;"></div>';
        $AlarmName = 'Duvarda Darbe2 Algılandı';
        AssanPaneleAlarmsArray.push($AlarmName);
    } else 
    if(item.error)
    {
        $Brunt02 = '<div class="vt-checkmark vt-green fa-2x" style="display: block; position: absolute; top: 580px; left: 80px;"></div>';
    }
    
    $('#AssanPanelDoorP').html($Brunt02);
}

var $Brunt03 = '';
function AssanPanelBrunt03JS( item )
{
    if(item.Brunt)
    {
        $('#AssanPanelDoorR').attr('rel', item.xDataId);
        $Brunt03 = '<div class="vt-alarm vt-red fa-2x" style="display: block; position: absolute; top: 850px; left: 80px;"></div>';
        $AlarmName = 'Duvarda Darbe3 Algılandı';
        AssanPaneleAlarmsArray.push($AlarmName);
    } else 
    if(item.error)
    {
        $Brunt03 = '<div class="vt-checkmark vt-green fa-2x" style="display: block; position: absolute; top: 850px; left: 80px;"></div>';
    }
    
    $('#AssanPanelDoorR').html($Brunt03);
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

ajaxJSONParser( yol + 'webservis/assanpanelbluetooth', {}, "AssanPanelBluetooth( item )" );

setTimeout(function(){
    for(var jx = 0;jx < ImeiIdx.length;jx++) {
        var lastDatajx = $('#' + ImeiIdx[jx]).attr('value');
        ajaxJSONParser( yol + 'webservis/assanpanelbluetoothdata', {lastdataid: lastDatajx, assanimeiid: ImeiIdx[jx]}, "AssanPanelBluetoothData( item )" );
    }
}, 5000);

setTimeout(function(){
////////////////////////////////////////////////////////////////////////////////
////////// kapılar için geçici alan ////////////////////////////////////////////
    ajaxJSONParser( yol + 'assan/assanpaneldoor01', {}, "AssanPanelDoor01JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor02', {}, "AssanPanelDoor02JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor03', {}, "AssanPanelDoor03JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor04', {}, "AssanPanelDoor04JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor05', {}, "AssanPanelDoor05JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor06', {}, "AssanPanelDoor06JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor07', {}, "AssanPanelDoor07JS( item )" );
    
    $AssanBrunt01 = $('#AssanPanelDoorP').attr('rel');
    ajaxJSONParser( yol + 'assan/assanpanelbrunt', {imeiid: '86307101469751714', lastdataid: $AssanBrunt01}, "AssanPanelBrunt01JS( item )" );
    $AssanBrunt02 = $('#AssanPanelDoorP').attr('rel');
    ajaxJSONParser( yol + 'assan/assanpanelbrunt', {imeiid: '86307101469866314', lastdataid: $AssanBrunt02}, "AssanPanelBrunt02JS( item )" );
    $AssanBrunt03 = $('#AssanPanelDoorP').attr('rel');
    ajaxJSONParser( yol + 'assan/assanpanelbrunt', {imeiid: '86307101469802814', lastdataid: $AssanBrunt03}, "AssanPanelBrunt03JS( item )" );
}, 3000);

setInterval(function(){
////////////////////////////////////////////////////////////////////////////////
////////// kapılar için geçici alan ////////////////////////////////////////////
    ajaxJSONParser( yol + 'assan/assanpaneldoor01', {}, "AssanPanelDoor01JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor02', {}, "AssanPanelDoor02JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor03', {}, "AssanPanelDoor03JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor04', {}, "AssanPanelDoor04JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor05', {}, "AssanPanelDoor05JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor06', {}, "AssanPanelDoor06JS( item )" );
    ajaxJSONParser( yol + 'assan/assanpaneldoor07', {}, "AssanPanelDoor07JS( item )" );
    
    $AssanBrunt01 = $('#AssanPanelDoorO').attr('rel');
    ajaxJSONParser( yol + 'assan/assanpanelbrunt', {imeiid: '86307101469751714', lastdataid: $AssanBrunt01}, "AssanPanelBrunt01JS( item )" );
    $AssanBrunt02 = $('#AssanPanelDoorP').attr('rel');
    ajaxJSONParser( yol + 'assan/assanpanelbrunt', {imeiid: '86307101469866314', lastdataid: $AssanBrunt02}, "AssanPanelBrunt02JS( item )" );
    $AssanBrunt03 = $('#AssanPanelDoorR').attr('rel');
    ajaxJSONParser( yol + 'assan/assanpanelbrunt', {imeiid: '86307101469802814', lastdataid: $AssanBrunt03}, "AssanPanelBrunt03JS( item )" );

    AssanAlarmNotifications( AssanPaneleAlarmsArray );
}, 5000);
setInterval(function(){
    $HouseDate = new Date();
    for(var j = 0;j < ImeiIdx.length;j++) {
        var lastDataj = $('#' + ImeiIdx[j]).attr('value');
        ajaxJSONParser( yol + 'webservis/assanpanelbluetoothdata', {lastdataid: lastDataj, assanimeiid: ImeiIdx[j]}, "AssanPanelBluetoothData( item )" ); 
    }
}, 60000);
    $GeneraleCount = setInterval("$.BackTimeout()", 1000);
    $AssanAlarmCount = setInterval("$.AssanAlarmInfo()", 1000);
////////////////////////////////////////////////////////////////////////////////
////////////////// Assan Kroki Bluetooth-search-box-assan //////////////////////
////////////////////////////////////////////////////////////////////////////////

$('#bluetooth-search-box-assan').keyup(BluetoothSearchBoxAssan).keyup();
function BluetoothSearchBoxAssan ( )
{
    for (var i = 0;i < labelArray.length;i++)
    {
        if ($('#bluetooth-search-box-assan').val().length > 16) {
           if (labelArray[i] == $('#bluetooth-search-box-assan').val()) {
                //console.log("var: " + labelArray[i]);
            } else {
                //console.log("yok: " + labelArray[i]);
            } 
        }
        
    }
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/* Alarmları ilgili alana yönelndirme function */
var TotalElement;
var AlarmDedektor;
function AssanAlarmNotifications( AssanPaneleAlarmsArray )
{
    AlarmDedektor = AssanPaneleAlarmsArray.indexOf(AssanPaneleAlarmsArray);
    if(AlarmDedektor != '-1')
    {

    } else {
        for (var i = 0;i < AssanPaneleAlarmsArray.length;i++)
        {
            if(AssanPaneleAlarmsArray[i] == AssanPaneleAlarmsArray[i])
            {
                $AssanRightNotifications += '<div class="AssanRightNotifications">' +
                    '<h4 class="pull-right"><small id="AlarmInfoCount"></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>' +
                    '<h6 class="text-left" style="padding-left: 35px; color: #ffffff;">' + AssanPaneleAlarmsArray[i] + '</h6>' +
                    '<h4 class="text-left" style="font-weight: bold; padding-left: 35px; color: #eb182b;">HAREKET <small style="padding-left: 10px; color: #ffffff;">algılandı</small></h4>' +
                    '<div class="button-area text-center">' +
                        '<button class="btn btn-success btn-sm text-center" style="width: 98px; margin-right: 10px; border-radius: 40px;">Kontrol Edildi</button>' +
                        '<button id="AmireAlarmBildir" value="' + AssanPaneleAlarmsArray[i] + '" class="btn btn-danger btn-sm text-center"  style="width: 98px; margin-left: 10px; border-radius: 40px;">Amire Bildir</button>' +
                    '</div>' +
                    '<hr style="width: 80%;">' +
                '</div>';
            }
       } 
       $('.AssanRightNotificationsAdds').html($AssanRightNotifications);
       $('button#AmireAlarmBildir').click(function(){
           var AlarmInfo = $(this).attr('value');
            $.post(yol + 'assan/alarminfomail', {'alarminfo': AlarmInfo}, function(veri,durum){
                console.log(veri);
            });
        });
    }
    TotalElement = AssanPaneleAlarmsArray.length;
    AssanPaneleAlarmsArray.splice(0, TotalElement);
    $AssanRightNotifications = '';
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/* Genel Sayaç Alanı *//*
var BackTimeoutz = 15400;
$.BackTimeout = function()
{
    if(BackTimeoutz > 1)
    {
        BackTimeoutz--;
        $('.BackTimeoutz').html('Oturum Süresi: ' + BackTimeoutz + ' Saniye Kaldı');
    }
}
$('.BackTimeoutz').html(BackTimeoutz + ' Saniye Kaldı');*/

var AssanAlarmInfoz = 300;
$.AssanAlarmInfo = function()
{
    if(AssanAlarmInfoz > 1)
    {
        AssanAlarmInfoz--;
            var index = $('#AlarmInfoCount div').index();
            $('#AlarmInfoCount div:eq('+index+')').html(AssanAlarmInfoz);
    }
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/* Alarm Notifications  alanı */
$("#ButtonAssanPanele").click(function (){
    // Set the effect type
    var effect = 'slide';
    // Set the options for the effect type chosen
    // yukarı, aşağı up, down
    // sagdan sola left
    // soldan sağa right
    var options = { direction: 'right' };
    // Set the duration (default: 400 milliseconds)
    var duration = 500;
    $('#AssanRightPanele, .AssanRightNotificationsBottom').toggle(effect, options, duration);
});
