
speak Starter Theme
=======================

First things first:
- View this in markdown version not html
- Formatting gets a little wierd on the html and the code snippets are particular
- A Starter template for speak Designers.
- Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
- Some small tweaks in `inc/template-functions.php` that can improve your theming experience.
- 2 sample CSS layouts in `layouts/` for a sidebar on either side of your content.
Note: `.no-sidebar` styles are not automatically loaded.
- speak CSS compiled to `style.css` from `style.scss`

Getting Started
---------------
Welcome to the speak starter template. Wordpress is a little particular so bare with me as I attempt to explain the process.
First things first entry point and file structure:
    -index.php
        + header.php
        + template-parts
            *content.php
            *content-none.php
            *content-search.php
            *content-page.php
        + footer.php
These are the main components that make up a WordPress site. The default entry point is the index.php file which serves as your main
 avenue to hold all page content even when visiting new pages. However, it is important to note that the index.php page can be overriden 
 and home.php will be used instead as the main point of entry. This is extremely important for one particular reason: Static vs Blog.
 Obviously, WordPress's claim to fame is the free blogging platform. However in many cases there is a need for a static front page, (or
 any page for that matter), to take precedence. In this case using the home.php template as the starting point allows the designer to
 seperate blog serving pages and static ones. The partial files being brought in are the same however it is easier to dilineate the two 
 by having seperate entities. To complicate things even more a third option is available called page.php. This is best used as a subpage
 iteration that is seperate from the home page styling. Essentially the list below explains the best practices for site entry points:
    1) Index.php - default entry point, main purpose for display of blog
    2) home.php - higher precedence entry point, can be served statically to produce a typical home page
    3) page.php or any custom page template - best used for interior pages

PLEASE DON'T DELETE ANY PAGES EVEN IF NOT USED!!!!!

It is really important that no files are deleted from the main directory or sub-directories. As you'll learn WordPress can be a fickle
beast and as such all of the files in this starter theme are necessary to run the basic installation. If you need to add more page parts
or templates feel free as more won't cause any harm :)

That brings me to the next point. WordPress can use as many templates as you want you must simply include them as needed. You can choose
which page to display in the admin section of wordpress for each individual page pretty easily in the page attributes. That being said all
pages must include the following block of code at the top of the php file regardless if they are partials or full page templates: 

<?php
/**
 *The template for displaying 'Insert Page Name'
 *
 *
 *@package speak
 */
?>

To create page templates for interior pages or for any other particular pages include this version of the above code to the top of the file:
<?php
/**
 *Template Name: 'insert template name here'
 *
 *@link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 *@package speak
 */

get_header();
?>

Also if this is to be a page template then a final script at the end of the page is needed that calls:
    <?php get_footer()?> (to include footer file)

If this is just a partial then the above script sans excess code will suffice.
If you need to include a page part into another page this is done using the folowing php:
    <?php get_template_part('Insert File Name without .php')?>
For example to include the page part "sidebar.php" you would include it as such:
    <?php get_template_part('sidebar')?>

The name of the template should follow this format for full page templates:
    page-{$Slug}.php
So for a particular template for a full width page and an about page should be created as follows:
    page-full-width.php
    page-about.php
For all other partials any name with work.

Something you will notice throughout the files is the repetitive use of the @package speak and speak in all of the scripts in functions.php. This is very important to keep consistent throughout the theme. If it must be replaced for a particular reason the easiest way is to do a replace all with speak with the necessary phrase. It is highly recommended we don't do this unless absolutely necessary to keep things simple and less likely to break.

At this point you should be good to go to at least start designing the necessary components and get things working together efficiently,
however, there is another key component of WordPress that must be done correctly. And that is The Loop. Because it is much easier to watch
a video than read my explanation visit the following link and that should give you a good overview of the process:
    * https://www.youtube.com/watch?v=O8Nnn06Um0I

The next important factor of WordPress is functions.php. This file houses all the "functions" for the wordpress theme. This is where you can create functions to allow users to customize fonts, colors, placement of items, etc through the admin portal. There are also various functions available to use for all kinds of purposes although the ones currently loaded should suffice. If you do need to add more feel free!

It looks really messing with a lot of files but it is almost the same process as SiteWrench. There are just some slight differences in the file structure process. 

All other questions you may have can most likely be found here: https://codex.wordpress.org/