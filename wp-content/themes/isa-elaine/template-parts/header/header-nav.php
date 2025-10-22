

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
                    <?php wp_nav_menu(array( 'menu' => 'Main menu 2-version',
                        'theme_location' => 'main-menu-2',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                        )); ?>
                </div>



                <!-- menu panel -->
                <div id="megaMenuPanelWhyWeExist" class="mega-menu-panel">
                    <?php wp_nav_menu(array( 'menu' => 'Why We Exist',
                        'theme_location' => 'why-we-exist',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>
                <div id="megaMenuPanelUnderstanding" class="mega-menu-panel">
                    <?php wp_nav_menu(array( 'menu' => 'Understanding Childhood Dementia',
                        'theme_location' => 'understanding-childhood-dementia',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelForResearchers" class="mega-menu-panel">
                    <?php wp_nav_menu(array( 'menu' => 'For Researchers',
                        'theme_location' => 'for-researchers',
                        'container' => false,
                        'menu_class' => 'main-menu',
                        'menu_id' => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelTakeAction" class="mega-menu-panel">
                    <?php wp_nav_menu(array( 'menu' => 'Take Action',
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
                    'menu_class'      => 'primary-menu',
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



<div id="mobile-menu">
    <nav class="nav-mobile">
        <div class="navigation-row" style="gap: 0px; display: grid;">
            <div class="navigation-card" style="max-width: 400px; margin-bottom: 10px;">
                <div class="card-image" style="margin: auto; margin-bottom: -5px;">
                        <a href="/#story">
                            <img data-desktop-src="/wp-content/uploads/2025/07/linkbox-03-nobg.svg?ver=1751995384" data-mobile-src="/wp-content/uploads/2025/07/linkbox-m-03-nobg.svg?ver=1751995384" alt="link" class="navigation-link-image" src="/wp-content/uploads/2025/07/linkbox-m-03-nobg.svg?ver=1751995384" style="max-width: 212px;">
                        </a>
                    </div>
                <div class="mobile-container-navigation-menu">
                </div>
                <div class="mobile-container-navigation-menu" style="margin-top: 15px;">
                    <div class="card-text">
                        <p style="font-family: 'iA Writer Duo', sans-serif; line-height: 2; font-size: 14px; letter-spacing: 0px; margin-bottom: 0px;">There is a way to help thousands of children across the world with rare diseases — learn about <a class="read-more-button" href="/#story" style="font-size: 14px; border: 1px solid; text-transform: none; white-space: nowrap; padding: 5px 10px 5px 10px;">Isa's Story</a></p>
                    </div>
                </div>
            </div>
            <div class="navigation-card" style="max-width: 400px; margin-bottom: 10px;">
                <div class="card-image" style="margin: auto; margin-bottom: -5px;">
                        <a href="/there-is-a-link">
                            <img data-desktop-src="/wp-content/uploads/2025/07/linkbox-01-nobg.svg?ver=1751995384" data-mobile-src="/wp-content/uploads/2025/07/linkbox-m-01-nobg.svg?ver=1751995384" alt="link" class="navigation-link-image" src="/wp-content/uploads/2025/07/linkbox-m-01-nobg.svg?ver=1751995384" style="max-width: 212px;display:none;">
                        </a>
                </div>
                <div class="mobile-container-navigation-menu">
                </div>
                <div class="mobile-container-navigation-menu" style="margin-top: 15px;">
                    <div class="card-text">
                        <p style="font-family: 'iA Writer Duo', sans-serif; line-height: 2; font-size: 14px; letter-spacing: 0px; margin-bottom: 0px;">There is a link between BPAN and Parkison's/Alzheimer's. Understanding <a class="read-more-button" href="/there-is-a-link" style="font-size: 14px; border: 1px solid; text-transform: none; white-space: nowrap; padding: 5px 10px 5px 10px;">the science</a> behind Isa's condition is key.</p>
                    </div>
                </div>
            </div>
            <div class="navigation-card" style="max-width: 400px; margin-bottom: 10px;">
                <div class="card-image" style="margin: auto; margin-bottom: -5px;">
                    <a href="/there-is-a-plan">
                        <img data-desktop-src="/wp-content/uploads/2025/07/linkbox-02-nobg.svg?ver=1751995384" data-mobile-src="/wp-content/uploads/2025/07/linkbox-m-02-nobg.svg?ver=1751995384" alt="link" class="navigation-link-image" src="/wp-content/uploads/2025/07/linkbox-m-02-nobg.svg?ver=1751995384" style="max-width: 212px; display:none;">
                    </a>
                </div>    
                <div class="mobile-container-navigation-menu">
                </div>
                <div class="mobile-container-navigation-menu" style="margin-top: 15px;">
                    <div class="card-text">
                        <p style="font-family: 'iA Writer Duo', sans-serif; line-height: 2; font-size: 14px; letter-spacing: 0px; margin-bottom: 0px;">There is a plan underway to urgently study young BPAN patients. <a class="read-more-button" href="/there-is-a-plan" style="font-size: 14px; border: 1px solid; text-transform: none; white-space: nowrap; padding: 5px 10px 5px 10px;">Join us</a> A team of minds to develop a treatment.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        wp_nav_menu(array(
            'menu' => 'Mobile menu part 1',
            'theme_location' => 'mobile-menu-1',
            'container' => false,
            'menu_class' => 'mobile-menu-1',
        ));
        ?>
        <?php
        wp_nav_menu(array(
            'menu' => 'Mobile menu part 2',
            'theme_location' => 'mobile-menu-2',
            'container' => false,
            'menu_class' => 'mobile-menu-2',
        ));
        ?>
    </nav>
</div>








<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupMegaMenu(toggleSelector, panelSelector) {
            const toggle = document.querySelector(toggleSelector);
            const panel = document.querySelector(panelSelector);
            if (!toggle || !panel) return;

            let isHovering = false;

            [toggle, panel].forEach(el => {
                el.addEventListener('mouseenter', () => {
                    isHovering = true;
                    panel.classList.add('open');
                    toggle.classList.add('open'); // add class to show blue square
                });

                el.addEventListener('mouseleave', () => {
                    isHovering = false;
                    setTimeout(() => {
                        if (!isHovering) {
                            panel.classList.remove('open');
                            toggle.classList.remove('open');
                        }
                    }, 100);
                });
            });

            window.addEventListener('scroll', () => {
                panel.classList.remove('open');
                toggle.classList.remove('open');
            });

            document.addEventListener('click', (e) => {
                if (!panel.contains(e.target) && e.target !== toggle) {
                    panel.classList.remove('open');
                    toggle.classList.remove('open');
                }
            });
        }



        // Example: Call setup for different menus

        setupMegaMenu('#megaMenuToggleWhyWeExist', '#megaMenuPanelWhyWeExist');
        setupMegaMenu('#megaMenuToggleUnderstanding', '#megaMenuPanelUnderstanding');
        setupMegaMenu('#megaMenuToggleForResearchers', '#megaMenuPanelForResearchers');

        setupMegaMenu('#megaMenuToggleTakeAction', '#megaMenuPanelTakeAction');


    });
</script>











<style>

    /* -------------------------------------- HEADER -------------------------------------- */
    nav {
        /*  position: relative; */
          top: -5px;
          bottom: auto;
      }

      .header-nav {
          position: relative;
      }

      .header-nav nav > ul {
          display: flex;
          align-items: center;
          flex-wrap: wrap;
          justify-content: flex-end;
      }

      .header-nav li {
          color: #000000 !important;
          border-radius: 50px;
          margin: 5px;
          font-size: 12px !important;
      }

    /* Target only top-level <li> inside your mega menu */
    #megaMenuPanel > ul > li > a ,
    #megaMenuPanelWhyWeExist > ul > li > a,
    #megaMenuPanelUnderstanding > ul > li > a,
    #megaMenuPanelForResearchers > ul > li > a,
    #megaMenuPanelTakeAction > ul > li > a{
        font-family: iA Writer Duo, sans-serif;
        font-size: 17px;
        font-weight: bold;
        text-transform: capitalize;
         /* disable clicking    pointer-events: none; */
        text-decoration: none;
        cursor: pointer;
    }
    /* Add spacing between top-level items */
    #megaMenuPanel > ul > li,
    #megaMenuPanelWhyWeExist > ul > li,
    #megaMenuPanelUnderstanding > ul > li,
    #megaMenuPanelForResearchers > ul > li,
    #megaMenuPanelTakeAction > ul > li {
        margin-right: 40px;
    }
    /* Turn top-level items into column headers */
    #megaMenuPanel > ul > li,
    #megaMenuPanelWhyWeExist > ul > li,
    #megaMenuPanelUnderstanding > ul > li,
    #megaMenuPanelForResearchers > ul > li,
    #megaMenuPanelTakeAction > ul > li{
        flex: 1;
        min-width: 200px;

        max-width: 200px;
    }

    #megaMenuPanel > ul > li > ul > li.menu-item-has-children > a,
    #megaMenuPanelWhyWeExist > ul > li > ul > li.menu-item-has-children > a,
    #megaMenuPanelUnderstanding > ul > li > ul > li.menu-item-has-children > a,
    #megaMenuPanelForResearchers > ul > li > ul > li.menu-item-has-children > a,
    #megaMenuPanelTakeAction > ul > li > ul > li.menu-item-has-children > a  {
        font-family: iA Writer Duo, sans-serif;
        font-size: 14px;
        font-weight: bold;
        text-transform: capitalize;
             /* disable clicking pointer-events: none;*/
        text-decoration: none;
        cursor: pointer;

    }





      .header-nav nav > ul > li:not(.btn) > a {
          color: #000000;
          font-family: "iA Writer Duo", sans-serif;
          font-stretch: normal;
          font-size: 15px;
          font-weight: 400;

          line-height: 1.5;
          padding: 0 0;
          height: 28px;
          display: flex;
          align-items: center;
          /*text-shadow: 3px 3px 3px rgba(52, 38, 89, 0.42);*/
    }

    /*
    .header-nav li:hover{
        background-color: #0867E8 !important;
    }
    .header-nav li:hover a {
        color: white !important;
    }
        */

    .header-nav.light-mode.sticky-bg nav > ul > li:not(.btn) > a {
        color: #0867E8;
        text-shadow: 3px 3px 3px rgba(186, 186, 186, 0.41);
    }


    .header-nav nav > ul > li:not(.btn) > a:hover {
        /* text-shadow: 3px 3px 3px rgba(52, 38, 89, 0.42);*/
        color: white;

    }

    .header-nav nav > ul > li.btn {
        margin-left: 10px;
    }

    .header-nav {
        position: absolute;
        top: 0;
        background-color: rgb(255, 255, 255); /* Или любой другой цвет фона */
        z-index: 1000;
        width: 100%;
    }

    .sticky {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        transition: background-color 0.3s ease-in-out;
    }

    .sticky-bg {
        backdrop-filter: blur(10px);
        background-color: rgb(255, 255, 255) /* Apply background only after 700px scroll */
    }

    .sticky-bg.light-mode {
        background-color: rgba(255, 255, 255, 0.42) /* Apply background only after 700px scroll */
    }








    .nav-header {
        display: flex;
        flex-direction: row;
        align-items: center;
        flex-wrap: wrap;
    }


    .header-logo img {
        max-width: 120px; /* set your max size here */
        height: auto;
        width: 100%; /* ensures responsiveness within the max width */
        display: block;
        object-fit: contain; /* keeps the aspect ratio */
        min-width: 40px;
    !important;
    }

    /* CSS */
    #mobile-menu-toggle {
        cursor: pointer;
        font-weight: 600;
        font-size: 17px;
        color: #0e0e0e;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        user-select: none;
        text-decoration: none;
        font-family: "iA Writer Duo", sans-serif;
        justify-content: center;
    }

    #mobile-menu-toggle .arrow-sub-menu {
        display: inline-block;
        transition: transform 0.3s ease-in-out;
        font-size: 18px;

    }

   .submenu-toggle{
        border: none !important;
        background: none !important;
        color: #0867E8;
    }

   .open-menu {
       transform: rotate(90deg);
   }

    #mobile-menu-toggle.opened .arrow-sub-menu {
        transform: rotate(90deg);
    }

    #mobile-menu-toggle .close-icon {
        color: #0e0e0e;
        cursor: pointer;
        font-weight: 600;
        font-size: 20px;

        display: inline-flex;
        align-items: center;
        gap: 6px;
        user-select: none;
        text-decoration: none;
        font-family: "iA Writer Duo", sans-serif;
    }

    /*
    .menu-contact li{
        padding: 22px 20px!important;
    }
    */



    /* mobile menu */


    .nav-mobile {
        font-family: "iA Writer Duo", sans-serif;
        padding-top: 12px;
    }

    .mobile-menu-2 {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px 30px;
        max-width: 350px;
        margin: 0 auto;
        padding: 0;
        list-style: none;
    }

    .mobile-menu-2 a{
        font-size: 14px;
        color: grey !important;
    }

    #menu-mobile-menu-part-2 {
        margin: 0 auto !important;
    }

    /*
    #mobile-menu > nav {
        padding: 30px 0;
    }
    */

    #mobile-menu > nav > div > a {

        padding: 13px 0 15px;
        display: block;

    }

    #mobile-menu > nav li.btn a {
        color: white;
        margin-top: 30px;
    }

    #mobile-menu > nav > ul:not(.social) {
        text-align: center;
        margin: 40px 0 60px 0;
        padding: 0;
        list-style: none;
    }

    /* Flex column on first menu */
    #mobile-menu .mobile-menu-1 {
        display: flex;
        flex-direction: column;
        align-items: center; /* aligns items to right */
        gap: 1px;
    }

    /* Borders on li */
    /*
    #mobile-menu .mobile-menu-1 > li:not(.btn) {
        outline: 1px solid black;
    }
    */

    /* Extra margin below first item */
    #mobile-menu .mobile-menu-1 > li:first-child {
       /*margin-bottom: 40px;*/
        width: 350px;
        padding-top: 10px;
        padding-bottom: 14px;
    }

    /* Link styling */
    #mobile-menu .mobile-menu-1 > li:not(.btn) > a {
        display: block;
        /*padding: 10px 15px;
        font-size: 16px !important;*/
        font-family: "iA Writer Duo", sans-serif;
        text-decoration: none;
        color: #000;
        text-transform: none;
        font-size: 20px;
    }

    /* Hover effect */
    #mobile-menu .mobile-menu-1 > li:not(.btn):hover {

    }

    /* Submenu */
    #mobile-menu > nav > ul > li > .sub-menu {
        background-color: #fff;
        padding: 20px 0;
        display: none;
    }

    #mobile-menu > nav > ul > li > .sub-menu > li:not(:last-child) {
        margin-bottom: 20px;
    }

    #mobile-menu > nav > ul > li > .sub-menu > li > a {
        color: #005387;
        font-size: 24px !important;
        font-family: "iA Writer Duo", sans-serif;
        text-transform: uppercase;
        font-weight: 700;
        display: block;
    }

    /*from navigation button */
    .menu-item-1175, .menu-item-1150, .menu-item-1151, .menu-item-906, .menu-item-1180, .menu-item-1130, .menu-item-1136, .menu-item-1128 {
        font-family: "iA Writer Duo", sans-serif;
        background-color: transparent;
        border: 1px solid #0867E8 !important;
        border-radius: 50px;
        padding: 2px 18px;
        cursor: pointer;
        margin: 5px;
        font-size: 14px !important;
    }

    .menu-item-906, .menu-item-1128 {
        border: 1px solid #CDB78D !important;
        background-color: #CDB78D !important;
        color: #000000 !important;

    }


    .give-today-footer-item a{
        font-family: "iA Writer Duo", sans-serif;
        font-stretch: normal;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.5;
        padding: 0 0;
        height: 28px;
        display: flex !important;
        align-items: center;
    }
    .blue-footer-item {
        font-family: "iA Writer Duo", sans-serif;
        background-color: transparent;
        border: 1px solid #0867E8 !important;
        border-radius: 50px;

        cursor: pointer;
        margin: 5px;
        text-transform: uppercase;
        font-size: 14px !important;
        padding: 3px 20px 3px 20px;
        line-height: 0.9;
    }


    .blue-footer-item a {
        font-family: "iA Writer Duo", sans-serif;
        font-stretch: normal;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.5;
        padding: 0 0;
        height: 28px;
        display: flex !important;
        align-items: center;
        color: #0867E8 !important;
    }




    .menu-item-1175 a, .menu-item-1150 a, .menu-item-1151 a, .menu-item-1180 a, .menu-item-1130 a, .menu-item-1136 a {
        color: #0867E8 !important;
    }

    .menu-item-906 a, .menu-item-1128 a {
        color: #000000 !important;
    }

    a.menu-item-1175, a.menu-item-1150, a.menu-item-1151, a.menu-item-1180, a.menu-item-1130, a.menu-item-1136 {
        color: #0867E8;
        transition: all 0.3s ease;
    }

    a.menu-item-906, a.menu-item-1128 {
        color: #000000 ;
        transition: all 0.3s ease;
    }

    .menu-item-1175:hover, .menu-item-1150:hover, .menu-item-1151:hover, .menu-item-1180:hover, .menu-item-1130:hover, .menu-item-1136:hover {
        opacity: 0.8;
        background: #6096ef45;
    }

    .menu-item-906:hover, .menu-item-1128:hover {

    }

        .navigation-row {
        display: flex;
        flex-wrap: wrap; /* allow items to wrap */
        justify-content: center; /* center items in row */
        gap: 3rem; /* optional: space between items */

    }

    .navigation-card {
        flex: 0 1 450px; /* flexible: grow/shrink with min width */
        max-width: 450px; /*     prevent items from being too wide */
        display: flex;
        flex-direction: column;
    }


    .card-title {
        font-size: 34px;
        margin-bottom: 15px;
    }

    .card-image {
        /*
        height: -webkit-fill-available;
        */
    }

    .card-image img {
        width: 100%;
        height: auto;
    }

    .card-text {
        font-family: "Bodoni 06", sans-serif;
        font-size: 17px;
        line-height: 1.5;
    }

    .hidden-text {
        display: none;
    }

    .hidden-text.show {
        display: block;
    }

    .read-more-button {
        font-family: "iA Writer Duo", sans-serif;
        background-color: transparent;
        text-align: left;
        width: 190px;
        border: 1px solid #0867E8;
        border-radius: 50px;
        font-size: 15px;
        padding: 3px 20px 3px 20px;
        cursor: pointer;
        margin: 30px 0;
        text-transform: uppercase;
    }

    .read-more-button a {
        color: #0867E8 !important;
    }

    a.read-more-button {
        color: #0867E8;
        transition: all 0.3s ease;
    }

    .read-more-button:hover {
        opacity: 0.8;
        background: #6096ef45;
    }

    .navigation-card a:hover {
       /* color: #0867E8;*/
        transition: all 0.3s ease;
    }

    .mobile-container-navigation {
        padding: 0 0;
    }

    .read-more-box {
        margin-bottom: 90px;
    }

    @media (max-width: 966px) {
        .mobile-container-navigation {
            padding: 0 25px;
        }

        .navigation-card {
            flex: 0 1 100%; /* flexible: grow/shrink with min width */
            max-width: 100%;
           /*   max-width: 500px;     prevent items from being too wide */
        }

        .read-more-button {
            font-size: 16px;

        }

        .card-text p{
            font-size: 15px;
        }

    }

    /* CSS */

    @media (max-width: 966px) {
        .header-logo img {
            max-width: 100px; /* set your max size here */
        }
        .mobile-container-navigation-menu {
            padding: 0 20px;
        }

        #mobile-menu,
        #mobile-menu nav,
        #mobile-menu * {
            transition: none !important;
            animation: none !important;
        }
    }







    /* ------------------- MEGA MENU ------------------- */

    .mega-menu-btn {
        background: none;
        border: none;
        font-size: 16px;
        cursor: none;
        padding: 10px 20px;
        font-weight: bold;
    }

    /* Hidden by default
    .mega-menu-panel {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        width: 100vw;
        background: #fff;
        padding: 40px 60px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        gap: 60px;
        z-index: 1000;
        flex-wrap: wrap;
        box-sizing: border-box;
    }


    .mega-menu-panel.open {
        display: flex;
    }
    */
    /* Mega menu panel base state (hidden) */
    .mega-menu-panel {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        width: 100vw;
        background: #fff;
        padding: 0 0 0 200px; /* no vertical padding when hidden */
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        gap: 100px;
        z-index: 1000;
        flex-wrap: wrap;
        box-sizing: border-box;
        display: flex; /* keep flex but collapse height */
        flex-direction: row;
        transition:
                max-height 0.5s ease,
                opacity 0.4s ease,
                padding 0.4s ease;
    }

    /* When open */
    .mega-menu-panel.open {
        max-height: 800px; /* big enough to fit all content */
        opacity: 1;
        padding: 40px 300px;
    }





    /* Reset default WP menu styles inside mega menu */
    .mega-menu-panel ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;

        flex: 1;
    }

    /* Top-level items become columns */
    .mega-menu-panel > ul > li {
        display: flex;                /* make the column a flex container */
        flex-direction: column;       /* stack items vertically */
        min-width: 180px;             /* column width */
    }

    /* Submenu inside each column */
    .mega-menu-panel ul ul {
        display: flex;                /* remove flex? default is block */
        flex-direction: column;       /* stack subitems vertically */
        margin-top: 8px;
        padding-left: 0;
        list-style: none;
    }

    /* Each submenu item */
    .mega-menu-panel ul ul li {
        margin-bottom: 6px;
    }

    /* Submenu links */
    .mega-menu-panel ul ul li a {
        display: block;               /* ensures they are vertical */
        font-weight: normal;
        padding-left: 0;              /* optional indentation */
    }

    .mega-menu-btn{
        font-family: "iA Writer Duo", sans-serif;
        background-color: transparent;
    /*  border: 1px solid #0867E8 !important; */
    /* border-radius: 50px;*/
    /* color: #0867E8;*/
    cursor: pointer;
    margin: 5px;

    font-stretch: normal;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.5;
    padding: 0 0;
    height: 28px;
    display: flex;
    align-items: center;
    padding: 23px 10px;
}




    .mega-menu-btn::before {
        content: "";
        display: inline-block;
        width: 6px;
        height: 6px;
        background-color: #0867E8;
        margin-right: 6px;
        border-radius: 1px; /* optional */
        flex-shrink: 0;
        opacity: 0; /* hidden by default */
        transition: opacity 0.2s ease;
        vertical-align: middle;
    }

    .mega-menu-btn.open::before {
        opacity: 1; /* show when menu is open */
    }

    /* Add before element for header + mega menu links, but NOT primary-menu */
    .header-nav nav > ul > li:not(.btn):not(.primary-menu li) > a::before,
    .mega-menu-panel ul ul li a::before {
        content: "";
        display: inline-block;
        width: 6px;
        height: 6px;
        background-color: #0867E8;
        margin-right: 6px;
        border-radius: 1px;
        flex-shrink: 0;
        opacity: 0;
        transition: opacity 0.2s ease;
        vertical-align: middle;
    }

    /* Show on hover */
    .header-nav nav > ul > li:not(.btn) > a:hover::before,
    .mega-menu-panel ul ul li a:hover::before {
        opacity: 1;
    }


</style>

