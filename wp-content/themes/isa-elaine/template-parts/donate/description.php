<section class="">
    <div class="container font-bodoni-italic-6">
        <?php if (get_sub_field('description')): ?>
            <?php echo wp_kses_post(get_sub_field('description')); ?>
        <?php endif; ?>
    </div>
</section>
