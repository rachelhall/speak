<?php
/**
 * Template Name: Home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package speak
 */

get_header(); ?>

<div id="home">
    <div class="body-overlay"></div>

    <section id="home-main">

        <?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>

        <?php
					endif;

					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'templates/parts/content', get_post_type() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'templates/parts/content', 'none' );

				endif;
			?>
    </section>

</div><!-- #primary -->

<aside id="secondary">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?php get_footer();