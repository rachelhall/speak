<div class="recent-posts">
    <p class="recent-posts__heading">Blog post</p>


    <div class="recent-posts__all-posts">

        <?php $args = array(
'post_type' => 'post',
'posts_per_page' => 4
);
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() )  {
		
	$the_query->the_post(); ?>
        <div class="recent-posts__single-post">
            <?php the_post_thumbnail(); ?>
            <div class="recent-posts__single-post--text">

                <p class='recent-posts__single-post--heading'><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                <p style="font-weight: 600;"> <?php the_time('n.j.y | g:ia'); ?>
                </p>
                <div>
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <p class="learn-more"><a href="<?php the_permalink(); ?>">Learn More</a></p>
                </div>
            </div>
        </div>
        <?php 
	} 
	?>
        <?php
}
?>
    </div>
</div>