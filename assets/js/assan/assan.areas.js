/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanAreaAnkara_InStore01JS( item )
{
    /**
     * Depo Kapısı
     */
    if(item.doorAlarm[19] == 0)
    {
        $('#AnkaraStoreOpen').css({
            'backgroundColor': "#dc2929"
        });
        $('#AnkaraStoreOff').css({
            'backgroundColor': "#d2d2d2"
        });
    } else {
        $('#AnkaraStoreOpen').css({
            'backgroundColor': "#d2d2d2"
        });
        $('#AnkaraStoreOff').css({
            'backgroundColor': "#70d179"
        });
    }
    
    /**
     * Panik Butonu
     */
    if(item.doorAlarm[2] == 0)
    {
        $('#Ankaravt-panic-button').css({
            'color': "#b4b4b4"
        });
        $('#Ankaravt-panic-button').popover('hide');
    } else {
        $('#Ankaravt-panic-button').css({
            'color': "#dc2929"
        });
        $('#Ankaravt-panic-button').attr('data-content', 'Panik Butonuna Basıldı');
        $('#Ankaravt-panic-button').popover('show');
    }
} // end AssanAreaAnkara_InStore01JS( item )

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanAreaAnkara_InStore02JS( item )
{
    /**
     * Depo içi Su Baskını
     */
    if(item.doorAlarm[0] == 0)
    {
        $('#Ankaravt-su').css({
            'color': "#b4b4b4"
        });
        $('#Ankaravt-su').popover('hide');
    } else {
        $('#Ankaravt-su').css({
            'color': "#dc2929"
        });
        $('#Ankaravt-su').attr('data-content', 'Su Baskın Alarmı');
        $('#Ankaravt-su').popover('show');
    }
    
    /**
     * Depo içi Pır dedektör
     *//*
    if(item.doorAlarm[1] == 0)
    {
        $('#Ankaravt-hareket-deprem').css({
            'color': "#b4b4b4"
        });
        $('#Ankaravt-hareket-deprem').popover('hide');
    } else {
        $('#Ankaravt-hareket-deprem').css({
            'color': "#dc2929"
        });
        $('#Ankaravt-hareket-deprem').attr('data-content', 'Depo içinde Hareket Algılandı');
        $('#Ankaravt-hareket-deprem').popover('show');
    }*/
    
    /**
     * Depo dışı Yangın Dedektörü
     */
    if(item.doorAlarm[18] == 0)
    {
        $('#Ankaravt-hareket-deprem').css({
            'color': "#b4b4b4"
        });
        $('#Ankaravt-hareket-deprem').popover('hide');
    } else {
        $('#Ankaravt-hareket-deprem').css({
            'color': "#dc2929"
        });
        $('#Ankaravt-hareket-deprem').attr('data-content', 'Depo dışında Hareket Algılandı');
        $('#Ankaravt-hareket-deprem').popover('show');
    }
    
    /**
     * Depo içi ve dışı Yangın Dedektörü
     */
    if(item.doorAlarm[19] == 1)
    {
        $('#Ankaravt-yangin').css({
            'color': "#b4b4b4"
        });
        $('#Ankaravt-yangin').popover('hide');
    } else {
        $('#Ankaravt-yangin').css({
            'color': "#dc2929"
        });
        $('#Ankaravt-yangin').attr('data-content', 'Yangın Alarmı');
        $('#Ankaravt-yangin').popover('show');
    }
} // end AssanAreaAnkara_InStore01JS( item )

/* Burası Mersin Depo */
/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanAreaMersin_InStore01JS( item )
{
    /**
     * Depo Kapısı
     */
    if(item.doorAlarm[19] == 0)
    {
        $('#MersinStoreOpen').css({
            'backgroundColor': "#dc2929"
        });
        $('#MersinStoreOff').css({
            'backgroundColor': "#d2d2d2"
        });
    } else {
        $('#MersinStoreOpen').css({
            'backgroundColor': "#d2d2d2"
        });
        $('#MersinStoreOff').css({
            'backgroundColor': "#70d179"
        });
    }
    
    /**
     * Panik Butonu
     */
    if(item.doorAlarm[2] == 0)
    {
        $('#Mersinvt-panic-button').css({
            'color': "#b4b4b4"
        });
        $('#Mersinvt-panic-button').popover('hide');
    } else {
        $('#Mersinvt-panic-button').css({
            'color': "#dc2929"
        });
        $('#Mersinvt-panic-button').attr('data-content', 'Panik Butonuna Basıldı');
        $('#Mersinvt-panic-button').popover('show');
    }
} // end AssanAreaMersin_InStore01JS( item )

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanAreaMersin_InStore02JS( item )
{
    /**
     * Depo içi Su Baskını
     */
    if(item.doorAlarm[0] == 0)
    {
        $('#Mersinvt-su').css({
            'color': "#b4b4b4"
        });
        $('#Mersinvt-su').popover('hide');
    } else {
        $('#Mersinvt-su').css({
            'color': "#dc2929"
        });
        $('#Mersinvt-su').attr('data-content', 'Su Baskın Alarmı');
        $('#Mersinvt-su').popover('show');
    }
    
    /**
     * Depo içi Pır dedektör
     */
    if(item.doorAlarm[1] == 0)
    {
        $('#Mersinvt-hareket-deprem').css({
            'color': "#b4b4b4"
        });
        $('#Mersinvt-hareket-deprem').popover('hide');
    } else {
        $('#Mersinvt-hareket-deprem').css({
            'color': "#dc2929"
        });
        $('#Mersinvt-hareket-deprem').attr('data-content', 'Depo içinde Hareket Algılandı');
        $('#Mersinvt-hareket-deprem').popover('show');
    }
    
    /**
     * Ofis içi Pır Dedektörü
     *//*
    if(item.doorAlarm[18] == 0)
    {
        $('#Mersinvt-hareket-deprem').css({
            'color': "#b4b4b4"
        });
        $('#Mersinvt-hareket-deprem').popover('hide');
    } else {
        $('#Mersinvt-hareket-deprem').css({
            'color': "#dc2929"
        });
        $('#Mersinvt-hareket-deprem').attr('data-content', 'Depo dışında Hareket Algılandı');
        $('#Mersinvt-hareket-deprem').popover('show');
    }*/
    
    /**
     * Depo içi ve dışı Yangın Dedektörü
     */
    if(item.doorAlarm[19] == 1)
    {
        $('#Mersinvt-yangin').css({
            'color': "#b4b4b4"
        });
        $('#Mersinvt-yangin').popover('hide');
    } else {
        $('#Mersinvt-yangin').css({
            'color': "#dc2929"
        });
        $('#Mersinvt-yangin').attr('data-content', 'Yangın Alarmı');
        $('#Mersinvt-yangin').popover('show');
    }
} // end AssanAreaMersin_InStore02JS( item )



/* Burası Denizli Depo */
/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanAreaIzmir_InStore01JS( item )
{
    /**
     * Depo Kapısı
     */
    if(item.doorAlarm[19] == 0)
    {
        $('#IzmirStoreOpen').css({
            'backgroundColor': "#dc2929"
        });
        $('#IzmirStoreOff').css({
            'backgroundColor': "#d2d2d2"
        });
    } else {
        $('#IzmirStoreOpen').css({
            'backgroundColor': "#d2d2d2"
        });
        $('#IzmirStoreOff').css({
            'backgroundColor': "#70d179"
        });
    }
    
    /**
     * Panik Butonu
     */
    if(item.doorAlarm[2] == 0)
    {
        $('#Izmirvt-panic-button').css({
            'color': "#b4b4b4"
        });
        $('#Izmirvt-panic-button').popover('hide');
    } else {
        $('#Izmirvt-panic-button').css({
            'color': "#dc2929"
        });
        $('#Izmirvt-panic-button').attr('data-content', 'Panik Butonuna Basıldı');
        $('#Izmirvt-panic-button').popover('show');
    }
} // end AssanAreaDenizli_InStore01JS( item )

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
function AssanAreaIzmir_InStore02JS( item )
{
    /**
     * Depo içi Su Baskını
     */
    if(item.doorAlarm[0] == 0)
    {
        $('#Izmirvt-su').css({
            'color': "#b4b4b4"
        });
        $('#Izmirvt-su').popover('hide');
    } else {
        $('#Izmirvt-su').css({
            'color': "#dc2929"
        });
        $('#Izmirvt-su').attr('data-content', 'Su Baskın Alarmı');
        $('#Izmirvt-su').popover('show');
    }
    
    /**
     * Depo içi Pır dedektör
     */
    if(item.doorAlarm[1] == 0)
    {
        $('#Izmirvt-hareket-deprem').css({
            'color': "#b4b4b4"
        });
        $('#Izmirvt-hareket-deprem').popover('hide');
    } else {
        $('#Izmirvt-hareket-deprem').css({
            'color': "#dc2929"
        });
        $('#Izmirvt-hareket-deprem').attr('data-content', 'Depo içinde Hareket Algılandı');
        $('#Mersinvt-hareket-deprem').popover('show');
    }
    
    /**
     * Ofis içi Pır Dedektörü
     *//*
    if(item.doorAlarm[18] == 0)
    {
        $('#Izmirvt-hareket-deprem').css({
            'color': "#b4b4b4"
        });
        $('#Izmirvt-hareket-deprem').popover('hide');
    } else {
        $('#Izmirvt-hareket-deprem').css({
            'color': "#dc2929"
        });
        $('#Izmirvt-hareket-deprem').attr('data-content', 'Depo dışında Hareket Algılandı');
        $('#Izmirvt-hareket-deprem').popover('show');
    }*/
    
    /**
     * Depo içi ve dışı Yangın Dedektörü
     */
    if(item.doorAlarm[19] == 1)
    {
        $('#Izmirvt-yangin').css({
            'color': "#b4b4b4"
        });
        $('#Izmirvt-yangin').popover('hide');
    } else {
        $('#Izmirvt-yangin').css({
            'color': "#dc2929"
        });
        $('#Izmirvt-yangin').attr('data-content', 'Yangın Alarmı');
        $('#Izmirvt-yangin').popover('show');
    }
} // end AssanAreaDenizli_InStore02JS( item )






/* Sorgu Alanları */
setTimeout(function(){
   ajaxJSONParser( yol + 'assan/assanareaankara_instore01', {}, "AssanAreaAnkara_InStore01JS( item )" ); 
   ajaxJSONParser( yol + 'assan/assanareaankara_instore02', {}, "AssanAreaAnkara_InStore02JS( item )" );
   
   ajaxJSONParser( yol + 'assan/assanareamersin_instore01', {}, "AssanAreaMersin_InStore01JS( item )" );
   ajaxJSONParser( yol + 'assan/assanareamersin_instore02', {}, "AssanAreaMersin_InStore02JS( item )" ); 
   
   ajaxJSONParser( yol + 'assan/assanareaizmir_instore01', {}, "AssanAreaIzmir_InStore01JS( item )" );
   ajaxJSONParser( yol + 'assan/assanareaizmir_instore02', {}, "AssanAreaIzmir_InStore02JS( item )" ); 
}, 3000);

setInterval(function(){
   ajaxJSONParser( yol + 'assan/assanareaankara_instore01', {}, "AssanAreaAnkara_InStore01JS( item )" );
   ajaxJSONParser( yol + 'assan/assanareaankara_instore02', {}, "AssanAreaAnkara_InStore02JS( item )" );
   
   ajaxJSONParser( yol + 'assan/assanareamersin_instore01', {}, "AssanAreaMersin_InStore01JS( item )" );
   ajaxJSONParser( yol + 'assan/assanareamersin_instore02', {}, "AssanAreaMersin_InStore02JS( item )" ); 
   
   ajaxJSONParser( yol + 'assan/assanareaizmir_instore01', {}, "AssanAreaIzmir_InStore01JS( item )" );
   ajaxJSONParser( yol + 'assan/assanareaizmir_instore02', {}, "AssanAreaIzmir_InStore02JS( item )" ); 
}, 300000);

