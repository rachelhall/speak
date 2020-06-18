<?php
/**
 * The template for displaying the sidecar menu
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package speak
 */

?>

<nav id="sidecar" class="slide-right">
	<button type="button" class="close-sidecar">Close</button>
	<div class="mainnav">
		<?php wp_nav_menu(array(
			'menu' => 'Main Nav',
			'theme_location' => '',
			'container_class' => 'menu'));
		?>
	</div>
</nav>