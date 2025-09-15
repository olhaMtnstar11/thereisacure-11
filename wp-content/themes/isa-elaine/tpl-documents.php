<?php get_header();
/**
 * Template name: Documents page
 */
?>


<?php

$image_mobile = get_field('image');
$image_desktop = get_field('image_desktop');

?>


<section id="documents" class="plain-text">




    <div class="new-section back-link">
        <a href="/home">
            ← back
        </a>
    </div>







    <div class="new-section">
        <?php if (get_field('title')): ?>
            <h2 class="mb-4">Documents</h2>
        <?php endif; ?>




    </div>


    <div class="new-section">


            <div class="documents-column">



                <?php
                while (have_posts()) : the_post(); ?>



                            <?php
                            $documents = get_field('attached_documents'); // relationship field
                            if ($documents):
                                foreach ($documents as $doc):
                                    $file = get_field('file', $doc->ID); // file field from 'document' CPT
                                    $icon = get_field('icon', $doc->ID); // optional icon/image field
                                    $pdf_label = get_the_title($doc->ID); // use the document title
                                    ?>

                                    <?php if ($icon || $file): ?>
                                    <div class="download-block">
                                        <!-- LEFT COLUMN -->
                                        <div class="download-block-left font-ia-writer-duo">
                                            <?php if ($file): ?>
                                                <?php if ($icon): ?>
                                                    <a href="<?php echo esc_url($file['url']); ?>" target="_blank">
                                                        <img src="<?php echo esc_url($icon); ?>" alt="">
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?php echo esc_url($file['url']); ?>" target="_blank" class="">
                                                    <p class="download-block-title">
                                                        <?php echo esc_html($pdf_label); ?> ↗
                                                    </p>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php
                                endforeach;
                            else:
                                echo '<p>No documents attached.</p>';
                            endif;
                            ?>



                <?php endwhile;?>



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



<?php endif; ?>




<!-- Thin Line Div -->
<div class="line-container">
    <div class="section-line-with-squares">
        <div class="square left"></div>
        <div class="section-line"></div>
        <div class="square right"></div>
    </div>
</div>




<?php
get_footer();
?>




<style>
    .new-section {
        width: 100%;
        padding-left: 26%;
        margin-right: auto;
        margin-left: auto;
    }

    .new-section h2{
        padding-bottom: 40px;
    }




    .vertical-center p{
        padding-left: 10px;
    }

    .three-column-grid {
        gap: 17px;
        display: grid;
        grid-template-columns: 25% 75%;
        margin-bottom: 2.1em;
    }
    .documents-column {
        display: flex;
        flex-wrap: wrap;
        gap: 40px; /* controls space between items */
        justify-content: flex-start;
        align-items: flex-start;
        font-size: 20px;
        line-height: 1.6;
        text-align: left;
    }

    /* Child block inside (like .download-block) */
    .documents-column > .download-block {
        flex: 1 1 calc(50% - 20px); /* two per row with gap accounted */
        box-sizing: border-box;
    }




    @media (max-width: 966px) {
        .documents-column {
            gap: 20px;
        }

        .download-block-left img {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .new-section {
            max-width: 930px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .new-section h2 {
            padding-bottom: 20px;
        }

        .new-section-content {
            padding: 0 25px;
            text-align: left;
        }

        .three-column-grid {
            gap: 0;
        }



        .three-column-grid {
            grid-template-columns: 1fr; /* stack in mobile */
            margin-bottom: 0px;
        }



        .vertical-center p {
            max-width: 300px;
        }

        .documents-column img {
            max-width: 300px;

        }
    }


</style>