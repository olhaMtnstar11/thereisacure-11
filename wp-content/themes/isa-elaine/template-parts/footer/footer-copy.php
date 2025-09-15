

<div class="footer-copy center-text flex flex-column" >


    <div style="margin-bottom: 20px">
        <?php
        $social_links = get_field('social_links', 'option');

        if ($social_links): ?>
            <ul class="social-links">
                <?php foreach ($social_links as $social):
                    $network = $social['social_network']; // Selected social network (Facebook, Instagram, etc.)
                    $icon = $social['icon']; // Icon HTML (FontAwesome, etc.)
                    $link = $social['link']; // Social media URL
                    ?>
                    <li>
                        <a href="<?php echo esc_url($link); ?>" target="_blank">
                            <?php echo $icon ? $icon : esc_html($network); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>



    </div>




    <div>
        <?php echo get_field('federal', 'option')?>
    </div>
    <div>
        © <?php echo date("Y"); ?> <?php echo get_field('copyright', 'option')?>
    </div>

</div>
<!-- /.flex footer-copy -->
