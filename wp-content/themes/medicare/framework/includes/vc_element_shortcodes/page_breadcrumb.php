<?php
vc_map(array(
	"name" => __("Page Breadcrumb", 'medicare'),
	"base" => "page_breadcrumb",
	"category" => __('Medicare', 'medicare'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Class", 'medicare'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medicare' )
		),
	)
));
