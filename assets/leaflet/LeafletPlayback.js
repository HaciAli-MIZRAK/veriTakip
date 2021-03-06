var tArray = [], locationArray = [], speedArray = [], statuArray = [];
var lastTime = 0;
function Uyar(event) {
    var speed = parseFloat($('#speed-input').val());
    if (!speed) return;
    playback.setSpeed(speed);
    $('.speed-menu').dropdown('toggle');
    //$('#speed-slider').slider('value', speedToSliderVal(speed));
    //$('#speed-icon-val').html(speed);
    if (event.which === 13) {
        $('.speed-menu').dropdown('toggle');
    }
}
function GetTime(time) {
    var tickArray = tArray;
    var k;
    while (k == undefined) {
        k = tickArray[time];
        time++
        if (time > lastTime) {

            break;
        }

    }
    time--;
    return time;
}
function UnixToTime(time) {
    var d = new Date(time * 1000);
    var currentTimezone = d.getTimezoneOffset();

    currentTimezone = (currentTimezone / 60);
    var h = d.getHours() + currentTimezone;
    var m = d.getMinutes();
    var s = d.getSeconds();
    var tms = time / 1000;
    var dec = (tms - Math.floor(tms)).toFixed(2).slice(1);
    //var mer = 'AM';
    //if (h > 11) {
    //    h %= 12;
    //    mer = 'PM';
    //}
    if (h != 0 && h <= 0) {
        //debugger;
        h += (-1 * currentTimezone);
    }
    //if (h === 0) h = 12;

    if (m < 10) m = '0' + m;
    if (s < 10) s = '0' + s;

    var Time = [];
    Time.push('Tarih: ' + (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear());
    Time.push('Saat: ' + h + ':' + m + ':' + s)
    return Time;//+ ' ' + mer;
}
L.Playback = L.Playback || {};

L.Playback.Util = L.Class.extend({
    statics: {

        DateStr: function (time) {
            return new Date(time).toDateString();
        },

        TimeStr: function (time) {
            var d = new Date(time * 1000);
            var h = d.getHours();
            var m = d.getMinutes();
            var s = d.getSeconds();
            var tms = time / 1000;
            var dec = (tms - Math.floor(tms)).toFixed(2).slice(1);
            var mer = 'AM';
            if (h > 11) {
                h %= 12;
                mer = 'PM';
            }
            if (h === 0) h = 12;
            if (m < 10) m = '0' + m;
            if (s < 10) s = '0' + s;
            return h + ':' + m + ':' + s + dec + ' ' + mer;
        },

        ParseGPX: function (gpx) {
            var geojson = {
                type: 'Feature',
                geometry: {
                    type: 'MultiPoint',
                    coordinates: []
                },
                properties: {
                    time: [],
                    speed: [],
                    altitude: []
                },
                bbox: []
            };
            var xml = $.parseXML(gpx);
            var pts = $(xml).find('trkpt');
            for (var i = 0, len = pts.length; i < len; i++) {
                var p = pts[i];
                var lat = parseFloat(p.getAttribute('lat'));
                var lng = parseFloat(p.getAttribute('lon'));
                var timeStr = $(p).find('time').text();
                var eleStr = $(p).find('ele').text();
                var t = new Date(timeStr).getTime();
                var ele = parseFloat(eleStr);

                var coords = geojson.geometry.coordinates;
                var props = geojson.properties;
                var time = props.time;
                var altitude = geojson.properties.altitude;

                coords.push([lng, lat]);
                time.push(t);
                altitude.push(ele);
            }
            return geojson;
        }
    }

});

L.Playback = L.Playback || {};

L.Playback.MoveableMarker = L.Marker.extend({
    initialize: function (startLatLng, options, feature) {
        var marker_options = options.marker || {};

        if (jQuery.isFunction(marker_options)) {
            marker_options = marker_options(feature);
        }

        L.Marker.prototype.initialize.call(this, startLatLng, marker_options);

        this.popupContent = '';

        //if (marker_options.getPopup) {
        //    this.popupContent = marker_options.getPopup(feature);
        //}

        //this.bindPopup(this.getPopupContent());
    },

    getPopupContent: function () {
        if (this.popupContent != '') {
            return '<b>' + this.popupContent + '</b><br/>'
        }

        return '';
    },

    move: function (latLng, transitionTime, time) {
        // Only if CSS3 transitions are supported
        if (L.DomUtil.TRANSITION) {
            if (this._icon) {
                this._icon.style[L.DomUtil.TRANSITION] = 'all ' + transitionTime + 'ms linear';
                if (this._popup && this._popup._wrapper)
                    this._popup._wrapper.style[L.DomUtil.TRANSITION] = 'all ' + transitionTime + 'ms linear';
            }
            if (this._shadow) {
                this._shadow.style[L.DomUtil.TRANSITION] = 'all ' + transitionTime + 'ms linear';
            }
        }
        this.setLatLng(latLng);
        if (this._popup) {
            if (document.getElementById('_infobar') != undefined) {
                this._popup.setContent(document.getElementById('_infobar').parentNode.innerText);
            }

        }
    }
});

L.Playback = L.Playback || {};

L.Playback.Track = L.Class.extend({

    initialize: function (geoJSON, options) {
        options = options || {};
        var tickLen = options.tickLen || 250;

        this._geoJSON = geoJSON;
        this._tickLen = tickLen;
        this._ticks = [];
        this._locations = [];
        this._speed = [];
        this._statu = [];
        this._marker = null;

        var sampleTimes = geoJSON.properties.time;
        var samples = geoJSON.geometry.coordinates;
        var locations = geoJSON.geometry.locations;
        var speed = geoJSON.properties.speed;
        var statu = geoJSON.properties.statu;

        var currSample = samples[0];
        var nextSample = samples[1];
        var t = currSampleTime = sampleTimes[0]; // t is used to iterate through tick times
        var nextSampleTime = sampleTimes[1];
        var tmod = t % tickLen; // ms past a tick time
        var rem,
        ratio;
        this._startTime = t;
        for (var i = 0, len = samples.length; i < len; i++) {
            currSample = samples[i];
            t = sampleTimes[i];
            this._ticks[t] = currSample;
            this._locations[t] = locations[i];
            this._speed[t] = speed[i];
            this._statu[t] = statu[i];
        }

        // handle edge case of only one t sample
        //if (sampleTimes.length === 1) {
        //    if (tmod !== 0)
        //        t += tickLen - tmod;
        //    this._ticks[t] = samples[0];
        //    this._startTime = t;
        //    this._endTime = t;
        //    return;
        //}

        // interpolate first tick if t not a tick time
        //if (tmod !== 0) {
        //    rem = tickLen - tmod;
        //    ratio = rem / (nextSampleTime - currSampleTime);
        //    t += rem;
        //    this._ticks[t] = this._interpolatePoint(currSample, nextSample, ratio);
        //} else {
        //    this._ticks[t] = currSample;
        //}

        //this._startTime = t;
        //t += tickLen;
        //while (t < nextSampleTime) {
        //    ratio = (t - currSampleTime) / (nextSampleTime - currSampleTime);
        //    this._ticks[t] = this._interpolatePoint(currSample, nextSample, ratio);
        //    t += tickLen;
        //}

        //// iterating through the rest of the samples
        //for (var i = 1, len = samples.length; i < len; i++) {
        //    currSample = samples[i];
        //    nextSample = samples[i + 1];
        //    t = currSampleTime = sampleTimes[i];
        //    nextSampleTime = sampleTimes[i + 1];

        //    tmod = t % tickLen;
        //    if (tmod != 0 && nextSampleTime) {
        //        rem = tickLen - tmod;
        //        ratio = rem / (nextSampleTime - currSampleTime);
        //        t += rem;
        //        this._ticks[t] = this._interpolatePoint(currSample, nextSample, ratio);
        //    } else {
        //        this._ticks[t] = currSample;
        //    }

        //    t += tickLen;
        //    while (t < nextSampleTime) {
        //        ratio = (t - currSampleTime) / (nextSampleTime - currSampleTime);

        //        if (nextSampleTime - currSampleTime > options.maxInterpolationTime) {
        //            this._ticks[t] = currSample;
        //        }
        //        else {
        //            this._ticks[t] = this._interpolatePoint(currSample, nextSample, ratio);
        //        }

        //        t += tickLen;
        //    }
        //}

        // the last t in the while would be past bounds
        this._endTime = t;// - tickLen;
        this._lastTick = this._ticks[this._endTime];
        lastTime = t;

    },

    _interpolatePoint: function (start, end, ratio) {
        try {
            var delta = [end[0] - start[0], end[1] - start[1]];
            var offset = [delta[0] * ratio, delta[1] * ratio];
            return [start[0] + offset[0], start[1] + offset[1]];
        } catch (e) {
            console.log('err: cant interpolate a point');
            console.log(['start', start]);
            console.log(['end', end]);
            console.log(['ratio', ratio]);
        }
    },

    getFirstTick: function () {
        return this._ticks[this._startTime];
    },

    getLastTick: function () {
        return this._ticks[this._endTime];
    },

    getStartTime: function () {
        return this._startTime;
    },

    getEndTime: function () {
        return this._endTime;
    },

    getTickMultiPoint: function () {
        var t = this.getStartTime();
        var endT = this.getEndTime();
        var coordinates = [];
        var time = [];
        while (t <= endT) {
            time.push(t);
            coordinates.push(this.tick(t));
            t += this._tickLen;
        }

        return {
            type: 'Feature',
            geometry: {
                type: 'MultiPoint',
                coordinates: coordinates
            },
            properties: {
                time: time
            }
        };
    },

    tick: function (timestamp) {
        if (timestamp > this._endTime)
            timestamp = this._endTime;
        if (timestamp < this._startTime)
            timestamp = this._startTime;

        return this._ticks[timestamp];
    },

    setMarker: function (timestamp, options) {
        var lngLat = null;

        // if time stamp is not set, then get first tick
        if (timestamp) {
            lngLat = this.tick(timestamp);
        }
        else {
            lngLat = this.getFirstTick();
        }

        if (lngLat) {
            var latLng = new L.LatLng(lngLat[1], lngLat[0]);
            this._marker = new L.Playback.MoveableMarker(latLng, options, this._geoJSON);
        }

        return this._marker;
    },

    moveMarker: function (latLng, transitionTime, time) {
        if (this._marker) {
            this._marker.move(latLng, transitionTime, time);
        }
    },

    getMarker: function () {
        return this._marker;
    }

});
L.Playback = L.Playback || {};

L.Playback.TrackController = L.Class.extend({

    initialize: function (map, tracks, options) {
        this.options = options || {};

        this._map = map;

        this._tracks = [];

        // initialize tick points
        this.setTracks(tracks);
    },

    clearTracks: function () {
        while (this._tracks.length > 0) {
            var track = this._tracks.pop();
            var marker = track.getMarker();

            if (marker) {
                this._map.removeLayer(marker);
            }
        }
    },

    setTracks: function (tracks) {
        // reset current tracks
        this.clearTracks();

        this.addTracks(tracks);
    },

    addTracks: function (tracks) {
        // return if nothing is set
        if (!tracks) {
            return;
        }

        if (tracks instanceof Array) {
            for (var i = 0, len = tracks.length; i < len; i++) {
                this.addTrack(tracks[i]);
            }
        } else {
            this.addTrack(tracks);
        }
    },

    // add single track
    addTrack: function (track, timestamp) {
        // return if nothing is set
        if (!track) {
            return;
        }

        var marker = track.setMarker(timestamp, this.options);

        if (marker) {
            marker.addTo(this._map);

            this._tracks.push(track);
        }
    },

    tock: function (timestamp, transitionTime) {
        for (var i = 0, len = this._tracks.length; i < len; i++) {
            var lngLat = this._tracks[i].tick(timestamp);
            var latLng = new L.LatLng(lngLat[1], lngLat[0]);
            this._tracks[i].moveMarker(latLng, transitionTime, timestamp);
            this._map.setView([latLng.lat, latLng.lng], this._map.getZoom());
        }
    },

    getStartTime: function () {
        var earliestTime = 0;

        if (this._tracks.length > 0) {
            earliestTime = this._tracks[0].getStartTime();
            for (var i = 0, len = this._tracks.length; i < len; i++) {
                var t = this._tracks[i].getStartTime();
                if (t < earliestTime)
                    earliestTime = t;
            }
        }

        return earliestTime;
    },

    getEndTime: function () {
        var latestTime = 0;

        if (this._tracks.length > 0) {
            latestTime = this._tracks[0].getEndTime();
            for (var i = 1, len = this._tracks.length; i < len; i++) {
                var t = this._tracks[i].getEndTime();
                if (t > latestTime)
                    latestTime = t;
            }
        }

        return latestTime;
    },

    getTracks: function () {
        return this._tracks;
    }
});
L.Playback = L.Playback || {};

L.Playback.Clock = L.Class.extend({

    initialize: function (trackController, callback, options) {
        this._trackController = trackController;
        this._callbacksArry = [];
        if (callback) this.addCallback(callback);
        L.setOptions(this, options);
        this._speed = this.options.speed;
        this._tickLen = this.options.tickLen;
        this._cursor = trackController.getStartTime();
        this._transitionTime = this._tickLen / this._speed;
        this._ticksArray = [];
    },

    _tick: function (self) {
        if (self._cursor > self._trackController.getEndTime()) {
            clearInterval(self._intervalID);
            return;
        }
        self._trackController.tock(self._cursor, self._transitionTime);
        self._callbacks(self._cursor);
        var t = self._cursor;
        t++;
        self._cursor = self.getSpecificTime(t);
    },

    _callbacks: function (cursor) {
        var arry = this._callbacksArry;
        for (var i = 0, len = arry.length; i < len; i++) {
            arry[i](cursor);
        }
    },

    addCallback: function (fn) {
        this._callbacksArry.push(fn);
    },

    start: function () {
        if (this._intervalID) return;
        this._intervalID = window.setInterval(
          this._tick,
          this._transitionTime,
          this);
    },

    stop: function () {
        if (!this._intervalID) return;
        clearInterval(this._intervalID);
        this._intervalID = null;
    },

    getSpeed: function () {
        return this._speed;
    },

    isPlaying: function () {
        return this._intervalID ? true : false;
    },

    setSpeed: function (speed) {
        this._speed = speed;
        this._transitionTime = this._tickLen / speed;
        if (this._intervalID) {
            this.stop();
            this.start();
        }
    },

    setCursor: function (ms) {
        var time = parseInt(ms);
        if (!time) return;
        var mod = time % this._tickLen;
        mod = 0;
        if (mod !== 0) {
            time += this._tickLen - mod;
        }
        this._cursor = time;
        this._trackController.tock(this._cursor, 0);
        this._callbacks(this._cursor);
    },

    getTime: function () {
        return this._cursor;
    },

    getStartTime: function () {
        return this._trackController.getStartTime();
    },

    getEndTime: function () {
        return this._trackController.getEndTime();
    },

    getTickLen: function () {
        return this._tickLen;
    },
    setTicksArray: function (ticks) {
        this._ticksArray = this._trackController._tracks[0]._ticks;
        this._locations = this._trackController._tracks[0]._locations;
        this._speed = this._trackController._tracks[0]._speed;
        this._statu = this._trackController._tracks[0]._statu;
        tArray = this._ticksArray;
        locationArray = this._locations;
        statuArray = this._statu;
        speedArray = this._speed;
    },
    getTicksArray: function () {
        return this._ticksArray;
    },
    getSpecificTime: function (time) {
        time = GetTime(time);
        return time;
    }

});

// Simply shows all of the track points as circles.
// TODO: Associate circle color with the marker color.

L.Playback = L.Playback || {};

L.Playback.TracksLayer = L.Class.extend({
    initialize: function (map, options) {
        var layer_options = options.layer || {};

        if (jQuery.isFunction(layer_options)) {
            layer_options = layer_options(feature);
        }

        if (!layer_options.pointToLayer) {
            layer_options.pointToLayer = function (featureData, latlng) {
                return new L.CircleMarker(latlng, { radius: 5 });
            }
        }

        this.layer = new L.GeoJSON(null, layer_options);

        var overlayControl = {
            'GPS Tracks': this.layer
        };

        L.control.layers(null, overlayControl, {
            collapsed: false
        }).addTo(map);
    },

    // clear all geoJSON layers
    clearLayer: function () {
        for (var i in this.layer._layers) {
            this.layer.removeLayer(this.layer._layers[i]);
        }
    },

    // add new geoJSON layer
    addLayer: function (geoJSON) {
        this.layer.addData(geoJSON);
    }
});
L.Playback = L.Playback || {};

L.Playback.DateControl = L.Control.extend({
    options: {
        position: 'bottomleft'
    },

    initialize: function (playback) {
        this.playback = playback;
    },

    onAdd: function (map) {

        this._container = L.DomUtil.create('div', 'leaflet-control-layers leaflet-control-layers-expanded');



        var self = this;
        var playback = this.playback;
        var time = playback.getTime();

        var datetime = L.DomUtil.create('div', 'datetimeControl', this._container);

        // date time
        this._date = L.DomUtil.create('p', '', datetime);
        this._time = L.DomUtil.create('p', '', datetime);
        var _location = L.DomUtil.create('p', '', this._container);
        _location.id = "_infobar";
        var _statu = L.DomUtil.create('p', '', this._container);
        var _speed = L.DomUtil.create('p', '', this._container);
        this._date.innerHTML = UnixToTime(time)[0];
        this._time.innerHTML = UnixToTime(time)[1];

        _location.innerHTML = 'Adres: ' + locationArray[time];
        _statu.innerHTML = 'Durum: ' + statuArray[time];
        _speed.innerHTML = ('H�z: ' + speedArray[time] + ' Km/h').replace('?', 'i');

        // setup callback
        playback.addCallback(function (ms) {

            self._date.innerHTML = UnixToTime(ms)[0];
            self._time.innerHTML = UnixToTime(ms)[1];
            _location.innerHTML = 'Adres: ' + locationArray[ms];
            _statu.innerHTML = 'Durum: ' + statuArray[ms];
            _speed.innerHTML = ('H�z: ' + speedArray[ms] + ' Km/h').replace('?', '�');
        });


        return this._container;
    }
});

L.Playback.PlayControl = L.Control.extend({
    options: {
        position: 'bottomleft'
    },

    initialize: function (playback) {
        this.playback = playback;
    },

    onAdd: function (map) {
        this._container = L.DomUtil.create('div', 'leaflet-control-layers leaflet-control-layers-expanded');

        var self = this;
        var playback = this.playback;
        playback.setSpeed(0.5);

        var playControl = L.DomUtil.create('div', 'playControl', this._container);


        this._button = L.DomUtil.create('button', '', playControl);
        this._button.innerHTML = 'Oynat';


        var stop = L.DomEvent.stopPropagation;

        L.DomEvent
        .on(this._button, 'click', stop)
        .on(this._button, 'mousedown', stop)
        .on(this._button, 'dblclick', stop)
        .on(this._button, 'click', L.DomEvent.preventDefault)
        .on(this._button, 'click', play, this);

        function play() {
            if (playback.isPlaying()) {
                playback.stop();
                self._button.innerHTML = 'Oynat';
            }
            else {
                playback.start();
                self._button.innerHTML = 'Durdur';
            }
        }

        return this._container;
    }
});

L.Playback.SliderControl = L.Control.extend({
    options: {
        position: 'bottomleft'
    },

    initialize: function (playback) {
        this.playback = playback;
    },

    onAdd: function (map) {
        this._container = L.DomUtil.create('div', 'leaflet-control-layers leaflet-control-layers-expanded');

        var self = this;
        var playback = this.playback;

        // slider
        this._slider = L.DomUtil.create('input', 'slider', this._container);
        this._slider.type = 'range';
        this._slider.id = 'slider';
        this._slider.min = playback.getStartTime();
        this._slider.max = playback.getEndTime();
        this._slider.value = playback.getTime();

        var stop = L.DomEvent.stopPropagation;

        L.DomEvent
        .on(this._slider, 'click', stop)
        .on(this._slider, 'mousedown', stop)
        .on(this._slider, 'dblclick', stop)
        .on(this._slider, 'click', myfunction)
        //.on(this._slider, 'mousemove', L.DomEvent.preventDefault)
        .on(this._slider, 'change', onSliderChange, this)
        .on(this._slider, 'mousemove', onSliderChange, this);

        function myfunction(a) {
            // debugger;
        }
        function onSliderChange(e) {
            var val = Number(e.target.value);
            val = GetTime(val);
            playback.setCursor(val);

        }

        playback.addCallback(function (ms) {
            self._slider.value = ms;
        });


        map.on('playback:add_tracks', function () {
            self._slider.min = playback.getStartTime();
            self._slider.max = playback.getEndTime();
            self._slider.value = playback.getTime();

        });

        return this._container;
    }
});
L.Playback.SpeedControl = L.Control.extend({
    options: {
        position: 'bottomleft'
    },

    initialize: function (playback) {
        this.playback = playback;
    },
    onAdd: function (map) {
        this._container = L.DomUtil.create('div', 'leaflet-control-layers leaflet-control-layers-expanded');

        var self = this;
        var playback = this.playback;

        var a = '<ul class="nav pull-right">' +
        '          <li class="ctrl dropup">' +
        '            <a id="speed-btn" data-toggle="dropdown" href="#"><i class="fa fa-dashboard fa-lg"></i> <span id="speed-icon-val" class="speed">0.1</span>x</a>' +
        '            <div class="speed-menu dropdown-menu" role="menu" aria-labelledby="speed-btn">' +
        '              <label>Playback<br/>Speed</label>' +
        '              <input id="speed-input" class="span1 speed slider" type="text" value="0.1" />' +
        '              <div id="speed-slider"></div>' +
        '            </div>' +
        '          </li>' +
        '        </ul>';
        //slider
        this._cc = L.DomUtil.create('div', null, this._container);
        $(this._cc).after(a);

        ////this._slider = $(this._cc);
        this._slider = L.DomUtil.create('div', '', this._container);
        $(this._slider).slider({
            min: 1,
            max: 10,
            step: 1,
            value: _speedToSliderVal(this.playback.getSpeed()),
            orientation: 'vertical',
            slide: function (event, ui) {
                var speed = _speedToSliderVal(parseFloat(ui.value));
                playback.setSpeed(speed);

                $('.speed').html(speed).val(speed);
            }
        });
        //this._slider.slide = function (event, ui) {
        //    var speed = self._sliderValToSpeed(parseFloat(ui.value));
        //    playback.setSpeed(speed);
        //    $('.speed').html(speed).val(speed);
        //}
        var stop = L.DomEvent.stopPropagation;

        L.DomEvent
        .on(this._slider, 'slide', myfunction);
        //.on(this._slider, 'mousedown', stop)
        //.on(this._slider, 'dblclick', stop)
        //.on(this._slider, 'click', myfunction)
        ////.on(this._slider, 'mousemove', L.DomEvent.preventDefault)
        //.on(this._slider, 'change', onSliderChange, this)
        //.on(this._slider, 'mousemove', onSliderChange, this);
        function _speedToSliderVal(speed) {
            //if (speed < 1) return -10 + speed * 10;
            //return speed - 1;
            return speed / 10;
        }
        function myfunction(a) {
            var speed = self._sliderValToSpeed(parseFloat(ui.value));
        }
        //function onSliderChange(e) {
        //    var val = Number(e.target.value);
        //    val = GetTime(val);
        //    playback.setCursor(val);

        //}

        playback.addCallback(function (ms) {
            self._slider.value = ms;
        });


        map.on('playback:add_tracks', function () {
            self._slider.min = playback.getStartTime();
            self._slider.max = playback.getEndTime();
            self._slider.value = playback.getTime();

        });

        return this._container;
    }
});

L.Playback.Control = L.Control.extend({

    _html:
  '<div class="lp">' +
  '  <div class="transport">' +
  '    <div class="navbar">' +
  '      <div class="navbar-inner">' +
  '        <ul class="nav">' +
  '          <li class="ctrl">' +
  '            <a id="play-pause" href="#"><i id="play-pause-icon" class="fa fa-play fa-lg"></i></a>' +
  '          </li>' +
  '          <li class="ctrl dropup">' +
  '            <a id="clock-btn" class="clock" data-toggle="dropdown" href="#">' +
  '              <span id="cursor-date"></span><br/>' +
  '              <span id="cursor-time"></span>' +
  '            </a>' +
  '            <div class="dropdown-menu" role="menu" aria-labelledby="clock-btn">' +
  '              <label>Playback Cursor Time</label>' +
  '              <div class="input-append bootstrap-timepicker">' +
  '                <input id="timepicker" type="text" class="input-small span2">' +
  '                <span class="add-on"><i class="fa fa-clock-o"></i></span>' +
  '              </div>' +
  '              <div id="calendar"></div>' +
  '              <div class="input-append">' +
  '                <input id="date-input" type="text" class="input-small">' +
  '                <span class="add-on"><i class="fa fa-calendar"></i></span>' +
  '              </div>' +
  '            </div>' +
  '          </li>' +
  '        </ul>' +
  '        <ul class="nav pull-right">' +
  '          <li>' +
  '            <div id="time-slider"></div>' +
  '          </li>' +
  '          <li class="ctrl dropup">' +
  '            <a id="speed-btn" data-toggle="dropdown" href="#"><i class="fa fa-dashboard fa-lg"></i> <span id="speed-icon-val" class="speed">1</span>x</a>' +
  '            <div class="speed-menu dropdown-menu" role="menu" aria-labelledby="speed-btn">' +
  '              <label>Playback<br/>Speed</label>' +
  '              <input id="speed-input" class="span1 speed" type="text" value="1" />' +
  '              <div id="speed-slider"></div>' +
  '            </div>' +
  '          </li>' +
  '          <li class="ctrl">' +
  '            <a id="load-tracks-btn" href="#"><i class="fa fa-map-marker fa-lg"></i> Tracks</a>' +
  '          </li>' +
  '        </ul>' +
  '      </div>' +
  '    </div>' +
  '  </div>' +
  '</div>' +
  '<div id="load-tracks-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="load-tracks-label" aria-hidden="true">' +
  '  <div class="modal-header">' +
  '    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>' +
  '    <h3 id="load-tracks-label">Load GPS Tracks</h3>' +
  '  </div>' +
  '  <div class="modal-body">' +
  '    <p>' +
  '      Leaflet Playback supports GeoJSON and GPX files. CSV support coming soon!' +
  '    </p>' +
  '    <label>Upload a File</label>' +
  '    <input type="file" id="load-tracks-file" />' +
  '  </div>' +
  '  <div class="modal-footer">' +
  '    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>' +
  '    <button id="load-tracks-save" class="btn btn-primary">Load</button>' +
  '  </div>' +
  '</div>',

    initialize: function (playback) {
        this.playback = playback;
        playback.addCallback(this._clockCallback);
    },

    onAdd: function (map) {
        var html = this._html;
        $('#gecmis_Izleme').after(html);
        this._setup();

        // just an empty container
        // TODO: dont do this

        return L.DomUtil.create('div');
    },

    _setup: function () {
        var self = this;
        var playback = this.playback;
        $('#play-pause').click(function () {
            if (playback.isPlaying() === false) {
                playback.start();
                $('#play-pause-icon').removeClass('fa-play');
                $('#play-pause-icon').addClass('fa-pause');
            } else {
                playback.stop();
                $('#play-pause-icon').removeClass('fa-pause');
                $('#play-pause-icon').addClass('fa-play');
            }
        });

        var startTime = playback.getStartTime();
        $('#cursor-date').html(L.Playback.Util.DateStr(startTime));
        $('#cursor-time').html(L.Playback.Util.TimeStr(startTime));

        $('#time-slider').slider({
            min: playback.getStartTime(),
            max: playback.getEndTime(),
            step: playback.getTickLen(),
            value: playback.getTime(),
            slide: function (event, ui) {
                playback.setCursor(ui.value);
                $('#cursor-time').val(ui.value.toString());
                $('#cursor-time-txt').html(new Date(ui.value).toString());
            }
        });

        $('#speed-slider').slider({
            min: -9,
            max: 9,
            step: .1,
            value: self._speedToSliderVal(this.playback.getSpeed()),
            orientation: 'vertical',
            slide: function (event, ui) {
                var speed = self._sliderValToSpeed(parseFloat(ui.value));
                playback.setSpeed(speed);
                $('.speed').html(speed).val(speed);
            }
        });

        $('#speed-input').on('keyup', function (e) {
            var speed = parseFloat($('#speed-input').val());
            if (!speed) return;
            playback.setSpeed(speed);
            $('#speed-slider').slider('value', speedToSliderVal(speed));
            $('#speed-icon-val').html(speed);
            if (e.keyCode === 13) {
                $('.speed-menu').dropdown('toggle');
            }
        });

        $('#calendar').datepicker({
            changeMonth: true,
            changeYear: true,
            altField: '#date-input',
            altFormat: 'mm/dd/yy',
            defaultDate: new Date(playback.getTime()),
            onSelect: function (date) {
                var date = new Date(date);
                var time = $('#timepicker').data('timepicker');
                var ts = self._combineDateAndTime(date, time);
                playback.setCursor(ts);
                $('#time-slider').slider('value', ts);
            }
        });

        $('#date-input').on('keyup', function (e) {
            $('#calendar').datepicker('setDate', $('#date-input').val());
        });

        $('.dropdown-menu').on('click', function (e) {
            e.stopPropagation();
        });

        //$('#timepicker').timepicker({
        //    showSeconds: true
        //});

        //$('#timepicker').timepicker('setTime',
        //    new Date(playback.getTime()).toTimeString());

        //$('#timepicker').timepicker().on('changeTime.timepicker', function (e) {
        //    var date = $('#calendar').datepicker('getDate');
        //    var ts = self._combineDateAndTime(date, e.time);
        //    playback.setCursor(ts);
        //    $('#time-slider').slider('value', ts);
        //});

        $('#load-tracks-btn').on('click', function (e) {
            $('#load-tracks-modal').modal();
        });

        $('#load-tracks-save').on('click', function (e) {
            var file = $('#load-tracks-file').get(0).files[0];
            self._loadTracksFromFile(file);
        });

    },

    _clockCallback: function (ms) {
        $('#cursor-date').html(L.Playback.Util.DateStr(ms));
        $('#cursor-time').html(L.Playback.Util.TimeStr(ms));
        $('#time-slider').slider('value', ms);
    },

    _speedToSliderVal: function (speed) {
        if (speed < 1) return -10 + speed * 10;
        return speed - 1;
    },

    _sliderValToSpeed: function (val) {
        if (val < 0) return parseFloat((1 + val / 10).toFixed(2));
        return val + 1;
    },

    _combineDateAndTime: function (date, time) {
        var yr = date.getFullYear();
        var mo = date.getMonth();
        var dy = date.getDate();
        // the calendar uses hour and the timepicker uses hours...
        var hr = time.hours || time.hour;
        if (time.meridian == 'PM' && hr != 12) hr += 12;
        var min = time.minutes || time.minute;
        var sec = time.seconds || time.second;
        return new Date(yr, mo, dy, hr, min, sec).getTime();
    },

    _loadTracksFromFile: function (file) {
        var self = this;
        var reader = new FileReader();
        reader.readAsText(file);
        reader.onload = function (e) {
            var fileStr = e.target.result;

            /**
             * See if we can do GeoJSON...
             */
            try {
                var tracks = JSON.parse(fileStr);
            } catch (e) {
                /**
                 * See if we can do GPX...
                 */
                try {
                    var tracks = L.Playback.Util.ParseGPX(fileStr);
                } catch (e) {
                    console.error('Unable to load tracks!');
                    return;
                }
            }

            self.playback.addData(tracks);
            $('#load-tracks-modal').modal('hide');
        }
    }

});


L.Playback = L.Playback.Clock.extend({
    statics: {
        MoveableMarker: L.Playback.MoveableMarker,
        Track: L.Playback.Track,
        TrackController: L.Playback.TrackController,
        Clock: L.Playback.Clock,
        Util: L.Playback.Util,

        TracksLayer: L.Playback.TracksLayer,
        PlayControl: L.Playback.PlayControl,
        DateControl: L.Playback.DateControl,
        SliderControl: L.Playback.SliderControl,
        SpeedControl: L.Playback.SpeedControl
    },

    options: {
        tickLen: 250,
        speed: 1,
        maxInterpolationTime: 5 * 60 * 1000, // 5 minutes

        tracksLayer: true,

        playControl: false,
        dateControl: false,
        sliderControl: false,
        speedControl: false,
        // options
        layer: {
            // pointToLayer(featureData, latlng)
        },

        marker: {
            // getPopup(feature)
        }
    },
    removeLayerGecmisIzleme: function (map, geoJSON) {
        debugger;
    },
    initialize: function (map, geoJSON, callback, options) {

        
        L.setOptions(this, options);

        this._map = map;
        this._trackController = new L.Playback.TrackController(map, null, this.options);
        L.Playback.Clock.prototype.initialize.call(this, this._trackController, callback, this.options);

        if (this.options.tracksLayer) {
            
            this._tracksLayer = new L.Playback.TracksLayer(map, options);
        }
        this.setData(geoJSON);


        if (this.options.playControl) {
            this.playControl = new L.Playback.PlayControl(this);
            this.playControl.addTo(map);
        }

        if (this.options.sliderControl) {
            this.sliderControl = new L.Playback.SliderControl(this);
            this.sliderControl.addTo(map);
        }

        if (this.options.dateControl) {
            this.dateControl = new L.Playback.DateControl(this);
            this.dateControl.addTo(map);
        }
        if (this.options.speedControl) {
            this.speedControl = new L.Playback.SpeedControl(this);
            this.speedControl.addTo(map);
        }
    },
    Yenile: function (map, geoJSON, callback, options) {
        map.remove();
        GecmisIzlemeHaritaYarat();
        map = gecmisIzleme;
        return new L.Playback(map, geoJSON, callback, options);
        //this._trackController = new L.Playback.TrackController(map, null, this.options);
        //L.Playback.Clock.prototype.initialize.call(this, this._trackController, null, this.options);
        //this.setData(geoJSON);
    },
    clearData: function () {
        this._trackController.clearTracks();

        if (this._tracksLayer) {
            this._tracksLayer.clearLayer();
        }
    },

    setData: function (geoJSON) {
        this.clearData();

        this.addData(geoJSON, this.getTime());

        this.setCursor(this.getStartTime());
        this.setTicksArray(this._trackController._tracks[0]._ticks);

    },

    // bad implementation
    addData: function (geoJSON, ms) {
        // return if data not set
        if (!geoJSON) {
            return;
        }

        if (geoJSON instanceof Array) {
            for (var i = 0, len = geoJSON.length; i < len; i++) {
                this._trackController.addTrack(new L.Playback.Track(geoJSON[i], this.options), ms);
            }
        } else {
            this._trackController.addTrack(new L.Playback.Track(geoJSON, this.options), ms);
        }

        this._map.fire('playback:set:data');

        if (this.options.tracksLayer) {
            this._tracksLayer.addLayer(geoJSON);
        }
    }
});

L.Map.addInitHook(function () {
    if (this.options.playback) {
        this.playback = new L.Playback(this);
    }
});

L.playback = function (map, geoJSON, callback, options) {
    return new L.Playback(map, geoJSON, callback, options);
};