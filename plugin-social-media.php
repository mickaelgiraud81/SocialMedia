<?php

/**
 * Plugin Name: Social Media
 * Description: A simple CSS and SVG driven social icons widget.
 * Version: 1.0
 * Author: Caroline et Mickael
 **/

add_action("admin_menu", "SocialMedia_add_menu_dashboard");

define( 'SOCIALMEDIA__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( SOCIALMEDIA__PLUGIN_DIR . 'social-media-connect.php' );

///calls the function to create the database when the plugin is activated
register_activation_hook( __FILE__, 'social_install' );
register_activation_hook( __FILE__, 'social_install_data' );


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

