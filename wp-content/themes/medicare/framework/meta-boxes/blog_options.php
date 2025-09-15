<div id="tb-blog-metabox" class='tb_metabox' style="display: none;">
	<div id="tb-tab-blog" class='categorydiv'>
		<ul class='category-tabs'>
		   <li class='tb-tab'><a href="#tabs-general"><i class="dashicons dashicons-admin-settings"></i> <?php echo _e('GENERAL','medicare');?></a></li>
		</ul>
		<div class='tb-tabs-panel'>
			<div id="tabs-general">
				<p class="tb_header tb-title-mb"><i class="dashicons dashicons-menu"></i><?php echo _e('Header Setting','medicare'); ?></p>
				<?php
					$headers = array('global' => 'Global', 'header-v1' => 'Header V1','header-v2' => 'Header V2');
					$this->select('header',
							'Header',
							$headers,
							'',
							''
					);
				?>
			</div>
		</div>
	</div>
</div>