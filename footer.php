<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package speak
 */

?>

	</div><!-- #content -->

	<footer>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf( esc_html__( 'Web Design by %2$s.', 'speak' ), 'speak', '<a href="https://madebyspeak.com/">speak Creative</a>' );
		?>		
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
