<?php

class SocialMedia_widget extends WP_Widget
{

    // Main constructor
    public function __construct()
    {
        load_plugin_textdomain('SocialMedia');
        parent::__construct(
            'socialmedia_widget',
            __('socialmedia widget', 'SocialMedia'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    function form($instance)
    {

        global $wpdb;
        $table_name = $wpdb->prefix . 'social';

        $results = $wpdb->get_results("SELECT * FROM $table_name");

        foreach ($results as $data) {

            $data->name_social_profile = '<img src="' . plugin_dir_url(__FILE__) . 'icons/' . $data->img_social . '" alt="">';


            echo $args['before_widget'];
            // Display the widget
            echo '<div class="social-icons">';

            echo (!empty($data->link_social)) ? $data->name_social_profile : null;

            echo '</div>';
        }
        // WordPress core after_widget hook (always include )
        echo $args['after_widget'];
    }


    // Display the widget
    public function widget($args, $instance)
    {

        global $wpdb;
        $table_name = $wpdb->prefix . 'social';

        $results = $wpdb->get_results("SELECT * FROM $table_name");

        foreach ($results as $data) {

            $data->name_social_profile = '<a class="facebook" target="_blank" href="' . $data->name_social . '"> <img src="' . plugin_dir_url(__FILE__) . 'icons/' . $data->img_social . '" alt=""></a>';


            echo $args['before_widget'];
            // Display the widget
            echo '<div class="social-icons">';

            echo (!empty($data->link_social)) ? $data->name_social_profile : null;

            echo '</div>';
        }
        // WordPress core after_widget hook (always include )
        echo $args['after_widget'];
    }
}


?>