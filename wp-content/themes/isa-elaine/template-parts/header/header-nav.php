<?php
$header_pictures = get_field('header_menu_pictures', 'option'); // get repeater from Theme Settings

if ($header_pictures) {
    $counter = 1; // Initialize counter outside the loop

    foreach ($header_pictures as $picture) {
        if (!empty($picture['image'])) {
            // create dynamic variable name
            ${'img_' . $counter} = esc_url($picture['image']);
            $counter++;
        }
    }
}
?>

<div id="overlay"></div>
<!-- /#overlay -->
<div class="header-nav">
    <div class="container container-second container-header">
        <div class="flex flex-align-center flex-space-between">
            <a href="<?php echo home_url() ?>" class="header-logo">
                <img class="p-3" src="<?php echo esc_url(get_field('logo', 'option')); ?>"
                     alt="<?php echo get_bloginfo(); ?>">
            </a>

            <nav class="nav-header">


                <!-- menu buttons -->

                <button id="megaMenuToggleWhyWeExist" class="mega-menu-btn">
                    Why We Exist
                </button>

                <button id="megaMenuToggleUnderstanding" class="mega-menu-btn">
                    Understanding Childhood Dementia
                </button>

                <button id="megaMenuToggleForResearchers" class="mega-menu-btn">
                    For Researchers
                </button>

                <button id="megaMenuToggleTakeAction" class="mega-menu-btn">
                    Take Action
                </button>

                <!-- ----- -->


                <div id="megaMenuPanel" class="mega-menu-panel">
                    <?php if (!empty($img_1)): ?>
                        <div class="header-menu-pic">
                            <img class=""
                                 src="<?php echo $img_1; ?>"
                                 alt="Header">
                        </div>
                    <?php endif; ?>
                    <?php wp_nav_menu(array('menu' => 'Main menu 2-version',
                        'theme_location' => 'main-menu-2',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>


                <!-- menu panel -->
                <div id="megaMenuPanelWhyWeExist" class="mega-menu-panel">

                    <?php if (!empty($img_1)): ?>
                        <div class="header-menu-pic">
                            <img class=""
                                 src="<?php echo $img_1; ?>"
                                 alt="Header">
                        </div>
                    <?php endif; ?>
                    <?php wp_nav_menu(array('menu' => 'Why We Exist',
                        'theme_location' => 'why-we-exist',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>
                <div id="megaMenuPanelUnderstanding" class="mega-menu-panel">


                    <?php if (!empty($img_2)): ?>
                        <div class="header-menu-pic">
                            <img class=""
                                 src="<?php echo $img_2; ?>"
                                 alt="Header">
                        </div>
                    <?php endif; ?>



                    <?php wp_nav_menu(array('menu' => 'Understanding Childhood Dementia',
                        'theme_location' => 'understanding-childhood-dementia',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelForResearchers" class="mega-menu-panel">
                    <?php if (!empty($img_3)): ?>
                        <div class="header-menu-pic">
                            <img class=""
                                 src="<?php echo $img_3 ?>"
                                 alt="Header">
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu(array('menu' => 'For Researchers',
                        'theme_location' => 'for-researchers',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelTakeAction" class="mega-menu-panel">
                    <?php if (!empty($img_4)): ?>
                        <div class="header-menu-pic">
                            <img class=""
                                 src="<?php echo $img_4; ?>"
                                 alt="Header">
                        </div>
                    <?php endif; ?>
                    <?php wp_nav_menu(array('menu' => 'Take Action',
                        'theme_location' => 'take-action',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>
                <!-- ------- -->


                <?php
                wp_nav_menu(array(
                    'menu' => 'Contact',
                    'theme_location' => 'secondary-menu',
                    'container' => false,
                    'menu_class' => 'primary-menu',
                ));
                ?>

            </nav>
            <div class="header-nav-right">


                <!--                <a href="<?php echo esc_url(get_field('donate_link', 'option')); ?>" class="btn" id="header-mobile-donate">Donate</a> -->


                <a href="#" id="mobile-menu-toggle" aria-expanded="false">
                    menu <span class="arrow-sub-menu"> </span>
                </a>


            </div>
            <!-- /.header-nav-right -->
        </div>
    </div>
    <!-- /.container -->
</div>


<div id="mobile-menu" style="z-index: 1000">
    <nav class="nav-mobile">
        <?php
        // Combine your key menus into one mobile accordion menu
        wp_nav_menu(array(
            'menu' => 'mobile menu', // or your main desktop menu name
            'theme_location' => 'mobile_menu',
            'container' => false,
            'menu_class' => 'mobile-menu-list',
            'menu_id' => 'mobile-menu-list',
        ));
        ?>
    </nav>
</div>





