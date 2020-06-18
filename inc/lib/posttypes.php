<?php
/**
 * speak post type and taxonomy registration
 *
 * @package speak
 * @since speak 1.0
 */

// Example Post Type Options
// array(
//   'slug' => 'speak_events', // required, what to target when querying posts from this post type
//   'label_plural' => 'Events', // required
//   'label_singular' => 'Event', // required
//   'hierarchical' => false, // required, whether the posts can have child posts
//   'supports' => array('title','editor','revisions','excerpt','thumbnail'), // required, default permissions, hooks and fields to support
//   'rewrite' => 'events', // required, URL extension before post URL
//   'pos' => 4, // required, position in the admin navigation, starts at 4
//   'icon' => 'dashicons-calendar', // required, https://developer.wordpress.org/resource/dashicons/ for options
//   'taxes' => array(), // optional, options for adding categories and tags taxonomies
//   'desc' => 'Calendar events and learning series.' // optional, description that appears on the posts archive in the admin
// ),

// Example Taxonomies options
// 'taxes' => array(
//   'cat' => 'speak_events_tax', // slug of categories taxonomy
//   'tag' => 'speak_events_tag' // slug of tags taxonomy
// ),

// Registers the new post type and taxonomy
function speak_post_type_init() {

  // Sets up the universal labels for category taxonomies and tag taxonomies
  $tax_labels = array(
    'name' => _x('Categories','taxonomy general name','speak-tax'),
    'singular_name' => _x('Category','taxonomy singular name','speak-tax'),
    'search_items' => __('Search Categories','speak-tax'),
    'all_items' => __('All Categories','speak-tax'),
    'parent_item' => __('Parent Category','speak-tax'),
    'parent_item_colon' => __('Parent Category:','speak-tax'),
    'edit_item' => __('Edit Category','speak-tax'),
    'update_item' => __('Update Category','speak-tax'),
    'add_new_item' => __('Add New Category','speak-tax'),
    'new_item_name' => __('New Category Name','speak-tax'),
    'menu_name' => __('Categories','speak-tax'),
  );
  $tag_labels = array(
    'name' => _x('Tags','taxonomy general name'),
    'singular_name' => _x('Tag','taxonomy singular name'),
    'search_items' =>  __('Search Tags'),
    'popular_items' => __('Popular Tags'),
    'all_items' => __('All Tags'),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __('Edit Tag'),
    'update_item' => __('Update Tag'),
    'add_new_item' => __('Add New Tag'),
    'new_item_name' => __('New Tag Name'),
    'separate_items_with_commas' => __('Separate tags with commas'),
    'add_or_remove_items' => __('Add or remove tags'),
    'choose_from_most_used' => __('Choose from the most used tags'),
    'menu_name' => __('Tags'),
  );

  // Add new post types and optionally add categories and tags by duplicating the inner array and replacing the values
  $ptypes = array(
    // YOUR POST TYPES AND TAXONOMIES
  );

  // Registers all custom post types listed in $ptypes array
  foreach($ptypes as $pt){
    register_post_type(
      $pt['slug'],
      array(
        'labels' => array(
          'name' => __($pt['label_plural']),
          'singular_name' => __($pt['label_singular']),
          'add_new' => __('Add '.$pt['label_singular']),
          'add_new_item' => __('Add '.$pt['label_singular']),
          'edit_item' => __('Edit '.$pt['label_singular']),
          'new_item' => __('Add '.$pt['label_singular']),
          'view_item' => __('View '.$pt['label_plural']),
          'search_items' => __('Search '.$pt['label_plural']),
          'not_found' => __('No '.$pt['slug'].' found'),
          'not_found_in_trash' => __('No '.$pt['slug'].' found in trash')
        ),
        'public' => true,
        'has_archive' => true,
        'hierarchical' => $pt['hierarchical'],
        'supports' => $pt['supports'],
        'capability_type' => 'post',
        'rewrite' => array("slug" => $pt['rewrite']),
        'menu_position' => $pt['pos'],
        'menu_icon' => $pt['icon'],
        'taxonomies' => $pt['taxes'],
        'description' => __($pt['desc'],$pt['slug']),
      )
    );
    if(isset($pt['taxes']) && !empty($pt['taxes'])){
      foreach($pt['taxes'] as $tax => $slug){
        register_taxonomy(
          $slug,
          $pt['slug'],
          array(
            'hierarchical' => ($tax == 'cat' ? true : false),
            'labels' => ($tax == 'cat' ? $tax_labels : $tag_labels),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $pt['rewrite'].($tax == 'cat' ? '-categories' : '-tags'))
          )
        );
      }
    }
  }

}
add_action('init','speak_post_type_init',1,0);

?>
