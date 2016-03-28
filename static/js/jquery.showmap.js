(function() {
    $.fn.showMap = function(config) {
        config = $.extend({
            update: $.noop()
        }, config);
        var canvas = this[0];


        var options = {zoom: 15};
        if(config.lat && config.lng) {
            options.center = new qq.maps.LatLng(config.lat, config.lng);
        }


        var map = new qq.maps.Map(canvas, options);
        qq.maps.event.addListener( map, 'click', function(event) {
            addMarker(event.latLng);
        });

        var marker;
        function addMarker(loc) {
            marker && marker.setMap(null);
            marker = new qq.maps.Marker({
                position: loc,
                draggable: true,
                map: map
            });
            qq.maps.event.addListener(marker, 'dragend', function(ev) {
                // console.log(ev.latLng);
                config.update(ev.latLng.lat, ev.latLng.lng)
            });
            config.update(loc.getLat(), loc.getLng())
        }

        var geoCoder = new qq.maps.Geocoder({
            complete : function(result){
                map.setCenter(result.detail.location);
                addMarker(result.detail.location);
            }
        });

        if(options.center) {
            addMarker(options.center);
        } else { // 没有经纬度尝试获取输入的位置 和 根据ip定位
            if(config.address) {
                geoCoder.getLocation(config.address);
            } else {
                new qq.maps.CityService({
                    complete: function(result) {
                        map.setCenter(result.detail.latLng);
                    }
                }).searchLocalCity();
            }
        }
        return geoCoder;
    };
})();
