<?php $thumbnail = get_the_post_thumbnail_url(); ?>
<section class="default-hero" <?php if($thumbnail):?> style="background-image: url(<?php echo $thumbnail?>)"<?php endif;?>>
    <div class="container">
        <div class="center-text">
            <h1><?php the_title();?></h1>
        </div>
        <!-- /.center-text -->
    </div>
    <!-- /.container -->
</section>
<!-- /.default-hero -->