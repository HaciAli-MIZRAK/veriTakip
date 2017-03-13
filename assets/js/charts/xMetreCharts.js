/*var veriTakipxMetreData;
var veriTakipxMetrex;
var mevcutx, toplamx, label, value, idxx, divIdxx;
var arrayPointx = [];
var arrayPointxx = [];
divIdxx = document.getElementById("veriTakipRadar").getContext("2d");
veriTakipxMetreData = {
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
            data: [75]
        },
        {
            label: "veriTakip Panel",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [75]
        }
    ]
};
veriTakipxMetrex = new Chart(divIdxx);//.Radar(data1);
veriTakipxMetrex = veriTakipxMetrex.Line(veriTakipxMetreData);

/**
 * 
 * @param {type} item
 * @returns {undefined}
 */
/*function veriTakipxMetre( item )
{
    for(var i = 0;i < item.xMetreInfo.length;i++){
        labelx      = item.xMetreInfo[i].Time;
        valuex      = item.xMetreInfo[i].ToprakTemp;
        mevcutx     = item.xMetreInfo[i].HavaTemp;
        veriTakipxMetrex.addData([mevcutx, valuex], labelx);
        
    }

    for(var j = 0;j < veriTakipxMetrex.datasets[0].points.length;j++){
        arrayPointx.push(veriTakipxMetrex.datasets[0].points[j].label);
        arrayPointxx.push(veriTakipxMetrex.datasets[0].points[j].value);
        veriTakipxMetrex.update();
        veriTakipxMetrex.removeData();
    }
    
    idxx = arrayPointx.indexOf(labelx);
    if (idxx != -1) {*/
        //veriTakipxMetrex.datasets[0].points[idxx].value = valuex;
        //veriTakipxMetrex.datasets[0].points[idxx].label = labelx;
/*    } else {
        veriTakipxMetrex.addData([mevcutx, valuex], labelx);
    }
    veriTakipxMetrex.addData([mevcutx, valuex], labelx);
    toplamx = veriTakipxMetrex.datasets[0].points.length;
    arrayPointx.splice(4, toplamx);
    arrayPointxx.splice(4, toplamx);
    console.log(toplamx);
    console.log(arrayPointx);
    console.log(arrayPointxx);
    //veriTakipxMetrex.update();
    //veriTakipxMetrex.removeData();
}*/

/*window.setTimeout(function(){
    ajaxJSONParser( yol + 'webservis/autoxmetrecontrol', {}, "veriTakipxMetre( item )" );
}, 2000);

window.setInterval(function(){
    ajaxJSONParser( yol + 'webservis/autoxmetrecontrol', {}, "veriTakipxMetre( item )" );
}, 90000);*/
