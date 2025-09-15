<?php
$array = get_field('contact');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('contact')) : the_row(); ?>
        <section class="contact" style="background-image: url(<?php the_sub_field('background'); ?>);">
            <div class="container">
                <div class="contact-content">
                    <div class="heading">
                        <?php the_sub_field('heading'); ?>
                    </div>
                    <!-- /.heading -->
                    <div class="contact-form">
                        <?php the_sub_field('form'); ?>
                    </div>
                    <!-- /.contact-form -->
                </div>
                <!-- /.contact-content -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.contact -->
    <?php endwhile;endif; ?>