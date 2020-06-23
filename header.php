<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package speak
 */

?>
<!DOCTYPE html>
<!--[if IE 8]>
  <html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page,$paged;

    wp_title('|',true,'right');

    // Add the blog name.
    bloginfo('name');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description','display');
    if($site_description && (is_home() || is_front_page())) echo " | $site_description";

    // Add a page number if necessary:
    if($paged >= 2 || $page >= 2) echo ' | '.sprintf(__('Page %s','speak'),max($paged,$page));
  ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link href="<?php echo get_stylesheet_directory_uri() ?>/inc/assets/images/favicon.ico" rel="icon"
        type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/inc/assets/images/favicon.ico"
        type="image/x-icon" />
    <link rel="icon" type="image/png"
        href="<?php echo get_stylesheet_directory_uri() ?>/inc/assets/images/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png"
        href="<?php echo get_stylesheet_directory_uri() ?>/inc/assets/images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png"
        href="<?php echo get_stylesheet_directory_uri() ?>/inc/assets/images/favicon-96x96.png" sizes="96x96">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/external/html5.js" type="text/javascript"></script>
  <![endif]-->
    <?php wp_head(); ?>
</head>

<!--[if lte IE 10]>
	<body <?php body_class('ie'); ?>>
  <div class="get-a-better-browser"><iframe src="http://www.getabetterbrowser.com" width="800" height="600"></iframe></div>
<![endif]-->
<!--[if gt IE 10 | !IE ]><!-->

<body <?php body_class(); ?>>
    <!--<![endif]-->
    <div id="page" class="hfeed site">

        <header class="header">
            <?php get_template_part( '/templates/parts/header/topnav' ) ?>
            <div class="hero">
                <div class="hero__overlay"><img
                        src="<?php echo get_template_directory_uri() . '/public/images/header-with-screen.png' ?>"
                        alt="">
                </div>
                <?php
				get_template_part( '/templates/parts/nav')
                ?>
                <div class="hero__copy">
                    <div class="hero__copy--container">

                        <div class="hero__copy--bold">
                            <p>Teaching</p>
                            <p>Manup</p>
                        </div>
                        <div class="hero__copy--thin">
                            <img src="<?php echo get_template_directory_uri() . '/public/SVGs/GoldStroke.svg' ?>">
                            <p>Rise to the occasion</p>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <div id="content">