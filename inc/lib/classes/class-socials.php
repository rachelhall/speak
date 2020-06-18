<?php
/**
 * Classes for Social Icons
 *
 * @package speak
 * @since speak 1.0
 */

// Generates social icon admin settings page
class social_settings {
  // Holds the values to be used in the fields callbacks
  private $options;
	private $fields = array(
		'Facebook'  => 'facebook',
		'LinkedIn'  => 'linkedin',
		'Twitter'   => 'twitter',
		'Instagram' => 'instagram',
		'YouTube'   => 'youtube'
	);

  // Start up
  public function __construct() {
    add_action('admin_menu',array($this,'menu_register'));
    add_action('admin_init',array($this,'page_init'));
  }

  // Add options page
  public function menu_register(){
		add_options_page(__('Social Icons','speak'),'Social Icons','manage_options','social-icons',array($this,'settings_page'));
	}

  // Options page callback
  public function settings_page(){
    $this->options = get_option('socials_settings'); ?>
    <div id="speak-page" class="settings-page">
      <form id="speak-settings" method="post" action="options.php">
        <header id="speak-masthead" class="speak-header">
          <h1 class="admin-title">Social Icons</h1>
        </header>
        <main id="speak-main" class="options-main">
          <?php settings_fields('socials_group');
            do_settings_sections('socials-settings'); ?>
        </main><!-- #speak-main .options-main -->
        <button type="submit" class="speak-btn"><i class="material-icons">refresh</i>Update</button>
      </form><!-- #speak-page .settings-page -->
    </div><!-- #speak-page .settings-page --><?php
  }

  // Register settings and add sections of fields
  public function page_init(){
    register_setting('socials_group','socials_settings',array($this,'sanitize'));
    add_settings_section('socials_section','',array($this,'setup_section'),'socials-settings');
  }

	// Add fields to each section
  public function setup_section($args){
		foreach($this->fields as $key => $value){
			add_settings_field($value,$key,array($this,'setup_field'),'socials-settings','socials_section',array('key' => $key,'value' => $value));
		}
	}

	public function setup_field($args){
		$settings = unserialize($this->options[$args['value']]);
    printf(
      '<div class="column span-3">
        <label for="%1$s_check" class="toggle-switch">
          Show %2$s
          <input type="checkbox" id="%1$s_check" name="socials_settings[%1$s][check]" value="true" %3$s />
          <span class="slider-wrap">
            <span class="slider"></span>
          </span>
        </label>
      </div>',
			$args['value'],
			$args['key'],
      $settings['check'] == 'true' ? 'checked="checked"' : ''
    );
    printf(
      '<div class="column span-9">
        <label for="%1$s_link" class="assistive-text">%3$s Link</label>
        <input type="text" id="%1$s_link" name="socials_settings[%1$s][link]" value="%2$s" />
      </div>',
      $args['value'],
      isset($settings['link']) ? esc_attr($settings['link']) : '',
      $args['key']
    );
		printf('<input type="hidden" name="socials_settings[%1$s][name]" value="%1$s" />',$args['value']);
		printf('<input type="hidden" name="socials_settings[%1$s][label]" value="%2$s" />',$args['value'],$args['key']);
	}

	// Sanitize each setting field as needed
  // @param array $input Contains all settings fields as array keys
  public function sanitize($input){
    $new_input = array();
		foreach($this->fields as $field){
	    if(isset($input[$field]) && (isset($input[$field]['check']) || isset($input[$field]['link']))) $new_input[$field] = serialize($input[$field]);
		}
    return $new_input;
  }
}
if(is_admin()) $social_sets = new social_settings();


// Generates custom social icons widget
class social_icons extends WP_Widget {

  function __construct(){
    parent::__construct(
      'social_icons',
      __('Social Icons','speak'),
      array('description' => __('Social Media Icons','speak'),)
    );
  }

  // Create widget output
  public function widget($args,$instance){
    $title = apply_filters('widget_title',$instance['title']);
    $socials = get_option('socials_settings');
		$output = '';

    // Before and after widget arguments are defined by themes
    $output .= $args['before_widget'].
			(!empty($title) ? $args['before_title'].$title.$args['after_title'] : '').
			'<nav class="site-navigation social-navigation">
				<ul class="menu">';
					if($socials && !empty($socials)){
						foreach($socials as $social){
							$social = unserialize($social);
							if($social['check'] && $social['check'] == 'true'){
								$output .= '<li><a href="'.$social['link'].'" target="_blank" title="'.$social['label'].'"><img src="'.get_stylesheet_directory_uri().'/inc/assets/icons/si/si-'.$social['name'].'.svg" alt="'.get_bloginfo('name').' '.$social['label'].'" /></a></li>';
							}
						}
					}
    		$output .= '</ul>
			</nav><!-- .site-naviation .social-navigation -->'.
		$args['after_widget'];

		// Output markup
		echo $output;
  }

  // Widget Backend
  public function form($instance){
    if(isset($instance['title' ])){ $title = $instance['title']; }
    else { $title = __('Social Icons','speak'); }

    // Widget admin form
    ?>
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </p>
    <?php
  }

  // Updating widget replacing old instances with new
  public function update($new_instance,$old_instance){
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    return $instance;
  }
} // social_icons

?>
