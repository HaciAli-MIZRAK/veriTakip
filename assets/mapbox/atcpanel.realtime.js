//function gönderiken "" string işaretleri kullanılmalı yoksa çalışmıyor.
//############################################################################################
//##################### BURADAN ASAGISI GEREKLI FUNCTION LAR ICIN ############################
//############################################################################################
setTimeout(function(){
    ajaxJSONParser( yol + 'webservis/endlokasyon', {API_KEY: '714306f22ccf1c42c0f38b17fa1daae9cb594601'}, "AtcInfoParse( item )" );  
}, 1000);

function MovingVehicles( ImeiId ){
    setInterval(function(){
        ajaxJSONParser( yol + 'webservis/xaktivedata', {imeiid: ImeiId}, "HareketliAraclar( item )" );
    }, 10000);
}





































