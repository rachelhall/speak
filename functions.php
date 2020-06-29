<?php
/**
 * speak functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package speak
 */

/**
 * Enqueue Admin Scripts and Styles
 */
function speak_admin_scripts(){
  wp_enqueue_script('media-upload');
  wp_enqueue_script('media');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('jq_input_mask',get_template_directory_uri().'/admin/js/jquery.input-mask.min.js',array('jquery'),false,true);
  wp_enqueue_script('speak_admin_js',get_template_directory_uri().'/admin/js/admin-min.js',array('jquery','media-upload','media','thickbox','jq_input_mask'),false,true);
}
function speak_admin_styles(){
  wp_enqueue_style('thickbox');
  wp_enqueue_style('md-icons','https://fonts.googleapis.com/css?family=Material+Icons|Roboto');
  wp_enqueue_style('speak_admin_css',get_template_directory_uri().'/admin/scss/admin.css');
}
add_action('admin_print_scripts','speak_admin_scripts');
add_action('admin_print_styles','speak_admin_styles');


/**
 * Theme includes and setup
 */
if(!function_exists('speak_setup')):
  function speak_setup(){
		// Theme includes
		require(get_template_directory().'/inc/lib/customizer.php');
    require(get_template_directory().'/inc/lib/helpers.php');
    require(get_template_directory().'/inc/lib/posttypes.php');
    require(get_template_directory().'/inc/lib/template-tags.php');
    foreach(glob(get_template_directory().'/inc/lib/classes/*.php') as $file) require($file);
    foreach(glob(get_template_directory().'/inc/lib/shortcodes/*.php') as $file) require($file);

    // Uncomment when using ACF blocks with Gutenberg
    // require(get_template_directory().'/inc/lib/acf/acf-blocks.php');

    // Uncomment when using WPBakery Page Builder
    // require(get_template_directory().'/inc/lib/vc/extend-vc.php');

		// Add translation support
    load_theme_textdomain('speak',get_template_directory().'/languages');

		// Add Theme supports
    add_theme_support('post-formats',array('link'));
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
		add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('html5',array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
		add_theme_support('custom-background',apply_filters('speak_custom_background_args',array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
		add_theme_support('custom-logo',array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));

		// Setup nav menus
    register_nav_menus(array('menu-1' => __('Primary Menu','speak')));
    register_nav_menus(array('menu-2' => __('Footer Menu','speak')));

		// Set initial global variable content width. Will be overridden by theme.
		$GLOBALS['content_width'] = apply_filters('speak_content_width',640);
  }
endif; // speak_setup
add_action('after_setup_theme','speak_setup');


/**
 * Enqueue scripts and styles
 */
function speak_scripts(){
  wp_enqueue_style('gfonts','https://fonts.googleapis.com/css?family=Playfair+Display|Roboto');
	wp_enqueue_style('speak-style',get_stylesheet_directory_uri().'/style.min.css',array(),null,'all');
	wp_enqueue_style('Font-Awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  if(is_singular() && comments_open() && get_option('thread_comments')){ wp_enqueue_script('comment-reply'); }

  wp_enqueue_script('jquery');
  wp_enqueue_script('speak-skip-link-focus-fix',get_stylesheet_directory_uri().'/js/external/skip-link-focus-fix.js',array(),'20190416',true);
	wp_enqueue_script('bootstrap_js','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js');
	wp_enqueue_script('modernizr_js',get_stylesheet_directory_uri().'/js/external/moderizr.flexbox.min.js',array(),'20190416',true);
	wp_register_script('helper_js',get_stylesheet_directory_uri().'/js/helper-min.js',array(),null,true);
	wp_localize_script('helper_js','myAjax',array('ajaxurl' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce("speak_ajax")));
	wp_enqueue_script('helper_js');
}
add_action('wp_enqueue_scripts','speak_scripts');


/**
 * Register widgetized area and update sidebar with default widgets
 */
function speak_widgets_init(){
	// Register widget areas
  register_sidebar(array(
    'name'          => esc_html__('Sidebar','speak'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.','speak'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Notification Bar','Speak'),
    'id'            => 'speak_notifications',
    'description'   => esc_html__('Place notifications to be visible by date here.','Speak'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '<span class="close-speak-notification" role="button" title="close notifications bar"><span class="assistive-text">Close Notifications Bar</span><i class="fa fa-times" aria-hidden="true"></i></span></div>',
    'before_title'  => '<h4 class="widget-title assistive-text">',
    'after_title'   => '</h4>',
  ));

	// Register widgets
  register_widget('social_icons');
  register_widget('speak_notification');
}
add_action('widgets_init','speak_widgets_init');


function manup_excerpt_length( $length ) {
  return 10;
}
add_filter( 'excerpt_length', 'manup_excerpt_length', 999 );