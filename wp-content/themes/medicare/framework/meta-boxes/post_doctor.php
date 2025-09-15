<div id="tb_doctor_metabox" class='tb-doctor-metabox'>
	<?php
	$this->text('doctor_major',
			'Major',
			'',
			__('Enter major in this post.','medicare')
	);
	$this->text('doctor_phone',
			'Phone',
			'',
			__('Enter phone in this post.','medicare')
	);
	$this->text('doctor_Email',
			'Email',
			'',
			__('Enter email in this post.','medicare')
	);
	$this->text('doctor_address',
			'Address',
			'',
			__('Enter address in this post.','medicare')
	);
    $this->text('appoitment_link',
			'Appointment Link',
			'',
			__('Enter appointment link in this post.','medicare')
	);
	$this->upload('doctor_extra_img', 
			'Extra Image',
			__('Choose extra image in this post.','medicare')
			);
	$this->text('doctor_icon',
			'Icon',
			'',
			__('Enter class icon in this post.','medicare')
	);
	$this->textarea('doctor_quotes',
			'Quotes',
			'',
			__('Enter quotes in this post.','medicare')
	);
	$this->textarea('doctor_testimonials',
			'Testimonials Shortcode',
			'',
			__('Enter testimonials shortcode in this post.','medicare')
	);
	?>
</div>
