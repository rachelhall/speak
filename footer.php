<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package speak
 */

?>

</div><!-- #content -->

<footer>
    <div class="footer-main">

        <div class="footer-left">

            <div class="footer-nav">
                <ul>
                    <li><a href="">Teacher Materials</a></li>
                    <li><a href="">Tools for Practice</a></li>
                    <li><a href="">The Praxis Academy</a></li>
                    <li>
                        <ul class='footer-nav__social-icons'>
                            <li><img src="<?php echo get_template_directory_uri() . '/public/SVGs/Facebook.svg' ?>"
                                    alt="Facebook"></li>
                            <li><img src="<?php echo get_template_directory_uri() . '/public/SVGs/Twitter.svg' ?>"
                                    alt="Twitter"></li>
                            <li><img src="<?php echo get_template_directory_uri() . '/public/SVGs/Instagram.svg' ?>"
                                    alt="Instagram"></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <p class="footer-left__paragraph">MAN Up Teacher Fellowship is a non-profit organization with the mission to
                give students in high poverty
                communities access to high quality male teachers and advancing policies that encourage equity in K – 12
                schools.</p>
            <div class="footer-left__row2">

                <div class="footer-left__newsletter">
                    <p>Join Our Newsletter</p>

                    <form action="">
                        <input type="text">
                    </form>
                </div>
                <div class="footer-left__partners">
                    <p>Our Partners</p>
                    <div class="footer-left__partners--logo-container">
                        <img src="<?php echo get_template_directory_uri() . '/public/SVGs/mississippi-state-logo.svg' ?>"
                            alt="Mississippi State">
                        <img src="<?php echo get_template_directory_uri() . '/public/SVGs/relay-logo.svg' ?>"
                            alt="Mississippi State">
                        <img src="<?php echo get_template_directory_uri() . '/public/SVGs/teacher-ready-logo.svg' ?>"
                            alt="Mississippi State">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-right"><img
                src="<?php echo get_template_directory_uri() . '/public/SVGs/manup-logo-stroke.svg' ?>" alt="Manup">
        </div>
    </div>
    <div class="speak-copyright">
        <p>@Copyright <?php echo date("Y");?>, ManUp Teacher Fellows, Inc. | <?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf( esc_html__( 'Web Design by %2$s.', 'speak' ), 'speak', '<a href="https://madebyspeak.com/">speak Creative</a>' );
		?> </p>

    </div>
</footer>
</div>

<?php wp_footer(); ?>

</body>

</html>