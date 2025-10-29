<?php get_header();
/**
 * Template name: Team page
 */
?>






<?php

//get_template_part('template-parts/general/content', 'default-hero');
function transformString($input)
{
    // Приведение строки к нижнему регистру
    $lowercase = strtolower($input);

    // Удаление всех знаков препинания с использованием регулярного выражения
    $cleaned = preg_replace('/[^\w\s]/u', '', $lowercase);

    // Замена пробелов на символ подчеркивания
    $result = str_replace(' ', '_', $cleaned);

    return $result;
}

?>




        <section id="team" class="board">

            <div class="container" >






                <div class="new-section back-link">
                   <a href="/home">
                       ← back
                   </a>
                </div>



                <?php if (get_field('title')): ?>
                    <h2 class="mb-5"><?php echo esc_html(get_field('title')); ?></h2>
                <?php endif; ?>

                <div class="team-container">

                    <?php while (have_rows('member_list')) : the_row(); ?>
                        <?php
                        $name = get_sub_field('full_name');
                        $title = get_sub_field('title');
                        $image = get_sub_field('image');
                        $bio = get_sub_field("read_bio");


                        $originalString = get_sub_field('full_name');
                        $transformedString = transformString($originalString);
                        ?>

                        <div class="team-item">


                            <div class="team-text-block">

                                <?php if ($image): ?>
                                    <div class="team-image">
                                        <img src="<?php echo esc_url($image); ?>" alt="">
                                    </div>
                                <?php endif; ?>


                                <?php if ($name): ?>
                                    <h3 class="team-name mb-2"><?php echo esc_html($name); ?></h3>
                                <?php endif; ?>

                                <?php if ($title): ?>
                                    <h4 class="team-title mb-4"><?php echo esc_html($title); ?></h4>
                                <?php endif; ?>

                                <div class="bio-button">
                                    <a data-fancybox-close-button="false" data-fancybox
                                       data-src="#hidden-bio-<?php echo $transformedString; ?>"
                                       href="javascript:;">Read Bio <span>→</span></a>
                                </div>
                            </div>


                        </div>
                        <?php if ($bio): ?>
                            <div class="hidden-content" id="hidden-bio-<?php echo $transformedString; ?>">
                                <!-- Sticky Close Button -->
                                <button type="button"
                                        class="fancybox-custom-close fancybox-button fancybox-close-small"
                                        data-fancybox-close onclick="$.fancybox.close();">
                                    <svg xmlns='http://www.w3.org/2000/svg'
                                         width='20'
                                         height='20'
                                         viewBox='0 0 24 24'>
                                        <path d='M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z'
                                              fill='rgba(240,245,250,.6)'/>
                                    </svg>
                                </button>
                                <!-- content -->
                                <div class="fancybox-content-padding">
                                    <?php echo $bio; ?>
                                </div>

                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>

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




