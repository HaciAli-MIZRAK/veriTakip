var $ProductShelf = '';
var $degerciarray1 = [];
var $degerciarray2 = [];
var $degerciarray3 = [];
function TotalMoney_Otomat( item )
{
    if (item.otomatTotalMoney == '-1')
    {
        $('#otomatTotalMoney').html('<strong>0.<small>00</small> &nbsp;&nbsp; <i class="fa fa-try"></i></strong>');
    } else {
        $('#otomatTotalMoney').html(item.otomatTotalMoney + '&nbsp;&nbsp; <i class="fa fa-try"></i>');
    }
    
}

//##############################################################################
//################ 1. kat raf sırası 11 ile 17 arası ###########################
//##############################################################################
function product_shelf( item )
{
    $ProductShelf = '';
    console.log(item.dataId);
    if (item.ProductShelf.length > 0)
    {
        $degerciarray1.splice(0, $degerciarray1.length);
        $degerciarray2.splice(0, $degerciarray2.length);
        $degerciarray3.splice(0, $degerciarray3.length);
        for (var i = 0;i < item.ProductShelf.length;i++)
        {
            /* test alanı */
            $degerci = item.ProductShelf[i][2].split("*");
            if($degerci[6] == 100)
            {
                $degerciarray1.push($degerci[1]);
                $('#productstyle1').animate({
                    'height': (0.1*$degerci[6]) + 'px'
                });
                $('#productstyle1-1').attr('title', $degerciarray1);
                $('#productstyle1-1').text("#" + $degerci[1]);
                $('#productstyle1-1-1').text($degerci[6]);
            }
            if($degerci[6] == 500)
            {
                $degerciarray2.push($degerci[1]);
                $('#productstyle2').animate({
                    'height': (0.1*$degerci[6]) + 'px'
                });
                $('#productstyle2-1').attr('title', $degerciarray2);
                $('#productstyle2-1').text("#" + $degerci[1]);
                $('#productstyle2-1-1').text($degerci[6]);
            }
            if($degerci[6] == 900)
            {
                $degerciarray3.push($degerci[1]);
                $('#productstyle3').animate({
                    'height': (0.1*$degerci[6]) + 'px'
                });
                $('#productstyle3-1').attr('title', $degerciarray3);
                $('#productstyle3-1').text("#" + $degerci[1]);
                $('#productstyle3-1-1').text($degerci[6]);
            }
            /* end test alanı */
            $ProductShelfOrder = item.ProductShelf[i][0].split("*");
            $ProductShelfSales = item.ProductShelf[i][1].split("*");
            if ($ProductShelfSales[1] == 0)
            {
                $ClassColor = 'product-shelf-green';
                
            } else if($ProductShelfSales[1] == 1)
            {
                $ClassColor = 'product-shelf-orange';
                
            } else if($ProductShelfSales[1] == 2)
            {
                $ClassColor = 'product-shelf-orange';
            
            } else if($ProductShelfSales[1] == 3)
            {
                $ClassColor = 'product-shelf-orange';
            
            } else if($ProductShelfSales[1] == 4)
            {
                $ClassColor = 'product-shelf-orange';
            
            } else if($ProductShelfSales[1] == 5)
            {
                $ClassColor = 'product-shelf-orange';
            
            } else if($ProductShelfSales[1] == 6)
            {
                $ClassColor = 'product-shelf-red';
            
            } else if($ProductShelfSales[1] == 7)
            {
                $ClassColor = 'product-shelf-red';
            
            } else if($ProductShelfSales[1] == 8)
            {
                $ClassColor = 'product-shelf-red';
             
            } else if ($ProductShelfSales[1] == 9)
            {
                $ClassColor = 'product-shelf-red';
                
            } else if ($ProductShelfSales[1] == 10)
            {
                $ClassColor = 'product-shelf-gray';
            }
            $ProductShelf += '<div id="product-shelf-' + $ProductShelfOrder[1] + '" class="text-center ' + $ClassColor + ' product-shelf" data-toggle="tooltip" title="' + $ProductShelfSales[1] + ' Satıldı">' + $ProductShelfOrder[1] + '</div>';
        }
        $('#product-shelf-general-a').attr("rel", item.dataId);
        $('#product-shelf-general-a').html($ProductShelf);
        $('[data-toggle="tooltip"]').tooltip(); 
    } else {
        $('#product-shelf-general-a').html('<strong style="display: block; font-size: 14pt; margin-top: 80px;">Henüz Sorgu Yapılmamış</strong>');
    }
}

function OtomatTemp( item )
{
    if(Math.floor(item.xSensorData.Sensor04.Sensor1.SensorDeger) < 10)
    {
        $('#OtomatTemp').animate({
            color: "#06069e"
        }); 
    } else 
    if(Math.floor(item.xSensorData.Sensor04.Sensor1.SensorDeger) < 15)
    {
        $('#OtomatTemp').animate({
            color: "#f67207"
        }); 
    } else 
    if(Math.floor(item.xSensorData.Sensor04.Sensor1.SensorDeger) < 30)
    {
        $('#OtomatTemp').animate({
            color: "#fa0404"
        }); 
    }
    $('#OtomatTemp').html(item.xSensorData.Sensor04.Sensor1.SensorDeger + "&nbsp;°C");
}
/* Address Bilgisi Çek */
function xAddressCheckInfo( item )
{
    if (item.display_name.length > 0)
    {
        $City = item.display_name.split(",");
        $City = $City.reverse();
        $('#OtomatLokasyonAdrress').text(item.display_name);
        for (var $i = 0;$i < $City.length;$i++)
        {
            if ($City)
            {
                $('#OtomatLokasyonAdrressCity').html('<font size="2" color="#dc2929">GPS\'den Adres Bilgisi Alanamadı..<i class="fa fa-map-marker fa-2x fa-rotate-30"></i></font>');
            } else {
                $('#OtomatLokasyonAdrress').text($City[6] + ' ' + $City[5] + ' ' + $City[4]);
                $('#OtomatLokasyonAdrressCity').text($City[3]);
            }
            
        }
    } else {
        $('#OtomatLokasyonAdrressCity').text('GPS\'den Adres Bilgisi Alanamadı..');
    }
}
//##############################################################################
//################ 1. kat raf sırası 11 ile 17 arası ###########################
//##############################################################################
var DataId = $('#product-shelf-general-a').attr("rel");
ajaxJSONParser( yol + 'otomat/totalmoney_otomat', {imeiid: '86107402547416775'}, "TotalMoney_Otomat( item )" );
ajaxJSONParser( yol + 'otomat/productshelf_otomat', {imeiid: '86107402547416775', xdataid: DataId}, "product_shelf( item )" );
ajaxJSONParser( yol + 'webservis/xsensordata', {imeiid: '86107402547416775'}, "OtomatTemp( item )" );
ajaxJSONParser( yol + 'webservis/xaddresscheckinfo', {imeiid: '86107402547416775'}, "xAddressCheckInfo( item )" );
setInterval(function(){
    ajaxJSONParser( yol + 'webservis/xsensordata', {imeiid: '86107402547416775'}, "OtomatTemp( item )" );
}, 300000);

