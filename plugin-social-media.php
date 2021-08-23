<?php
/**
 * Plugin Name: Social Media
 * Description: A simple CSS and SVG driven social icons widget.
 * Version: 1.0
 * Author: Caroline et Mickael
 **/

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

function socialmedia_enqueue_script()
{
    wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . 'js/form.js');
}
add_action('admin_enqueue_scripts', 'socialmedia_enqueue_script');

function socialmedia_enqueue_style()
{
    wp_enqueue_style('my_custom_style', plugin_dir_url(__FILE__) . 'custom/style.css');
}
add_action('admin_print_styles', 'socialmedia_enqueue_style');

//Define path files
define('SOCIALMEDIA__PLUGIN_DIR', plugin_dir_path(__FILE__));
require_once SOCIALMEDIA__PLUGIN_DIR . 'social-media-db.php';
require_once SOCIALMEDIA__PLUGIN_DIR . 'class.social-media-widget.php';

//Define path img
define('SOCIALMEDIAPATH', plugin_dir_url(__FILE__));

//calls the function to create the database when the plugin is activated
register_activation_hook(__FILE__, 'social_install');
register_activation_hook(__FILE__, 'social_install_data');

add_action("admin_menu", "SocialMedia_add_menu_dashboard");

//register widget in dashboard
add_action('widgets_init', 'new_social_zone');

function new_social_zone()
{

    register_widget('SocialMedia_widget');
}

////
function SocialMedia_add_menu_dashboard()
{

    add_menu_page(
        __("Social Media - settings", "SocialMedia"), // texte de la balise <title>
        __("Social Media", "SocialMedia"), // titre de l'option de menu
        "manage_options", // droits requis pour voir l'option de menu
        "SocialMedia_menu_admin", // slug
        "SocialMedia_create_page_settings", // fonction de rappel pour créer la page
        "dashicons-share"
    );
}

function select()
{

    global $wpdb;

    $results = $wpdb->get_results(
        "SELECT * FROM $wpdb->prefix . 'social'");
}

function SocialMedia_create_page_settings()
{

    global $title; // titre de la page du menu, tel que spécifié dans la fonction add_menu_page

    global $wpdb;
    $table_name = $wpdb->prefix . 'social';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
    ?>

    <div class="wrap">

        <h2><?php echo $title; ?></h2>
    <div class="info">
        <form action="" method="post">

        <?php

    foreach ($results as $data):

    ?>

        
            <div>
                <input type="hidden" name="id_social" value="<?=$data->id_social;?>">
            </div>
            <div class="name-reseaux">
            <div class="image">
                <img id="preview" src="<?=SOCIALMEDIAPATH . $data->img_social;?>" alt="<?=$data->name_social;?>" />
            </div>
            <div class="social">
                <?=$data->name_social;?></p>
            </div>
            </div>
            <div>
                <label for="link_social">Lien</label>
                <input type="text" name="link_social">
            </div>
            
            <?php endforeach?>
        
            <input class="metjour" type="submit" value="Mettre à jour" name="submit">
            </form>
            </div>
        <button>Ajouter un réseau social</button>
        
    </div>

<?php

}
