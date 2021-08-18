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

        $defaults = apply_filters( 'icones_styles', array(
            'name_social'      => '',
            'link_social'      => '',
            'img_social'      => '',

        ));
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

          <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'name_social' )); ?>"><?php _e('name:', 'icones'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name_social' ) ); ?>"name="<?php echo esc_attr( $this->get_field_name( 'name_social')); ?>" type="text" value="<?php echo esc_attr($name); ?>"/>
          </p>  
          <?php
    }

    // Display the widget
    public function widget( $args, $instance ) {

	extract( $args );

	// Check the widget options
	$name    = isset( $instance['name_social'] ) ? apply_filters( 'widget_title', $instance['name_social'] ) : '';

	// WordPress core before_widget hook (always include )
	echo $before_widget;

   // Display the widget
   echo '<div class="block_widget">';

		// Display widget title if defined
		if ( $name ) {
			echo $before_title . $name . $after_title;
		}


	echo '</div>';

	// WordPress core after_widget hook (always include )
	echo $after_widget;

    }
}