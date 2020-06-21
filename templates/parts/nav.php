<nav class="flex-nav">
    <?php get_template_part('sidecar'); ?>
    <div class="mainnav">
        <?php wp_nav_menu(array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'menu_class'     => 'mainnav__ul',
					'walker'         => new Aria_Walker_Nav_Menu(),
					'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
				)); ?>
    </div>
</nav>