<?php
/**
 * Template Name: Full Width Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package speak
 */

get_header(); ?>

	<div id="full-width">
		<section id="default-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'templates/parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</section>
	</div>

<?php get_footer();
