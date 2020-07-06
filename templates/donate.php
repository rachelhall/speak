<?php
/**
 * Template Name: Donate
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package speak
 */

get_header(); ?>

<div id="full-width">
    <section id="home-main" style="overflow: hidden;">
        <div class="donate-hero" style="background-image: url('<?php the_field('background_image') ?>')">
            <div class="donate-hero__overlay">
                <div class="donate-hero__screen"></div>
            </div>

            <div class="donate-hero__copy">
                <div class="donate-hero__copy--container">
                    <div class="donate-hero__copy--bold">
                        <p><?php the_field('title')?></p>
                    </div>
                    <div class="donate-hero__copy--subtitle">
                        <p><?php the_field('subtitle')?></p>
                    </div>

                </div>
            </div>

        </div>
        <!-- <?php 	get_template_part( 'templates/parts/blocks/whyManup' ); ?> -->
        <div class="donate-content">
            <div class="donate-content">
                <div class="donate-item">
                    <div class="notepaper">
                        <p>Men of color make up less than 2% of the nation's teachers. Manup Teacher Fellowship Inc. is
                            changing this!</p>
                    </div>
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/lines-yellow.svg' ?>">
                </div>
                <div class="donate-item">
                    <div class="picture-caption">
                        <img src="<?php echo get_template_directory_uri() . '/public/images/current-fellows.jpg' ?>">
                        <p class='picture-caption__heading'>Man Up Program</p>
                        <p class='description'>Men of color make up less than 2% of the nation's teachers. Manup Teacher
                            Fellowship Inc. is
                            changing this!</p>
                    </div>
                </div>
                <div class="donate-item">
                    <div class="notepaper">
                        <p>Men of color make up less than 2% of the nation's teachers. Manup Teacher Fellowship Inc. is
                            changing this!</p>
                    </div>
                </div>
                <div class="donate-item">
                    <div class="picture-caption">
                        <img src="<?php echo get_template_directory_uri() . '/public/images/current-fellows.jpg' ?>">
                        <p class='picture-caption__heading'>Fellows Program</p>
                        <p class='description'>Men of color make up less than 2% of the nation's teachers. Manup Teacher
                            Fellowship Inc. is
                            changing this!</p>
                    </div>
                    <img class="blue-lines"
                        src="<?php echo get_template_directory_uri() . '/public/SVGs/lines-blue.svg' ?>">
                </div>
                <div class="donate-item">
                    <div class="picture-caption">
                        <img src="<?php echo get_template_directory_uri() . '/public/images/current-fellows.jpg' ?>">
                        <p class='picture-caption__heading'>Community Impact</p>
                        <p class='description'>Men of color make up less than 2% of the nation's teachers. Manup Teacher
                            Fellowship Inc. is
                            changing this!</p>
                    </div>
                    <img class="black-lines"
                        src="<?php echo get_template_directory_uri() . '/public/SVGs/lines-black.svg' ?>">
                </div>
                <div class="donate-item">
                    <h2>Donate</h2>
                    <p>$10 Goes to helping this thing</p>
                    <div class="form-options">
                        <div>$10</div>
                        <div>$20</div>
                        <div>$50</div>
                        <div>Donate</div>
                    </div>

                </div>
            </div>

        </div>


    </section>
</div>

<?php get_footer();