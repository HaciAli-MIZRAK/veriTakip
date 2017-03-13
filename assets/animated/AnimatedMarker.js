/*
kordinat bilgilerini dizi olarak yolluyoruz.
*/
var icons = [];

L.Icon.Text = L.Icon.extend({
    initialize: function (text, options) {
        this._text = text;
        L.Icon.prototype.initialize.apply(this, [options]);
    },

    createIcon: function () {
        var el = document.createElement('div');
        el.appendChild(document.createTextNode(this._text));
        //el.innerHTML = this._text;
        this._setIconStyles(el, 'icon');
        el.style.textShadow = '2px 2px 2px #fff';
        return el;
    },

    createShadow: function () { return null; }

});
L.AnimatedMarker = L.Marker.extend({
    options: {
        // meters
        distance: 200000,
        // ms
        interval: 1000,
        // animate on add?
        autoStart: false,
        pulsing: true,
        smallIcon: true,
        Speed: true,
        // callback onend
        onEnd: function () { },
        clickable: true
    },
    animateTo: function(newPosition, options) {
        defaultOptions = {
            duration: 10000,
            easing: 'linear',
            complete: null
        }
        options = options || {};

        // complete missing options
        for (key in defaultOptions) {
            options[key] = options[key] || defaultOptions[key];
        }

        // throw exception if easing function doesn't exist
        if (options.easing != 'linear') {            
            if (typeof jQuery == 'undefined' || !jQuery.easing[options.easing]) {
                throw '"' + options.easing + '" easing function doesn\'t exist. Include jQuery and/or the jQuery easing plugin and use the right function name.';
                return;
            }
        }
  
        window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
        window.cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

        // save current position. prefixed to avoid name collisions. separate for lat/lng to avoid calling lat()/lng() in every frame

        this.AT_startPosition_lat = this._latlng.lat;
        this.AT_startPosition_lng = this._latlng.lng;
        var newPosition_lat = newPosition.lat;
        var newPosition_lng = newPosition.lng;
  
        // crossing the 180° meridian and going the long way around the earth?
        if (Math.abs(newPosition_lng - this.AT_startPosition_lng) > 180) {
            if (newPosition_lng > this.AT_startPosition_lng) {      
                newPosition_lng -= 360;      
            } else {
                newPosition_lng += 360;
            }
        }

        var animateStep = function(marker, startTime) {            
            var ellapsedTime = (new Date()).getTime() - startTime;
            var durationRatio = ellapsedTime / options.duration; // 0 - 1
            var easingDurationRatio = durationRatio;

            // use jQuery easing if it's not linear
            if (options.easing !== 'linear') {
                easingDurationRatio = jQuery.easing[options.easing](durationRatio, ellapsedTime, 0, 1, options.duration);
            }
    
            if (durationRatio < 1) {
                var deltaPosition = new L.LatLng( marker.AT_startPosition_lat + (newPosition_lat - marker.AT_startPosition_lat)*easingDurationRatio,
                                                            marker.AT_startPosition_lng + (newPosition_lng - marker.AT_startPosition_lng)*easingDurationRatio);

                //var newposition1 = new L.LatLng(deltaPosition.k, deltaPosition.B);
                var denemeposition = new L.LatLng(deltaPosition.lat, deltaPosition.lng);
                marker.setLatLng(denemeposition);
                //marker.setPosition(deltaPosition);

                // use requestAnimationFrame if it exists on this browser. If not, use setTimeout with ~60 fps
                if (window.requestAnimationFrame) {
                    marker.AT_animationHandler = window.requestAnimationFrame(function() {animateStep(marker, startTime)});                
                } else {
                    marker.AT_animationHandler = setTimeout(function() {animateStep(marker, startTime)}, 17); 
                }

            } else {
      

                //var newposition1 = new L.LatLng(newPosition.k, newPosition.B);
                var newposition1 = new L.LatLng(newPosition.lat, newPosition.lng);
                denemekonum = newposition1;
                marker.setLatLng(newposition1);
                //marker.setPosition(newPosition);

                if (typeof options.complete === 'function') {
                    options.complete();
                }

            }            
        }

        // stop possibly running animation
        if (window.cancelAnimationFrame) {
            window.cancelAnimationFrame(this.AT_animationHandler);
        } else {
            clearTimeout(this.AT_animationHandler); 
        }
  
        animateStep(this, (new Date()).getTime());
    },
    setPulsing: function (pulsing) {
        this._pulsing = pulsing;
   //console.log(this.options.Ignition);
        var ClassNamex;
        ClassNamex = "orange";
	var MarkerTabela; 
        var BlueToothBeacon;
        var BlueToothBeaconData = '';
        var SuddenBlockageEngine = '';
        
        /* Renkli Duruma göre Marker alanı için yapıldı. */
        if (this.options.Ignition == 1) {
            ClassNamex = '<div class="pinred"></div><div class="pulsered"></div>';
        } 
        if (this.options.Ignition == 0) {
            ClassNamex = '<div class="pingreenyellow"></div><div class="pulsegreenyellow"></div>';
        }
	if (this.options.Rolante == 1) {
            ClassNamex = '<div class="pinorange"></div><div class="pulseorange"></div>';
        }
        /* Motor Blokaj Durumu */
        if(this.options.EngineBlock == 1){
            SuddenBlockageEngine = ''; //'<div class="marker-Engine-Block text-center">Motor Block Aktif<br /><i class="fa fa-exclamation-triangle fa-red fa-4x fa-box-shadow-white faa-flash animated"></i></div>';
            ClassNamex = '<div class="marker-Engine-Block"><i class="fa fa-exclamation fa-red fa-3x fa-box-shadow-white faa-flash animated"></i></div>';
        }
        
        /* Bu alan Cihazda Bluetooth Beacon Açık ise Görünecek. */
        if(this.options.Sensor12 == 'not') {
            BlueToothBeacon = '';
        } else {
            if(this.options.xSensor12Data == undefined)
            {} else {
                for (var Sensor12_x_i = 0;Sensor12_x_i < this.options.xSensor12Data.data.length;Sensor12_x_i++)
                {
                    BlueToothBeaconData += this.options.xSensor12Data.data[Sensor12_x_i].label + ' ' + this.options.xSensor12Data.data[Sensor12_x_i].value + "dbm\n";
                }
                BlueToothBeacon = '<div class="marker-Bluetooth-Beacon">' + BlueToothBeaconData + '\n</div>';
            }
            
        }
        
	/* Bu Alan Plaka verisi için yapıldı */	
        if (this.options.Plaka == null) {
            MarkerTabela = '';
        } else {
            MarkerTabela = '<div class="marker-etiket">' + 
            '<i class="fa fa-tachometer"></i> km/h: ' + 
            this.options.Speed + '<br />' + 
            this.options.Plaka + '</div>';
        }
        /* Mapbox divIcon Alanı */
        var iconPulsingSmall = L.divIcon({
            id: 'id',
            className: 'cls',
            iconAnchor: [-5, 16],
            iconSize: [0, 0],
            //popupAnchor: [0, -10],
            //labelAnchor: [3, -4],
            html: ClassNamex + MarkerTabela + BlueToothBeacon
        });
        if (this.options.smallIcon) {
            this.setIcon(!!this._pulsing ? iconPulsingSmall : iconSmall);
            icons.push(iconPulsingSmall);
        } else {

           this.setIcon(!!this._pulsing ? iconPulsing : icon);
        }
    },
    updateText: function (id, text) {
        if (document.getElementById('marker' + id) != null) {
            document.getElementById('marker' + id).innerHTML = text;
        }

    },
    deviceSearchZoom: function(pulsing){
        map.setView([this._latlngs[0].lat, this._latlngs[1].lng], 15);
    },
    updateIcon: function (id, bilgi, kapat) {


        var durum = 0;
        if (bilgi.Ignition == 1) {
            durum = 1;
            if (bilgi.Speed <= 3) {
                durum = 2;
            }
        }
        if (kapat) {
            durum = 0;
        }
        var clsi = "pulse_blue";
        var cls = "leaflet-usermarker-small_blue";
        switch (durum) {
            case 0:
                cls = "leaflet-usermarker-small_red";
                clsi = "pulse_red";
                break;
            case 1:
                cls = "leaflet-usermarker-small_green";
                clsi = "pulse_green";
                break;
            case 2:
                cls = "leaflet-usermarker-small_yellow";
                clsi = "pulse_yellow";
                break;
            default:

        }


        if (document.getElementById('markericon' + id) != null) {
            document.getElementById('markericon' + id).className = clsi;
            document.getElementById('markericon' + id).parentElement.className = "leaflet-marker-icon leaflet-zoom-hide leaflet-clickable " + cls;
        }

    },
    updateIconMiniMarker: function (id, durum) {


        var clsi = "pulse_blue";
        var cls = "leaflet-usermarker-small_blue";
        switch (durum) {
            case 0:
                cls = "leaflet-usermarker-small_red";
                clsi = "pulse_red";
                break;
            case 1:
                cls = "leaflet-usermarker-small_green";
                clsi = "pulse_green";
                break;
            case 2:
                cls = "leaflet-usermarker-small_yellow";
                clsi = "pulse_yellow";
                break;
            default:

        }


        if (document.getElementById('markericon' + id) != null) {
            document.getElementById('markericon' + id).className = clsi;
            document.getElementById('markericon' + id).parentElement.className = "leaflet-marker-icon leaflet-zoom-hide leaflet-clickable " + cls;
        }

    },
    initialize: function (latlngs, options) {
        this.setLine(latlngs);
        this.setPulsing(this.options.pulsing, options.id, options.MarkerText, options);
        L.Marker.prototype.initialize.call(this, latlngs[0], options);
    },
    _initIcon1: function () {
        L.Marker.prototype._initIcon.apply(this);

        var i = this._icon, s = this._shadow, obj = this.options.icon;
        this._icon = this._shadow = null;

        this.options.icon = this._fakeicon;
        L.Marker.prototype._initIcon.apply(this);
        this.options.icon = obj;

        if (s) {
            s.parentNode.removeChild(s);
            this._icon.appendChild(s);
        }

        i.parentNode.removeChild(i);
        this._icon.appendChild(i);

        var w = this._icon.clientWidth, h = this._icon.clientHeight;
        this._icon.style.marginLeft = -w / 2 + 'px';
        var off = new L.Point(w / 2, 0);
        if (L.Browser.webkit) off.y = -h;
        L.DomUtil.setPosition(i, off);
        if (s) L.DomUtil.setPosition(s, off);
    },
    // Breaks the line up into tiny chunks (see options) ONLY if CSS3 animations
    // are not supported.
    _chunk: function (latlngs) {
        var i,
            len = latlngs.length,
            chunkedLatLngs = [];

        for (i = 1; i < len; i++) {
            var cur = latlngs[i - 1],
                next = latlngs[i],
                dist = cur.distanceTo(next),
                factor = this.options.distance / dist,
                dLat = factor * (next.lat - cur.lat),
                dLng = factor * (next.lng - cur.lng);

            if (dist > this.options.distance) {
                while (dist > this.options.distance) {
                    cur = new L.LatLng(cur.lat + dLat, cur.lng + dLng);
                    dist = cur.distanceTo(next);
                    chunkedLatLngs.push(cur);
                }
            } else {
                chunkedLatLngs.push(cur);
            }
        }

        return chunkedLatLngs;
    },

    onAdd: function (map) {
        L.Marker.prototype.onAdd.call(this, map);

        // Start animating when added to the map
        if (this.options.autoStart) {
            this.start();
        }
    },

    animate: function () {
        var self = this,
            len = this._latlngs.length,
            speed = this.options.interval;

        // Normalize the transition speed from vertex to vertex
        if (this._i < len) {
            speed = this._latlngs[this._i - 1].distanceTo(this._latlngs[this._i]) / this.options.distance * this.options.interval;
        }

        // Only if CSS3 transitions are supported
        if (L.DomUtil.TRANSITION) {
            if (this._icon) { this._icon.style[L.DomUtil.TRANSITION] = ('all ' + speed + 'ms linear'); }
            if (this._shadow) { this._shadow.style[L.DomUtil.TRANSITION] = 'all ' + speed + 'ms linear'; }
        }

        // Move to the next vertex
        this.setLatLng(this._latlngs[this._i]);
        this._i++;

        // Queue up the animation to the next next vertex
        this._tid = setTimeout(function () {
            if (self._i === len) {
                self.options.onEnd.apply(self, Array.prototype.slice.call(arguments));
            } else {
                self.animate();
            }
        }, speed);
    },

    // Start the animation
    start: function () {
        if (!this._i) {
            this._i = 1;
        }

        this.animate();
    },

    // Stop the animation in place
    stop: function () {
        if (this._tid) {
            clearTimeout(this._tid);
        }
    },

    setLine: function (latlngs) {
        if (L.DomUtil.TRANSITION) {
            // No need to to check up the line if we can animate using CSS3
            this._latlngs = latlngs;
        } else {
            // Chunk up the lines into options.distance bits
            this._latlngs = this._chunk(latlngs);
            this.options.distance = 10;
            this.options.interval = 30;
        }
    }

});

L.animatedMarker = function (latlngs, options) {
    return new L.AnimatedMarker(latlngs, options);
};
