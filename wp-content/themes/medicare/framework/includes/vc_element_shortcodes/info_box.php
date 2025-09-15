<?php
vc_map(array(
	"name" => __("Info Box", 'medicare'),
	"base" => "info_box",
	"category" => __('Medicare', 'medicare'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon", 'medicare'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Please, enter class icon in this element.", 'medicare')
		),
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
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'medicare'),
			"param_name" => "content",
			"value" => "",
			"description" => __("Please, enter content in this element.", 'medicare')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Link", 'medicare'),
			"param_name" => "ex_link",
			"value" => "",
			"description" => __("Please, enter extra link in this element.", 'medicare')
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
