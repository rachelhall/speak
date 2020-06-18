<?php
/**
 * Extends WPBakery Page Builder
 *
 * @package speak
 * @since speak 1.0
 */

function extend_vc() {

  /**
   * Remove Non-essential Built-in Visual Composer Elements
   */
  vc_remove_element('layerslider_vc');
  vc_remove_element('rev_slider_vc');
  vc_remove_element('vc_accordion_tab');
  vc_remove_element('vc_accordion');
  vc_remove_element('vc_basic_grid_filter');
  vc_remove_element('vc_basic_grid');
  vc_remove_element('vc_btn');
  vc_remove_element('vc_button');
  vc_remove_element('vc_button2');
  vc_remove_element('vc_carousel');
  //vc_remove_element('vc_column_inner');
  //vc_remove_element('vc_column_text');
  //vc_remove_element('vc_column');
  vc_remove_element('vc_cta_button');
  vc_remove_element('vc_cta_button2');
  vc_remove_element('vc_cta');
  vc_remove_element('vc_custom_field');
  vc_remove_element('vc_custom_heading');
  vc_remove_element('vc_empty_space');
  vc_remove_element('vc_facebook');
  vc_remove_element('vc_flickr');
  vc_remove_element('vc_gallery');
  vc_remove_element('vc_gitem_animated_block');
  vc_remove_element('vc_gitem_block');
  vc_remove_element('vc_gitem_col');
  vc_remove_element('vc_gitem_image');
  vc_remove_element('vc_gitem_post_author');
  vc_remove_element('vc_gitem_post_categories');
  vc_remove_element('vc_gitem_post_data');
  vc_remove_element('vc_gitem_post_meta');
  vc_remove_element('vc_gitem_row');
  vc_remove_element('vc_gitem_zone_c');
  vc_remove_element('vc_gitem_zone');
  vc_remove_element('vc_gitem');
  vc_remove_element('vc_gmaps');
  vc_remove_element('vc_googleplus');
  vc_remove_element('vc_hoverbox');
  vc_remove_element('vc_icon');
  vc_remove_element('vc_images_carousel');
  vc_remove_element('vc_item');
  vc_remove_element('vc_items');
  vc_remove_element('vc_line_chart');
  vc_remove_element('vc_masonry_grid');
  vc_remove_element('vc_masonry_media_grid');
  vc_remove_element('vc_media_grid');
  vc_remove_element('vc_message');
  vc_remove_element('vc_pie');
  vc_remove_element('vc_pinterest');
  vc_remove_element('vc_posts_grid');
  vc_remove_element('vc_posts_slider');
  vc_remove_element('vc_progress_bar');
  //vc_remove_element('vc_raw_html');
  //vc_remove_element('vc_raw_js');
  vc_remove_element('vc_round_chart');
  //vc_remove_element('vc_row_inner');
  //vc_remove_element('vc_row');
  //vc_remove_element('vc_section');
  vc_remove_element('vc_separator');
  vc_remove_element('vc_single_image');
  vc_remove_element('vc_tab');
  vc_remove_element('vc_tabs');
  vc_remove_element('vc_text_separator');
  vc_remove_element('vc_toggle');
  vc_remove_element('vc_tour');
  vc_remove_element('vc_tta_global');
  vc_remove_element('vc_tta_pageable_section');
  vc_remove_element('vc_tta_section');
  vc_remove_element('vc_tta_accordion');
  vc_remove_element('vc_tta_pageable');
  vc_remove_element('vc_tta_section');
  vc_remove_element('vc_tta_tabs');
  vc_remove_element('vc_tta_tour');
  vc_remove_element('vc_tweetmeme');
  vc_remove_element('vc_video');
  vc_remove_element('vc_widget_sidebar');
  vc_remove_element('vc_wp_archives');
  vc_remove_element('vc_wp_calendar');
  vc_remove_element('vc_wp_categories');
  vc_remove_element('vc_wp_custommenu');
  vc_remove_element('vc_wp_links');
  vc_remove_element('vc_wp_meta');
  vc_remove_element('vc_wp_pages');
  vc_remove_element('vc_wp_posts');
  vc_remove_element('vc_wp_recentcomments');
  vc_remove_element('vc_wp_rss');
  vc_remove_element('vc_wp_search');
  vc_remove_element('vc_wp_tagcloud');
  vc_remove_element('vc_wp_text');
  vc_remove_element('vc_zigzag');


  /**
   * Remove default edit Fields
   */
  vc_remove_param('vc_section','full_width');
  vc_remove_param('vc_section','full_height');
  vc_remove_param('vc_section','content_placement');
  vc_remove_param('vc_section','video_bg');
  vc_remove_param('vc_section','video_bg_url');
  vc_remove_param('vc_section','video_bg_parallax');
  vc_remove_param('vc_section','parallax');
  vc_remove_param('vc_section','parallax_image');
  vc_remove_param('vc_section','parallax_speed_video');
  vc_remove_param('vc_section','parallax_speed_bg');
  vc_remove_param('vc_section','disable_element');
  vc_remove_param('vc_section','css');
  vc_remove_param('vc_section','css_animation');
  vc_remove_param('vc_row','full_width');
  vc_remove_param('vc_row','gap');
  vc_remove_param('vc_row','full_height');
  vc_remove_param('vc_row','columns_placement');
  vc_remove_param('vc_row','equal_height');
  vc_remove_param('vc_row','rtl_reverse');
  vc_remove_param('vc_row','content_placement');
  vc_remove_param('vc_row','video_bg');
  vc_remove_param('vc_row','video_bg_url');
  vc_remove_param('vc_row','video_bg_parallax');
  vc_remove_param('vc_row','parallax');
  vc_remove_param('vc_row','parallax_image');
  vc_remove_param('vc_row','parallax_speed_video');
  vc_remove_param('vc_row','parallax_speed_bg');
  vc_remove_param('vc_row','disable_element');
  vc_remove_param('vc_row','css');
  vc_remove_param('vc_row','css_animation');
  vc_remove_param('vc_row_inner','equal_height');
  vc_remove_param('vc_row_inner','rtl_reverse');
  vc_remove_param('vc_row_inner','content_placement');
  vc_remove_param('vc_row_inner','gap');
  vc_remove_param('vc_row_inner','disable_element');
  vc_remove_param('vc_row_inner','css');
  vc_remove_param('vc_row_inner','css_animation');
  vc_remove_param('vc_column','video_bg');
  vc_remove_param('vc_column','video_bg_url');
  vc_remove_param('vc_column','video_bg_parallax');
  vc_remove_param('vc_column','parallax');
  vc_remove_param('vc_column','parallax_image');
  vc_remove_param('vc_column','parallax_speed_video');
  vc_remove_param('vc_column','parallax_speed_bg');
  vc_remove_param('vc_column','css');
  vc_remove_param('vc_column','css_animation');
  //vc_remove_param('vc_column','width');
  vc_remove_param('vc_column','offset');
  vc_remove_param('vc_column_inner','css');
  vc_remove_param('vc_column_inner','css_animation');
  //vc_remove_param('vc_column_inner','width');
  vc_remove_param('vc_column_inner','offset');
  vc_remove_param('vc_single_image','css_animation');
  vc_remove_param('vc_gallery','css_animation');
  vc_remove_param('vc_video','css_animation');
  vc_remove_param('vc_column_text','css');
  vc_remove_param('vc_column_text','css_animation');
  vc_remove_param('vc_icon','type');
  vc_remove_param('vc_icon','icon_openiconic');
  vc_remove_param('vc_icon','icon_typicons');
  vc_remove_param('vc_icon','icon_entypo');
  vc_remove_param('vc_icon','icon_linecons');
  vc_remove_param('vc_icon','icon_monosocial');
  vc_remove_param('vc_icon','icon_material');
  vc_remove_param('vc_icon','color');
  vc_remove_param('vc_icon','custom_color');
  vc_remove_param('vc_icon','background_style');
  vc_remove_param('vc_icon','background_color');
  vc_remove_param('vc_icon','custom_background_color');
  vc_remove_param('vc_icon','size');
  vc_remove_param('vc_icon','align');
  vc_remove_param('vc_icon','css');
  vc_remove_param('vc_icon','css_animation');


  /**
   * Set edit fields of base essential elements
   */
  $section_params = array(
    // Add Section Parameters
  );
  vc_add_params('vc_section',$section_params);

  $row_params = array(
    // Add Row Parameters
 );
  vc_add_params('vc_row',$row_params);

  $row_inner_params = array(
    // Add Inner Row Parameters
 );
  vc_add_params('vc_row_inner',$row_inner_params);

  $text_params = array(
    // Add Text Block Parameters
 );
  vc_add_params('vc_column_text',$text_params);

  $col_params = array(
    // Add Column Parameters
  );
  vc_add_params('vc_column',$col_params);
  vc_add_params('vc_column_inner',$col_params);


  /**
   * Register custom elements
   */
  // Example Element Registration
  // vc_map(
  //   array(
  //     'name' => __('Element Title','speak'),
  //   	'base' => 'shortcode',
  //   	'icon' => 'icon name or path',
  //   	'category' => array(
  //   		__('Content','extend_vc'),
  //   	),
  //   	'description' => __('The element description.','extend_vc'),
  //   	'params' => array(
  //       // Param Fields
  //     ),
  //   )
  // );

}
add_action('vc_before_init','extend_vc');

?>
