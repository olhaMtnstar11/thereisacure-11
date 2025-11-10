<?php
$array = get_field('goal');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('goal')) : the_row(); ?>

        <?php
        $arrow_text = get_sub_field('arrow_text');
        $text_1 = get_sub_field('1_text');
        $amount = get_sub_field('amount');
        $text_2 = get_sub_field('2_text');

        $is_one_more = get_sub_field('one_more'); // true/false field

        $arrow_text2 = get_sub_field('arrow_text_2');
        $text_12 = get_sub_field('1_text_2');
        $amount2 = get_sub_field('amount_2');
        $text_22 = get_sub_field('2_text_2');
        ?>


        <section class="plain-text scroll-section ">
            <h2 > Goal </h2>

            <div class="stat-callout">
                <div class="goal-block" style="">
                    <div class="goal-text">
                        <p>
                            <em><?php echo esc_html($arrow_text); ?></em>
                        </p>
                    </div>
                    <div class="line-with-arrow">
                        <span class="line"></span>
                        <span class="arrow"></span>
                    </div>
                </div>
                <div class="funding-text">
                    <p class="over small-caps wide-letter-spacing"><?php echo esc_html($text_1); ?></p>
                    <p class="amount small-caps wide-letter-spacing">$ <span><?php echo esc_html($amount); ?></span></p>
                    <p class="sub small-caps wide-letter-spacing"><?php echo esc_html($text_2); ?></p>
                </div>
            </div>

            <!-- one more time  -->

            <?php if ($is_one_more): ?>




                <div class="stat-callout stat-callout-second">
                    <div class="funding-text funding-text-right">
                        <p class="over small-caps wide-letter-spacing"><?php echo esc_html($text_12); ?></p>
                        <p class="amount small-caps wide-letter-spacing">$
                            <span><?php echo esc_html($amount2); ?></span></p>
                        <p class="sub small-caps wide-letter-spacing"><?php echo esc_html($text_22); ?></p>
                    </div>
                    <div class=" goal-block goal-block-second" style="">

                        <div class="goal-text goal-text-right">
                            <p>
                                <em><?php echo esc_html($arrow_text2); ?></em>
                            </p>
                        </div>
                        <div class="line-with-arrow line-with-arrow-second">
                            <span class="arrow-right"></span>
                            <span class="line-right"></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <!-- /.home-about -->
    <?php endwhile;endif; ?>
<!-- Thin Line Div -->
<div class="line-container">
    <div class="section-line-with-squares">
        <div class="square left"></div>
        <div class="section-line"></div>
        <div class="square right"></div>
    </div>
</div>

<style>


    .stat-callout {
        display: flex ;
        align-items: center;
        justify-content: center ;
        flex-wrap: wrap ;
        flex-direction: row ;
        width: 100%;
        text-align: center;
        gap: 50px;
        margin: 0 0 0 0 ;
        padding: 20px 0 0 0;
        background-color: rgba(205, 183, 141, 0.06);
    }

    .stat-callout-second {
        margin: 0 0 0 0 ;
        gap: 50px;
    }


    .goal-block {
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    .goal-block-second {
        display: flex;
        flex-direction: column;
        width: 70%;
    }
    /* Left side text + arrow */
    .goal-text {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        position: relative;
        flex: 1;

        text-align: right;
        color: black;
        font-size: 27px;
        font-style: italic;
        line-height: 1.4;
    }

    .goal-text-right {

        justify-content: flex-start;
        text-align: left;
        font-size: 17px;
        color: #0867E8;
    }

    .goal-text p {
        margin-bottom: 15px;
    }

    .goal-text-right p {
        font-family: "iA Writer Duo", sans-serif;
        margin-bottom: 15px;
    }


    /* Center line with arrow */
    .line-with-arrow {
        display: flex;
        justify-content: center;
        flex: 0 0 15px;
        position: relative;
        align-items: flex-start;
    }



    .line-with-arrow .line {
        flex: 1;
        height: 2px;
        background-color: #0867E8;
    }

    .line-with-arrow .arrow {
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-left: 8px solid #0867E8;
        position: relative;
        top: -5px;
    }

    .line-with-arrow .arrow-right {
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 8px solid black; /* changed from border-left */
        position: relative;
        top: -5px;
    }


    .line-with-arrow .line-right {
        flex: 1;
        height: 2px;
        background-color: black;
    }


    /* Right side stats */
    .funding-text {
        flex: 1;
        min-width: 250px;
        text-align: left;
    }


    .funding-text .over {
        color: black;
        font-weight: 700;
        margin: 0;
        font-size: 27px;
    }

    .funding-text .amount {
        font-size: 90px;
        font-weight: 700;
        color: #0867E8;
        margin: 0;
        line-height: 0.9;
    }

    .funding-text .amount span {
        color: #0867E8;
    }

    .funding-text .sub {
        color: black;
        font-weight: 700;
        font-size: 27px;
        margin-top: 10px;
    }


    .funding-text-right {
        text-align: right;
    }

    .stat-callout-second .funding-text .amount span {
        color: #CDB78D;
    }

    .stat-callout-second .funding-text .amount {
        font-size: 45px;
        font-weight: 600;
        color: #CDB78D;
        margin: 0;
        line-height: 0.7;
    }

    .stat-callout-second .funding-text .sub {
        color: black;
        font-weight: 600;
        font-size: 17px;
        margin-top: 10px;
    }


    .stat-callout-second .funding-text .over {
        color: black;
        font-size: 17px;
    }


    @media (max-width: 1400px) {
        .home h2 {
            font-size: 52px;
            margin-bottom: 10px;
        }



.goal-text{
    font-size: 17px;
}

        .goal-text-right{
            font-size: 14px;
        }

        .funding-text .amount{
            font-size: 55px;
        }

        .stat-callout-second .funding-text .amount {
            font-size: 45px;
        }
    }

    /* Responsive */
    @media (max-width: 966px) {
        .stat-callout {
            flex-wrap: wrap;
            flex-direction: column;
            gap: 10px;
            padding: 50px 25px;
            margin: 20px 0;
        }
        .stat-callout-second {
            flex-direction: column-reverse;
        }


        .goal-block {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .goal-block-second {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .funding-text {
            flex: 1;
            min-width: 250px;
            text-align: left;
        }


        .funding-text .over {
            font-weight: 600;
            font-size: 21px;
            text-align: left;
        }

        .funding-text .amount {
            font-size: 60px;
            font-weight: 600;
            text-align: left;
        }


        .funding-text .sub {
            font-weight: 600;
            font-size: 21px;
            text-align: left;
        }





        .stat-callout-second .funding-text .amount {
            font-size: 40px;
            font-weight: 500;
            color: #CDB78D;
        }

        .stat-callout-second .funding-text .sub {
            font-weight: 500;
            font-size: 12px;
        }


        .stat-callout-second .funding-text .over {
            font-size: 12px;
        }





        .goal-text {
            justify-content: center;
            text-align: center;
        }

        .goal-text .arrow {
            display: none;
        }

        .funding-text {
            text-align: center;
        }

        .goal-text p {
            text-align: left;
        }
        .goal-text-right p {
    text-align: center;
        }



        .line-with-arrow {
            flex-direction: column; /* stack vertically */
            flex: 0 0 80px;
            align-items: center;
        }
        .line-with-arrow .line {
            width: 2px;
            height: 100px; /* adjust as needed */
        }

        .line-with-arrow .arrow {
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 8px solid #0867E8; /* arrow points down */
            top: 0;
        }

        .line-with-arrow-second{
            display: flex;
            flex-direction: column-reverse; /* arrow on top in markup, bottom visually */
            align-items: center;
            position: relative;
        }

        .line-with-arrow .line-right {
            width: 2px;
            height: 100px; /* adjust as needed */
            background-color: black;
        }

        .line-with-arrow .arrow-right {
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 8px solid black; /* arrow points down */
            position: relative;
            margin-top: -1px; /* small overlap */
        }

    }

</style>