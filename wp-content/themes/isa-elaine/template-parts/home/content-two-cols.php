<?php
$array = get_field('two_cols');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('two_cols')) : the_row(); ?>
        <section class="two-columns" id="contact">

            <div class="heading">
                <div class="container">
                    <?php the_sub_field('heading'); ?>
                </div>
            </div>
            <!-- /.heading center-text -->
            <div class="container">
                <div class="flex flex-align-center">
                    <div class="half two-columns-text">
                        <?php the_sub_field('left_column'); ?>
                    </div>
                    <!-- /.half -->

                    <div class="half two-columns-img">
                        <?php the_sub_field('right_column'); ?>
                    </div>
                    <!-- /.half -->
                </div>
                <!-- /.flex -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.two-cols -->
        <?php endwhile;endif; ?>
<!-- Thin Line Div -->
<div class="line-container">
    <div class="section-line-with-squares">
        <div class="square left"></div>
        <div class="section-line"></div>
        <div class="square right"></div>
    </div>
</div>