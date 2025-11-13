<?php
$array = get_field('line');

if (is_array($array) && array_filter($array)):
    while (have_rows('line')) : the_row();

        if (have_rows('item')) :
            while (have_rows('item')) : the_row();
                $title = get_sub_field('title');
                $subtitle = get_sub_field('sub_title');
                $content = get_sub_field('content');

                $image = get_sub_field('image'); // URL
                ?>

                <!-- Each item = one section -->
                <section id="line" class="plain-text scroll-section">
                    <div class=" timeline-container" style="display: flex">

                        <!-- Image on the far left -->
                        <?php if ($image): ?>
                            <div class="timeline-image">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" >
                            </div>
                        <?php endif; ?>



                        <ul class="custom-timeline-list">
                            <li class="custom-timeline-item">
                                <div class="marker-square"></div>
                                <div class="content-block">
                                    <?php if ($title): ?>
                                        <h2 class="line-title"><?php echo esc_html($title); ?></h2>
                                    <?php endif; ?>

                                    <?php if ($subtitle): ?>
                                        <h3 class="line-subtitle small-caps wide-letter-spacing"><?php echo esc_html($subtitle); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($content): ?>
                                        <div class="line-content"><?php echo wp_kses_post($content); ?></div>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>



            <?php endwhile;
        endif;

    endwhile;
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

    .timeline-container {
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-wrap: nowrap;
        flex-direction: row;
        padding-left: 120px; /* adjust this value */
    }
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
        bottom: var(--line-bottom, 10);
        width: 2px;
        background-color: #0867E8;
        z-index: 1;
    }

    /* rest is the same */
    .custom-timeline-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;

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
        font-size: 72px;
        margin: 0 0 5px;
    }

    .line-subtitle {
        font-size: 24px;
        color: #0867E8;
        margin: 0 0 10px;
    }

    .line-content {
        font-size: 17px;
        color: #333;
    }
    .content-block {
        max-width: 500px;
    }

    .content-block h2 {
        font-size: 72px;
        padding-bottom: 10px;
    }

    .content-block h3 {
        font-size: 24px;
        font-family: iA Writer Duo, sans-serif;
    }


    .timeline-image img {
        width: 300px;
    }
    @media (max-width: 1400px) {

        .content-block h2 {
            font-size: 34px!important;
            padding-bottom: 10px;
            margin-bottom: 0 !important;
        }

        .content-block h3 {
            font-size: 24px;
            font-family: iA Writer Duo, sans-serif;
        }



    }

    @media (max-width: 966px) {
        .timeline-container {
            padding: 0 25px
        }

        .timeline-image {
            max-width: 100%;
        }
        .timeline-image img {

            width: 150px;
        }
    }
</style>