document.addEventListener("DOMContentLoaded", function () {
    const responsiveImgs = document.querySelectorAll(".hero-content-img");

    function updateImages() {
        const isDesktop = window.innerWidth >= 967;

        responsiveImgs.forEach(img => {
            const src = isDesktop ? img.dataset.desktop : img.dataset.mobile;
            if (src) img.src = src;
        });
    }

    updateImages(); // Initial load
    window.addEventListener("resize", updateImages); // Update on resize
});


//accordion
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.acc-trigger');
    if (!btn) return;

    const panelId = btn.getAttribute('aria-controls');
    const panel = document.getElementById(panelId);
    const isOpen = btn.getAttribute('aria-expanded') === 'true';

    // close
    if (isOpen) {
        btn.setAttribute('aria-expanded', 'false');
        panel.setAttribute('hidden', '');
    }
    // open
    else {
        btn.setAttribute('aria-expanded', 'true');
        panel.removeAttribute('hidden');
    }
});


//detect the current section in view
document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('.anchor-section');
    // Select only links that point to anchors on the same page
    const menuLinks = document.querySelectorAll('.for-families li a[href*="#"]');

    // Helper: get numeric offsetTop (account for position context)
    function getTop(el) {
        return el.getBoundingClientRect().top + window.pageYOffset;
    }

    // Highlight menu based on visible section and update URL (replaceState)
    function activateMenuOnScroll() {
        const scrollPos = window.scrollY || window.pageYOffset;
        let found = false;

        sections.forEach(section => {
            const top = getTop(section) - 120; // header offset
            const bottom = top + section.offsetHeight;
            const id = section.id;

            if (scrollPos >= top && scrollPos < bottom) {
                // mark active link(s)
                menuLinks.forEach(link => link.classList.remove('active'));
                const match = document.querySelector('.for-families li a[href$="#' + id + '"]');
                if (match) {
                    match.classList.add('active');
                }

                // update URL hash without adding history entry (replaceState)
                const newHash = '#' + id;
                if (window.location.hash !== newHash) {
                    history.replaceState(null, '', newHash);
                }

                found = true;
            }
        });

        // If nothing found (scrolled above first section), clear hash
        if (!found) {
            // only clear if there is a hash
            if (window.location.hash) {
                history.replaceState(null, '', window.location.pathname + window.location.search);
                menuLinks.forEach(link => link.classList.remove('active'));
            }
        }
    }

    // Smooth scroll + pushState on click
    menuLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            // allow full-page links (different page) to behave normally
            try {
                const url = new URL(href, window.location.origin);
                const targetId = url.hash ? url.hash.slice(1) : null;
                // ensure link target is on same path (same page) and has an id
                if (targetId && url.pathname.replace(/\/$/, '') === window.location.pathname.replace(/\/$/, '')) {
                    const target = document.getElementById(targetId);
                    if (target) {
                        e.preventDefault();

                        // Smooth scroll
                        const targetTop = getTop(target) - 100; // adjust for sticky header
                        window.scrollTo({
                            top: targetTop,
                            behavior: 'smooth'
                        });

                        // Update URL hash and create a history entry after a small delay
                        // (so the browser doesn't jump; delay is tiny and safe)
                        window.setTimeout(function () {
                            const newHash = '#' + targetId;
                            if (window.location.hash !== newHash) {
                                history.pushState(null, '', newHash);
                            }
                        }, 300); // 300ms matches typical smooth scroll; adjust if needed
                    }
                }
                // else allow normal navigation to another page (no preventDefault)
            } catch (err) {
                // If URL constructor fails, just let it be
            }
        });
    });

    // Run on load (for deep links) after a micro task so page layout is ready
    setTimeout(activateMenuOnScroll, 50);
    window.addEventListener('scroll', activateMenuOnScroll);
    window.addEventListener('resize', activateMenuOnScroll); // recalc on resize
});

document.addEventListener("DOMContentLoaded", function () {
    const menus = document.querySelectorAll(".types-nbia-sub-menu, .left-menu");
    const footer = document.querySelector("footer");
    const contact = document.querySelector("#contact-us");

    if (!menus.length || (!footer && !contact)) return;

    function toggleMenuVisibility() {
        const windowHeight = window.innerHeight;
        const footerRect = footer ? footer.getBoundingClientRect() : null;
        const contactRect = contact ? contact.getBoundingClientRect() : null;

        const footerVisible = footerRect && footerRect.top < windowHeight;
        const contactVisible = contactRect && contactRect.top < windowHeight;

        menus.forEach(menu => {
            if (footerVisible || contactVisible) {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        });
    }

    window.addEventListener("scroll", toggleMenuVisibility);
    window.addEventListener("resize", toggleMenuVisibility);
    toggleMenuVisibility(); // run once on load
});


document.addEventListener("DOMContentLoaded", function () {
    const questions = document.querySelectorAll(".faq-question");

    questions.forEach((question) => {
        question.addEventListener("click", () => {
            const answer = question.nextElementSibling;
            answer.classList.toggle("active");
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.querySelector('.events-carousel-wrapper');
    if (!wrapper) return;
    const track = wrapper.querySelector('.events-track');
    const slides = wrapper.querySelectorAll('.event-slide');
    const prevBtn = wrapper.querySelector('.carousel-btn.prev');
    const nextBtn = wrapper.querySelector('.carousel-btn.next');

    let currentIndex = 0;
    let visibleSlides = 3;
    let isDragging = false;
    let startX = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID;
    let maxTranslate = 0;

    function updateVisibleSlides() {
        const width = window.innerWidth;
        if (width <= 600) visibleSlides = 1;
        else if (width <= 992) visibleSlides = 2;
        else visibleSlides = 3;
    }

    function markSingleState() {
        // if only one slide total -> add .single to track
        if (slides.length === 1) {
            track.classList.add('single');
        } else {
            track.classList.remove('single');
        }
    }

    function updateCarousel() {
        if (!slides.length) return;
        const slideWidth = slides[0].offsetWidth + parseInt(getComputedStyle(track).gap || 20);
        maxTranslate = -(slides.length - visibleSlides) * slideWidth;

        // Keep index within bounds
        if (currentIndex < 0) currentIndex = 0;
        if (currentIndex > slides.length - visibleSlides) currentIndex = Math.max(0, slides.length - visibleSlides);

        prevTranslate = -currentIndex * slideWidth;
        track.style.transform = `translateX(${prevTranslate}px)`;

        // Show/hide buttons and dragging based on number of slides vs visibleSlides
        if (slides.length <= visibleSlides) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            track.style.cursor = 'default';
            disableDragging();
        } else {
            prevBtn.style.display = currentIndex === 0 ? 'none' : 'block';
            nextBtn.style.display = currentIndex >= slides.length - visibleSlides ? 'none' : 'block';
            track.style.cursor = 'grab';
            enableDragging();
        }
    }

    // Navigation buttons
    nextBtn.addEventListener('click', () => {
        if (currentIndex < slides.length - visibleSlides) {
            currentIndex++;
            updateCarousel();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });

    // Drag / swipe handlers (same as your fixed version)
    function dragStart(e) {
        if (slides.length <= visibleSlides) return;
        isDragging = true;
        startX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
        track.style.transition = 'none';
        animationID = requestAnimationFrame(animation);
    }

    function dragAction(e) {
        if (!isDragging) return;
        const currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
        const delta = currentX - startX;
        currentTranslate = prevTranslate + delta;
        // clamp
        if (currentTranslate > 0) currentTranslate = 0;
        if (currentTranslate < maxTranslate) currentTranslate = maxTranslate;
    }

    function dragEnd() {
        if (!isDragging) return;
        cancelAnimationFrame(animationID);
        isDragging = false;
        track.style.transition = 'transform 0.4s ease';
        const slideWidth = slides[0].offsetWidth + parseInt(getComputedStyle(track).gap || 20);
        const movedSlides = Math.round(-currentTranslate / slideWidth);
        currentIndex = Math.min(Math.max(0, movedSlides), Math.max(0, slides.length - visibleSlides));
        prevTranslate = -currentIndex * slideWidth;
        track.style.transform = `translateX(${prevTranslate}px)`;
        updateCarousel();
    }

    function animation() {
        track.style.transform = `translateX(${currentTranslate}px)`;
        if (isDragging) requestAnimationFrame(animation);
    }

    function enableDragging() {
        track.addEventListener('mousedown', dragStart);
        track.addEventListener('touchstart', dragStart, {passive: true});
        track.addEventListener('mouseup', dragEnd);
        track.addEventListener('mouseleave', dragEnd);
        track.addEventListener('touchend', dragEnd);
        track.addEventListener('mousemove', dragAction);
        track.addEventListener('touchmove', dragAction);
    }

    function disableDragging() {
        track.removeEventListener('mousedown', dragStart);
        track.removeEventListener('touchstart', dragStart);
        track.removeEventListener('mouseup', dragEnd);
        track.removeEventListener('mouseleave', dragEnd);
        track.removeEventListener('touchend', dragEnd);
        track.removeEventListener('mousemove', dragAction);
        track.removeEventListener('touchmove', dragAction);
    }

    window.addEventListener('resize', () => {
        updateVisibleSlides();
        // recalc after a short delay so DOM has updated
        setTimeout(() => {
            markSingleState();
            updateCarousel();
        }, 120);
    });

    // Initialize
    updateVisibleSlides();
    markSingleState();
    updateCarousel();
});
