<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package speak
 */

if(!function_exists('speak_posted_on')){
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function speak_posted_on(){
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if(get_the_time('U') !== get_the_modified_time('U')){
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf($time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('Posted on %s','post date','speak'),
			'<a href="'.esc_url(get_permalink()).'" rel="bookmark">'.$time_string.'</a>'
		);

		echo '<span class="posted-on">'.$posted_on.'</span>'; // WPCS: XSS OK.
	}
}

if(!function_exists('speak_posted_by')){
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function speak_posted_by(){
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s','post author','speak'),
			'<span class="author vcard"><a class="url fn n" href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'">'.esc_html(get_the_author()).'</a></span>'
		);

		echo '<span class="byline"> '.$byline.'</span>'; // WPCS: XSS OK.
	}
}

if(!function_exists('speak_entry_footer')){
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function speak_entry_footer(){
		// Hide category and tag text for pages.
		if('post' === get_post_type()){
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(',', 'speak'));
			if($categories_list){
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">'.esc_html__('Posted in %1$s','speak').'</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(',', 'list item separator','speak'));
			if($tags_list){
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">'.esc_html__('Tagged %1$s','speak').'</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if(!is_single() && !post_password_required() && (comments_open() || get_comments_number())){
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>','speak'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>','speak'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if(!function_exists('speak_post_thumbnail')){
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div element when on single views.
	 */
	function speak_post_thumbnail(){
		if(post_password_required() || is_attachment() || !has_post_thumbnail()) return;

		if(is_singular()){ ?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php } else { ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail('post-thumbnail',array(
					'alt' => the_title_attribute(array(
						'echo' => false,
					)),
				)); ?>
			</a>

		<?php } // End is_singular().
	}
}


/**
 * Returns true if a blog has more than 1 category
 *
 * @since speak 1.0
 */
function speak_categorized_blog(){
  if(false === ($all_the_cool_cats = get_transient('all_the_cool_cats'))){
    // Create an array of all the categories that are attached to posts
    $all_the_cool_cats = get_categories(array('hide_empty' => 1,));
    // Count the number of categories that are attached to the posts
    $all_the_cool_cats = count($all_the_cool_cats);
    set_transient('all_the_cool_cats',$all_the_cool_cats);
  }
  if('1' != $all_the_cool_cats){ return true; } else{ return false; }
}


/**
 * Flush out the transients used in speak_categorized_blog
 *
 * @since speak 1.0
 */
function speak_category_transient_flusher(){ delete_transient('all_the_cool_cats'); }
add_action('edit_category','speak_category_transient_flusher');
add_action('save_post','speak_category_transient_flusher');


if(!function_exists('speak_content_nav')):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since speak 1.0
 */
function speak_content_nav($nav_id){
  global $wp_query,$post;
  // Don't print empty markup on single pages if there's nowhere to navigate.
  if(is_single()){
    $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false,'',true);
    $next = get_adjacent_post(false,'',false);
    if(!$next && !$previous) return;
  }
  // Don't print empty markup in archives if there's only one page.
  if($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search())) return;
  $nav_class = 'site-navigation paging-navigation';
  if(is_single()) $nav_class = 'site-navigation post-navigation';
  ?>
  <nav role="navigation" id="<?php $output .= $nav_id; ?>" class="<?php $output .= $nav_class; ?>">
    <h1 class="assistive-text"><?php _e('Post navigation','speak'); ?></h1>
    <?php
      if(is_single()) :
        previous_post_link('<div class="nav-previous">%link</div>','<span class="meta-nav">'._x('&larr;','Previous post link','speak').'</span> %title');
        next_post_link('<div class="nav-next">%link</div>','%title <span class="meta-nav">'._x('&rarr;','Next post link','speak').'</span>');
      elseif($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home,archive,and search pages
        if(get_next_posts_link()) : ?>
          <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts','speak')); ?></div>
        <?php endif;
        if(get_previous_posts_link()) : ?>
          <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>','speak')); ?></div>
        <?php endif;
      endif;
    ?>
  </nav><!-- #<?php $output .= $nav_id; ?> -->
  <?php
}
endif; // speak_content_nav


/**
 * Context specific search form
 *
 * @since speak 1.0.0
 */
if(!function_exists('speak_search_form')) :
function speak_search_form($context){
  ?><form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">

    <div class="form-row">
      <label for="<?php echo $context; ?>-searchfield" class="assistive-text"><?php _e('Search','speak'); ?></label>
      <div class="input-wrap">
        <input type="text" id="<?php echo $context; ?>-searchfield" class="field" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search &hellip;','speak'); ?>" />
      </div>
    </div><!-- .form-row -->

    <div class="form-row">
      <button type="submit" class="button submit">Search</button>
    </div><!-- .form-row -->

  </form><?php
}
endif; // ends check for speak_search_form()


if(!function_exists('speak_comment')) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since speak 1.0
 */
function speak_comment($comment,$args,$depth){
  $GLOBALS['comment'] = $comment;

  switch ($comment->comment_type) :
    case 'pingback' :
    case 'trackback' : ?>
      <li class="post pingback">
        <p><?php _e('Pingback:','speak'); echo ' '; comment_author_link(); edit_comment_link(__('(Edit)','speak'),' '); ?></p><?php
      break;

    default : ?>
    <li <?php comment_class('anim'); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment-block">
        <header>
          <div class="author-info">
            <h4 class="comment-meta">
              <span class="comment-author"><?php
              echo get_comment_author_link();
              ?></span> | <time pubdate datetime="<?php comment_time('c'); ?>"><?php printf(__('%1$s','speak'),get_comment_date('m.d.Y')); ?></time>
            </h4>
          </div>
          <?php if($comment->comment_approved == '0') : ?>
            <h6><?php _e('This comment is in review.','speak'); ?></h6>
          <?php endif; ?>
        </header>

        <div class="comment-content"><?php comment_text(); ?></div>

        <div class="reply">
          <?php comment_reply_link(array_merge($args,array('depth' => $depth,'max_depth' => $args['max_depth']))); ?>
        </div><!-- .reply -->
      </article><!-- #comment-## -->
      <?php break;

  endswitch;
  ?></li><?php
}
endif; // ends check for speak_comment()


/**
 * Custom Breadcrumb
 *
 * @since speak 1.0
 */
function speak_breadcrumb($reverse = false){

  // Settings
  $separator        = '<i class="material-icons">keyboard_arrow_right</i>';
  $breadcrums_id    = 'breadcrumb-list';
  $breadcrums_class = 'breadcrumb'.($reverse ? ' reverse' : '');
  $home_title       = 'Home';

  // If you have any custom post types with custom taxonomies,put the taxonomy name below (e.g. product_cat)
  $custom_taxonomy  = 'null';

  // Get the query & post information
  global $post, $wp_query;

  // Do not display on the homepage
  if(!is_front_page()){

    // Build the breadcrums
    $output = '<ul id="'.$breadcrums_id.'" class="'.$breadcrums_class.'">';

    // Home page
    $output .= '<li class="item-home"><a class="bread-link bread-home" href="'.get_home_url().'" title="'.$home_title.'">'.$home_title.'</a></li>';
    $output .= '<li class="separator separator-home">'.$separator.'</li>';

    if(is_archive() && !is_tax() && !is_category() && !is_tag()){
      $output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">'.post_type_archive_title($prefix,false).'</span></li>';
    } elseif(is_archive() && is_tax() && !is_category() && !is_tag()){

        // If post is a custom post type
        $post_type = get_post_type();

        // If it is a custom post type display name and link
        if($post_type != 'post'){
          $post_type_object = get_post_type_object($post_type);
          $post_type_archive = get_post_type_archive_link($post_type);

          $output .= '<li class="item-cat item-custom-post-type-'.$post_type.'"><a class="bread-cat bread-custom-post-type-'.$post_type.'" href="'.$post_type_archive.'" title="'.$post_type_object->labels->name.'">'.$post_type_object->labels->name.'</a></li>';
          $output .= '<li class="separator">'.$separator.'</li>';
        }

        $custom_tax_name = get_queried_object()->name;
        $output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">'.$custom_tax_name.'</span></li>';

    } elseif(is_single()){

        // If post is a custom post type
        $post_type = get_post_type();

        // If it is a custom post type display name and link
        if($post_type != 'post'){
          $post_type_object = get_post_type_object($post_type);
          $post_type_archive = get_post_type_archive_link($post_type);

          $output .= '<li class="item-cat item-custom-post-type-'.$post_type.'"><a class="bread-cat bread-custom-post-type-'.$post_type.'" href="'.$post_type_archive.'" title="'.$post_type_object->labels->name.'">'.$post_type_object->labels->name.'</a></li>';
          $output .= '<li class="separator">'.$separator.'</li>';
        }

        // Get post category info
        $category = get_the_category();

        if(!empty($category)){
          // Get last category post is in
          $last_category = end(array_values($category));

          // Get parent any categories and create array
          $get_cat_parents = rtrim(get_category_parents($last_category->term_id,true,','),',');
          $cat_parents = explode(',',$get_cat_parents);

          // Loop through parent categories and store in variable $cat_display
          $cat_display = '';
          foreach($cat_parents as $parents){
            $cat_display .= '<li class="item-cat">'.$parents.'</li>';
            $cat_display .= '<li class="separator">'.$separator.'</li>';
          }
        }

        // If it's a custom post type within a custom taxonomy
        $taxonomy_exists = taxonomy_exists($custom_taxonomy);
        if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists){
          $taxonomy_terms = get_the_terms($post->ID,$custom_taxonomy);
          $cat_id         = $taxonomy_terms[0]->term_id;
          $cat_nicename   = $taxonomy_terms[0]->slug;
          $cat_link       = get_term_link($taxonomy_terms[0]->term_id,$custom_taxonomy);
          $cat_name       = $taxonomy_terms[0]->name;
        }

        // Check if the post is in a category
        if(!empty($last_category)){
          $output .= $cat_display;
          $output .= '<li class="item-current item-'.$post->ID.'"><span class="bread-current bread-'.$post->ID.'" title="'.get_the_title().'">'.get_the_title().'</span></li>';

        // elseif post is in a custom taxonomy
        } elseif(!empty($cat_id)){
          $output .= '<li class="item-cat item-cat-'.$cat_id.' item-cat-'.$cat_nicename.'"><a class="bread-cat bread-cat-'.$cat_id.' bread-cat-'.$cat_nicename.'" href="'.$cat_link.'" title="'.$cat_name.'">'.$cat_name.'</a></li>';
          $output .= '<li class="separator">'.$separator.'</li>';
          $output .= '<li class="item-current item-'.$post->ID.'"><span class="bread-current bread-'.$post->ID.'" title="'.get_the_title().'">'.get_the_title().'</span></li>';
        } else{
          $output .= '<li class="item-current item-'.$post->ID.'"><span class="bread-current bread-'.$post->ID.'" title="'.get_the_title().'">'.get_the_title().'</span></li>';
        }

    } elseif(is_category()){

      // Category page
      $output .= '<li class="item-current item-cat"><span class="bread-current bread-cat">'.single_cat_title('',false).'</span></li>';

    } elseif(is_page()){

      // Standard page
      if($post->post_parent){

        // If child page,get parents
        $anc = get_post_ancestors($post->ID);

        // Get parents in the right order
        $anc = array_reverse($anc);

        // Parent page loop
        if(!isset($parents)) $parents = null;
        foreach ($anc as $ancestor){
          $parents .= '<li class="item-parent item-parent-'.$ancestor.'"><a class="bread-parent bread-parent-'.$ancestor.'" href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
          $parents .= '<li class="separator separator-'.$ancestor.'">'.$separator.'</li>';
        }

        // Display parent pages
        $output .= $parents;

        // Current page
        $output .= '<li class="item-current item-'.$post->ID.'"><span title="'.get_the_title().'"> '.get_the_title().'</span></li>';

      } else{
        // Just display current page if not parents
        $output .= '<li class="item-current item-'.$post->ID.'"><span class="bread-current bread-'.$post->ID.'"> '.get_the_title().'</span></li>';
      }

    } elseif(is_tag()){ // Tag page

      // Get tag information
      $term_id        = get_query_var('tag_id');
      $taxonomy       = 'post_tag';
      $args           = 'include='.$term_id;
      $terms          = get_terms($taxonomy,$args);
      $get_term_id    = $terms[0]->term_id;
      $get_term_slug  = $terms[0]->slug;
      $get_term_name  = $terms[0]->name;

      // Display the tag name
      $output .= '<li class="item-current item-tag-'.$get_term_id.' item-tag-'.$get_term_slug.'"><span class="bread-current bread-tag-'.$get_term_id.' bread-tag-'.$get_term_slug.'">'.$get_term_name.'</span></li>';

    } elseif(is_day()){ // Day archive

      // Year link
      $output .= '<li class="item-year item-year-'.get_the_time('Y').'"><a class="bread-year bread-year-'.get_the_time('Y').'" href="'.get_year_link(get_the_time('Y')).'" title="'.get_the_time('Y').'">'.get_the_time('Y').' Archives</a></li>';
      $output .= '<li class="separator separator-'.get_the_time('Y').'">'.$separator.'</li>';

      // Month link
      $output .= '<li class="item-month item-month-'.get_the_time('m').'"><a class="bread-month bread-month-'.get_the_time('m').'" href="'.get_month_link(get_the_time('Y'),get_the_time('m')).'" title="'.get_the_time('M').'">'.get_the_time('M').' Archives</a></li>';
      $output .= '<li class="separator separator-'.get_the_time('m').'">'.$separator.'</li>';

      // Day display
      $output .= '<li class="item-current item-'.get_the_time('j').'"><span class="bread-current bread-'.get_the_time('j').'"> '.get_the_time('jS').' '.get_the_time('M').' Archives</span></li>';

    } elseif(is_month()){ // Month Archive

      // Year link
      $output .= '<li class="item-year item-year-'.get_the_time('Y').'"><a class="bread-year bread-year-'.get_the_time('Y').'" href="'.get_year_link(get_the_time('Y')).'" title="'.get_the_time('Y').'">'.get_the_time('Y').' Archives</a></li>';
      $output .= '<li class="separator separator-'.get_the_time('Y').'">'.$separator.'</li>';

      // Month display
      $output .= '<li class="item-month item-month-'.get_the_time('m').'"><span class="bread-month bread-month-'.get_the_time('m').'" title="'.get_the_time('M').'">'.get_the_time('M').' Archives</span></li>';

    } elseif(is_year()){

      // Display year archive
      $output .= '<li class="item-current item-current-'.get_the_time('Y').'"><span class="bread-current bread-current-'.get_the_time('Y').'" title="'.get_the_time('Y').'">'.get_the_time('Y').' Archives</span></li>';

    } elseif(is_author()){ // Auhor archive

      // Get the author information
      global $author;
      $userdata = get_userdata($author);

      // Display author name
      $output .= '<li class="item-current item-current-'.$userdata->user_nicename.'"><span class="bread-current bread-current-'.$userdata->user_nicename.'" title="'.$userdata->display_name.'">'.'Author: '.$userdata->display_name.'</span></li>';

    } elseif(get_query_var('paged')){

      // Paginated archives
      $output .= '<li class="item-current item-current-'.get_query_var('paged').'"><span class="bread-current bread-current-'.get_query_var('paged').'" title="Page '.get_query_var('paged').'">'.__('Page').' '.get_query_var('paged').'</span></li>';

    } elseif(is_search()){

      // Search results page
      $output .= '<li class="item-current item-current-'.get_search_query().'"><span class="bread-current bread-current-'.get_search_query().'" title="Search results for: '.get_search_query().'">Search results for: '.get_search_query().'</span></li>';

    } elseif(is_404()){
      // 404 page
      $output .= '<li>'.'Error 404'.'</li>';
    }
    $output .= '</ul>';
  }

  return $output;
}
