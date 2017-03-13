/*! 
 * datatakip.net ve veritakip.net için özel hazırlanmıştır.
 *  dosya versiyonu: 0.1-beta veritakip LTD
 *  (c) 2006 - 2016
 *  Hazırlanma Tarihi: 29-08-2015
 */

$( ".form-control" ).keyup(function() {
    $( ".form-control" ).each(function(e){
        var value = $( this ).val();
        if(value == '') {
            $("button#submit").attr("disabled", true);
        } else {
            $("button#submit").attr("disabled", false); 
            $("button#submit").html('Cihaz Ekle');
        } 
    });
    var ImeiIdControl = $('#ImeiIdControl').val();
    var ImeiIdControlSize = ImeiIdControl.length;
    if(ImeiIdControlSize >= 17) {
        $.get(yol + 'cpanel/devicecontrol', {imeiId: ImeiIdControl}, function(data){
            var query = $.parseJSON(data);
            if(query.imeiidcontrol == 'var'){
                $('.imeiidControltr').attr({
                    class: 'imeiidControltr fa-background-adddevice-red'
                });
                $("button#submit").attr("disabled", true);
            }
            if(query.imeiidcontrol == 'yok'){
                $('.imeiidControltr').attr({
                    class: 'imeiidControltr fa-background-adddevice-green'
                });
            }
        });  
    }
    
}).keyup();

$('button#windowClose').click(function(){
    location.reload();
});

function ImeiIdControlx()
{
    var ImeiIdControls = $('#ImeiIdControl').val();
    console.log(ImeiIdControls);
} // end ImeiIdControl ()
//ImeiIdControl();

$("button#submit").click(function(){ 
    //console.log("button click");
    var AddDevicePlus = $("#AddDevicePlus").serialize();
    var dType = 'json';
    var submitType = 'POST';
    jQuery.support.cors = true;
    $.ajax({
        type: submitType,
        url: yol + 'cpanel/adddeviceplus',
        async: true,
        data: AddDevicePlus,
        beforeSend :function(){
            $("button#submit").html('<i class="fa fa-refresh fa-spin fa-lg"></i>');
        },
        success: function(item){
            //console.log(item);
                $(':input').not(':button, :submit, :reset, :hidden').each( function() {
                    this.value = this.defaultValue;
                });
                $('#uyari').html(item);
                $("button#submit").html('İşlem Tamam <i class="fa fa-check fa-lg"></i>');
                $("button#submit").attr("disabled", true);
        },
        statusCode: {
            404: function(){
                $('#test').hide().fadeIn().html("URL Çalışmıyor..");
            }
        }
    });
});

/**
 * ürün ekleme sayfasında ürünlerin aktif
 * veya pasif duruma almak için kullanılacak.
 */

$("button.ProductChecked").click(function(){
    ProductCheckedStatus = $(this).attr('value');
    var dType = 'JSON';
    var submitType = 'GET';
    jQuery.support.cors = true;
    $.ajax({
        type: submitType,
        url: yol + 'cpanel/deviceliststatus',
        async: true,
        data: {productcheckid: this.id, adminstatus: ProductCheckedStatus},
        contentType: 'application/json; charset=utf-8',
        dataType: dType,
        beforeSend :function(){
            //$("button#submit").html('<i class="fa fa-refresh fa-spin fa-lg"></i>');
        },
        success: function(item){
            if(item[0].status == 0) {
                $('#ProductChecked_' + item[0].deviceimeiid).attr({class: 'fa fa-times fa-red fa-lg btn btn-link ProductChecked', value: '1'});
            }
            if(item[0].status == 1) {
               $('#ProductChecked_' + item[0].deviceimeiid).attr({class: 'fa fa-check fa-green fa-lg btn btn-link ProductChecked', value: '0'}); 
            }
        },
        statusCode: {
            404: function(){
                $('#test').hide().fadeIn().html("URL Çalışmıyor..");
            }
        }
    });
});
