<?php get_header();
/**
 * Template name: general template
 */
?>


<!-- back button -->
<section id="general-tpl" class="plain-text">
    <div class="general-tpl-section back-link">
        <a href="/home">
            ← back
        </a>
        <!--  breadcrumbs    -->
        <!--    <?php my_custom_breadcrumbs(); ?>  -->
    </div>

    <?php if (have_rows('Sections')): ?>
        <?php while (have_rows('Sections')): the_row(); ?>
            <!-- 1-hero section -->
            <?php if (get_row_layout() == 'hero_section'): ?>
                <!-- Main title -->
                <div class="general-tpl-section">
                    <?php if (get_sub_field('title')): ?>
                        <h2 class="mb-4"><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>
                </div>
                <!-- Sub title -->
                <div class="general-tpl-section">
                    <?php if (get_sub_field('sub_title')): ?>
                        <h4 class="mb-6 sub-title font-ia-writer-duo"><?php echo esc_html(get_sub_field('sub_title')); ?></h4>
                    <?php endif; ?>
                </div>
                <!-- responsive hero image -->
                <?php if (get_sub_field('image_mobile') || get_sub_field('image_desktop')): ?>
                    <div class="general-tpl-section">
                        <img class="hero-content-img"
                             src=""
                             data-mobile="<?php echo get_sub_field('image_mobile'); ?>"
                             data-desktop="<?php echo get_sub_field('image_desktop'); ?>"
                             alt="image">
                    </div>
                <?php endif; ?>


         <!-- 2 column grid section -->
            <?php elseif (get_row_layout() == '3_column_grid'): ?>
                <?php if (get_row_layout() == '3_column_grid'): ?>
                    <!-- 3 column grid -->



                    <div class="general-tpl-section">
                        <?php if (get_sub_field('title_main_column')): ?>
                            <h3 class="mb-4"><?php echo esc_html(get_sub_field('title_main_column')); ?></h3>
                        <?php endif; ?>
                    </div>



                    <div class="grid-container general-tpl-section-content">
                        <div class="left-column">
                            <?php if (get_sub_field('content_1')): ?>
                                <?php echo wp_kses_post(get_sub_field('content_1')); ?>
                            <?php endif; ?>
                        </div>




                        <?php if (get_sub_field('content_2') && get_sub_field("2_column_count")): ?>
                            <div class="middle-column">



                                <?php echo wp_kses_post(get_sub_field('content_2')); ?>
                                <div>
                                    <?php
                                    $icon = get_sub_field('icon_image');
                                    $pdf_label = get_sub_field('label_file');
                                    $pdf_link = get_sub_field('file'); // file field
                                    ?>
                                    <?php if ($icon || $pdf_link): ?>
                                        <div class="download-block">
                                            <!-- LEFT COLUMN -->
                                            <div class="download-block-left font-ia-writer-duo">
                                                <?php if ($pdf_link): ?>
                                                    <?php if ($icon): ?>
                                                        <a href="<?php echo esc_url($pdf_link['url']); ?>"
                                                           target="_blank">
                                                            <img src="<?php echo esc_url($icon); ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <a href="<?php echo esc_url($pdf_link['url']); ?>" target="_blank"
                                                   class="">
                                                    <p class="download-block-title"><?php echo esc_html($pdf_label); ?>
                                                        ↗ </p>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                <?php elseif (get_sub_field('content_2_1') && !get_sub_field("2_column_count")): ?>
                    <div class="middle-column middle-one-column">
                        <?php echo wp_kses_post(get_sub_field('content_2_1')); ?>
                        <div>
                            <?php
                            $icon = get_sub_field('icon_image');
                            $pdf_label = get_sub_field('label_file');
                            $pdf_link = get_sub_field('file'); // file field
                            ?>
                            <?php if ($icon || $pdf_link): ?>
                                <div class="download-block">
                                    <!-- LEFT COLUMN -->
                                    <div class="download-block-left font-ia-writer-duo">
                                        <?php if ($pdf_link): ?>
                                            <?php if ($icon): ?>
                                                <a href="<?php echo esc_url($pdf_link['url']); ?>"
                                                   target="_blank">
                                                    <img src="<?php echo esc_url($icon); ?>" alt="">
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url($pdf_link['url']); ?>" target="_blank"
                                           class="">
                                            <p class="download-block-title"><?php echo esc_html($pdf_label); ?>
                                                ↗ </p>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>


                        <?php if (get_sub_field('content_3')): ?>
                            <div class="right-column">
                                <?php echo wp_kses_post(get_sub_field('content_3')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                <!-- anchor_link -->
            <?php elseif (get_row_layout() == 'anchor_link'): ?>
                <?php if (get_row_layout() == 'anchor_link'): ?>
                    <?php
                    // Get the ID for the anchor from ACF subfield
                    $anchor_id = get_sub_field('anchor_id'); // e.g., "daily-life-coping"
                    ?>

                    <?php if ($anchor_id): ?>
                        <div id="<?php echo esc_attr($anchor_id); ?>" style="scroll-margin-top: 120px;" class="anchor-section">
                    <?php endif; ?>

                <?php endif; ?>

                <!-- anchor_link close -->
            <?php elseif (get_row_layout() == 'anchor_close'): ?>
                <?php if (get_row_layout() == 'anchor_close'): ?>



                     </div>


                <?php endif; ?>







                <!-- line -->
            <?php elseif (get_row_layout() == 'line'): ?>
                <?php if (get_row_layout() == 'line'): ?>
                    <!-- Thin Line Div -->
                    <div class="line-container" style="margin: 100px 0;">
                        <div class="section-line-with-squares">
                            <div class="square left"></div>
                            <div class="section-line"></div>
                            <div class="square right"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 3-some different content -->
            <?php elseif (get_row_layout() == '1_column'): ?>
                <?php if (get_row_layout() == '1_column'): ?>
                    <!-- some different content -->
                    <div class="general-tpl-section general-block">
                        <?php if (get_sub_field('content_4')): ?>
                            <?php echo wp_kses_post(get_sub_field('content_4')); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                <!--4-partner -->
            <?php elseif (get_row_layout() == 'partner'): ?>
                <?php if (get_row_layout() == 'partner'): ?>
                    <div class="partner-logos">
                        <?php if (get_sub_field('partner_item')): ?>
                            <?php while (have_rows('partner_item')): the_row();
                                $logo = get_sub_field('logo');
                                if (!empty($logo)) :
                                    ?>
                                    <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>"
                                       class="partner-logo">
                                        <img src="<?php echo esc_url($logo); ?>" alt=" ">
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- 5-accordion -->
            <?php elseif (get_row_layout() == 'accordion'): ?>
                <?php if (get_row_layout() == 'accordion'):
                    $title = get_sub_field('title');
                    $content = get_sub_field('content');
                    $id = uniqid('acc-'); // unique id for aria-controls
                    ?>
                    <div class="general-tpl-section">
                        <h2 class="sub-title font-ia-writer-duo accordion-title">
                            <button class="acc-trigger"
                                    aria-controls="<?php echo esc_attr($id); ?>"
                                    aria-expanded="false">
                                <?php echo esc_html($title); ?>
                                <span class="acc-icon" aria-hidden="true"></span>
                            </button>
                        </h2>
                    </div>
                    <div class="grid-container general-tpl-section-content grid-accordion">
                        <div class="left-column">
                        </div>
                        <div class="middle-column accordion-content ">
                            <div id="<?php echo esc_attr($id); ?>"
                                 class="acc-panel"
                                 role="region"
                                 hidden>
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        </div>
                        <div class="right-column">
                        </div>
                    </div>


                <?php endif; ?>
                <!-- 6-documents section -->
            <?php elseif (get_row_layout() == 'download_document'): ?>
                <?php if (get_row_layout() == 'download_document'): ?>
                    <!-- column grid -->

                    <div class="documents-section">

                        <div class="documents-column">
                            <?php
                            while (have_posts()) : the_post(); ?>
                                <?php
                                $documents = get_sub_field('attached_documents'); // relationship field
                                if ($documents):
                                    foreach ($documents as $doc):
                                        $file = get_field('file', $doc->ID); // file field from 'document' CPT
                                        $icon = get_field('icon', $doc->ID); // optional icon/image field
                                        $pdf_label = get_the_title($doc->ID); // use the document title
                                        ?>
                                        <?php if ($icon || $file): ?>
                                        <div class="download-block">
                                            <!-- LEFT COLUMN -->
                                            <div class="download-block-left font-ia-writer-duo">
                                                <?php if ($file): ?>
                                                    <?php if ($icon): ?>
                                                        <a href="<?php echo esc_url($file['url']); ?>" target="_blank">
                                                            <img src="<?php echo esc_url($icon); ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url($file['url']); ?>" target="_blank"
                                                       class="">
                                                        <p class="download-block-title">
                                                            <?php echo esc_html($pdf_label); ?> ↗
                                                        </p>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    endforeach;
                                else:
                                    echo '<p>No documents attached.</p>';
                                endif;
                                ?>
                            <?php endwhile; ?>
                        </div>


                    </div>
                <?php endif; ?>


                <!--5- documents section -->
            <?php elseif (get_row_layout() == '2_image5050'): ?>
                <?php if (get_row_layout() == '2_image5050'): ?>
                    <!-- 3 column grid -->
                    <div class="grid-container general-tpl-section-content">
                        <div class="left-column">

                        </div>

                        <div class="middle-column middle-one-column">
                            <div class="two-image-row">
                                <div>
                                    <?php if (get_sub_field('isa_image_1')): ?>
                                        <img src="<?php echo esc_url(get_sub_field('isa_image_1')); ?>" alt="">
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <?php if (get_sub_field('isa_image_2')): ?>
                                        <img src="<?php echo esc_url(get_sub_field('isa_image_2')); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="right-column">

                        </div>

                    </div>
                <?php endif; ?>


                <!--7-icons-statistic-->
            <?php elseif (get_row_layout() == 'icons-statistic'): ?>
                <?php if (get_row_layout() == 'icons-statistic'): ?>
                    <div class="icons-statistic-box">
                        <?php if (get_sub_field('item')): ?>
                            <?php while (have_rows('item')): the_row();
                                $icon = get_sub_field('icon');
                                $label = get_sub_field('label');
                                $description = get_sub_field('description');


                                if (!empty($icon)) :
                                    ?>



                        <div class="icons-statistic-item">
                                    <div class="icons-statistic-img">
                                        <img src="<?php echo esc_url($icon); ?>" alt=" ">
                                    </div>


                                <div class="m-2">
                                    <?php echo esc_html($label); ?>
                                </div>
                                    <div class="m-2">
                                        <?php echo esc_html($description); ?>
                                    </div>

                        </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>













            <?php endif; ?>
        <?php endwhile; ?>
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


<!-- contact us form -->
<?php if (get_field('contact_us_section')): ?>
    <section class="two-columns">
        <div class="heading">
            <div class="container">
                <?php echo do_shortcode(get_field('contact_us_section')); ?>
            </div>
        </div>
    </section>

    <!-- Thin Line Div -->
    <div class="line-container">
        <div class="section-line-with-squares">
            <div class="square left"></div>
            <div class="section-line"></div>
            <div class="square right"></div>
        </div>
    </div>
<?php endif; ?>


<?php
get_footer();
?>


<style>
    .general-tpl-section {
        width: 100%;
        padding-left: 26%;
        margin-right: auto;
        margin-left: auto;
    }

    .hero-content-img {
        margin-bottom: 100px;
    }

    .general-tpl-section h2 {
        padding-bottom: 40px;
    }

    .general-block {
        padding-left: 0% !important;
    }

    .content-pic {
        max-width: 450px;
        padding: 50px 0;
    }


    .left-column {
        text-align: center;
    }

    .right-column {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center; /* optional: for horizontal centering */
        text-align: start; /* optional: for text alignment */
        font-style: italic;
        font-size: 14px;
        max-width: 85%;
        hyphens: auto;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
    }

    .right-column p {
        padding-left: 10px;
        font-family: iA Writer Duo, sans-serif;
    }

    .grid-container {
        gap: 17px;
        display: grid;
        grid-template-columns: 25% 50% 25%;
        margin-bottom: 2.1em;
    }


    .grid-container.grid-accordion {
        margin-bottom: 0em;
    }

    .middle-column {
        font-size: 20px;
        column-count: 2;
        column-gap: 20px;
        line-height: 1.6;
        text-align: left;
        hyphens: auto;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
    }

    .middle-one-column {
        column-count: 1;
    }


    .general-block {
        font-size: 20px;
    }


    .image-general-tpl {
        max-width: 450px;
        margin: 100px 0;
    }


    .middle-column:has(p img.map) {
        column-count: 1;
    }

    .middle-column p:has(img.map) {
        margin-bottom: 0 !important;
    }

    img.map {
        width: 100%;
    }

    img.full-width {
        width: 100vw;
    }


    .documents-section {
        width: 100%;
        padding-left: 26%;
        margin-right: auto;
        margin-left: auto;
    }

    .documents-section h2 {
        padding-bottom: 40px;
    }

    .documents-column {
        max-width: 90%;
        display: flex;
        flex-wrap: wrap;
        gap: 40px; /* controls space between items */
        justify-content: flex-start;
        align-items: flex-start;
        font-size: 20px;
        line-height: 1.6;
        text-align: left;
    }

    /* Child block inside (like .download-block) */
    .documents-column > .download-block {
        flex: 1 1 calc(50% - 20px); /* two per row with gap accounted */
        box-sizing: border-box;
    }

    .download-block-left img {
        margin-top: 15px;
        margin-bottom: 15px;
    }


    .two-image-row {
        display: flex;
        flex-wrap: nowrap; /* allows wrapping on small screens */

    }

    .two-image-row img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    .accordion-title {
        margin: 20px 0 !important;
        font-family: "Bodoni 11", serif;
        font-size: 45px;
    }



    .icons-statistic-box {
        padding: 100px 0;
        background-color: #0867E8;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 50px;
        flex-wrap: wrap;
        margin: 50px 0;
    }
    .icons-statistic-box a {
        max-width: 200px;
    }

    .icons-statistic-box a {
        max-width: 200px;
    }


    .icons-statistic-item{
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }
    .icons-statistic img {
        cursor: pointer;
        max-height: 80px;
        width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .icons-statistic img:hover {
        transform: scale(1.1);
    }



    @media (max-width: 1600px) {
        .middle-column {
            column-count: 1;
        }

        .middle-column img {
            max-width: 400px;

        }

        img.map {
            max-width: 100%;
            width: 100%;
        }
    }


/*left menu */
    /* Left sticky menu wrapper */
    #menu-for-families {
        margin-left: 0px !important;
    }

    #menu-for-families ul li {
        padding-bottom: 0px!important;
    }




    .left-menu {
        position: fixed;     /* always stays in place */
        top: 100px;          /* adjust depending on header height */
        left: 0;

        height: calc(100vh - 100px); /* full height minus header */
        overflow-y: auto;    /* scroll inside if too tall */

        border-right: 1px solid #0867E8;
        padding: 20px 15px;
        z-index: 500;
    }



    /* For Families Menu - Compact Vertical Style */
    /* For Families Menu - Flush Left Compact Style */
    .for-families {
        list-style: none !important;
        margin: 0;
        padding: 0;
        font-family: "Georgia", serif;
        font-size: 15px;
        line-height: 1.4;
    }

    /* Top-level items */
    .for-families > li {
        margin: 4px 0;
        position: relative;
        padding-left: 14px; /* space for square only */
        text-align: left;
    }

    /* Blue square before top-level item */
    .for-families > li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0.55em;
        width: 7px;
        height: 7px;
        background-color: #0867E8;
    }

    /* Top-level links */
    .for-families > li > a {
        color: #333;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
        display: inline-block;
    }

    /* Hover state */
    .for-families > li > a:hover {
        color: #000;
    }

    /* Submenu */
    .for-families li ul {
        list-style: none;
        margin: 4px 0 4px 0; /* remove left margin */
        padding: 0;
    }

    /* Submenu items */
    .for-families li ul li {
        margin: 3px 0;
        position: relative;
        padding-left: 14px; /* same as top level */
        text-align: left;
    }

    /* Blue square before submenu item */
    .for-families li ul li::before {

    }

    /* Submenu links */
    .for-families li ul li a {
        font-size: 13px;
        font-weight: normal;
        color: #555;
        text-decoration: none;
        transition: color 0.2s ease;
        display: inline-block;
    }

    .for-families li ul li a:hover {
        color: #000;
    }



    .for-families a.active {
        color: #0867E8 !important; /* blue highlight */

    }

    .for-families li a.active {
        color: #0867E8;
        font-weight: bold;
        border-left: 3px solid #0867E8;
        padding-left: 8px;
    }
    /*left menu */



    @media (max-width: 966px) {
        .general-tpl-section {
            max-width: 930px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .general-tpl-section-content {
            padding: 0 25px;
            text-align: left;
        }

        .grid-container {
            gap: 0;
        }

        .left-column {
            text-align: left;
        }

        .middle-column {
            column-count: 1; /* stack into one column on smaller screens */
        }

        .grid-container {
            grid-template-columns: 1fr; /* stack in mobile */
            margin-bottom: 0px;
        }

        .right-column {
            max-width: 100%;
            justify-content: end;
        }

        .right-column p {
            width: 100%;
        }

        .middle-column img {
            max-width: 300px;

        }

        .image-general-tpl {
            margin: 0 0;
        }

        img.map {
            max-width: 100%;
        }

        .documents-column {
            gap: 20px;
        }

        .download-block-left img {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .documents-section {
            max-width: 930px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .documents-section h2 {
            padding-bottom: 20px;
        }


        .vertical-center p {
            max-width: 300px;
        }

        .documents-column img {
            max-width: 300px;

        }
    }

    /* Reset button look */
    .acc-trigger {
        all: unset; /* clears all default browser styles */
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        cursor: pointer;
    }

    /* Make it behave like text but clickable */
    .acc-trigger {
        font: inherit;          /* inherit font from h4 */
        color: inherit;         /* inherit color from heading */
        line-height: inherit;
        padding: 0;             /* remove padding */
        margin: 0;              /* remove margin */
        transition: transform 0.9s ease;
    }

    /* Hover effect (optional) */
    .acc-trigger:hover {
        color: #2563eb; /* example: blue on hover */
    }

    /* Arrow icon */
    .acc-icon::after {
        content: "↓";           /* down arrow */
        margin-left: 0.5rem;
        transition: transform 0.9s ease;
    }
    /* When open = up */
    .acc-trigger[aria-expanded="true"] .acc-icon::after {
        content: "↑";
        transition: transform 0.9s ease;
    }

    .acc-trigger[aria-expanded="true"] .acc-icon::after {
        transform: rotate(180deg); /* flip up */
        transition: transform 0.9s ease;
    }

    .acc-panel {
    }

</style>


<script>
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
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.anchor-section');
        const menuLinks = document.querySelectorAll('.for-families li a');

        function activateMenu() {
            let scrollPos = window.scrollY || window.pageYOffset;

            sections.forEach(section => {
                const top = section.offsetTop - 120; // offset for header
                const bottom = top + section.offsetHeight;
                const id = section.getAttribute('id');

                if (scrollPos >= top && scrollPos < bottom) {
                    menuLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.hash === '#' + id) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        // Highlight on scroll
        window.addEventListener('scroll', activateMenu);

        // Highlight on load (deep links)
        activateMenu();

        // Smooth scroll + highlight on click
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.hash.slice(1);
                const target = document.getElementById(targetId);

                if (target) {
                    e.preventDefault();
                    window.scrollTo({
                        top: target.offsetTop - 100, // adjust offset
                        behavior: 'smooth'
                    });
                }
            });
        });
    });






</script>