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



            <!-- /.header-nav-right -->

        </div>
    </div>
    <!-- /.container -->
</div>




<aside class="sidebar">
    <div class="sidebar-inner">


        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary_menu',
            'container' => false,
            'menu_class' => 'menu-right-primary',
        ));
        ?>


    </div>
</aside>


<div class="sidebar-overlay"></div>


<div class="sidebar-buttons">
    <a href="/donate" class="sidebar-donate-btn">Donate</a>

    <div class="menu-toggle js-sidebar-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>


<style>
    /* ------------------------- */
    /* SIDEBAR RIGHT */
    /* ------------------------- */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s ease;
        z-index: 9990;
    }

    .sidebar.open ~ .sidebar-overlay {
        opacity: 1;
        pointer-events: auto;
    }

    .sidebar {
        position: fixed;
        top: 0;
        right: 0;
        width: 280px;
        height: 100%;
        background: #fff;
        border-left: 1px solid #ddd;
        transform: translateX(100%);
        transition: transform .3s ease;
        z-index: 9999;
        padding: 50px 20px;
    }

    .sidebar.open {
        transform: translateX(0);
    }

    /* ------------------------- */
    /* BUTTONS AREA (Donate + Burger) */
    /* ------------------------- */
    .sidebar-buttons {
        position: fixed;
        top: 40px;
        right: 40px;
        display: flex;
        align-items: center;
        gap: 20px;
        z-index: 10000;
        /* move left when sidebar opens */
        transform: translateX(0);
        transition: transform .3s ease;
    }

    .sidebar.open ~ .sidebar-buttons {
        transform: translateX(-280px); /* sidebar width */
    }

    /* ------------------------- */
    /* DONATE BUTTON */
    /* ------------------------- */
    .sidebar-donate-btn {
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: center;
        font-weight: 400;
        height: 35px;
        border: 1px solid #CDB78D !important;
        background-color: #CDB78D !important;
        padding: 2px 18px;
        font-size: 17px !important;
        border-radius: 50px;
        color: #fff;
        text-decoration: none;
    }

    /* ------------------------- */
    /* YOUR BURGER */
    /* ------------------------- */
    .menu-toggle {
        width: 40px;
        height: 32px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
    }

    .menu-toggle span {
        background: black;
        display: block;
        height: 3px;
        border-radius: 2px;
        transition: transform 0.4s ease, opacity 0.4s ease, background 0.4s ease;
    }

    /* HAMBURGER BUTTON */
    .menu-toggle {
        cursor: pointer;
        width: 30px;
        height: 25px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        z-index: 100000;
        position: relative;
        margin-left: 10px;
    }

    /* ANIMATION → X */


    /* When sidebar is open, change to white (close "X") */
    .sidebar.open ~ .sidebar-buttons .menu-toggle span {
        background: #fff;
    }



    .sidebar.open ~ .sidebar-buttons .menu-toggle span:nth-child(1) {
        transform: translateY(14px) rotate(45deg);
    }

    .sidebar.open ~ .sidebar-buttons .menu-toggle span:nth-child(2) {
        opacity: 0;
    }

    .sidebar.open ~ .sidebar-buttons .menu-toggle span:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    /* When menu is opened (X icon), make lines white */
    .menu-toggle.active span {
        background: #fff; /* white X */
    }

    /* When menu is opened, transform hamburger into X */
    .menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(10px, 10px);
        background: #fff; /* X is white */
    }

    .menu-toggle.active span:nth-child(2) {
        opacity: 0; /* hide middle line */
    }

    .menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
        background: #fff; /* X is white */
    }

    /* Optional: add hover effect for better UX */
    .menu-toggle:hover span {
        background: #0867E8; /* slightly darker black on hover */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const sidebar = document.querySelector(".sidebar");
        const toggle = document.querySelector(".js-sidebar-toggle");
        const overlay = document.querySelector(".sidebar-overlay");

        function closeSidebar() {
            sidebar.classList.remove("open");
        }

        // Toggle sidebar
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });

        // Close on overlay click
        overlay.addEventListener("click", closeSidebar);

        // Close on ESC key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                closeSidebar();
            }
        });

        // Close when clicking a menu item
        document.querySelectorAll(".menu-right-primary a").forEach(link => {
            link.addEventListener("click", () => {
                closeSidebar();
            });
        });

    });
</script>


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
                function (btn) {
                    return btn.classList.contains('open');
                }
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
            observer.observe(toggle, {attributes: true});
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


<style>


    .sidebar-inner {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .sidebar-panel {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow-y: auto;
        background: #fff;
        transition: opacity 0.3s ease;
        z-index: 1;
        pointer-events: auto;
        display: none; /* hide by default */
    }

    .sidebar-panel.active {
        display: block; /* show active panel */
        z-index: 10;
        opacity: 1;
    }

    .sidebar-panel.prev {
        display: none; /* hide previous panel */
    }

    .sidebar-back {
        font-size: 14px;
        margin-bottom: 20px;
        cursor: pointer;
        color: #0867E8;
        display: inline-block;
    }
    /* Hide all submenus initially */
    .sidebar-panel ul.sub-menu {

    }


    /* Make all list items in the sidebar show pointer */
    .sidebar-inner li {
        cursor: pointer;
        border-bottom: 1px solid rgba(0, 0, 0, 0.13);
 margin: 20px 0;
    }

    .
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // ---------- Desktop sidebar ----------
        const sidebarRootMenu = document.querySelector(".menu-right-primary");
        const sidebarInner = document.querySelector(".sidebar-inner");
        const sidebarPanelStack = [];

        if (sidebarRootMenu) {
            const firstPanel = createPanel(sidebarRootMenu, true, sidebarPanelStack);
            sidebarInner.innerHTML = "";
            sidebarInner.appendChild(firstPanel);
            firstPanel.classList.add("active");
            sidebarPanelStack.push(firstPanel);
        }

        // ---------- Mobile menu ----------
        const mobileRootMenu = document.querySelector("#mobile-menu .mobile-menu-list");
        const mobileMenuContainer = document.querySelector("#mobile-menu nav");
        const mobilePanelStack = [];

        if (mobileRootMenu && mobileMenuContainer) {
            const firstMobilePanel = createPanel(mobileRootMenu, true, mobilePanelStack);
            mobileMenuContainer.innerHTML = "";
            mobileMenuContainer.appendChild(firstMobilePanel);
            firstMobilePanel.classList.add("active");
            mobilePanelStack.push(firstMobilePanel);
        }

        function createPanel(ul, isRoot = false, stack) {
            const panel = document.createElement("div");
            panel.className = "sidebar-panel";

            // Back button
            if (!isRoot) {
                const backBtn = document.createElement("div");
                backBtn.className = "sidebar-back";
                backBtn.textContent = "← Back";
                backBtn.addEventListener("click", () => slideBack(panel, stack));
                panel.appendChild(backBtn);
            }

            // Create new UL with only top-level items
            const newUL = document.createElement("ul");
            newUL.className = ul.className;

            Array.from(ul.children).forEach(li => {
                const cloneLI = li.cloneNode(false); // only LI
                cloneLI.innerHTML = li.querySelector("a").outerHTML; // only the link

                // If has submenu
                if (li.classList.contains("menu-item-has-children")) {
                    const sub = li.querySelector("ul.sub-menu");
                    cloneLI.querySelector("a").addEventListener("click", (e) => {
                        e.preventDefault();
                        slideForward(sub, panel, stack);
                    });
                }

                newUL.appendChild(cloneLI);
            });

            panel.appendChild(newUL);
            return panel;
        }

        function slideForward(submenu, currentPanel, stack) {
            const nextPanel = createPanel(submenu, false, stack);
            currentPanel.parentNode.appendChild(nextPanel);
            stack.push(nextPanel);

            currentPanel.classList.remove("active");
            currentPanel.classList.add("prev");
            nextPanel.classList.add("active");
        }

        function slideBack(currentPanel, stack) {
            const previousPanel = stack[stack.length - 2];
            currentPanel.classList.remove("active");
            currentPanel.classList.add("prev");
            previousPanel.classList.remove("prev");
            previousPanel.classList.add("active");
            stack.pop();

            setTimeout(() => currentPanel.remove(), 300);
        }
    });
</script>






