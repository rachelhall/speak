<?php

// Example uses
// [sc_company_info info="hours" multiline="true"]
// [sc_company_info info="address" multiline="true"]
// [sc_company_info info="street"]
// [sc_company_info info="city"]
// [sc_company_info info="state"]
// [sc_company_info info="zip"]
// [sc_company_info info="email"]
// [sc_company_info info="phone"]

if(!function_exists('sc_company_info')){
  function sc_company_info($atts){
    $args = array(
      'info' => '',
      'multiline' => 'true'
    );
    extract(shortcode_atts($args,$atts));
    $options = get_option('company_info');
    $output = '';

    switch($info){
      case 'hours':
        if($multiline == 'true'){
          $output .= str_replace(array("\r\n"),'<br/>',$options['hours']);
        } else {
          $output .= str_replace(array("\r\n"),' | ',$options['hours']);
        }
        break;

      case 'address':
        if($multiline == 'true'){
          $output .= $options['address_street'].'<br/>'.$options['address_city'].', '.$options['address_state'].' '.$options['address_zip'];
        } else {
          $output .= $options['address_street'].', '.$options['address_city'].', '.$options['address_state'].' '.$options['address_zip'];
        }
        break;

      case 'street':
        $output .= $options['address_street'];
        break;

      case 'city':
        $output .= $options['address_city'];
        break;

      case 'state':
        $output .= $options['address_state'];
        break;

      case 'zip':
        $output .= $options['address_zip'];
        break;

      case 'email':
        $output .= $options['email'];
        break;

      case 'phone':
        $output .= $options['phone'];
        break;

      default: $output;
    }

    return $output;
  }
  add_shortcode('sc_company_info','sc_company_info');
}

?>
