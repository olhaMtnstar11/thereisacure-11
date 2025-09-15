<?php
vc_map ( array (
		"name" => 'Doctor',
		"base" => "doctor",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'Medicare', 'medicare' ), 
		'admin_enqueue_js' => array(URI_PATH_FR.'/admin/assets/js/customvc.js'),
		"params" => array (
					array (
							"type" => "tb_taxonomy",
							"taxonomy" => "doctor_department",
							"heading" => __ ( "Categories", 'medicare' ),
							"param_name" => "category",
							"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'medicare' )
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Count', 'medicare' ),
							"param_name" => "posts_per_page",
							'value' => '',
							"description" => __ ( 'The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'medicare' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order by', 'medicare' ),
							"param_name" => "orderby",
							"value" => array (
									"None" => "none",
									"Title" => "title",
									"Date" => "date",
									"ID" => "ID"
							),
							"description" => __ ( 'Order by ("none", "title", "date", "ID").', 'medicare' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order', 'medicare' ),
							"param_name" => "order",
							"value" => Array (
									"None" => "none",
									"ASC" => "ASC",
									"DESC" => "DESC"
							),
							"description" => __ ( 'Order ("None", "Asc", "Desc").', 'medicare' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Extra Class", 'medicare'),
						"param_name" => "el_class",
						"value" => "",
						"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medicare' )
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Image", 'medicare'),
						"param_name" => "show_image",
						"value" => array (
							__ ( "Yes, please", 'medicare' ) => true
						),
						"group" => __("Template", 'medicare'),
						"description" => __("Show or not featured image of post in this element.", 'medicare')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Ttile", 'medicare'),
						"param_name" => "show_title",
						"value" => array (
							__ ( "Yes, please", 'medicare' ) => true
						),
						"group" => __("Template", 'medicare'),
						"description" => __("Show or not title of post in this element.", 'medicare')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Excerpt", 'medicare'),
						"param_name" => "show_excerpt",
						"value" => array (
							__ ( "Yes, please", 'medicare' ) => true
						),
						"group" => __("Template", 'medicare'),
						"description" => __("Show or not excerpt of post in this element.", 'medicare')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Meta", 'medicare'),
						"param_name" => "show_meta",
						"value" => array (
							__ ( "Yes, please", 'medicare' ) => true
						),
						"group" => __("Template", 'medicare'),
						"description" => __("Show or not meta of post in this element.", 'medicare')
					),
		)
));