// -------------------------------
// Sticky navigation logic
// -------------------------------
document.addEventListener('DOMContentLoaded', function () {
    const headerNav = document.querySelector('.header-nav');
    const overlayDiv = document.querySelector('#overlay');

    const heroSection = document.querySelector('.home-hero');
    const defaultSection = document.querySelector('.default-hero');

    function updateStickyClasses() {
        if (window.pageYOffset > headerNav.offsetTop) {
            headerNav.classList.add('sticky');
        } else {
            headerNav.classList.remove('sticky');
        }

        if (heroSection) {
            const threshold = heroSection.offsetTop + heroSection.offsetHeight - headerNav.offsetHeight;
            if (window.pageYOffset > threshold) {
                headerNav.classList.add('sticky-bg');
            } else {
                headerNav.classList.remove('sticky-bg');
            }
        } else if (defaultSection) {
            headerNav.classList.add('sticky-bg');
        } else {
            headerNav.classList.remove('sticky-bg');
        }
    }

    window.addEventListener('scroll', updateStickyClasses);
    window.addEventListener('resize', updateStickyClasses);

    updateStickyClasses();
});

// -------------------------------
// Form validation for Contact Form 7
// -------------------------------
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.wpcf7-form');
    if (!form) return;

    const submitButton = form.querySelector('input[type="submit"]');

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function checkFormValidity() {
        let isValid = true;

        form.querySelectorAll('.wpcf7-validates-as-required').forEach(input => {
            if (!input.value.trim()) isValid = false;
        });

        const emailInput = form.querySelector('.wpcf7-email');
        if (emailInput && !isValidEmail(emailInput.value)) isValid = false;

        submitButton.disabled = !isValid;
    }

    form.addEventListener('input', checkFormValidity);
    checkFormValidity();
});

// -------------------------------
// Disable touch scrolling behind Fancybox (Safari)
// -------------------------------
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const fancyboxContent = document.querySelector(".fancybox-content");

    function disableScroll(event) {
        if (!fancyboxContent.contains(event.target)) {
            event.preventDefault();
        }
    }

    document.addEventListener("fancyboxopen", function () {
        body.classList.add("fancybox-active");
        document.addEventListener("touchmove", disableScroll, { passive: false });
    });

    document.addEventListener("fancyboxclose", function () {
        body.classList.remove("fancybox-active");
        document.removeEventListener("touchmove", disableScroll);
    });
});

// -------------------------------
// Donate / Join button hover text
// -------------------------------
jQuery(document).ready(function ($) {
    $(".button-hover-text-donate, .button-hover-text-join").hide();

    $(".button.donate").hover(
        function () {
            $(".button-hover-text-donate, .button-hover-text-join").stop(true, true).hide();
            $(".button-hover-text-donate").fadeIn();
        },
        function () {
            $(".button-hover-text-donate").fadeOut();
        }
    );

    $(".button.join").hover(
        function () {
            $(".button-hover-text-donate, .button-hover-text-join").stop(true, true).hide();
            $(".button-hover-text-join").fadeIn();
        },
        function () {
            $(".button-hover-text-join").fadeOut();
        }
    );
});

// -------------------------------
// Responsive hero background
// -------------------------------
function updateHeroBackgrounds() {
    const isMobile = window.innerWidth < 966;

    document.querySelectorAll('.responsive-bg').forEach(div => {
        const mobileBg = div.getAttribute('data-mobile-bg');
        const desktopBg = div.getAttribute('data-desktop-bg');
        div.style.backgroundImage = `url(${isMobile ? mobileBg : desktopBg})`;
        div.style.aspectRatio = isMobile ? '1 / 2' : '40 / 21';
    });
}

document.addEventListener('DOMContentLoaded', updateHeroBackgrounds);
window.addEventListener('resize', updateHeroBackgrounds);

// -------------------------------
// Donation input formatting
// -------------------------------
document.addEventListener('DOMContentLoaded', () => {
    function formatToCurrency(value) {
        const num = parseFloat(value) / 100;
        return num.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    }

    function formatCurrency(input) {
        let cleanValue = input.value.replace(/[^0-9]/g, '');
        input.value = cleanValue.length > 0 ? formatToCurrency(cleanValue) : "$0.00";
    }
});

// -------------------------------
// Scroll container: one section per scroll
// -------------------------------
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.scroll-container');
    if (!container) return;

    const sections = document.querySelectorAll('.scroll-section');
    const height = window.innerHeight;
    let isScrolling = false;

    container.addEventListener('scroll', () => {
        const scrollTop = container.scrollTop;
        sections.forEach(sec => {
            const offset = sec.offsetTop;
            if (scrollTop >= offset - height / 1.5 && scrollTop < offset + height / 1.5) {
                sec.classList.add('active');
            } else {
                sec.classList.remove('active');
            }
        });
    });

    container.addEventListener('wheel', e => {
        if (window.innerWidth > 1024) {
            e.preventDefault();
            if (isScrolling) return;
            isScrolling = true;

            container.scrollBy({
                top: e.deltaY > 0 ? height : -height,
                behavior: 'smooth',
            });

            setTimeout(() => isScrolling = false, 1200);
        }
    }, { passive: false });
});
