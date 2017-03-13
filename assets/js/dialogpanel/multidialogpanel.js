/**
 * DialogPanel( title, width, height, className, namex )
 * Multi Dialog Panel function
 * @param {type} title
 * @param {type} width
 * @param {type} height
 * @param {type} className
 * @param {type} namex
 * @returns {undefined}
 */
function DialogPanel( title, width, height, className, namex )
{
    var dialogOptions = {
        "title" : title,
        "width" : width == null ? '500' : width,
        "height" : height == null ? '200' : height,
        "modal" : false,
        "resizable" : false,
        "draggable" : true
    }; 
   var dialogExtendOptions = {
        "closable" : true,
        "maximizable" : false,
        "minimizable" : true,
        "minimizeLocation" : 'right', // burası sağ veya sol parametresi alıyor
        "collapsable" : false,
        "dblclick" : "minimize",
        "titlebar" : false,
    }; 
    $("<div />")
    .append('<div class="' + className + '">' + namex + '</div>')
    .dialog(dialogOptions).dialogExtend(dialogExtendOptions);
}

/**
 * ajaxJSONParser( url, dataId, func )
 * json formatında api çekmek için
 * @param {type} url
 * @param {type} dataId
 * @param {type} func
 * @returns {undefined}
 */
function ajaxJSONParser( url, dataId, func ){
    var dType = 'JSON';
    var submitType = 'GET';
    jQuery.support.cors = true;
    $.ajax({
        type: submitType,
        url: url,
        async: true,
        data: dataId,
        contentType: 'application/json; charset=utf-8',
        dataType: dType,
        beforeSend: function(){
            $('#xmetredatatablesLoading').show();
        },
        success: function(item){
            eval(func);
            $('#xmetredatatablesLoading').hide();
        },
        statusCode: {
            404: function(){
                //$('.BackTimeoutz').hide().fadeIn().html("URL Çalışmıyor..");
                //clearInterval($GeneraleCount);
            }
        },
        error:function(){
            //$('.BackTimeoutz').hide().fadeIn().html("URL Çalışmıyor..");
            //clearInterval($GeneraleCount);
        }
    });
} 

/**
 * $(document).ready(function()
 * fullscreen pencere için.
 * @param {type} param
 */
$(document).ready(function(){
    $("#aktif").click(function(){
        if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
            $("#aktif").html('<i class="fa fa-minus fa-lg fa-red"></i>');
         } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
            $("#aktif").html('<i class="glyphicon glyphicon-fullscreen fa-lg fa-green"></i>');
        }

    });
});

