<?php
/**
 * Customize Gutenberg / ACF Blocks
 *
 * @package speak
 * @since speak 1.0
 */


/**
 * Gutenberg scripts and styles
 * @see https://www.billerickson.net/wordpress-color-palette-button-styling-gutenberg
 */
function speak_editor_scripts(){
	wp_enqueue_script('speak-editor-js',get_stylesheet_directory_uri().'/js/editor.js',array('wp-blocks','wp-dom'),null,true);
}
add_action('enqueue_block_editor_assets','speak_editor_scripts' );


/**
 * Register custom Gutenberg block categories
 */
function speak_gb_categories($categories,$post){
  if($post->post_type !== 'post'){
    return $categories;
  }
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'your-category',
        'title' => __( 'Your Category','speak'),
        'icon'  => 'wordpress',
      ),
    )
  );
}
add_filter('block_categories','speak_gb_categories',10,2);


/**
 * 	Register custom ACF Gutenberg Blocks
 */
function speak_acf_blocks(){
	// check function exists
	if(function_exists('acf_register_block')){

		// Emample Block Registration
		// acf_register_block(array(
		// 	'name' => 'accordion',
		// 	'title' => __('Accordion'),
		// 	'description' => __('A custom accordion block.'),
		// 	'render_callback'	=> 'render_speak_acf_block',
		// 	'category' => 'your-category',
		// 	'icon' => 'list-view',
		// 	'keywords' => array('accordion'),
		// 	'supports' => array('align','true')
		// ));

	}
}
add_action('acf/init','speak_acf_blocks');

function render_speak_acf_block($block){
	// convert name ("acf/name") into path friendly slug ("name")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "templates/parts/blocks" folder
	if(file_exists(get_theme_file_path("/templates/parts/blocks/content-{$slug}.php"))){
		include( get_theme_file_path("/templates/parts/blocks/content-{$slug}.php"));
	}
}
