<?php get_header(); ?>


<div class="scroll-container">
<?php
get_template_part('template-parts/home/content', 'hero');
get_template_part('template-parts/home/content', 'line');
get_template_part('template-parts/home/content', 'goal');
get_template_part('template-parts/home/content', 'news');
get_template_part('template-parts/home/content', 'navigation-section');
get_template_part('template-parts/home/content', 'mission');



get_template_part('template-parts/home/content', 'story');


//get_template_part('template-parts/home/content', 'science');


//get_template_part('template-parts/home/content', 'faq');
//get_template_part('template-parts/home/content', 'key-points');
//get_template_part('template-parts/home/content', 'board');

get_template_part('template-parts/home/content', 'poem');




get_template_part('template-parts/home/content', 'two-cols');

?>
    <div class="scroll-section">
        <?php get_footer();?>
    </div>




</div>


