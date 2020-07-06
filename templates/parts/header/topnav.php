<div class="topnav">
    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/topnav.svg' ?>" class="topnav__background">
    <div class="topnav__header--container">
        <p class='topnav__header'>The Praxis Academy</p>
        <img src="<?php echo get_template_directory_uri() . '/public/SVGs/topnav-header-underline.svg' ?>">
    </div>
    <img src="<?php echo get_template_directory_uri() . '/public/SVGs/manup-logo-stroke.svg' ?>" alt="Man Up Logo"
        class="topnav__logo" height="132">


    <?php wp_nav_menu(array(
					'theme_location' => 'topnav',
					'container'      => false,
					'menu_class'     => 'topnav__ul',
					'walker'         => new Aria_Walker_Nav_Menu(),
					'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
					'link_before' => '<span class="topnav__ul--li">',
  					'link_after' => '</span>',
				)); ?>
</div>