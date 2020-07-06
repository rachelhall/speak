<?php
/**
 * Template Name: Teacher Programs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package speak
 */

get_header(); ?>

<div id="full-width">
    <section id="home-main" style="overflow: hidden;">
        <div class="teacher-programs-hero" style="background-image: url('<?php the_field('background_image') ?>')">
            <div class="teacher-programs-hero__overlay">
                <div class="teacher-programs-hero__screen"></div>
            </div>

            <div class="teacher-programs-hero__copy">
                <div class="teacher-programs-hero__copy--container">
                    <div class="teacher-programs-hero__copy--bold">
                        <p><?php the_field('title')?></p>

                    </div>

                </div>
            </div>
        </div>
        <div class="teacher-programs-content">
            <div class="teacher-programs-content__left">
                <div class="teacher-programs-content__left--heading">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/teacher-programs-heading-background.svg' ?>"" alt="">
                    <p>Teacher Programs</p>
                </div>
                <?php get_template_part( 'templates/parts/blocks/teacher-programs-menu'  )?>
                <div class=" teacher-programs-content__left--paper-icons">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/PaperairplaneDrawing.svg' ?>"
                        alt="">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/symbols-drawing.svg' ?>" alt="">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/StarDrawing.svg' ?>" alt="">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/PaperclipDrawing.svg' ?>" alt="">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/LightbulbDrawing.svg' ?>" alt="">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/LightbulbDrawing.svg' ?>" alt="">
                </div>
            </div>
            <div class=" teacher-programs-content__right">
                <div class="yellow-lines">
                    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/lines-yellow.svg' ?>" alt="">
                </div>
                <div class="description">
                    <p>Man Up Teacher Fellows will have an opportunity to earn a Master’s of Education degree at
                        Blue
                        Mountain College and RELAY Graduate School Of Education at no cost and earn an additional
                        $5,000
                        per year in addition to their salary for up to three years!</p>
                </div>
                <div class="teacher-programs-content__right--qualifications">
                    <div class="background-image">
                        <img src="<?php echo get_template_directory_uri() . '/public/SVGs/qualifications-background.svg' ?>"" alt="">
                    </div>
                    <h3><?php the_field('qualifications_heading') ?></h3>
                    <?php the_field('qualifications_list') ?>
                </div>
                <div class=" teacher-programs-content__right--statistic">
                        <p>Men of color make up less than <img class="CircleForStats"
                                src="<?php echo get_template_directory_uri() . '/public/SVGs/two-percent.svg' ?>"
                                alt="">of the
                            nation's teachers.</p>
                        <p>Man up teacher fellowship, inc. is changing this!</p>

                    </div>
                    <div class="teacher-programs-content__editor">
                        <?php the_field('program_description') ?>
                    </div>
                </div>
            </div>
    </section>
</div>

<?php get_footer();