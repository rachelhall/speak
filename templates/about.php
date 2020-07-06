<?php
/**
 * Template Name: About
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package speak
 */

get_header(); ?>

<div id="home">

    <section id="home-main" style="overflow: hidden;">
        <div class="hero" style="background-image: url('<?php the_field('background_image') ?>')">
            <!-- <div class="hero__image">
                <img src="<?php the_field('background_image') ?>" alt="">
            </div> -->

            <div class="hero__copy">
                <div class="hero__copy--container">
                    <div class="hero__copy--bold">
                        <p><?php the_field('title')?></p>
                    </div>
                    <div class="hero__copy--thin">
                        <img src="<?php echo get_template_directory_uri() . '/public/SVGs/GoldStroke.svg' ?>">
                        <p><?php the_field('subtitle')?></p>
                    </div>
                </div>
            </div>

        </div>
        <?php 	get_template_part( 'templates/parts/blocks/whyManup' ); ?>
        <?php 	get_template_part( 'templates/parts/blocks/quiz' ); ?>
        <?php 	get_template_part( 'templates/parts/blocks/fellows-banner' ); ?>
        <?php 	get_template_part( 'templates/parts/blocks/recent-posts' ); ?>
        <?php 	get_template_part( 'templates/parts/blocks/upcoming-events' ); ?>
    </section>

</div>

<?php get_footer();