<div class='teacher-programs-menu'>
    <?php wp_nav_menu(array(
					'theme_location' => 'teacher-programs',
					'container'      => false,
					'menu_class'     => 'teacher-programs-menu__ul',
					'walker'         => new Aria_Walker_Nav_Menu(),
					'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
					'link_before' => '<span class="teacher-programs__ul--li">',
  					'link_after' => '</span>',
				)); ?>
</div>