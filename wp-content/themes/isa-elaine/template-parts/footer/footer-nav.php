<div class="flex footer-nav flex-space-between">
    <div class="footer-col footer-logo">
        <a href="<?php echo home_url() ?>" >
            <img src="<?php echo esc_url(get_field('logo', 'option')); ?>" alt="<?php echo get_bloginfo(); ?>">
        </a>
    </div>
    <!-- /.footer-col -->
    <div id="footer-mobile-menu">
        <nav class="nav-mobile-footer">

            <?php
            wp_nav_menu(array(
                'menu' => 'Mobile menu footer part 1',
                'theme_location' => 'footer-mobile-menu-1',
                'container' => false,
                'menu_class' => 'footer-mobile-menu-1',
            ));
            ?>
            <?php
            wp_nav_menu(array(
                'menu' => 'Mobile menu part 2',
                'theme_location' => 'mobile-menu-2',
                'container' => false,
                'menu_class' => 'mobile-menu-2-footer',
            ));
            ?>
        </nav>
    </div>
    <!-- /.footer-col -->
</div>
<!-- /.flex -->






<style>

    .nav-mobile-footer {
        font-family: "iA Writer Duo", sans-serif;
        padding-top: 12px;
        display: flex;
    }

    .mobile-menu-2-footer {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-evenly;
        gap: 0px 20px;
        max-width: 350px;
        padding: 0;
        list-style: none;
        flex-direction: column;
        align-items: flex-start;
        margin-left: 20px;
    }

    .mobile-menu-2-footer a{
        font-size: 17px;
        color: grey !important;
    }

    #footer-mobile-menu {
        display: flex;
      justify-content: right;
    }
    /* Flex column on first menu */
    #footer-mobile-menu .footer-mobile-menu-1 {
        display: flex;
        flex-direction: column;
        align-items: flex-end; /* aligns items to right */
        gap: 1px;

    }

    #footer-mobile-menu .footer-mobile-menu-1 > li:not(.btn) {

    }
    */

    /* Extra margin below first item */
    #footer-mobile-menu .footer-mobile-menu-1 > li:first-child {
        /*margin-bottom: 40px;*/
        width: 350px;
        padding-top: 10px;
        padding-bottom: 14px;
    }

    /* Link styling */
    #footer-mobile-menu .footer-mobile-menu-1 > li:not(.btn) > a {
        display: block;
        /*padding: 10px 15px;
        font-size: 16px !important;*/
        font-family: "iA Writer Duo", sans-serif;
        text-decoration: none;
        color: #000;
        text-transform: none;
        font-size: 20px;
    }

    @media (max-width: 966px) {
.nav-mobile-footer {
    flex-wrap: wrap;
    flex-direction: column;
    width: 100%;
}

        .mobile-menu-2-footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px 30px;
            max-width: 350px;
            margin: 0 auto;
            padding: 0;
            list-style: none;
            flex-direction: row;
            align-content: center;
            align-items: center;
        }

        .mobile-menu-2-footer a{
            font-size: 14px;
        }

        .footer-mobile-menu-1 {
            margin-bottom: 60px;
        }
    }


</style>