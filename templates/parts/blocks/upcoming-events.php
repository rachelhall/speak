<div class="events-container">
    <!-- <div class="events-container-background"></div> -->
    <div>

        <p class="events__heading">Events</p>
    </div>



    <div class="events">
        <?php 
$events = tribe_get_events([
    'posts_per_page' => 3,
    'start_date'     => 'now',
    ]);
    $venue = tribe_get_venue_details();
    
    
    if ( $events) :
        
        foreach ( $events as $event ) :
            $date = $event->event_date;
            
            ?>
        <!-- <pre><?php print_r($event) ?></pre> -->
        <div class="events__single">
            <img src="<?php echo get_template_directory_uri() . '/public/images/header-bg.jpg' ?>" alt="Facebook">
            <div class="events__single--text">
                <p class="events__single--heading"><a
                        href="<?php echo $event->the_permalink ?>"><?php echo $event->post_title ?></a></p>
                <p class="events__single--paragraph"><?php  echo $date?></p>
                <p class="events__single--paragraph"><?php echo $venue[1] ?></p>
                <p class="events__single--link">Learn More</p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>





        <!-- <img src="<?php echo get_template_directory_uri() . '/public/SVGs/EventsBrush.svg' ?>" alt=""> -->

    </div>
</div>
</div>

<?php wp_reset_postdata();?>