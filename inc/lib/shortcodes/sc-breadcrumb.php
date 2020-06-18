<?php

if(!function_exists('sc_breadcrumb')){
  function sc_breadcrumb($atts){
    $args = array();
    extract(shortcode_atts($args,$atts));

    $output = speak_breadcrumb();

    return $output;
  }
  add_shortcode('sc_breadcrumb','sc_breadcrumb');
}

?>
