
jQuery(function ($) {
    google.maps.event.addDomListener(window, 'load', function () {
        //React Live Edit Template
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                var newNodes = mutation.addedNodes;
                if (newNodes !== null) {
                    var $nodes = $(newNodes);

                    $nodes.each(function () {
                        var $node = $(this);
                        $node.find('.sppb-addon-gmap-canvas').each(function (index) {
                            var mapId = 'sppb-addon-gmap' + (index + 1);
                            var self = this;

                            $(this).attr('id', mapId);

                            // Get data
                            var zoom = $(self).data('mapzoom');
                            var mousescroll = $(self).data('mousescroll');

                            var latlng = new google.maps.LatLng($(self).data('lat'), $(self).data('lng'));
                            var mapOptions = {
                                zoom: zoom,
                                center: latlng,
                                disableDefaultUI: true,
                                scrollwheel: mousescroll
                            };
                            var map = new google.maps.Map(document.getElementById(mapId), mapOptions);
                            var marker = new google.maps.Marker({position: latlng, map: map});
                            map.setMapTypeId(google.maps.MapTypeId[$(self).data('maptype')]);

                            //Get colors
                            var water_color = $(self).data('water_color');
                            var highway_stroke_color = $(self).data('highway_stroke_color');
                            var highway_fill_color = $(self).data('highway_fill_color');
                            var local_stroke_color = $(self).data('local_stroke_color');
                            var local_fill_color = $(self).data('local_fill_color');
                            var poi_fill_color = $(self).data('poi_fill_color');
                            var administrative_color = $(self).data('administrative_color');
                            var landscape_color = $(self).data('landscape_color');
                            var road_text_color = $(self).data('road_text_color');
                            var road_arterial_fill_color = $(self).data('road_arterial_fill_color');
                            var road_arterial_stroke_color = $(self).data('road_arterial_stroke_color');


                            var styles = [
                                {
                                    "featureType": "water",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "color": water_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "transit",
                                    "stylers": [
                                        {
                                            "color": "#808080"
                                        },
                                        {
                                            "visibility": "off"
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road.highway",
                                    "elementType": "geometry.stroke",
                                    "stylers": [
                                        {
                                            "visibility": "on"
                                        },
                                        {
                                            "color": highway_stroke_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road.highway",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "color": highway_fill_color
                                        }
                                    ]
                                },

                                {
                                    "featureType": "road.local",
                                    "elementType": "geometry.stroke",
                                    "stylers": [
                                        {
                                            "color": local_stroke_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road.local",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "visibility": "on"
                                        },
                                        {
                                            "color": local_fill_color
                                        },
                                        {
                                            "weight": 1.8
                                        }
                                    ]
                                },
                                {
                                    "featureType": "poi",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "visibility": "on"
                                        },
                                        {
                                            "color": poi_fill_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "administrative",
                                    "elementType": "geometry",
                                    "stylers": [
                                        {
                                            "color": administrative_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road.arterial",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "color": road_arterial_fill_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road.arterial",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "color": road_arterial_fill_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "landscape",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "visibility": "on"
                                        },
                                        {
                                            "color": landscape_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road",
                                    "elementType": "labels.text.fill",
                                    "stylers": [
                                        {
                                            "color": road_text_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "administrative",
                                    "elementType": "labels.text.fill",
                                    "stylers": [
                                        {
                                            "visibility": "on"
                                        },
                                        {
                                            "color": "#737373"
                                        }
                                    ]
                                },
                                {
                                    "featureType": "poi",
                                    "elementType": "labels.icon",
                                    "stylers": [
                                        {
                                            "visibility": "off"
                                        }
                                    ]
                                },
                                {
                                    "featureType": "poi",
                                    "elementType": "labels",
                                    "stylers": [
                                        {
                                            "visibility": "off"
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road.arterial",
                                    "elementType": "geometry.stroke",
                                    "stylers": [
                                        {
                                            "color": road_arterial_stroke_color
                                        }
                                    ]
                                },
                                {
                                    "featureType": "road",
                                    "elementType": "labels.icon",
                                    "stylers": [
                                        {
                                            "visibility": "off"
                                        }
                                    ]
                                },
                                {},
                                {
                                    "featureType": "poi",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                        {
                                            "color": "#dadada"
                                        }
                                    ]
                                }

                            ]; // END gmap styles

                            // Set styles to map
                            map.setOptions({styles: styles});
                        });
                    });
                }
            });
        });

        var config = {
            childList: true,
            subtree: true
        };

        // Pass in the target node, as well as the observer options
        observer.observe(document.body, config);

        //Front end show
        $('.sppb-addon-gmap-canvas').each(function (index) {
            var mapId = 'sppb-addon-gmap' + (index + 1);
            var self = this;

            $(this).attr('id', mapId);

            // Get data
            var zoom = $(self).data('mapzoom');
            var mousescroll = $(self).data('mousescroll');

            var latlng = new google.maps.LatLng($(self).data('lat'), $(self).data('lng'));
            var mapOptions = {
                zoom: zoom,
                center: latlng,
                disableDefaultUI: true,
                scrollwheel: mousescroll
            };
            var map = new google.maps.Map(document.getElementById(mapId), mapOptions);
            var marker = new google.maps.Marker({position: latlng, map: map});
            map.setMapTypeId(google.maps.MapTypeId[$(self).data('maptype')]);

            //Get colors
            var water_color = $(self).data('water_color');
            var highway_stroke_color = $(self).data('highway_stroke_color');
            var highway_fill_color = $(self).data('highway_fill_color');
            var local_stroke_color = $(self).data('local_stroke_color');
            var local_fill_color = $(self).data('local_fill_color');
            var poi_fill_color = $(self).data('poi_fill_color');
            var administrative_color = $(self).data('administrative_color');
            var landscape_color = $(self).data('landscape_color');
            var road_text_color = $(self).data('road_text_color');
            var road_arterial_fill_color = $(self).data('road_arterial_fill_color');
            var road_arterial_stroke_color = $(self).data('road_arterial_stroke_color');


            var styles = [
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": water_color
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                        {
                            "color": "#808080"
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": highway_stroke_color
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": highway_fill_color
                        }
                    ]
                },

                {
                    "featureType": "road.local",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": local_stroke_color
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": local_fill_color
                        },
                        {
                            "weight": 1.8
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": poi_fill_color
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": administrative_color
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": road_arterial_fill_color
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": road_arterial_fill_color
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": landscape_color
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": road_text_color
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#737373"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": road_arterial_stroke_color
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {},
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#dadada"
                        }
                    ]
                }

            ]; // END gmap styles

            // Set styles to map
            map.setOptions({styles: styles});

        });
    });
});