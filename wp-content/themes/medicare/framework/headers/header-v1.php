<?php
	global $tb_options;
	$cl_stick = isset($tb_options['tb_stick_header']) && $tb_options['tb_stick_header'] ? 'ro-header-stick': '';
     $manage_location = "";
    if(has_nav_menu( 'main_navigation' )) {
      $manage_location = isset($tb_options['tb_manage_location']) && $tb_options['tb_manage_location'] ? $tb_options['tb_manage_location'] : 'main_navigation';
    }
?>
<!-- Start Header -->
<header>
	<div class="ro-header-v1 <?php echo esc_attr($cl_stick); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a class="ro-logo" href="<?php echo esc_url(home_url()); ?>">
						<?php ro_theme_logo(); ?>
					</a>
                    <?php if (!empty($manage_location)) : ?>
					<div id="ro-hamburger" class="ro-hamburger visible-xs visible-sm"><i class="icon icon-menu"></i></div>
                    <?php endif; ?>
				</div>
				<div class="col-md-9">
					<?php
					
                   
                    
					$arr = array(
						'theme_location' => $manage_location,
						'menu_id' => 'nav',
						'menu' => '',
						'container_class' => 'ro-menu-list ro-menu-sidebar-active hidden-xs hidden-sm',
						'menu_class'      => 'text-right',
						'echo'            => true,
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
					);
					if (!empty($manage_location)) {
						wp_nav_menu( $arr );
					} else{
                            echo "<a href='".esc_url(  admin_url('/nav-menus.php') )."' class='add_menu'>".esc_html("Add Menu" , "medicare")."</a>";
                    } ?>
					
					<div class="ro-menu-sidebar hidden-xs hidden-sm">
						<?php
							if (is_active_sidebar("tbtheme-search-on-menu-sidebar")) echo '<a id="ro-search-form" href="javascript:void(0)"><i class="icon icon-search"></i></a>';
							if (is_active_sidebar("tbtheme-menu-canvas-sidebar")) echo '<a id="ro-canvas-menu" href="javascript:void(0)"><i class="icon icon-menu"></i></a>';
						?>
					</div>
				</div>
				<?php
					if (is_active_sidebar("tbtheme-search-on-menu-sidebar")) {
						echo '<div id="ro-search-form-popup" class="ro-search-form hidden-xs hidden-sm">';
							dynamic_sidebar("Search On Menu Sidebar"); 
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</header>
<!-- End Header -->