<?php
$array = get_field('map');

if (is_array($array) && array_filter($array)):
    while (have_rows('map')) : the_row();


        // Get subfields
        $title = get_sub_field('title');
        $image = get_sub_field('image'); // URL
        $patients = get_sub_field('patients');
        $top_researchers = get_sub_field('top_researchers');

        $pin_image = get_sub_field('pin_image'); // URL


        ?>

        <script>
            const customPinImage = "<?php echo esc_url($pin_image); ?>";
        </script>
        <section id="map" class="research-map-section scroll-section">
            <div class="map-container">
                <?php if ($title): ?>
                    <h3 class="section-title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
                <div class="map-content-wrapper">


                    <!-- Map Image -->
                    <?php if ($image): ?>
                        <div class="map-box" style="    width: 100%;">
                            <div class="usa-map">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                <div class="pin pin-left"></div>
                                <div class="pin pin-right"></div>

                                <!-- dynamic pins will appear here -->
                                <div class="dynamic-pins"></div>


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
                                    <span class="partners-title"
                                          id="partners-title">Research Partners (0/<?php echo count($partners); ?>)</span>

                                </div>

                                <ul class="partner-list">
                                    <?php foreach ($partners as $index => $partner):
                                        $title = $partner['title'];
                                        $description = $partner['description'];

                                        $state = $partner['state']; // new ACF state field


                                        // Convert to safe file part: lowercase + replace spaces with hyphens
                                        $state_slug = strtolower(str_replace(' ', '-', trim($state)));

                                        // Build final image path
                                        $partner_map_image = get_template_directory_uri() . '/assets/img/state-map/usa-map-' . $state_slug . '.svg';

                                        // $partner_map_image = $partner['image']; // new image field

                                        // Make first partner active + checked
                                        $activeClass = ($index === 0) ? 'active checked' : '';
                                        ?>
                                        <li class="partner-item <?php echo $activeClass; ?>"
                                            data-state="<?php echo esc_attr($state_slug); ?>"
                                            data-image="<?php echo esc_url($partner_map_image); ?>">

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

    .research-map-section p {
        font-size: 13px;
        margin-bottom: 0 !important;
    }

    .map-container {
        margin-bottom: 100px;
        width: 100%;
        max-width: 930px;
    }

    /* Wrapper for map image + stats + partners */
    .map-content-wrapper {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        /* gap: 30px;  spacing between map and stats */
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

    .section-title h2 {
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
        color: #555;
        margin-bottom: 15px;
    }

    .map-box {
        text-align: center;

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


    .dynamic-pins {
        position: absolute;
        top: 0;
        left: 0;
        width: 10%;;
        height: 100%;
    }

    .dynamic-pin {
        position: absolute;
        transform: translate(-50%, -100%);
        width: 3.5%; /* scales with the map image */
        height: auto;
        pointer-events: none;
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

        margin-top: 3px;
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


    @media (max-width: 966px) {

        /* Wrapper for map image + stats + partners */
        .map-content-wrapper {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;

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

        .research-map-section p {
            font-size: 11px;
            margin-bottom: 0 !important;
        }


        .label {
            font-size: 9px;
        }

        .value {
            font-size: 20px;
        }


    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ---- state coordinates (keys are human-readable; we normalize later) ----
        const stateCoordinates = {
            "ca": {x: 95, y: 48},
            "or": {x: 115, y: 25},
            "pa": {x: 847, y: 35},
            "tx": {x: 480, y: 70},

            "fl": {x: 815, y: 78},
            "ga": {x: 755, y: 64},
        };

        // build a case-insensitive lookup (trimmed)
        const coordLookup = {};
        Object.keys(stateCoordinates).forEach(k => {
            coordLookup[k.trim().toLowerCase()] = stateCoordinates[k];
        });

        // helpers
        const partnerListSelector = '.partner-list';
        const partnerItemSelector = '.partner-item';
        const partnerTopSelector = '.partner-top';
        const dynamicPinsSelector = '.dynamic-pins';
        const partnersTitleId = 'partners-title';

        const partnerList = document.querySelector(partnerListSelector);
        const pinContainer = document.querySelector(dynamicPinsSelector);
        const partnerTitle = document.getElementById(partnersTitleId);

        if (!partnerList) {
            console.warn('Partner list element not found (".partner-list").');
            return;
        }
        if (!pinContainer) {
            console.warn('Pin container not found (".dynamic-pins").');
            return;
        }

        // attach listeners to each partner-top (checkbox and dropdown)
        document.querySelectorAll(partnerTopSelector).forEach(top => {
            const checkbox = top.querySelector('.partner-color');
            const toggleTargets = top.querySelectorAll('.partner-toggle, .partner-name');
            const parentItem = top.closest(partnerItemSelector);

            if (!parentItem) return;

            // checkbox toggles .checked and updates pins/count
            if (checkbox) {
                checkbox.addEventListener('click', (e) => {
                    e.stopPropagation();
                    parentItem.classList.toggle('checked');
                    updateCheckedCount();
                    updatePins();
                });
            }

            // name / plus toggles dropdown (and closes others)
            toggleTargets.forEach(target => {
                target.addEventListener('click', (e) => {
                    e.stopPropagation();
                    // close others
                    document.querySelectorAll(partnerItemSelector).forEach(item => {
                        if (item !== parentItem) item.classList.remove('active');
                    });
                    parentItem.classList.toggle('active');
                });
            });
        });

        // create/refresh partnerItems NodeList on demand
        function getPartnerItems() {
            return Array.from(document.querySelectorAll(partnerItemSelector));
        }

        function updateCheckedCount() {
            const partnerItems = getPartnerItems();
            const checkedCount = partnerItems.filter(i => i.classList.contains('checked')).length;
            const totalCount = partnerItems.length;
            if (partnerTitle) {
                partnerTitle.textContent = `Research Partners (${checkedCount}/${totalCount})`;
            }
        }

        function updatePins() {
            // clear old pins
            pinContainer.innerHTML = '';

            const partnerItems = getPartnerItems().filter(i => i.classList.contains('checked'));

            const mapContainer = document.querySelector('.usa-map');

            // remove old overlay images
            mapContainer.querySelectorAll('.partner-map-overlay').forEach(el => el.remove());

            partnerItems.forEach(item => {
                const coords = coordLookup[item.getAttribute('data-state').trim().toLowerCase()];
                if (!coords) return;

                const partnerNameEl = item.querySelector('.partner-name');
                const partnerName = partnerNameEl ? partnerNameEl.textContent.trim() : '';

                // --- Add pin ---
                const pin = document.createElement('img');
                pin.className = 'dynamic-pin';
                pin.src = customPinImage;
                pin.style.position = 'absolute';
                pin.style.zIndex = '111';
                pin.style.left = coords.x + '%';
                pin.style.top = coords.y + '%';
                pin.style.transform = 'translate(-50%, -100%)';
                pin.dataset.partnerName = partnerName;
                pinContainer.appendChild(pin);

                // --- Add partner overlay image on the map ---
                const overlaySrc = item.getAttribute('data-image');
                if (overlaySrc) {
                    const overlay = document.createElement('img');
                    overlay.className = 'partner-map-overlay';
                    overlay.src = overlaySrc;
                    overlay.style.position = 'absolute';
                    overlay.style.top = 0;
                    overlay.style.left = 0;
                    overlay.style.width = '100%';

                    overlay.style.objectFit = 'contain';
                    overlay.style.pointerEvents = 'none'; // clicks go through to pins
                    overlay.dataset.partnerName = partnerName;

                    mapContainer.appendChild(overlay);
                }
            });
        }

        // Initialize on load (handles PHP-set "active checked" first item)
        updateCheckedCount();
        updatePins();

        // (Optional) If you add partners dynamically later, you can call these again.
    });
</script>
