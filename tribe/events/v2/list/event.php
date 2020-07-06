<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$container_classes = [ 'tribe-common-g-row', 'tribe-events-calendar-list__event-row' ];
$container_classes['tribe-events-calendar-list__event-row--featured'] = $event->featured;

$event_classes = tribe_get_post_class( [ 'tribe-events-calendar-list__event', 'tribe-common-g-row', 'tribe-common-g-row--gutters' ], $event->ID );
?>
<div>
    <div class=" event-container">
        <?php $this->template( 'list/event/featured-image', [ 'event' => $event ] ); ?>
        <div class="event-details">
            <?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>
            <?php $this->template( 'list/event/date', [ 'event' => $event ] ); ?>
            <?php $this->template( 'list/event/venue', [ 'event' => $event ] ); ?>
        </div>
    </div>

</div>