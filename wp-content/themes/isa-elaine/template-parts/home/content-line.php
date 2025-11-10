<?php
$array = get_field('line');

if (is_array($array) && array_filter($array)):
    while (have_rows('line')) : the_row(); ?>

        <section id="line" class="plain-text scroll-section ">
            <div class="container" style="height: 100%">
                <ul class="custom-timeline-list">
                    <?php
                    if (have_rows('item')) :
                        while (have_rows('item')) : the_row();
                            $title = get_sub_field('title');
                            $subtitle = get_sub_field('sub_title');
                            $content = get_sub_field('content');
                            ?>

                            <li class="custom-timeline-item">
                                <div class="marker-square"></div>
                                <div class="content-block">
                                    <?php if ($title): ?>
                                        <h2 class="line-title "><?php echo esc_html($title); ?></h2>
                                    <?php endif; ?>

                                    <?php if ($subtitle): ?>
                                        <h3 class="line-subtitle small-caps wide-letter-spacing"><?php echo esc_html($subtitle); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($content): ?>
                                        <div class="line-content"><?php echo wp_kses_post($content); ?></div>
                                    <?php endif; ?>
                                </div>
                            </li>

                        <?php endwhile;
                    endif;
                    ?>
                </ul>
            </div>

        </section>

        <!-- Decorative Line -->
        <div class="line-container">
            <div class="section-line-with-squares">
                <div class="square left"></div>
                <div class="section-line"></div>
                <div class="square right"></div>
            </div>
        </div>

    <?php endwhile;
endif;
?>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const timeline = document.querySelector(".custom-timeline-list");
        const squares = document.querySelectorAll(".marker-square");

        if (timeline && squares.length > 1) {
            const firstSquare = squares[0].getBoundingClientRect();
            const lastSquare = squares[squares.length - 1].getBoundingClientRect();
            const containerRect = timeline.getBoundingClientRect();

            // Calculate positions relative to the UL container
            const top = firstSquare.top - containerRect.top + firstSquare.height / 2;
            const bottom = containerRect.bottom - lastSquare.bottom + lastSquare.height / 2;

            // Apply dynamic values to the pseudo-element via CSS variable
            timeline.style.setProperty("--line-top", `${top}px`);
            timeline.style.setProperty("--line-bottom", `${bottom}px`);
        }
    });


    function updateTimelineLine() {
        const timeline = document.querySelector(".custom-timeline-list");
        const squares = document.querySelectorAll(".marker-square");

        if (timeline && squares.length > 1) {
            const firstSquare = squares[0].getBoundingClientRect();
            const lastSquare = squares[squares.length - 1].getBoundingClientRect();
            const containerRect = timeline.getBoundingClientRect();

            const top = firstSquare.top - containerRect.top + firstSquare.height / 2;
            const bottom = containerRect.bottom - lastSquare.bottom + lastSquare.height / 2;

            timeline.style.setProperty("--line-top", `${top}px`);
            timeline.style.setProperty("--line-bottom", `${bottom}px`);
        }
    }

    window.addEventListener("resize", updateTimelineLine);
    document.addEventListener("DOMContentLoaded", updateTimelineLine);




</script>

<style>
    .custom-timeline-list {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
        font-variant-numeric:normal;
    }

    .custom-timeline-list::before {
        content: "";
        position: absolute;
        left: 6px;
        top: var(--line-top, 0);
        bottom: var(--line-bottom, 0);
        width: 2px;
        background-color: #0867E8;
        z-index: 1;
    }

    /* rest is the same */
    .custom-timeline-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px 0;
        position: relative;
    }

    .marker-square {
        width: 12px;
        height: 12px;
        background-color: #0867E8;
        flex-shrink: 0;
        margin-top: 8px;
        position: relative;
        z-index: 2;
    }

    /* Typography */
    .line-title {
        font-size: 1.25rem;
        margin: 0 0 5px;
    }

    .line-subtitle {
        font-size: 1rem;
        color: #0867E8;
        margin: 0 0 10px;
    }

    .line-content {
        font-size: 0.95rem;
        color: #333;
    }


    .content-block h2 {
        font-size: 44px;
        padding-bottom: 10px;
    }

    .content-block h3 {
        font-size: 17px;
        font-family: iA Writer Duo, sans-serif;
    }

    @media (max-width: 1400px) {

        .content-block h2 {
            font-size: 34px!important;
            padding-bottom: 10px;
            margin-bottom: 0 !important;
        }

        .content-block h3 {
            font-size: 14px;
            font-family: iA Writer Duo, sans-serif;
        }



    }



</style>