<?php
/**
 * Classes for Notifications Bar
 *
 * @package speak
 * @since speak 1.0
 */

class speak_notification extends WP_Widget {
  function __construct(){
    parent::__construct(
      'speak_notification',
      __('Notification','speak'),
      array('description' => __('A date specific notification.','speak'))
    );
  }
  // Creating widget output
  public function widget($args,$instance){
    $title = apply_filters('widget_title',$instance['title']);
    $date = $instance['date'];
    $message = trim($instance['message']);

    // Check that the current date is greater than or equal to the date of the notification
    if(strtotime($date) >= strtotime(date("Y-m-d"))){

      // Before and after widget arguments are defined in the notifcations_init function of the main class
      echo $args['before_widget'];

      // Widget Title
      if(trim($title) !== ''){ echo $args['before_title'].$title.$args['after_title']; }

      // Widget Body
      echo '<p>'.$message.'</p>';

      echo $args['after_widget'];
    } else {
      // return nothing if current date is before or after the date specified by the notification
      echo '';
    }
  }

  // Widget Backend
  public function form($instance){
    if(isset($instance['title'])){ $title = $instance['title']; }
    else { $title = ''; }

    if(isset($instance['date'])){ $date = $instance['date']; }
    else { $date = date('Y-m-d'); }

    if(isset($instance['message'])){ $message = $instance['message']; }
    else { $message = ''; }

    // Widget admin form
    ?>
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('date'); ?>"><?php _e('Date:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" type="date" value="<?php echo esc_attr($date); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Message:'); ?></label>
        <textarea class="widefat" style="height:150px;" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" /><?php echo esc_attr($message); ?></textarea>
      </p>
    <?php
  }

  // Updating widget replacing old instances with new
  public function update($new_instance,$old_instance){
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['date'] = (!empty($new_instance['date'])) ? strip_tags($new_instance['date']) : '';
    $instance['message'] = (!empty($new_instance['message'])) ? strip_tags($new_instance['message']) : '';
    return $instance;
  }
}

?>
