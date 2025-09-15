<?php
vc_map(array(
	"name" => __("Page Title Bar", 'medicare'),
	"base" => "page_title_bar",
	"category" => __('Medicare', 'medicare'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'medicare'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Please, enter title in this element.", 'medicare')
		),
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Description", 'medicare'),
			"param_name" => "desc",
			"value" => "",
			"description" => __("Please, enter description in this element.", 'medicare')
		),
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
