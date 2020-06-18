<?php
/**
 * Class for Company Info
 *
 * @package speak
 * @since speak 1.0
 */

// Generates social icon admin settings page
class company_info {
  // Holds the values to be used in the fields callbacks
  private $options;
  private $fields = array(
    'hours' => array(
      'type' => 'textarea',
      'label' => 'Business Hours',
      'id' => 'hours',
      'options' => null
    ),
    'address_street' => array(
      'type' => 'text',
      'label' => 'Street',
      'id' => 'address-street',
      'options' => null
    ),
    'address_city' => array(
      'type' => 'text',
      'label' => 'City',
      'id' => 'address-city',
      'options' => null
    ),
    'address_state' => array(
      'type' => 'select',
      'label' => 'State',
      'id' => 'address-state',
      'options' => array(
        'AL'=>'Alabama',
      	'AK'=>'Aaska',
      	'AZ'=>'Arizona',
      	'AR'=>'Arkansas',
      	'CA'=>'California',
      	'CO'=>'Colorado',
      	'CT'=>'Connecticut',
      	'DE'=>'Delaware',
      	'FL'=>'Florida',
      	'GA'=>'Georgia',
      	'HI'=>'Hawaii',
      	'ID'=>'Idaho',
      	'IL'=>'Illinois',
      	'IN'=>'Indiana',
      	'IA'=>'Iowa',
      	'KS'=>'Kansas',
      	'KY'=>'Kentucky',
      	'LA'=>'Louisiana',
      	'ME'=>'Maine',
      	'MD'=>'Maryland',
      	'MA'=>'Massachusetts',
      	'MI'=>'Michigan',
      	'MN'=>'Minnesota',
      	'MS'=>'Mississippi',
      	'MO'=>'Missouri',
      	'MT'=>'Montana',
      	'NE'=>'Nebraska',
      	'NV'=>'Nevada',
      	'NH'=>'New Hampshire',
      	'NJ'=>'New Jersey',
      	'NM'=>'New Mexico',
      	'NY'=>'New York',
      	'NC'=>'North Carolina',
      	'ND'=>'North Dakota',
      	'OH'=>'Ohio',
      	'OK'=>'Oklahoma',
      	'OR'=>'Oregon',
      	'PA'=>'Pennsylvania',
        'PR'=>'Puerto Rico',
      	'RI'=>'Rhode Island',
      	'SC'=>'South Carolina',
      	'SD'=>'South Dakota',
      	'TN'=>'Tennessee',
      	'TX'=>'Texas',
      	'UT'=>'Utah',
      	'VT'=>'Vermont',
      	'VA'=>'Virginia',
      	'WA'=>'Washington',
      	'WV'=>'West Virginia',
      	'WI'=>'Wisconsin',
      	'WY'=>'Wyoming'
      )
    ),
    'address_zip' => array(
      'type' => 'text',
      'label' => 'ZIP',
      'id' => 'address-zip',
      'options' => null
    ),
    'email' => array(
      'type' => 'email',
      'label' => 'Email',
      'id' => 'email',
      'options' => null
    ),
    'phone' => array(
      'type' => 'tel',
      'label' => 'Phone',
      'id' => 'phone',
      'options' => null
    ),
  );

  // Start up
  public function __construct() {
    add_action('admin_menu',array($this,'menu_register'));
    add_action('admin_init',array($this,'page_init'));
  }

  // Add options page
  public function menu_register(){
		add_options_page(__('Company Info','speak'),'Company Info','manage_options','company-info',array($this,'settings_page'));
	}

  // Options page callback
  public function settings_page(){
    $this->options = get_option('company_info'); ?>
    <div id="speak-page" class="settings-page">
      <form id="speak-settings" method="post" action="options.php">
        <header id="speak-masthead" class="speak-header">
          <h1 class="admin-title">Company Info</h1>
        </header>
        <main id="speak-main" class="options-main">
          <?php settings_fields('info_group');
            do_settings_sections('company-info'); ?>
        </main><!-- #speak-main .options-main -->
        <button type="submit" class="speak-btn"><i class="material-icons">refresh</i>Update</button>
      </form><!-- #speak-page .settings-page -->
    </div><!-- #speak-page .settings-page --><?php
  }

  // Register settings and add sections of fields
  public function page_init(){
    register_setting('info_group','company_info',array($this,'sanitize'));
    add_settings_section('info_section','',array($this,'setup_section'),'company-info');
  }

	// Add fields to each section
  public function setup_section($args){
		foreach($this->fields as $key => $args){
			add_settings_field($key,$args['label'],array($this,'setup_field'),'company-info','info_section',array_merge(array('name' => $key),$args));
		}
	}

	public function setup_field($args){
		$value = $this->options[$args['name']];
    if($args['type'] == 'select'){
      $options = '';
      foreach($args['options'] as $val => $key){
        $options .= '<option value="'.$val.'"'.($val == $value ? ' selected' : '').'>'.$key.'</option>';
      }
    }
    echo '<div class="column span-12">
      <label for="company-'.$args['id'].'" class="assistive-text">'.$args['label'].'</label>'.
      ($args['type'] == 'select'
        ? '<div class="select-wrap">
            <select id="company-'.$args['id'].'" name="company_info['.$args['name'].']">'.$options.'</select>
          </div>'
        : '<div class="input-wrap">'.
            ($args['type'] == 'textarea'
              ? '<textarea  id="company-'.$args['id'].'" name="company_info['.$args['name'].']">'.$value.'</textarea>'
              : '<input type="'.$args['type'].'" id="company-'.$args['id'].'" name="company_info['.$args['name'].']" value="'.$value.'" />'
            ).
          '</div>'
      ).
    '</div>';
	}

	// Sanitize each setting field as needed
  // @param array $input Contains all settings fields as array keys
  public function sanitize($input){
    $new_input = array();
		foreach($this->fields as $key => $args){
	    if(isset($input[$key]) && $input[$key] !== '') $new_input[$key] = sanitize_textarea_field($input[$key]);
		}
    return $new_input;
  }
}
if(is_admin()) $company_info = new company_info();

?>
