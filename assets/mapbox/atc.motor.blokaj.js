$("#AtcMotorBlokaj").click(function(){
    if($(this).attr('class') == 'icon-motorblokaj-icon-siyah2 fa-green fa-3x')
    {
        swal({
            title: "Motor Durdurmayı Aktif Et?",
            text: "Aracı Durdurmak İstediğinizden Emin misiniz?!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#70d179",
            confirmButtonText: "Evet İşlem Yap",
            closeOnConfirm: false
        },
        function(){
            swal(
                "İşlem Yapıldı!",
                "Motor Durdurma Komutu Gönderildi.",
                "success"
            );
            $("#AtcMotorBlokaj").attr({
                'class': 'icon-motorblokaj-icon-siyah2 fa-red fa-3x'
            });
            ajaxJSONParser( yol + 'cpanel/suddenblockageengine', {imeiid: ImeiId, status: '200ok'}, "SuddenBlockageEngineJS( item )" );
        });
    } else 
    if($(this).attr('class') == 'icon-motorblokaj-icon-siyah2 fa-red fa-3x')
    {
        swal({
            title: "Motor Durdurmayı Pasif Et?",
            text: "Araç Durdurmayı  Kaldırmak İstediğinizden Emin misiniz?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#70d179",
            confirmButtonText: "Evet İşlem Yap",
            closeOnConfirm: false
        },
        function(){
            swal(
                "İşlem Yapıldı!",
                "Motor Durdurmayı Kaldırma Komutu Gönderildi.",
                "success"
            );
            $("#AtcMotorBlokaj").attr({
                'class': 'icon-motorblokaj-icon-siyah2 fa-green fa-3x'
            });
            ajaxJSONParser( yol + 'cpanel/suddenblockageengine', {imeiid: ImeiId, status: '600ok'}, "SuddenBlockageEngineJS( item )" );
        });
    }
});
function SuddenBlockageEngineJS( item )
{
    console.log(item);
    console.log("ilgili komutlar");
}



