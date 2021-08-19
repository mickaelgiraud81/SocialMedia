<?php

class SocialMedia_widget extends WP_Widget{

// Main constructor
    public function __construct() {
        load_plugin_textdomain( 'SocialMedia');
        parent::__construct(
            'socialmedia_widget',
            __( 'socialmedia widget', 'SocialMedia'),
            array(
                'customize_selective_refresh' => true,
            )
            );
    }

// The widget form (for the backend )
    function form( $instance ) {

        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['instagram']) ? $instagram = $instance['instagram'] : null;
        isset($instance['youtube']) ? $youtube = $instance['youtube'] : null;
        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        
        ?>   
<p>
            <label for="<?php echo $this->get_field_id('1'); ?>"><?php _e('Facebook:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('1'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('2'); ?>"><?php _e('instagram:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('2'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('3'); ?>"><?php _e('youtube:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('3'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('4'); ?>"><?php _e('Linkedin:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('4'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
        </p>
 
        <?php
		
    }

    // Display the widget
    public function widget( $args, $instance ) {

        $facebook_profile = '<a class="facebook" href="' . $instance['facebook'] . '"> <img src="'.plugin_dir_url(__FILE__).'icons/facebook.svg" alt=""></a>';
        $instagram_profile = '<a class="instagram" href="' . $instance['instagram'] . '"> <img src="'.plugin_dir_url(__FILE__).'icons/instagram.svg"  alt=""></a>';
        $youtube_profile = '<a class="youtube" href="' . $instance['youtube'] . '"><img src="'.plugin_dir_url(__FILE__).'icons/youtube.svg" alt=""></a>';
        $linkedin_profile = '<a class="linkedin" href="' . $instance['linkedin'] . '"><img src="'.plugin_dir_url(__FILE__).'icons/linkedin.svg" alt=""></a>';
	
    echo $args['before_widget'];
   // Display the widget
   echo '<div class="social-icons">';
        echo (!empty( $instance['facebook']) ) ? $facebook_profile : null;
        echo (!empty($instance['instagram']) ) ? $instagram_profile : null;
        echo (!empty($instance['youtube']) ) ? $youtube_profile : null;
        echo (!empty($instance['linkedin']) ) ? $linkedin_profile : null;
        echo '</div>';

	// WordPress core after_widget hook (always include )
	echo $args['after_widget'];

    }
}


?>

