        var labels = { visible: true, position: 'outside' };
        $('#gaugeContainer').jqxGauge({
            ranges: [
                { startValue: 0, endValue: 90, style: { fill: '#e2e2e2', stroke: '#e2e2e2' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
                { startValue: 90, endValue: 140, style: { fill: '#f6de54', stroke: '#f6de54' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
                { startValue: 140, endValue: 180, style: { fill: '#db5016', stroke: '#db5016' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
                { startValue: 180, endValue: 220, style: { fill: '#d02841', stroke: '#d02841' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 }
            ],
            ticksMinor: { interval: 5, size: '5%' },
            ticksMajor: { interval: 10, size: '9%' },
            value: 0,
            colorScheme: 'scheme05',
            animationDuration: 1200
        });
        //$('#gaugeContainer').jqxExpander({ toggleMode: 'none', showArrow: false, width: 200});
        $('#gaugeContainer').jqxGauge('labels', labels);
        $('#gaugeContainer').jqxGauge({ border: { size: '20%', style: { stroke: '#990000'}, visible: false, showGradient: false }}); // dış border
        $('#gaugeContainer').jqxGauge({ caption: { value: 'veriTakip', position: 'bottom', offset: [0, 10], visible: false }}); // saat içine yazı
        $('#gaugeContainer').jqxGauge({ cap: { size: '43%', style: { fill: '#ffffff', stroke: '#ffffff' } , visible: true }}); // ibre merkezine daire
        $('#gaugeContainer').jqxGauge({ pointer: { pointerType: 'default', style: { fill: '#ff0000', stroke: '#ff0000' }, length: '80%', width: '3%', visible: true }}); // ibre
        $('#gaugeContainer').jqxGauge({ width: 300 }); // genişlik
        $('#gaugeContainer').jqxGauge({ height: 300 }); // yükseklik
        $('#gaugeContainer').jqxGauge({ max: 220 });
        
