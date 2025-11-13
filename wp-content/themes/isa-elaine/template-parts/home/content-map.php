<?php
$array = get_field('map');

if (is_array($array) && array_filter($array)):
    while (have_rows('map')) : the_row();


        // Get subfields
        $title = get_sub_field('title');
        $image = get_sub_field('image'); // URL
        $patients = get_sub_field('patients');
        $top_researchers = get_sub_field('top_researchers');

        ?>


        <section id="map" class="research-map-section scroll-section">
            <div class="map-container">
                <?php if ($title): ?>
                    <h3 class="section-title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
<div class="map-content-wrapper" >





    <!-- Map Image -->
    <?php if ($image): ?>
        <div class="map-box" style="    width: 100%;">
            <div class="usa-map">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                <div class="pin pin-left"></div>
                <div class="pin pin-right"></div>
            </div>
        </div>
    <?php endif; ?>




    <div style="    width: 100%;">


        <div class="stats">
            <?php if ($patients): ?>
                <div class="stat">
                    <span class="label">Patients</span>
                    <span class="value"><?php echo esc_html($patients); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($top_researchers): ?>
                <div class="stat">
                    <span class="label">Top Researchers</span>
                    <span class="value"><?php echo esc_html($top_researchers); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <?php
        $partners = get_sub_field('research_partners');

        if ($partners && is_array($partners)): ?>
            <div class="partners">
                <div class="partners-header">
                    <span class="partners-title" id="partners-title">Research Partners (0/<?php echo count($partners); ?>)</span>

                </div>

                <ul class="partner-list">
                    <?php foreach ($partners as $index => $partner):
                        $title = $partner['title'];
                        $description = $partner['description'];

                        // Make first partner active + checked
                        $activeClass = ($index === 0) ? 'active checked' : '';
                        ?>
                        <li class="partner-item <?php echo $activeClass; ?>">
                            <div class="partner-top">
                                <span class="partner-color"></span>
                                <span class="partner-name"><?php echo esc_html($title); ?></span>
                                <span class="partner-toggle">+</span>
                            </div>
                            <?php if ($description): ?>
                                <div class="partner-dropdown">
                                    <?php echo wp_kses_post($description); ?>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        <?php endif; ?>



    </div>




</div>








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


<style>
    .research-map-section {
        font-family: iA Writer Duo, sans-serif;
        padding: 130px 20px 0 20px !important;

        height: auto; /* allow height to adjust */
        justify-content: flex-start !important;
    }
    .research-map-section p{
   font-size: 13px;
        margin-bottom: 0 !important;
    }

    .map-container {
        width: 100%;
        max-width: 930px;
    }
    /* Wrapper for map image + stats + partners */
    .map-content-wrapper {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        gap: 30px; /* spacing between map and stats */
        justify-content: space-between;
        align-items: flex-start;
    }

    .section-title {
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
        color: #555;
        margin-bottom: 15px;
    }
    .section-title h2{
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
        color: #555;
        margin-bottom: 15px;
    }
    .map-box {
        text-align: center;
        margin-bottom: 25px;
        position: relative;
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        flex-direction: column;
        justify-content: center;



    }

    .usa-map {
        position: relative;
        display: inline-block;
        width: 100%;
        max-width: 400px;
    }

    .usa-map img {
        width: 100%;
        height: auto;
    }

    .pin {
        width: 18px;
        height: 24px;
        background: #e63946;
        clip-path: polygon(50% 0%, 100% 40%, 50% 100%, 0% 40%);
        position: absolute;
    }

    .pin-left {
        top: 25%;
        left: 20%;
    }

    .pin-right {
        top: 20%;
        right: 22%;
    }

    .stats {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .stat {
        background: #d8e6fb;
        padding: 5px 10px;
        text-align: center;
        width: 100%;
    }

    .label {
        display: block;
        text-transform: uppercase;
        font-size: 12px;
        color: #555;
        margin-bottom: 5px;
    }

    .value {
        font-size: 26px;
        font-weight: bold;
        color: #002b5c;
    }

    .partners {

        border-radius: 6px;

    }

    .partners-header {
        margin-bottom: 10px;
    }

    .partners-title {
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
    }

    .partner-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .partner-item {

        margin-bottom: 3px;
        overflow: hidden;
    }

    .partner-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 10px;
        cursor: pointer;
        background: #cfe0ff;
    }



    .partner-color {
        width: 14px;
        height: 14px;
        border: 2px solid #002b5c;
        margin-right: 8px;
        background-color: transparent; /* unchecked by default */
        transition: background 0.3s;
        cursor: pointer;
    }

    /* checked state */
    .partner-item.checked .partner-color {
        background-color: #e63946;
    }





    .partner-name {
        flex: 1;
        font-size: 13px;
    }


    .partner-toggle {
        font-weight: bold;
        color: #002b5c;
        font-size: 18px;
        display: flex; /* use flex to align the + properly */
        align-items: center; /* center vertically */
        justify-content: center; /* center horizontally */
        transition: transform 0.3s;
        transform-origin: center center; /* rotate exactly in center */
    }

    /* Rotate 45 degrees when parent is active */
    .partner-item.active .partner-toggle {
        transform: rotate(45deg);
    }

    /* dropdown hidden by default */
    .partner-dropdown {
        display: none;
        border: 2px solid #e6efff;
       background-color: white;
        padding: 8px 15px;
        font-size: 13px;

        margin-top: 5px;
        margin-left: 30px;
    }

    /* dropdown visible when active */
    .partner-item.active .partner-dropdown {
        display: block;
    }

    /* RESPONSIVE */


    @media (max-width: 1400px) {



        /* Wrapper for map image + stats + partners */
        .map-content-wrapper {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            gap: 30px;
            justify-content: space-between;
            align-items: flex-start;
        }

        .map-container {
            width: 100%;
            max-width: 100%;
        }


        .usa-map {

            max-width: 100%;
        }

    }



    @media (max-width: 768px) {

        /* Wrapper for map image + stats + partners */
        .map-content-wrapper {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            gap: 30px; /* spacing between map and stats */
            justify-content: space-between;
            align-items: flex-start;
        }

        .research-map-section {
            padding: 60px 80px;
        }

        .stats {
            gap: 20px;
        }

        .stat {
            min-width: 180px;

        }

        .value {

        }
    }
</style>

<script>
    document.querySelectorAll('.partner-top').forEach(top => {
        const checkbox = top.querySelector('.partner-color');
        const toggleTargets = top.querySelectorAll('.partner-toggle, .partner-name'); // toggle dropdown on name or plus
        const parentItem = top.parentElement;

        // Checkbox click: toggle checked state independently
        checkbox.addEventListener('click', (e) => {
            e.stopPropagation();
            parentItem.classList.toggle('checked');
            updateCheckedCount(); // update counter if using (X/Y)
        });

        // Dropdown click: toggle only this dropdown, close others
        toggleTargets.forEach(target => {
            target.addEventListener('click', (e) => {
                e.stopPropagation();

                // Close all other dropdowns
                document.querySelectorAll('.partner-item').forEach(item => {
                    if (item !== parentItem) {
                        item.classList.remove('active');
                    }
                });

                // Toggle this one
                parentItem.classList.toggle('active');
            });
        });
    });

    // Optional: update count for X/Y in title
    const partnerTitle = document.getElementById('partners-title');
    const partnerItems = document.querySelectorAll('.partner-item');

    function updateCheckedCount() {
        const checkedCount = document.querySelectorAll('.partner-item.checked').length;
        const totalCount = partnerItems.length;
        partnerTitle.textContent = `Research Partners (${checkedCount}/${totalCount})`;
    }

    // Initialize count on page load
    updateCheckedCount();

</script>
