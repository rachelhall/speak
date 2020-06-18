<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package speak
 */

get_header(); ?>

	<div id="post">
		<section id="post-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'templates/parts/content', get_post_type() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</section>
	</div>

<?php get_footer();
