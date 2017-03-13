/*
kordinatları tekil göndereceğiz
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

L.marker = L.Marker.extend({
    options: {
        // meters
        distance: 200,
        // ms
        interval: 1000,
        // animate on add?
        autoStart: false,
        pulsing: true,
        smallIcon: true,
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
    }

});

//L.animatedMarker = function (latlngs, options) {
//    return L.AnimatedMarker(latlngs, options);
//};