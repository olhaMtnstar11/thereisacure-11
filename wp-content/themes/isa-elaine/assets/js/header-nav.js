document.addEventListener('DOMContentLoaded', function () {
    const menus = [
        {toggle: '#megaMenuToggleWhyWeExist', panel: '#megaMenuPanelWhyWeExist'},
        {toggle: '#megaMenuToggleUnderstanding', panel: '#megaMenuPanelUnderstanding'},
        {toggle: '#megaMenuToggleForResearchers', panel: '#megaMenuPanelForResearchers'},
        {toggle: '#megaMenuToggleTakeAction', panel: '#megaMenuPanelTakeAction'},
    ];

    let activePanel = null;
    let hideTimeout = null;

    function openPanel(toggle, panel) {
        clearTimeout(hideTimeout);
        closeAllPanels();
        panel.classList.add('open');
        toggle.classList.add('open');
        activePanel = panel;
    }

    function closeAllPanels() {
        menus.forEach(({toggle, panel}) => {
            const t = document.querySelector(toggle);
            const p = document.querySelector(panel);
            if (t && p) {
                t.classList.remove('open');
                p.classList.remove('open');
            }
        });
        activePanel = null;
    }

    menus.forEach(({toggle, panel}) => {
        const toggleEl = document.querySelector(toggle);
        const panelEl = document.querySelector(panel);
        if (!toggleEl || !panelEl) return;

        // --- Hover behavior (desktop) ---
        toggleEl.addEventListener('mouseenter', () => {
            if (window.matchMedia('(hover: hover)').matches) {
                openPanel(toggleEl, panelEl);
            }
        });

        toggleEl.addEventListener('mouseleave', () => {
            if (window.matchMedia('(hover: hover)').matches) {
                hideTimeout = setTimeout(() => {
                    if (!panelEl.matches(':hover')) closeAllPanels();
                }, 250);
            }
        });

        panelEl.addEventListener('mouseenter', () => {
            if (window.matchMedia('(hover: hover)').matches) {
                clearTimeout(hideTimeout);
            }
        });

        panelEl.addEventListener('mouseleave', () => {
            if (window.matchMedia('(hover: hover)').matches) {
                hideTimeout = setTimeout(() => {
                    if (!toggleEl.matches(':hover')) closeAllPanels();
                }, 250);
            }
        });

        // --- Click behavior (touch devices / mobile) ---
        toggleEl.addEventListener('click', (e) => {
            if (!window.matchMedia('(hover: hover)').matches) {
                e.preventDefault();
                const isOpen = panelEl.classList.contains('open');
                closeAllPanels();
                if (!isOpen) {
                    panelEl.classList.add('open');
                    toggleEl.classList.add('open');
                    activePanel = panelEl;
                }
            }
        });
    });

    // --- Close when scrolling ---
    window.addEventListener('scroll', closeAllPanels);

    // --- Close when clicking outside ---
    document.addEventListener('click', (e) => {
        if (activePanel && !activePanel.contains(e.target) && !e.target.closest('.mega-menu-btn')) {
            closeAllPanels();
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const menuLinks = document.querySelectorAll(".mobile-menu-list a");
    const menuItems = document.querySelectorAll(".mobile-menu-list li.menu-item-has-children > a");

    // Normalize current path and hash
    const currentUrl = new URL(window.location.href);
    const currentPath = currentUrl.pathname.replace(/\/$/, ""); // remove trailing slash
    const currentHash = currentUrl.hash; // e.g. "#family-conferences"

    let hasActive = false;

    // --- Highlighting logic ---
    menuLinks.forEach(link => {
        link.classList.remove("active-exact");
        const parentLi = link.closest("li");
        if (parentLi) parentLi.classList.remove("current-menu-item");

        const href = link.getAttribute("href");
        if (!href) return;

        const linkUrl = new URL(href, window.location.origin);
        const linkPath = linkUrl.pathname.replace(/\/$/, "");
        const linkHash = linkUrl.hash;

        // highlight if same path + hash (but ignore homepage with /#something)
        if (
            linkPath === currentPath &&
            linkHash === currentHash &&
            !(currentPath === "" && currentHash !== "")
        ) {
            link.classList.add("active-exact");
            if (parentLi) parentLi.classList.add("current-menu-item");
            hasActive = true;
        }
    });

    // --- Auto-open parent menus only if something is highlighted ---
    if (hasActive) {
        const activeItems = document.querySelectorAll(".mobile-menu-list .current-menu-item");
        activeItems.forEach(active => {
            let parentLi = active.closest("li.menu-item-has-children");
            while (parentLi) {
                parentLi.classList.add("open");
                const submenu = parentLi.querySelector("ul.sub-menu");
                if (submenu) submenu.classList.add("open");
                parentLi = parentLi.parentElement.closest("li.menu-item-has-children");
            }
        });
    }

    // --- Accordion toggle ---
    menuItems.forEach(item => {
        item.addEventListener("click", function (e) {
            const parentLi = item.parentElement;
            const submenu = parentLi.querySelector("ul.sub-menu");
            const href = item.getAttribute("href");

            // Determine if link is an anchor (like /#id)
            const isAnchorLink = href && href.includes("/#");

            // Only prevent default if there is a submenu and it’s not an anchor link
            if (submenu && !isAnchorLink) {
                e.preventDefault();
                parentLi.classList.toggle("open");
                submenu.classList.toggle("open");
            }
            // Otherwise, allow normal navigation (keeps /#id in URL)
        });
    });
});
