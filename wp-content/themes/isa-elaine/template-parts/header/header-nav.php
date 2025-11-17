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

<div id="overlay" aria-hidden="true"></div>
<!-- /#overlay -->

<div class="header-nav">
    <div class="container container-second container-header">
        <div class="flex flex-align-center flex-space-between">

            <a href="<?php echo home_url(); ?>" class="header-logo">
                <img class="p-3"
                     src="<?php echo esc_url(get_field('logo', 'option')); ?>"
                     alt="<?php echo esc_attr(get_bloginfo()); ?>">
            </a>

            <nav class="nav-header" aria-label="Main navigation">

                <!-- menu buttons -->

                <button id="megaMenuToggleWhyWeExist"
                        class="mega-menu-btn"
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="megaMenuPanelWhyWeExist">
                    Why We Exist
                </button>

                <button id="megaMenuToggleUnderstanding"
                        class="mega-menu-btn"
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="megaMenuPanelUnderstanding">
                    Understanding Childhood Dementia
                </button>

                <button id="megaMenuToggleForResearchers"
                        class="mega-menu-btn"
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="megaMenuPanelForResearchers">
                    For Researchers
                </button>

 

                <!-- ----- -->

                <div id="megaMenuPanel"
                     class="mega-menu-panel"
                     role="region"
                     aria-hidden="true">
                    <?php if (!empty($img_1)): ?>
                        <div class="header-menu-pic">
                            <img src="<?php echo $img_1; ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <?php wp_nav_menu(array(
                        'menu'           => 'Main menu 2-version',
                        'theme_location' => 'main-menu-2',
                        'container'      => false,
                        'menu_class'     => 'main-menu',
                        'menu_id'        => 'main-mega-menu',
                    )); ?>
                </div>

                <!-- menu panel -->
                <div id="megaMenuPanelWhyWeExist"
                     class="mega-menu-panel"
                     role="region"
                     aria-labelledby="megaMenuToggleWhyWeExist"
                     aria-hidden="true">

                    <?php if (!empty($img_1)): ?>
                        <div class="header-menu-pic">
                            <img src="<?php echo $img_1; ?>" alt="">
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu(array(
                        'menu'           => 'Why We Exist',
                        'theme_location' => 'why-we-exist',
                        'container'      => false,
                        'menu_class'     => 'main-menu',
                        'menu_id'        => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelUnderstanding"
                     class="mega-menu-panel"
                     role="region"
                     aria-labelledby="megaMenuToggleUnderstanding"
                     aria-hidden="true">

                    <?php if (!empty($img_2)): ?>
                        <div class="header-menu-pic">
                            <img src="<?php echo $img_2; ?>" alt="">
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu(array(
                        'menu'           => 'Understanding Childhood Dementia',
                        'theme_location' => 'understanding-childhood-dementia',
                        'container'      => false,
                        'menu_class'     => 'main-menu',
                        'menu_id'        => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelForResearchers"
                     class="mega-menu-panel"
                     role="region"
                     aria-labelledby="megaMenuToggleForResearchers"
                     aria-hidden="true">

                    <?php if (!empty($img_3)): ?>
                        <div class="header-menu-pic">
                            <img src="<?php echo $img_3; ?>" alt="">
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu(array(
                        'menu'           => 'For Researchers',
                        'theme_location' => 'for-researchers',
                        'container'      => false,
                        'menu_class'     => 'main-menu',
                        'menu_id'        => 'main-mega-menu',
                    )); ?>
                </div>

                <div id="megaMenuPanelTakeAction"
                     class="mega-menu-panel"
                     role="region"
                     aria-labelledby="megaMenuToggleTakeAction"
                     aria-hidden="true">

                    <?php if (!empty($img_4)): ?>
                        <div class="header-menu-pic">
                            <img src="<?php echo $img_4; ?>" alt="">
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu(array(
                        'menu'           => 'Take Action',
                        'theme_location' => 'take-action',
                        'container'      => false,
                        'menu_class'     => 'main-menu',
                        'menu_id'        => 'main-mega-menu',
                    )); ?>
                </div>
                <!-- ------- -->

                <?php
                wp_nav_menu(array(
                    'menu'           => 'Contact',
                    'theme_location' => 'secondary-menu',
                    'container'      => false,
                    'menu_class'     => 'primary-menu',
                ));
                ?>

            </nav>

            <div class="header-nav-right">
                <a href="#"
                   id="mobile-menu-toggle"
                   aria-expanded="false"
                   aria-controls="mobile-menu"
                   role="button">
                    menu <span class="arrow-sub-menu"> </span>
                </a>
            </div>
            <!-- /.header-nav-right -->

        </div>
    </div>
    <!-- /.container -->
</div>

<div id="mobile-menu" style="z-index: 1000" aria-hidden="true">
    <nav class="nav-mobile" aria-label="Mobile navigation">
        <?php
        // Combine your key menus into one mobile accordion menu
        wp_nav_menu(array(
            'menu'           => 'mobile menu',
            'theme_location' => 'mobile_menu',
            'container'      => false,
            'menu_class'     => 'mobile-menu-list',
            'menu_id'        => 'mobile-menu-list',
        ));
        ?>
    </nav>
</div>

<script>
// ARIA sync helper: assumes your existing JS/CSS toggles .open and visibility.
// Does not change classes or styles; only updates ARIA + adds keyboard support.
document.addEventListener('DOMContentLoaded', function () {
    var overlay = document.getElementById('overlay');

    function setOverlayHidden(hidden) {
        if (!overlay) return;
        overlay.setAttribute('aria-hidden', hidden ? 'true' : 'false');
    }

    function syncToggleAndPanel(toggle) {
        var controls = toggle.getAttribute('aria-controls');
        if (!controls) return;

        var panel = document.getElementById(controls);
        if (!panel) return;

        // Treat presence of .open on the toggle as source of truth
        var isOpen = toggle.classList.contains('open');
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');

        // Overlay is "visible" in accessibility when any mega menu is open
        var anyOpen = Array.prototype.some.call(
            document.querySelectorAll('.mega-menu-btn'),
            function (btn) { return btn.classList.contains('open'); }
        );
        setOverlayHidden(!anyOpen);
    }

    // For each mega menu toggle, observe class changes and support keyboard
    var megaToggles = document.querySelectorAll('.mega-menu-btn');
    megaToggles.forEach(function (toggle) {
        // Initial sync (in case something starts open)
        syncToggleAndPanel(toggle);

        // Allow Enter/Space to trigger the existing click behavior
        toggle.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggle.click();
            }
        });

        // Watch for .open being toggled by your existing JS
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (m) {
                if (m.attributeName === 'class') {
                    syncToggleAndPanel(toggle);
                }
            });
        });
        observer.observe(toggle, { attributes: true });
    });

    // ESC closes all mega panels (visually via .open + ARIA sync)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            megaToggles.forEach(function (toggle) {
                if (toggle.classList.contains('open')) {
                    toggle.classList.remove('open');
                }
                syncToggleAndPanel(toggle);
            });
        }
    });

    // Clicking overlay closes all mega menus
    if (overlay) {
        overlay.addEventListener('click', function () {
            megaToggles.forEach(function (toggle) {
                if (toggle.classList.contains('open')) {
                    toggle.classList.remove('open');
                }
                syncToggleAndPanel(toggle);
            });
        });
    }

    // Mobile menu ARIA sync
    var mobileToggle = document.getElementById('mobile-menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');

    if (mobileToggle && mobileMenu) {
        function syncMobile() {
            var isVisible =
                window.getComputedStyle(mobileMenu).display !== 'none' &&
                mobileMenu.offsetParent !== null;
            mobileToggle.setAttribute('aria-expanded', isVisible ? 'true' : 'false');
            mobileMenu.setAttribute('aria-hidden', isVisible ? 'false' : 'true');
        }

        // After your existing JS runs on click, sync ARIA
        mobileToggle.addEventListener('click', function (e) {
            // don't block existing handlers
            setTimeout(syncMobile, 0);
        });

        // Keyboard trigger for mobile toggle
        mobileToggle.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                mobileToggle.click();
            }
        });

        // Initial state
        syncMobile();
    }
});
</script>
