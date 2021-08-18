<?php

class SocialMedia_widget extends WP_Widget{

    public function __construct() {
        load_plugin_textdomain( 'SocialMedia')
        parent::__construct(
            'socialmedia_widget',
            __( 'socialmedia widget', 'SocialMedia'),
            array(
                'customize_selective_refresh' => true,
            )
            );
    }

    function form( $instance ) {

        $defaults = apply_filters( 'icones_styles', array(
            'title'  => '',
            'size'   => 36,
            'alignement'   => 'alignleft',
            'facebook'   => '',
            'instagram'  => '',
            'youtube'  => '',
            'linkedin'  => '',

        ));
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

          <p>

            <label for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"><?php _e('title:', 'icones'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"name="<?php echo esc_attr( $this->get_field_name( 'title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
          
          </p>  
    }
}