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

    add_action( 'widgets_init', 'new_social_zone' );

function new_social_zone() {

    register_sidebar( array(
        'name'          => 'icone media réseaux sociaux',
        'id'            => 'nouvelle_zone',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
        'class'         => 'icons_social',
    ) );
}

    function form( $instance ) {

        $defaults = apply_filters( 'icones_styles', array(
            'name'      => '',
            'facebook'  => '',
            'instagram' => '',
            'youtube'   => '',
            'linkedin'  => '',

        ));
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

          <p>

            <label for="<?php echo esc_attr( $this->get_field_id( 'name' )); ?>"><?php _e('name:', 'icones'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"name="<?php echo esc_attr( $this->get_field_name( 'name')); ?>" type="text" value="<?php echo esc_attr($name); ?>"/>

          
          </p>  
          <?php
    }
}