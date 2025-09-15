<?php
vc_map(array(
    "name" => 'Google Maps',
    "base" => "maps",
    "category" => __('Medicare', 'medicare'),
	"icon" => "tb-icon-for-vc",
    "description" => __('Google Maps API V3', 'medicare'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('API Key', 'medicare'),
            "param_name" => "api",
            "value" => '',
            "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Address', 'medicare'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => __('Enter address of Map', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Coordinate', 'medicare'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Click Show Info window', 'medicare'),
            "param_name" => "infoclick",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Marker", 'medicare'),
            "description" => __('Click a marker and show info window (Default Show).', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Coordinate', 'medicare'),
            "param_name" => "markercoordinate",
            "value" => '',
            "group" => __("Marker", 'medicare'),
            "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Title', 'medicare'),
            "param_name" => "markertitle",
            "value" => '',
            "group" => __("Marker", 'medicare'),
            "description" => __('Enter Title Info windows for marker', 'medicare')
        ),
        array(
            "type" => "textarea",
            "heading" => __('Marker Description', 'medicare'),
            "param_name" => "markerdesc",
            "value" => '',
            "group" => __("Marker", 'medicare'),
            "description" => __('Enter Description Info windows for marker', 'medicare')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Marker Icon', 'medicare'),
            "param_name" => "markericon",
            "value" => '',
            "group" => __("Marker", 'medicare'),
            "description" => __('Select image icon for marker', 'medicare')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Marker List', 'medicare'),
            "param_name" => "markerlist",
            "value" => '',
            "group" => __("Multiple Marker", 'medicare'),
            "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Info Window Max Width', 'medicare'),
            "param_name" => "infowidth",
            "value" => '200',
            "group" => __("Marker", 'medicare'),
            "description" => __('Set max width for info window', 'medicare')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'medicare'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => __('Select the map type.', 'medicare')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style Template", 'medicare'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Subtle Grayscale" => "Subtle-Grayscale",
                "Shades of Grey" => "Shades-of-Grey",
                "Blue water" => "Blue-water",
                "Pale Dawn" => "Pale-Dawn",
                "Blue Essence" => "Blue-Essence",
                "Apple Maps-esque" => "Apple-Maps-esque",
            ),
            "group" => __("Map Style", 'medicare'),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textfield",
            "heading" => __('Zoom', 'medicare'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => __('zoom level of map, default is 13', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Width', 'medicare'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => __('Width of map without pixel, default is auto', 'medicare')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Height', 'medicare'),
            "param_name" => "height",
            "value" => '350px',
            "description" => __('Height of map without pixel, default is 350px', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scroll Wheel', 'medicare'),
            "param_name" => "scrollwheel",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Pan Control', 'medicare'),
            "param_name" => "pancontrol",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('Show or hide Pan control.', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Zoom Control', 'medicare'),
            "param_name" => "zoomcontrol",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('Show or hide Zoom Control.', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scale Control', 'medicare'),
            "param_name" => "scalecontrol",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('Show or hide Scale Control.', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Map Type Control', 'medicare'),
            "param_name" => "maptypecontrol",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('Show or hide Map Type Control.', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Street View Control', 'medicare'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('Show or hide Street View Control.', 'medicare')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Over View Map Control', 'medicare'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                __("Yes, please", 'medicare') => true
            ),
            "group" => __("Controls", 'medicare'),
            "description" => __('Show or hide Over View Map Control.', 'medicare')
        )
    )
));