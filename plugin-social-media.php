<?php

/**
 * Plugin Name: Social Media
 * Description: A simple CSS and SVG driven social icons widget.
 * Version: 1.0
 * Author: Caroline et Mickael
 **/

 // Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

//Define path files
define( 'SOCIALMEDIA__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( SOCIALMEDIA__PLUGIN_DIR . 'social-media-db.php' );
require_once( SOCIALMEDIA__PLUGIN_DIR . 'class.social-media-widget.php' );


//calls the function to create the database when the plugin is activated
register_activation_hook( __FILE__, 'social_install' );
register_activation_hook( __FILE__, 'social_install_data' );

add_action("admin_menu", "SocialMedia_add_menu_dashboard");

//register widget in dashboard
add_action( 'widgets_init', 'new_social_zone' );

function new_social_zone() {

    register_widget( 'SocialMedia_widget');
}

////
function SocialMedia_add_menu_dashboard()
{

    add_menu_page(
        __("Social Media - settings", "SocialMedia"), // texte de la balise <title>
        __("Social Media", "SocialMedia"),  // titre de l'option de menu
        "manage_options", // droits requis pour voir l'option de menu
        "SocialMedia_menu_admin", // slug
        "SocialMedia_create_page_settings", // fonction de rappel pour créer la page
        "dashicons-share"
    );
}


function SocialMedia_create_page_settings()
{

    global $title;   // titre de la page du menu, tel que spécifié dans la fonction add_menu_page

?>

    <div class="wrap">

        <h2><?php echo $title; ?></h2>

        ...

    </div>

<?php

}

