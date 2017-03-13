// Dolap Tarafı Aydınlatma Aç / Kapat
$('#LightingGroup2').click(function(){
    if($(this).attr('value') == '0')
    {
        $(this).attr('value', '1');
        $(this).animate({
            'background-color': '#dc2929'
        }, 'slow');
        $(this).text('Kapat');
        $('#LightingGroup2-vt-lamba').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclasslighting', {imeiid: '86107402998424575', status: '300ok'}, "SmartClassLightingJS( item )" );
    } else {
        $(this).attr('value', '0');
        $(this).animate({
            'background-color': '#70d179'
        }, 'slow');
        $(this).text('Aç');
        $('#LightingGroup2-vt-lamba').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclasslighting', {imeiid: '86107402998424575', status: '400ok'}, "SmartClassLightingJS( item )" );
    }
    
});

// Kapı Tarafı Aydınlatma Aç / Kapat
$('#LightingGroup1').click(function(){
    if($(this).attr('value') == '0')
    {
        $(this).attr('value', '1');
        $(this).animate({
            'background-color': '#dc2929'
        }, 'slow');
        $(this).text('Kapat');
        $('#LightingGroup1-vt-lamba').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclasslighting', {imeiid: '86107402998424575', status: '100ok'}, "SmartClassLightingJS( item )" );
    } else {
        $(this).attr('value', '0');
        $(this).animate({
            'background-color': '#70d179'
        }, 'slow');
        $(this).text('Aç');
        $('#LightingGroup1-vt-lamba').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclasslighting', {imeiid: '86107402998424575', status: '200ok'}, "SmartClassLightingJS( item )" );
    }
    
});

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Perde Aç (yukarı) / Kapat (Aşağı)
$('#CurtainUp').click(function(){
    if($(this).attr('value') == '0')
    {
        $(this).attr('value', '1');
        $(this).animate({
            'background-color': '#dc2929'
        }, 'slow');
        $(this).text('Çıkıyor');
        $('#CurtainDown').attr('disabled', true);
        $('#CurtainUp-vt-perde').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclasscurtain', {imeiid: '86107402998422975', status: '500ok'}, "SmartClassCurtainJS( item )" );
    } else {
        $(this).attr('value', '0');
        $(this).animate({
            'background-color': '#70d179'
        }, 'slow');
        $(this).text('Yukarı');
        $('#CurtainDown').attr('disabled', false);
        $('#CurtainUp-vt-perde').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclasscurtain', {imeiid: '86107402998422975', status: '600ok'}, "SmartClassCurtainJS( item )" );
    }
    
});

// Perde Durdurma Bekletme
$('#CurtainDown').click(function(){
    if($(this).attr('value') == '0')
    {
        $(this).attr('value', '1');
        $(this).animate({
            'background-color': '#dc2929'
        }, 'slow');
        $(this).text('İniyor');
        $('#CurtainUp').attr('disabled', true);
        ajaxJSONParser( yol + 'cpanel/smartclasscurtain', {imeiid: '86107402998422975', status: '700ok'}, "SmartClassCurtainJS( item )" );
    } else {
        $(this).attr('value', '0');
        $(this).animate({
            'background-color': '#70d179'
        }, 'slow');
        $(this).text('Aşağı');
        $('#CurtainUp').attr('disabled', false);
        ajaxJSONParser( yol + 'cpanel/smartclasscurtain', {imeiid: '86107402998422975', status: '800ok'}, "SmartClassCurtainJS( item )" );
    }
    
});

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Klima Aç / Kapat
$('#AirConditioning').click(function(){
    if($(this).attr('value') == '0')
    {
        $(this).attr('value', '1');
        $(this).animate({
            'background-color': '#dc2929'
        }, 'slow');
        $(this).text('Kapat');
        //$('#AirConditioning').attr('disabled', true);
        $('#AirConditioning-vt-klima').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclassairconditioning', {imeiid: '86107402992648575', status: '900ok'}, "SmartClassAirConditioningJS( item )" );
    } else {
        $(this).attr('value', '0');
        $(this).animate({
            'background-color': '#70d179'
        }, 'slow');
        $(this).text('Aç');
        //$('#AirConditioning').attr('disabled', false);
        $('#AirConditioning-vt-klima').toggleClass('fa-shadow-icon');
        ajaxJSONParser( yol + 'cpanel/smartclassairconditioning', {imeiid: '86107402992648575', status: '1000ok'}, "SmartClassAirConditioningJS( item )" );
    }
    
});

/* Doğa Koleji Akıllı Sınıf Aydınlatma Kontrolü */
function SmartClassLightingJS( item )
{
    console.log(item);
}

/* Doğa Koleji Akıllı Sınıf Perde Kontrolü */
function SmartClassCurtainJS( item )
{
    console.log(item);
}

/* Doğa Koleji Akıllı Sınıf Klima Kontrolü */
function SmartClassAirConditioningJS( item )
{
    console.log(item);
}

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function DogaKolejiSmartClassLightingJS( item )
{
    if(item.SmartClass[6] == 1)
    {
        $('#LightingGroup2').attr('value', '1');
        $('#LightingGroup2').animate({
            'background-color': '#dc2929'
        }, 'slow');
        $('#LightingGroup2').text('Kapat');
        $('#LightingGroup2-vt-lamba').toggleClass('fa-shadow-icon');
    } else {
        $('#LightingGroup2').attr('value', '0');
        $('#LightingGroup2').animate({
            'background-color': '#70d179'
        }, 'slow');
        $('#LightingGroup2').text('Aç');
    }
    
    if(item.SmartClass[5] == 1)
    {
        $('#LightingGroup1').attr('value', '1');
        $('#LightingGroup1').animate({
            'background-color': '#dc2929'
        }, 'slow');
        $('#LightingGroup1').text('Kapat');
        $('#LightingGroup1-vt-lamba').toggleClass('fa-shadow-icon');
    } else {
        $('#LightingGroup2').attr('value', '0');
        $('#LightingGroup1').animate({
            'background-color': '#70d179'
        }, 'slow');
        $('#LightingGroup1').text('Aç');
    }
    
    console.log('Çıkış1: ' + item.SmartClass[5] + ' | Çıkış2: ' + item.SmartClass[6]);
}

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function DogaKolejiSmartClassCurtainJS( item )
{
    if(item.SmartClass[6] == 1)
    {
        $('#CurtainUp').attr('value', '1');
        $('#CurtainUp').animate({
            'background-color': '#dc2929'
        }, 'slow');
        $('#CurtainUp').text('Çıkıyor');
        $('#CurtainUp-vt-perde').toggleClass('fa-shadow-icon');
    } else {
        $('#CurtainUp').attr('value', '0');
        $('#CurtainUp').animate({
            'background-color': '#70d179'
        }, 'slow');
        $('#CurtainUp').text('Yukarı');
    }
    
    if(item.SmartClass[5] == 1)
    {
        $('#CurtainDown').attr('value', '1');
        $('#CurtainDown').animate({
            'background-color': '#dc2929'
        }, 'slow');
        $('#CurtainDown').text('İniyor');
        $('#CurtainDown-vt-perde').toggleClass('fa-shadow-icon');
    } else {
        $('#LightingGroup2').attr('value', '0');
        $('#CurtainDown').animate({
            'background-color': '#70d179'
        }, 'slow');
        $('#CurtainDown').text('Aşağı');
    }
    
    console.log('Çıkış1: ' + item.SmartClass[5] + ' | Çıkış2: ' + item.SmartClass[6]);
}

/**
 * 
 */
function DogaKolejiSmartClassAirConditioningJS( item )
{
    if(item.SmartClass[5] == 1)
    {
        $('#AirConditioning').attr('value', '1');
        $('#AirConditioning').animate({
            'background-color': '#dc2929'
        }, 'slow');
        $('#AirConditioning').text('Kapat');
        $('#AirConditioning-vt-klima').toggleClass('fa-shadow-icon');
    } else {
        $('#AirConditioning').attr('value', '0');
        $('#AirConditioning').animate({
            'background-color': '#70d179'
        }, 'slow');
        $('#AirConditioning').text('Aç');
    }
    
    console.log('Çıkış1: ' + item.SmartClass[5] + ' | Çıkış2: ' + item.SmartClass[6]);
}

setTimeout(function(){
    ajaxJSONParser( yol + 'dogakoleji/dogakolejismartclasslighting', {}, "DogaKolejiSmartClassLightingJS( item )" );
    ajaxJSONParser( yol + 'dogakoleji/dogakolejismartclassCurtain', {}, "DogaKolejiSmartClassCurtainJS( item )" );
    ajaxJSONParser( yol + 'dogakoleji/dogakolejismartclassairconditioning', {}, "DogaKolejiSmartClassAirConditioningJS( item )" );
}, 2000);
