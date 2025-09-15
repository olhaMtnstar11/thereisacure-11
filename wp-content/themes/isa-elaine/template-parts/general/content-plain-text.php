<?php
$array = get_field('plain_text');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('plain_text')) : the_row(); ?>
        <section class="plain-text">
            <div class="container">
                <div class="heading center-text">
                    <?php the_sub_field('heading'); ?>
                </div>
                <!-- /.heading center-text -->
                <?php the_sub_field('text'); ?>
            </div>
            <!-- /.container -->
        </section>
        <!-- /.home-about -->
    <?php endwhile;endif; ?>
