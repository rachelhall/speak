<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package speak
 */

get_header();
?>

	<div id="primary" class="index">
		<div class="body-overlay"></div>

		<section class="default-main">
			<div class="flex-container">
				<!-- Must Use PageBody -->
				<div class="flex-row">
					<div class="flex-col-md-8 flex-col-sm-10 flex-col-md-offset-2 flex-col-sm-offset-1">
						<?php
							if ( have_posts() ) :

								if ( is_home() && ! is_front_page() ) :
									?>
									<header>
										<h1 class="h1"><?php single_post_title(); ?></h1>
									</header>
									<?php
								endif;

								/* Start the Loop */
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
					</div>
				</div>
			</div>
		</section>

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
