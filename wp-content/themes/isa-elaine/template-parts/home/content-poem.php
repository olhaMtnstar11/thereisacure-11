<?php
$array = get_field('poem');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('poem')) : the_row(); ?>
        <section id="poem" class="plain-text">

            <div>
                <?php if (get_sub_field('poem_logo')): ?>
                    <img class="poem-img" src="<?php echo esc_url(get_sub_field('poem_logo')); ?>" alt="">
                <?php endif; ?>

            </div>
            <div class="poem-text">
                <?php if (get_sub_field('poem_text')): ?>
                    <?php echo wp_kses_post(get_sub_field('poem_text')); ?>
                <?php endif; ?>
            </div>

            <div class="poem-logo">
                <?php if (get_sub_field('little_logo')): ?>
                    <img class="p-3" style="    max-width: 120px;"
                         src="<?php echo esc_url(get_sub_field('little_logo')); ?>" alt="">
                <?php endif; ?>
            </div>


            <?php if (have_rows('partner_item')): ?>
                <div class="partner-logos">
                    <?php while (have_rows('partner_item')): the_row();
                        $logo = get_sub_field('logo');
                        if (!empty($logo)) : ?>
                            <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>" class="partner-logo">
                                <img src="<?php echo esc_url($logo); ?>" alt="">
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>


        </section>
        <!-- Thin Line Div -->
        <div class="line-container">
            <div class="section-line-with-squares">
                <div class="square left"></div>
                <div class="section-line"></div>
                <div class="square right"></div>
            </div>
        </div>


    <?php endwhile;endif; ?>

<style>
    .general-tpl-section {
        width: 100%;
        padding-left: 26%;
        padding-right: 26%;
        margin-right: auto;
        margin-left: auto;
    }

    .poem-img {
        width: 100vw;
    }

    .poem-text {
        font-family: "Bodoni 06", sans-serif;
        font-size: 20px;
        text-align: center;
        letter-spacing: 1.3px;
        padding: 80px 0 20px 0;
    }

    .poem-text p {
        line-height: 2 !important;
    }

    .poem-logo {
        text-align: center;
    }

    @media (max-width: 966px) {
        .poem-text {
            font-size: 16px;
        }
    }



    /* FORCE single horizontal line + scrolling */
    .partner-logos {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;   /* <- no wrap */
        align-items: center;
        gap: 30px;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: x proximity;
        padding: 20px 0;
    }

    /* base: always horizontal no wrap */
    .partner-logos {
        display: flex;
        gap: 30px;
        align-items: center;
        white-space: nowrap;
        overflow-x: auto;                /* needed so we can update scrollLeft */
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: none;
        padding: 20px 0;
        box-sizing: border-box;
    }

    /* make sure links don't become full width by theme */
    .partner-logos .partner-logo {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto !important;
        width: auto !important;
    }

    .partner-logos .partner-logo img {
        height: 50px;
        width: auto;
        display: block;
    }

    /* hide scrollbar (optional) */
    .partner-logos::-webkit-scrollbar { display: none; }
    .partner-logos { scrollbar-width: none; }

    /* Desktop: center and keep static */
    @media (min-width: 769px) {
        .partner-logos {
            justify-content: center;
            overflow-x: visible; /* no scrollbars and stays centered if content fits */
            gap: 100px!important;
            flex-grow: 0;
            flex-shrink: 1;
        }
    }

    .partner-logos-inner {
        display: flex;
        gap: 30px;
        will-change: transform; /* enable GPU acceleration */
    }
    /* Desktop: center and keep static */
    @media (max-width: 769px) {
        .partner-logos {
            justify-content: center;
            overflow-x: visible; /* no scrollbars and stays centered if content fits */
            gap: 100px!important;
            flex-grow: 1;
            flex-shrink: 0;
        }
    }

</style>
<script>

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.partner-logos');
        if (!container) return;

        const originalHTML = container.innerHTML;
        const DEFAULT_SPEED = 0.5; // px per frame, adjust for slower/faster

        let position = 0;
        let rafId = null;
        let isPointerDown = false;
        let startX = 0;
        let startScroll = 0;
        let auto = true;
        let resumeTimer = null;

        // --- Helpers ---
        function needsScrolling() {
            return container.scrollWidth > container.clientWidth;
        }

        // --- Drag/Swipe ---
        function onPointerDown(e) {
            isPointerDown = true;
            auto = false;
            startX = (e.clientX !== undefined) ? e.clientX : e.touches[0].clientX;
            startScroll = position;
            if (resumeTimer) clearTimeout(resumeTimer);
        }

        function onPointerMove(e) {
            if (!isPointerDown) return;
            const x = (e.clientX !== undefined) ? e.clientX : e.touches[0].clientX;
            const dx = x - startX;
            position = startScroll - dx;
        }

        function onPointerUp() {
            isPointerDown = false;
            resumeTimer = setTimeout(() => { auto = true; }, 800);
        }

        function addListeners() {
            container.addEventListener('pointerdown', onPointerDown, {passive:true});
            window.addEventListener('pointermove', onPointerMove, {passive:true});
            window.addEventListener('pointerup', onPointerUp, {passive:true});

            container.addEventListener('touchstart', onPointerDown, {passive:true});
            window.addEventListener('touchmove', onPointerMove, {passive:true});
            window.addEventListener('touchend', onPointerUp, {passive:true});
        }

        function removeListeners() {
            container.removeEventListener('pointerdown', onPointerDown);
            window.removeEventListener('pointermove', onPointerMove);
            window.removeEventListener('pointerup', onPointerUp);

            container.removeEventListener('touchstart', onPointerDown);
            window.removeEventListener('touchmove', onPointerMove);
            window.removeEventListener('touchend', onPointerUp);
        }

        // --- Auto-scroll ---
        function step() {
            if (auto && !isPointerDown) {
                position += DEFAULT_SPEED;
            }

            const half = container.scrollWidth / 2;
            if (half > 0) {
                if (position >= half) position -= half;
                if (position < 0) position += half;
            }

            container.scrollLeft = position;
            rafId = requestAnimationFrame(step);
        }

        // --- Initialize scrolling if content overflows ---
        function initScroll() {
            container.innerHTML = originalHTML + originalHTML; // duplicate row for seamless
            position = 0;
            auto = true;
            addListeners();
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(step);
        }

        function destroyScroll() {
            if (rafId) cancelAnimationFrame(rafId);
            container.innerHTML = originalHTML;
            removeListeners();
            auto = false;
            container.style.display = 'flex';
            container.style.justifyContent = 'center';
            container.style.overflowX = 'visible';
        }

        // --- Initial check ---
        if (needsScrolling()) {
            initScroll();
        } else {
            destroyScroll();
        }

        // --- Handle resize ---
        let resizeTimer = null;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (needsScrolling() && container.innerHTML === originalHTML) initScroll();
                else if (!needsScrolling() && container.innerHTML !== originalHTML) destroyScroll();
            }, 180);
        });




    });





</script>

