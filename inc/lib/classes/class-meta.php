<?php
/**
 * Classes for Nav Walkers
 *
 * @package speak
 * @since speak 1.0
 */

// Example Meta Box Options
// array(
// 	'id' => 'meta-box-id', // required
// 	'title' => 'Meta Box Title', // required
// 	'post_type' => 'page', // required
// 	'pos' => 'side', // required
// 	'priority' => 'high', // required
//	'conditions' => array(), // optional
// 	'fields' => array(
// 		// Fields
// 	), // optional
// ),

// Example Conditions Options
// 'conditions' => array(
// 	'post_type' => 'page', // Can be any variable in the post object. Label must match the variable label in the post object followed by the desired value
// 	'meta' => array( // Show/hide metabox based on other meta field values
// 		array(
// 			'selector' => '#inspector-select-control-1', // Any valid css selector for the field to target
// 			'value' => 'home.php',
// 			'relation' => '==', // can be is, isnot, >, >=, <, <=, !, !=, !==, =, ==, ===
// 		),
// 	),
// ),

// Example Field Options
// array(
// 	'type' => 'single', // required, whether a single field or repeater
// 	'input' => 'textarea', // required, should correspond to a valid html input type
// 	'label' => 'Text Label', // required
// 	'id' => 'text-id', // required, what the label connects to
// 	'name' => 'text_field', // required, what the data will be saved under
// 	'options' => null, // required for selects, radios and checkboxes
// 	'atts' => null, // optional, string of additional attributes and values, e.g. ' placeholder="value"'
// 	'cols' => 12, // optional, how many columns in the metabox the field should span, based on 12 column grid
// 	'value' => null, // optional, set the default value
//	'conditions' => array(), // optional, show/hide this field based on value of other fields
// ),

// Example Options Array
// 'options' => array(
// 	'opt1' => 'Option 1', // syntax should be data-label => Pretty Title
// 	'opt2' => 'Option 2'
// ),

// Example Field Conditions Options
// 'conditions' => array(
// 	array(
// 		'selector' => '#inspector-select-control-1', // Any valid css selector for the field to target
// 		'value' => 'home.php',
// 		'relation' => '==', // can be is, isnot, >, >=, <, <=, !, !=, !==, =, ==, ===
// 	),
// ),

if(!class_exists('speak_meta')){
	class speak_meta {
		protected static $instance;
		private $meta = array();
		private $boxes = array(
			// YOUR META BOXES
		);

		public static function init(){
			null === self::$instance AND self::$instance = new self;
			return self::$instance;
		}

		public function __construct(){
			foreach($this->boxes as $box){
				foreach($box['fields'] as $field){ $this->meta[] = $field['name']; }
			}

			add_action('add_meta_boxes',array($this,'add_meta_boxes'),10,2);
			add_action('save_post',array($this,'save_meta'),10,2);
		}

		public function add_meta_boxes(){
			foreach($this->boxes as $box){
				$args = array_filter(array(
					'fields' => $box['fields'],
					'conditions' => (isset($box['conditions']['meta']) && !empty($box['conditions']['meta']))
						? $box['conditions']['meta']
						: ''
				));
				unset($box['conditions']['meta']);

				if(isset($box['conditions']) && !empty($box['conditions'])){
					$include = validate_post_values($box['conditions']);

					if($include === true){
						add_meta_box($box['id'],$box['title'],array($this,'render_meta_box'),$box['post_type'],$box['pos'],$box['priority'],$args);
						add_filter('postbox_classes_'.$box['post_type'].'_'.$box['id'],array($this,'add_metabox_classes'));
					}
				} else {
					add_meta_box($box['id'],$box['title'],array($this,'render_meta_box'),$box['post_type'],$box['pos'],$box['priority'],$args);
					add_filter('postbox_classes_'.$box['post_type'].'_'.$box['id'],array($this,'add_metabox_classes'));
				}
			}
		}

		public function add_metabox_classes($classes = array()){
			$new_classes = array('speak-meta-box','speak-toggleable');
			foreach($new_classes as $class){
				if(!in_array($class,$classes)) $classes[] = $class;
			}
		  return $classes;
		}

		public function render_meta_box($post,$args){
			wp_nonce_field(basename(__FILE__),'speak-meta-nonce');

			$args = $args['args'];
		  $output = (isset($args['conditions']) && !empty($args['conditions']) ? '<div class="speak-conditions speak-box-conditions assistive-text">'.json_encode($args['conditions']).'</div>' : '');
		  foreach($args['fields'] as $field){
				if(isset($field['type']) && ($field['type'] == 'single' || $field['type'] == 'repeater')){
		      if($field['type'] == 'single'){
		        unset($field['type']);
		        $output .= gen_meta_field($post->ID,$field);
		      } else {
		        unset($field['type']);
		        $output .= gen_repeater_fields($post->ID,$field);
		      }
				}
		  }
		  echo $output;
		}

		public function save_meta($post_id){
		  if(!isset($_POST['speak-meta-nonce']) || !wp_verify_nonce($_POST['speak-meta-nonce'],basename(__FILE__))) return $post_id;
		  if(!current_user_can('edit_post',$post_id)) return $post_id;
		  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

		  foreach($this->meta as $field){

		    if(isset($_POST[$field]) && !is_array($_POST[$field])){

		      if(isset($_POST[$field]) && trim($_POST[$field]) !== ''){
		        update_post_meta($post_id,$field,sanitize_textarea_field($_POST[$field]));
		      } else {
		        delete_post_meta($post_id,$field);
		      }

		    } elseif(isset($_POST[$field]) && is_array($_POST[$field])){

		      if(!empty($_POST[$field])){
		        $data = array_filter_map($_POST[$field]);
		        if(!empty($data)){
		          update_post_meta($post_id,$field,serialize($data));
		        } else {
		          delete_post_meta($post_id,$field);
		        }
		      } else {
		        delete_post_meta($post_id,$field);
		      }

		    }

		  }

		}
	}
	add_action('load-post.php',array('speak_meta','init'));
	add_action('load-post-new.php',array('speak_meta','init'));
}

?>
