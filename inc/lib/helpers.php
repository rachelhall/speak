<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package speak
 * @since speak 1.0
 */


/**
 * Get our wp_nav_menu() fallback,wp_page_menu(),to show a home link.
 *
 * @since speak 1.0
 */
function speak_page_menu_args($args){
  $args['show_home'] = true;
  return $args;
}
add_filter('wp_page_menu_args','speak_page_menu_args');


/**
 * Adds custom classes to the array of body classes.
 *
 * @since speak 1.0
 */
function speak_body_classes($classes){
  // Adds a class of group-blog to blogs with more than 1 published author
  if(is_multi_author()){ $classes[] = 'group-blog'; }

  // Adds a class of no-sidebar when there is no sidebar present.
  if(!is_active_sidebar('sidebar-1')){ $classes[] = 'no-sidebar';}

  return $classes;
}
add_filter('body_class','speak_body_classes');


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since speak 1.0
 */
function speak_enhanced_image_navigation($url,$id){
  if(!is_attachment() && !wp_attachment_is_image($id)) return $url;

  $image = get_post($id);
  if(!empty($image->post_parent) && $image->post_parent != $id) $url .= '#main';

  return $url;
}
add_filter('attachment_link','speak_enhanced_image_navigation',10,2);


/**
 * TinyMCE New Formats
 *
 * @since speak 1.0
 */
function speak_mce_buttons($buttons){
	array_unshift($buttons,'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2','speak_mce_buttons');

function speak_mce_formats($init_array){
	// Define the style_formats array
	$style_formats = array(
		// add custom formats to extend block level styles here
    // https://codex.wordpress.org/TinyMCE_Custom_Styles
	);

	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = wp_json_encode($style_formats);

	return $init_array;
}
add_filter('tiny_mce_before_init','speak_mce_formats');


/**
 * Remove CF7 WPAUTOP Filter
 */
function wpcf7_autop_return_false(){
  return false;
}
add_filter('wpcf7_autop_or_not','wpcf7_autop_return_false');


/**
 * Helper functions
 *
 * @since speak 1.0
 */

// Generate string of randomized characters
if(!function_exists('gen_random_string')){
	function gen_random_string($length){
	  $length = (is_int($length) && $length > 0) ? $length : false;

	  if($length){
	    // Define all the possible characters that could go into a string
	    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	    // Start the final string
	    $str = '';

	    for($i = 0; $i < $length; $i++){
	      // Get a random character from the possibleCharacters string
	      $char = substr($chars,rand(0,strlen($chars)),1);

	      // Append this character to the final string
	      $str .= $char;
	    }

	    // Return the final string
	    return $str;
	  } else {
	    return false;
	  }
	}
}

// Return contents of a template as a string
function include_template_contents($slug,$name=null){
  ob_start();
  get_template_part($slug,$name);
  $content = ob_get_contents();
  ob_end_clean();

  return $content;
}

// Convert object to array
function object_to_array($d){
  if(is_object($d)){ $d = get_object_vars($d); }
  if(is_array($d)){ return array_map(__FUNCTION__,$d); } else { return $d; }
}

// Remove item from array by value
function array_remove_value(&$array,$value){
  if(($key = array_search($value,$array)) !== false){ unset($array[$key]); }
}

// Recursively filter an array
function array_filter_recursive(array $array,callable $callback = null){
  $array = is_callable($callback) ? array_filter($array,$callback) : array_filter($array);
  foreach($array as &$value){
    if(is_array($value)){ $value = call_user_func(__FUNCTION__,$value,$callback); }
  }

  return $array;
}

// Recursively filter an array and remap both associative and numeric keys
function array_filter_map(array $array){
  $new_array = array();
  foreach($array as $key => $value){
    if(is_array($value) && !empty($value)){ $value = call_user_func(__FUNCTION__,$value); }
    if((is_array($value) && !empty($value)) || (!is_array($value) && trim($value) !== '')){
      if(is_numeric($key)){
        $new_array[] = $value;
      } else {
        $new_array[$key] = $value;
      }
    }
  }

  return $new_array;
}

// Check if multiple array keys exist in an array
function array_keys_exist(array $keys,array $array){
  return !array_diff_key(array_flip($keys),$array);
}

// Convert hex string to RGB array or string
function hex_to_rgb($hexStr,$returnAsString = false,$seperator = ',') {
  $hexStr = preg_replace("/[^0-9A-Fa-f]/",'',$hexStr); // Gets a proper hex string
  $rgbArray = array();

  if(strlen($hexStr) == 6){ // If a proper hex code, convert using bitwise operation. No overhead... faster
    $colorVal = hexdec($hexStr);
    $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
    $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
    $rgbArray['blue'] = 0xFF & $colorVal;
  } elseif(strlen($hexStr) == 3){ // If shorthand notation, need some string manipulations
    $rgbArray['red'] = hexdec(str_repeat(substr($hexStr,0,1),2));
    $rgbArray['green'] = hexdec(str_repeat(substr($hexStr,1,1),2));
    $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr,2,1),2));
  } else {
    return false; //Invalid hex color code
  }

  return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

// Remove formatting characters from a number string
function number_unformat($number,$force_number = true,$dec_point = '.',$thousands_sep = ',') {
	if($force_number){ $number = preg_replace('/^[^\d]+/','',$number); }
  elseif(preg_match('/^[^\d]+/',$number)){ return false; }

	$type = (strpos($number,$dec_point) === false) ? 'int' : 'float';
	$number = str_replace(array($dec_point,$thousands_sep),array('.',''),$number);
	settype($number,$type);

	return $number;
}

// Abbreviate and format a number
function abbreviate_number($n,$precision = 1){
	if($n < 900){
		// 0 - 900
		$n_format = number_format($n,$precision);
		$suffix = '';
	} elseif($n < 900000){
		// 0.9k-850k
		$n_format = number_format($n / 1000,$precision);
		$suffix = 'K';
	} elseif($n < 900000000){
		// 0.9m-850m
		$n_format = number_format($n / 1000000,$precision);
		$suffix = 'M';
	} elseif($n < 900000000000){
		// 0.9b-850b
		$n_format = number_format($n / 1000000000,$precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000,$precision);
		$suffix = 'T';
	}

  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if($precision > 0){
		$dotzero = '.'.str_repeat('0',$precision);
		$n_format = str_replace($dotzero,'',$n_format);
	}
	return $n_format.$suffix;
}

// Calculate overall brightness of an image
function calc_brightness($filename,$num_samples = 30){
  // needs a mimetype check
  $img = imagecreatefromjpeg($filename);

  $width = imagesx($img);
  $height = imagesy($img);

  $x_step = intval($width / $num_samples);
  $y_step = intval($height / $num_samples);

  $total_lum = 0;
  $sample_no = 1;

  for($x = 0; $x < $width; $x += $x_step){
    for($y=0; $y < $height; $y += $y_step){
      $rgb = imagecolorat($img,$x,$y);
      $r = ($rgb >> 16) & 0xFF;
      $g = ($rgb >> 8) & 0xFF;
      $b = $rgb & 0xFF;

      // choose a simple luminance formula from here
      // http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
      $lum = ($r + $r + $b + $g + $g + $g) / 6;

      $total_lum += $lum;
      $sample_no++;
    }
  }

  // work out the average
  $avg_lum  = $total_lum / $sample_no;

  return ($avg_lum / 255) * 100;
}

// Create inverted grayscale image data
function gen_shade_image($img,$format){
  $formats = array('bmp','gd2','gd2part','gd','gif','jpeg','png','string','wbmp','webp','xbm','xpm');

  // Create php image data based on format
  if(in_array($format,$formats)){
    $im = call_user_func('imagecreatefrom'.$format,$img);
  } else {
    $im = imagecreatefromjpeg($img);
  }

  if($im && imagefilter($im,IMG_FILTER_GRAYSCALE) && imagefilter($im,IMG_FILTER_NEGATE)){
    ob_start(); // start stream

    // get raw image bits based on format
    if(in_array($format,$formats)){
      call_user_func('image'.$format,$img);
    } else {
      imagejpeg($im,NULL,100);
    }

    $rawImageBytes = ob_get_clean(); // store bits and end stream
    imagedestroy($im); // destroy php image data

    return 'data:image/jpeg;base64,'.base64_encode($rawImageBytes);
  } else {
    imagedestroy($im);
    return false;
  }
}

// Validate $post object value
function validate_post_values($conditions){
  global $post;
  $p = object_to_array($post);
  $include = true;

  foreach($conditions as $key => $value){
    if($key !== 'meta'){
      if(!isset($p[$key]) || $p[$key] !== $value){ $include = false; }
    }
  }

  return $include;
}

// Generate repeater of meta fields
// @required post_id,label,name
function gen_repeater_fields($post_id,$args){
  // Sanitize passed data
  $args = is_array($args) && !empty($args) ? array_filter($args) : array();
  $required = array('label','name','fields');
  if(isset($args['label']) && trim($args['label']) !== ''){ $args['label'] = trim($args['label']); } else { unset($args['label']); }
  if(isset($args['name']) && trim($args['name']) !== ''){ $args['name'] = trim($args['name']); } else { unset($args['name']); }
  if(isset($args['fields']) && is_array($args['fields']) && !empty(array_filter($args['fields']))){ $args['fields'] = array_filter($args['fields']); } else { unset($args['fields']); }

  // Check for valid required data
  if($post_id !== null && array_keys_exist($required,$args)){
    // Get existing meta if any exist
    $rows = unserialize(get_post_meta($post_id,$args['name'],true));

    // Setup markup for UI buttons
    $btns = array(
      'move' => '<span class="move-row-btn sort-handle" role="button" title="click and drag to reorder"><i class="material-icons">open_with</i><span class="assistive-text">move row</span></span>',
      'remove' => '<span class="remove-row-btn" role="button" title="remove row"><i class="material-icons">highlight_off</i><span class="assistive-text">remove row</span></span>'
    );

    // Generate markup for an empty row
    $clean = '';
    foreach($args['fields'] as $field){
      $field['name'] = $args['name'].'[replace_index]['.$field['name'].']';
      $field['id'] .= '-replace_index';
      $clean .= gen_meta_field($post_id,$field);
    }

    // Start output
    $output = '<div class="speak-meta-repeater speak-toggleable">'.
      (isset($args['conditions']) && !empty($args['conditions']) ? '<div class="speak-conditions speak-field-conditions assistive-text">'.json_encode($args['conditions']).'</div>' : '').
      '<legend>'.$args['label'].'</legend>
      <fieldset>
        <ul class="repeater-rows speak-sortable">';

        // Loop through rows if they exist, otherwise include an empty row
        if(is_array($rows) && !empty($rows)){
          $i = 0;
          foreach($rows as $row){
            $output .= '<li class="repeater-row sort-item" data-index="'.$i.'">'.$btns['move'];
            foreach($args['fields'] as $field){
              $field['value'] = $row[$field['name']];
              $field['name'] = $args['name'].'['.$i.']['.$field['name'].']';
              $field['id'] .= '-'.$i;
              $output .= gen_meta_field($post_id,$field);
            }
            $output .= $btns['remove'].'</li>';
            $i++;
          }
        } else {
          $output .= '<li class="repeater-row sort-item" data-index="0">'.$btns['move'].str_replace('replace_index','0',$clean).$btns['remove'].'</li>';
        }

      // End output with an empty row to be cloned to new rows with JS
        $output .= '</ul>
      </fieldset>
      <span class="speak-btn mini add-repeater-row" role="button" title="add new row"><i class="material-icons">add_circle_outline</i>Add Row</span>
      <div class="repeater-clone">'.$btns['move'].$clean.$btns['remove'].'</div>
    </div>';
    return $output;

  } else {
    return false;
  }
}

// Generate meta field markup
// @required post_id,type,label,name
function gen_meta_field($post_id,$args){
  // Sanitize passed data
  $args = is_array($args) && !empty($args) ? array_filter($args) : array();
  $required = array('input','label','id','name');
  foreach($required as $data){
    if(isset($args[$data]) && trim($args[$data]) !== ''){ $args[$data] = trim($args[$data]); } else { unset($args[$data]); }
  }

  // Check for valid required data
  if($post_id !== null && array_keys_exist($required,$args)){
    // Setup field value and start of output markup
    $fieldval = (isset($args['value']) && $args['value'] !== null) ? $args['value'] : get_post_meta($post_id,$args['name'],true);
    $output = ($args['input'] == 'hidden' ? '<div class="assistive-text">' : '<div class="column span-'.(isset($args['cols']) ? $args['cols'] : '12').' speak-toggleable">').
      (isset($args['conditions']) && !empty($args['conditions']) ? '<div class="speak-conditions speak-field-conditions assistive-text">'.json_encode($args['conditions']).'</div>' : '');

    // Create the meta field based on type
    switch($args['input']){

      case 'checkbox':
        // Only output field if options exist
        if(isset($args['options']) && !empty($args['options'])){
          // Setup existing meta if there is any
          $options = array();
          $values = (!is_array($fieldval) && (@unserialize($fieldval) === 'b:0' || @unserialize($fieldval) !== false)) ? unserialize($fieldval) : $fieldval;
          $single = (count($args['options']) == 1) ? true : false;

          // Generate options
          foreach($args['options'] as $key => $value){
            $options[] = '<div class="check-wrap">
              <input type="checkbox"
                id="'.$args['id'].($single === true ? '' : '-'.$key).'"
                name="'.$args['name'].($single === true ? '' : '[]').'"
                value="'.($single === true ? 'true' : $key).'"'.
                ($single === true
                  ? ($values == 'true' ? ' checked' : '')
                  : (in_array($key,$values) ? ' checked' : '')
                ).
                (isset($args['atts']) && trim($args['atts']) !== '' ? ' '.trim($args['atts']) : '').
              '>
              <label for="'.$args['id'].($single === true ? '' : '-'.$key).'">
                <div class="checkbox">
                  <span class="circle"></span>
                  <span class="bar-left"></span>
                  <span class="bar-bottom"></span>
                </div>'.
                $value.
              '</label>
            </div>';
          }

          // Final markup to be output for field
          $output .= '<legend'.(isset($args['hide_label']) && $args['hide_label'] === true ? ' class="assistive-text"' : '').'>'.$args['label'].'</legend>
            <fieldset>'.
              implode('',$options).
            '</fieldset>';
        } else {
          return false;
        }
        break;

      case 'radio':
        // Only output field if options exist
        if(isset($args['options']) && !empty($args['options'])){
          // Generate options
          $options = array();
          foreach($args['options'] as $key => $value){
            $options[] = '<div class="radio-wrap">
              <input type="radio" id="'.$args['id'].'-'.$key.'" name="'.$args['name'].'" value="'.$key.'"'.($fieldval == $key ? ' checked' : '').
              (isset($args['atts']) && trim($args['atts']) !== '' ? ' '.trim($args['atts']) : '').'>
              <label for="'.$args['id'].'-'.$key.'">
                <div class="radio">
                  <span class="circle"></span>
                  <span class="dot"></span>
                </div>'.
                $value.
              '</label>
            </div>';
          }

          // Final markup to be output for field
          $output .= '<legend'.(isset($args['hide_label']) && $args['hide_label'] === true ? ' class="assistive-text"' : '').'>'.$args['label'].'</legend>
            <fieldset>'.
              implode('',$options).
            '</fieldset>';
        } else {
          return false;
        }
        break;

      case 'select':
        // Only output field if options exist
        if(isset($args['options']) && !empty($args['options'])){
          // Generate options
          $options = array();
          foreach($args['options'] as $key => $value){
            $options[] = '<option value="'.$key.'"'.($key == $fieldval ? ' selected' : '').'>'.$value.'</option>';
          }

          // Final markup to be output for field
          $output .= '<label for="'.$args['id'].'"'.(isset($args['hide_label']) && $args['hide_label'] === true ? ' class="assistive-text"' : '').'>'.$args['label'].'</label>
            <div class="select-wrap">
              <select id="'.$args['id'].'" name="'.$args['name'].'"'.(isset($args['atts']) && trim($args['atts']) !== '' ? ' '.trim($args['atts']) : '').'>'.
                implode('',$options).
              '</select>
            </div>';
        } else {
          return false;
        }
        break;

      case 'file':
        $output .= '<div class="file-wrap">
          <input type="hidden" id="'.$args['id'].'" name="'.$args['name'].'" value="'.$fieldval.'">'.
          ($fieldval !== '' ? '<div class="remove-image" style="background-image:url(\''.wp_get_attachment_url($fieldval).'\');" title="remove image"><i class="material-icons">close</i></div>' : '').
          '<div class="attach-image" title="'.($fieldval !== '' ? 'update image' : 'attach an image').'"><i class="material-icons">photo</i></div>
          <label for="'.$args['id'].'"'.(isset($args['hide_label']) && $args['hide_label'] === true ? ' class="assistive-text"' : '').'>'.$args['label'].'</label>
        </div>';
        break;

      default: $output .= '<label for="'.$args['id'].'"'.(isset($args['hide_label']) && $args['hide_label'] === true ? ' class="assistive-text"' : '').'>'.$args['label'].'</label>
        <div class="input-wrap">'.
          ($args['input'] == 'textarea'
            ? '<textarea id="'.$args['id'].'" name="'.$args['name'].'"'.(isset($args['atts']) && trim($args['atts']) !== '' ? ' '.trim($args['atts']) : '').'>'.$fieldval.'</textarea>'
            : '<input type="'.$args['input'].'" id="'.$args['id'].'" name="'.$args['name'].'" value="'.$fieldval.'"'.(isset($args['atts']) && trim($args['atts']) !== '' ? ' '.trim($args['atts']) : '').'>'
          ).
        '</div>';

    }

    $output .= '</div>';
    return $output;

  } else {
    return false;
  }
}
