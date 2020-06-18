<?php

if(!function_exists('sc_social_icons')){
  function sc_social_icons($atts){
    $args = array(
      "class" => "",
      "reverse" => "false",
    );
    extract(shortcode_atts($args,$atts));

    $socials = get_option('socials_settings');
		$output = '<nav class="site-navigation social-navigation'.($class && $class !== '' ? ' '.$class : '').'">
			<ul class="menu">';
				if($socials && !empty($socials)){
					foreach($socials as $social){
						$social = unserialize($social);
						if($social['check'] && $social['check'] == 'true'){
							$output .= '<li><a href="'.$social['link'].'" target="_blank" title="'.$social['label'].'"><img src="'.get_stylesheet_directory_uri().'/inc/assets/images/icons/si/si-'.$social['name'].($reverse == 'true' ? '-ko' : '').'.svg" alt="'.get_bloginfo('name').' '.$social['label'].'" /></a></li>';
						}
					}
				}
  		$output .= '</ul>
		</nav><!-- .site-naviation .social-navigation -->';

    return $output;
  }
  add_shortcode('sc_social_icons','sc_social_icons');
}

?>
