$(document).ready(function () {

    // Mobile menu toggle functionality
    $("#mobile-menu-toggle").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("opened");
        $('body').toggleClass("fixed");
        $("#mobile-menu").fadeToggle();
        $("#overlay").toggleClass("opened");

        // Update aria-expanded for accessibility
        let expanded = $(this).attr("aria-expanded") === "true";
        $(this).attr("aria-expanded", !expanded);

        // Update button content
        if (!expanded) {
            // Menu is opening → show "✕"
            $(this).html('<span class="close-icon" aria-hidden="true">✕</span>');
        } else {
            // Menu is closing → revert to original
            $(this).html('  <a href="#" id="mobile-menu-toggle" aria-expanded="false">\n' +
                '                    menu <span class="arrow"> </span>\n' +
                '                </a>');
        }
    });

    // Mobile menu item click functionality (to close menu after clicking)
    $("#mobile-menu a[href*='#']").click(function (e) {
        e.preventDefault();
        closeMobileMenu();

        var target = $(this).attr("href");
        var fixed_offset = 100;

        if (target.startsWith("#")) {
            var targetElement = $(target);
            if (targetElement.length) {
                $('html, body').stop().animate({
                    scrollTop: targetElement.offset().top - fixed_offset
                }, 1000);
            }
        } else {
            var baseUrl = window.location.origin;
            var fullUrl = baseUrl + target;
            window.location.href = fullUrl;
        }
    });

    // Ensure the mobile menu closes before opening the Donate popup
    /*
  $(".donate").click(function (e) {
        e.preventDefault();
        closeMobileMenu();

        // Small delay to allow menu to close before opening Fancybox
        setTimeout(() => {
            $.fancybox.open({
                src: '#donate-popup',
                type: 'inline'
            });
        }, 300);
    });
    * */


    // Function to handle resizing
    function handleResize() {
        const screenWidth = $(window).width();
        if (screenWidth >= 966) {
            closeMobileMenu();
        }
    }

    // Function to close the mobile menu and reset styles
    function closeMobileMenu() {
        $("#mobile-menu-toggle").removeClass("opened");
        $("body").removeClass("fixed");
        $("#mobile-menu").fadeOut();
        $("#overlay").removeClass("opened");

        // Reset button aria-expanded and content
        $("#mobile-menu-toggle").attr("aria-expanded", "false");
        $("#mobile-menu-toggle").html('menu <span class="arrow">➔</span>');
    }

    // Check window resize
    $(window).resize(function () {
        handleResize();
    });

    // Initial check on page load
    handleResize();

    // Handle scroll event to ensure mobile menu is reset properly
    $(window).on('scroll', function () {
        handleResize();
    });

    // Slick carousel initialization
    $('.reasons-list').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 966,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

});


// Sticky navigation logic
document.addEventListener('DOMContentLoaded', function () {
    const headerNav = document.querySelector('.header-nav');
    const overlayDiv = document.querySelector('#overlay');
    const mobileMenuToggle = document.querySelector('#mobile-menu-toggle');

    let heroSection = document.querySelector('.home-hero');
    let defaultSection = document.querySelector('.default-hero');

    function updateStickyClasses() {
        if (window.pageYOffset > headerNav.offsetTop) {
            headerNav.classList.add('sticky');
        } else {
            headerNav.classList.remove('sticky');
        }

        if (heroSection) {
            const threshold = heroSection.offsetTop + heroSection.offsetHeight - headerNav.offsetHeight;

            if (window.pageYOffset > threshold) {
                if (!overlayDiv.classList.contains('opened')) {
                    headerNav.classList.add('sticky-bg');
                }
            } else {
                headerNav.classList.remove('sticky-bg');
            }
        } else if (defaultSection) {
            headerNav.classList.add('sticky-bg');
        } else {
            headerNav.classList.remove('sticky-bg');
        }
    }

    function toggleStickyBg() {
        if (overlayDiv.classList.contains('opened')) {
            headerNav.classList.remove('sticky-bg');
        } else {
            updateStickyClasses();
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(func, wait);
        };
    }

    window.addEventListener('scroll', updateStickyClasses);
    window.addEventListener('resize', updateStickyClasses);

    // Listen for clicks on the mobile menu toggle button
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function () {
            setTimeout(toggleStickyBg, 10); // Small delay to ensure class is added/removed first
        });
    }

    updateStickyClasses();
});

// Form validation for button submit
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.wpcf7-form'); // Select Contact Form 7 form

    if (!form) {
        // Optionally log a warning, or just exit if the form is not found
        // console.warn('Form with class .wpcf7-form not found.');
        return;
    }

    const submitButton = form.querySelector('input[type="submit"]');

    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
        return emailPattern.test(email);
    }

    function checkFormValidity() {
        let isValid = true;

        // Loop through all required fields
        form.querySelectorAll('.wpcf7-validates-as-required').forEach(input => {
            if (!input.value.trim()) {
                isValid = false; // Mark as invalid if empty
            }
        });

        // Validate email field
        const emailInput = form.querySelector('.wpcf7-email');
        if (emailInput && !isValidEmail(emailInput.value)) {
            isValid = false; // Mark as invalid if email format is incorrect
        }

        submitButton.disabled = !isValid; // Enable/Disable button
    }

    // Check on input change
    form.addEventListener('input', checkFormValidity);

    // Disable button initially
    checkFormValidity();
});


// disable touch scrolling on the background in SAFARI
document.addEventListener("DOMContentLoaded", function () {
    let body = document.body;
    let fancyboxContent = document.querySelector(".fancybox-content");

    function disableScroll(event) {
        if (!fancyboxContent.contains(event.target)) {
            event.preventDefault();
        }
    }

    document.addEventListener("fancyboxopen", function () {
        body.classList.add("fancybox-active");
        document.addEventListener("touchmove", disableScroll, {passive: false});
    });

    document.addEventListener("fancyboxclose", function () {
        body.classList.remove("fancybox-active");
        document.removeEventListener("touchmove", disableScroll);
    });
});


jQuery(document).ready(function ($) {
    $(".button-hover-text-donate, .button-hover-text-join").hide(); // Hide text initially

    $(".button.donate").hover(
        function () {
            $(".button-hover-text-donate, .button-hover-text-join").stop(true, true).hide(); // Immediately hide both
            $(".button-hover-text-donate").fadeIn();
        },
        function () {
            $(".button-hover-text-donate").fadeOut();
        }
    );

    $(".button.join").hover(
        function () {
            $(".button-hover-text-donate, .button-hover-text-join").stop(true, true).hide(); // Immediately hide both
            $(".button-hover-text-join").fadeIn();
        },
        function () {
            $(".button-hover-text-join").fadeOut();
        }
    );
});


/*

document.addEventListener("DOMContentLoaded", function () {
    let heroBg = document.querySelector(".home-hero-bg");
    let navHeader = document.querySelector(".visible-menu");
    let heroTextD = document.querySelector(".hero-text-desktop");
    let heroTextM = document.querySelector(".hero-text-mobile");
    let buttonHover = document.querySelector(".button-container-desktop");
    let buttonText = document.querySelector(".button-container-mobile");

    if (!heroBg || !navHeader) return;

    function updateBackgroundAndMenu() {
        // ✅ Always get the most recent data values
        let desktopBg = heroBg.getAttribute("data-desktop-bg");
        let mobileBg = heroBg.getAttribute("data-mobile-bg");

        let isMobilebg = window.matchMedia("(max-width: 650px)").matches;
        let isMobilemenu = window.matchMedia("(max-width: 950px)").matches;
        let bgImage = isMobilebg ? mobileBg : desktopBg;

        heroBg.style.backgroundImage = `url('${bgImage}')`;
        navHeader.style.display = isMobilemenu ? "flex" : "none";
        heroTextD.style.display = isMobilemenu ? "none" : "flex";
        heroTextM.style.display = isMobilemenu ? "block" : "none";
        buttonHover.style.display = isMobilemenu ? "none" : "flex";
        buttonText.style.display = isMobilemenu ? "block" : "none";
    }

   // updateBackgroundAndMenu();   ---if you want change pict only in first loading
    window.addEventListener("resize", updateBackgroundAndMenu);
    window.addEventListener("orientationchange", updateBackgroundAndMenu);
    updateBackgroundAndMenu();
});



* */
function updateHeroBackgrounds() {
    const isMobile = window.innerWidth < 966;

    document.querySelectorAll('.responsive-bg').forEach(div => {
        const mobileBg = div.getAttribute('data-mobile-bg');
        const desktopBg = div.getAttribute('data-desktop-bg');

        if (isMobile) {
            div.style.backgroundImage = `url(${mobileBg})`;
            div.style.aspectRatio = '1 / 2'; // 10/20
        } else {
            div.style.backgroundImage = `url(${desktopBg})`;
            div.style.aspectRatio = '40 / 21'; // 20/20
        }
    });
}

document.addEventListener('DOMContentLoaded', updateHeroBackgrounds);
window.addEventListener('resize', updateHeroBackgrounds);




document.addEventListener('DOMContentLoaded', function() {

    /*
    const donationInput = document.querySelector('input[name="donation-amount"]');

    if (donationInput) {
        // Set default value
        donationInput.value = "";

        donationInput.addEventListener('focus', function () {
            if (this.value === "$0.00") {
                this.value = "";
            }
        });

        donationInput.addEventListener('blur', function () {
            if (this.value.trim() === "" || this.value.trim() === "$0.00") {
                this.value = null;
            } else {
                formatCurrency(this);
            }
        });

        donationInput.addEventListener('input', function () {
            // Remove anything that's not a number
            let cleanValue = this.value.replace(/[^0-9]/g, '');
            if (cleanValue.length > 0) {
                this.value = formatToCurrency(cleanValue);
            } else {
                this.value = "";
            }
        });
    }
    */

    function formatCurrency(input) {
        let cleanValue = input.value.replace(/[^0-9]/g, '');
        if (cleanValue.length > 0) {
            input.value = formatToCurrency(cleanValue);
        } else {
            input.value = "$0.00";
        }
    }

    function formatToCurrency(value) {
        const num = parseFloat(value) / 100;
        return num.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
    }

});