var $dateTime, xMetreDateTime, DeviceId, $DeviceList;
var toplam = 1;
var dataTablesLists = [];

function cb(start, end) {
    $('#reportrange span').html(start.format('D, M, YYYY') + ' - ' + end.format('D, M, YYYY'));
    $dateTime = start.format('YYYY-M-D') + '|' + end.format('YYYY-M-D');
}
cb(moment().subtract(29, 'days'), moment());

$('#reportrange').daterangepicker({
    ranges: {
       'Bugün': [moment(), moment()],
       'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Son 7 Gün': [moment().subtract(6, 'days'), moment()],
//     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//     'This Month': [moment().startOf('month'), moment().endOf('month')],
//     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    dateLimit: {
        'days': 15 
    },
    locale: {
        'applyLabel': "Seç",
        'cancelLabel': "Çık",
        'daysOfWeek': [ "pz", "pt", "sl", "çb", "pb", "cm", "ct" ], // [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],
        'monthNames': [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
        'customRangeLabel': "Siz Seçin",
    }
}, cb);

function xModalReport0401( item )
{
    dataTablesLists = [];
      //table.destroy();
    if(item.data.length > 0) {
        for (var i = 0;i < item.data.length;i++) {
            var xSensor1 = item.data[i].data.Sensor04.Sensor1.SensorDeger + " C";
            var xSensor2 = item.data[i].data.Sensor0E.SatelliteCount + " x";
            var xSensor3 = item.data[i].data.Sensor05.IdlingTime + " Saniye";
            var xtimes   = item.data[i].time;
            dataTablesLists.push([xSensor1, xSensor2, xSensor3, xtimes]);
            toplam = i + 1;
        }

        $('#example').DataTable({
            aLengthMenu: [25, 50, 100, 500, 1000, 1500],
            data: dataTablesLists,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            columns: [
                { title: "Sıcaklık Değeri" },
                { title: "Uydu Sayısı" },
                { title: "Rölante Süresi" },
                { title: "Tarih Saat" },
            ],
            destroy: true,
        });
       $('#example').DataTable();
    }
}
$('.ranges').click(function(){
    ajaxJSONParser( yol + 'webservis/xmodalreport0401', {imeiid: ImeiId, dateTimes: $dateTime}, "xModalReport0401( item )" );
});

/* xMetre DataTables Paneli */

function xMetrecb(start, end) {
    $('#xMetreReports span').html(start.format('D, M, YYYY') + ' - ' + end.format('D, M, YYYY'));
    xMetreDateTime = start.format('YYYY-M-D') + '|' + end.format('YYYY-M-D');
}
xMetrecb(moment(), moment());

$('#xMetreReports').daterangepicker({
    ranges: {
       'Bugün': [moment(), moment()],
       'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Son 7 Gün': [moment().subtract(6, 'days'), moment()],
//     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//     'This Month': [moment().startOf('month'), moment().endOf('month')],
//     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    dateLimit: {
        'days': 15 
    },
    locale: {
        'applyLabel': "Seç",
        'cancelLabel': "Çık",
        'daysOfWeek': [ "pz", "pt", "sl", "çb", "pb", "cm", "ct" ], // [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],
        'monthNames': [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
        'customRangeLabel': "Siz Seçin",
    }
}, xMetrecb);

function xMetreDataTables( item )
{
    dataTablesLists = [];
      //table.destroy();
    if(item.xMetreInfo.length > 0) {
        for (var i = 0;i < item.xMetreInfo.length;i++) {
            DeviceId        = item.xMetreInfo[i].ImeiId;
            var Datex           = item.xMetreInfo[i].Date;
            var Timex           = item.xMetreInfo[i].Time;
            var GSMQualityx     = item.xMetreInfo[i].GSMQuality + ' GSM Quality';
            var dataStatusx     = item.xMetreInfo[i].dataStatus;
            var FazInfox        = item.xMetreInfo[i].FazInfo;
            var HavaTempx       = item.xMetreInfo[i].HavaTemp;
            var HavaNemx        = item.xMetreInfo[i].HavaNem;
            var ToprakTempx     = item.xMetreInfo[i].ToprakTemp;
            var ToprakNemx      = item.xMetreInfo[i].ToprakNem;
            var voltajx         = item.xMetreInfo[i].voltaj;
            var Bateryx         = item.xMetreInfo[i].Batery;
            var rwaxdatax       = item.xMetreInfo[i].rwaxdata;
            dataTablesLists.push([DeviceId, Datex, Timex, GSMQualityx, dataStatusx, FazInfox, HavaTempx, HavaNemx, ToprakTempx, ToprakNemx, voltajx, Bateryx, rwaxdatax]);
            toplam = i + 1;
        }

        $('#xmetredatatables').DataTable({
            aLengthMenu: [25, 50, 100, 500, 1000, 1500],
            data: dataTablesLists,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            columns: [
                { title: "Cihaz ID" },
                { title: "Tarih" },
                { title: "Saat" },
                { title: "GSM Kalitesi  <i class='fa fa-signal fa-green fa-lg'></i>" },
                { title: "Data Durumu" },
                { title: "Faz Bilgisi"},
                { title: "Hava Sıcaklığı (°C)"},
                { title: "Hava Nem (%)"},
                { title: "Toprak Sıcaklığı (°C)"},
                { title: "Toprak Nem (%)"},
                { title: "Voltaj Bilgisi  <i class='fa fa-bolt fa-green fa-lg'></i>"},
                { title: "Pil Bilgisi  <i class='fa fa-battery-full fa-green fa-lg'></i>"},
                { title: "RawData"},
            ],
            language: {
                sProcessing:   "İşleniyor...",
                sLengthMenu:   "Sayfada _MENU_ Kayıt Göster",
                sZeroRecords:  "Eşleşen Kayıt Bulunmadı",
                sInfo:         "  _TOTAL_ Kayıttan _START_ - _END_ Arası Kayıtlar",
                sInfoEmpty:    "Kayıt Yok",
                sInfoFiltered: "( _MAX_ Kayıt İçerisinden Bulunan)",
                sInfoPostFix:  "",
                sSearch:       "Bul:",
                sUrl:          "",
                oPaginate: {
                    sFirst:    "İlk",
                    sPrevious: "Önceki",
                    sNext:     "Sonraki",
                    sLast:     "Son"
                }
            },
            destroy: true,
        });
        $('#xmetredatatables').DataTable();
        $('#xmetredatatablesx').remove();
        $('#xMetreReports').show();
        $('input#devicecmdsendinput').attr("disabled", false);
        $('button#devicecmdsendbutton').attr("disabled", false);
    } else {
        $('#xmetredatatables').DataTable({
            aLengthMenu: [25, 50, 100, 500, 1000, 1500],
            data: dataTablesLists,
            columns: [
                { title: "Cihaz ID" },
                { title: "Tarih" },
                { title: "Saat" },
                { title: "GSM Kalitesi  <i class='fa fa-signal fa-green fa-lg'></i>" },
                { title: "Data Durumu" },
                { title: "Faz Bilgisi"},
                { title: "Hava Sıcaklığı (°C)"},
                { title: "Hava Nem (%)"},
                { title: "Toprak Sıcaklığı (°C)"},
                { title: "Toprak Nem (%)"},
                { title: "Voltaj Bilgisi  <i class='fa fa-bolt fa-green fa-lg'></i>"},
                { title: "Pil Bilgisi  <i class='fa fa-battery-full fa-green fa-lg'></i>"},
                { title: "RawData"},
            ],
            language: {
                sProcessing:   "İşleniyor...",
                sLengthMenu:   "Sayfada _MENU_ Kayıt Göster",
                sZeroRecords:  "Eşleşen Kayıt Bulunmadı",
                sInfo:         "  _TOTAL_ Kayıttan _START_ - _END_ Arası Kayıtlar",
                sInfoEmpty:    "Kayıt Yok",
                sInfoFiltered: "( _MAX_ Kayıt İçerisinden Bulunan)",
                sInfoPostFix:  "",
                sSearch:       "Bul:",
                sUrl:          "",
                oPaginate: {
                    sFirst:    "İlk",
                    sPrevious: "Önceki",
                    sNext:     "Sonraki",
                    sLast:     "Son"
                }
            },
            destroy: true,
        });
        $('#xmetredatatables').DataTable();
        $('#xmetredatatablesx').remove();
        $('#xMetreReports').show();
        $('input#devicecmdsendinput').attr("disabled", true);
        $('button#devicecmdsendbutton').attr("disabled", true);
        //sweetAlert("Hata", "Bu Tarihde Yeni Kayıt Yok", "error");
    }
}
function DeviceCMDSend( item ){

    if(item.error) {
        sweetAlert("Hata", item.error, "error");
    } else {
        sweetAlert("Gönderilen Komut", item.AtcCommand, "success");
    }
}
var link = window.location.href;
if(link == 'http://www.veritakip.net/takip/xmetrepages'){
    $( ".form-control" ).change(function() {
        $DeviceList = $(this).val();
        ajaxJSONParser( yol + 'webservis/autoxmetrecontrol', {xMetredateTimes: xMetreDateTime, imeiid: $DeviceList}, "xMetreDataTables( item )" );
    }).keyup();
    
    $('.ranges').click(function(){
        ajaxJSONParser( yol + 'webservis/autoxmetrecontrol', {xMetredateTimes: xMetreDateTime, imeiid: $DeviceList}, "xMetreDataTables( item )" );
    });

    $('button#devicecmdsendbutton').click(function(){
        var cmdSendx = decodeURIComponent($('input#devicecmdsendinput').serialize());
        if (cmdSendx == 'devicecmdsend=') {
            //$('.devicecmdsendinputtext').html("Komut Yazmadınız..");
            sweetAlert("Hata", "Komut Yazmadınız..", "error");
        } else {
            ajaxJSONParser( yol + 'cpanel/devicecmdsend', {imeiid: DeviceId, cmdSend: cmdSendx}, "DeviceCMDSend( item )" );
            $('.devicecmdsendinputtext').hide();
        }
    });

    window.setTimeout(function(){
        ajaxJSONParser( yol + 'webservis/autoxmetrecontrol', {xMetredateTimes: xMetreDateTime}, "xMetreDataTables( item )" ); 
    }, 2000);
}



