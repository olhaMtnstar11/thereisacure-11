<?php
vc_map(array(
	"name" => __("Service Box", 'medicare'),
	"base" => "service_box",
	"category" => __('Medicare', 'medicare'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Template", 'medicare'),
			"param_name" => "tpl",
			"value" => array(
				"Template 1" => "tpl1",
				"Template 2" => "tpl2",
				"Template 3" => "tpl3",
			),
			"description" => __('Select template in this element.', 'medicare')
		),
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Image", 'medicare'),
			"param_name" => "img",
			"value" => "",
			"dependency" => array(
				"element"=>"tpl",
				"value"=> array("tpl2", "tpl3")
			),
			"description" => __("Select image in this element.", 'medicare')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon", 'medicare'),
			"param_name" => "icon",
			"value" => "",
			"dependency" => array(
				"element"=>"tpl",
				"value"=> array("tpl1", "tpl2")
			),
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
			"heading" => __("Description", 'medicare'),
			"param_name" => "content",
			"value" => "",
			"dependency" => array(
				"element"=>"tpl",
				"value"=> array("tpl1", "tpl3")
			),
			"description" => __("Please, enter description in this element.", 'medicare')
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
