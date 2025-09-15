<section class="board">
    <?php if (have_rows('board')): $k=0;?>

        <?php while (have_rows('board')): the_row(); $k++;?>
            <!-- Heading вынесен за пределы container -->
            <div class="heading center-text" id="board-heading-<?php echo $k?>">
                <?php the_sub_field('heading', false, false); ?>
            </div>
            <!-- /.heading center-text -->           
            <?php if (have_rows('list')):  ?>
                <div class="container">
                    <div class="board-list">
                        <?php while (have_rows('list')): the_row();  ?>
                            <div class="board-list-item flex">
                                <?php $image = get_sub_field('image'); ?>
                                <div class="board-list-item-thumb">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                                    <?php endif; ?>
                                </div>
                                <!-- /.board-list-item-thumb -->
                                <div class="board-list-item-text">
                                    <h3><?php the_sub_field('title'); ?></h3>
                                    <h4><?php the_sub_field('subtitle'); ?></h4>
                                    <?php if (have_rows('jumplinks')):  ?> 
                                        <ul>
                                            <?php while (have_rows('jumplinks')): the_row(); ?>
                                                <li><a href="#<?php the_sub_field('jumplink'); ?>"><?php the_sub_field('jumplink_name'); ?></a></li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif;?>
                                  
                               </div>
                               <!-- /.board-list-item-text -->
                           </div>
                           <!-- /.board-list-item -->
                             <?php if (have_rows('bio_blocks')):  ?> 
                                       <div class="bio-blocks-list">
                                           <?php while (have_rows('bio_blocks')): the_row(); ?>
                                            <div class="bio-blocks-list-item" id="<?php the_sub_field('jumplink_id'); ?>">
                                                <?php the_sub_field('text'); ?>
                                            </div>
                                           <?php endwhile; ?>
                                       </div>
                                   <?php endif;?>
                       <?php endwhile; ?>
                   </div>
                   <!-- /.board-list -->
               </div>
               <!-- /.container -->
           <?php endif; ?>
       <?php endwhile; ?>

   <?php endif; ?>
</section>
<!-- /.board -->
