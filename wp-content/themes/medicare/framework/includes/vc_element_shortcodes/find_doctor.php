<?php
vc_map ( array (
		"name" => 'Find Doctor',
		"base" => "find_doctor",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'Medicare', 'medicare' ),
		"params" => array (
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Appointment Link", 'medicare'),
						"param_name" => "appoitment_link",
						"value" => "",
						"description" => __ ( "Please, Enter appoitment link.", 'medicare' )
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