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

//calls the function to desactive the database when the plugin is activated
register_deactivation_hook(__FILE__, 'truncateTable');

//register widget in dashboard
add_action('widgets_init', 'new_social_zone');

function new_social_zone()
{

    register_widget('SocialMedia_widget');
}

////add plugin to the dashboard menu
function SocialMedia_add_menu_dashboard()
{

    add_menu_page(
        "Social Media", // texte de la balise <title>
        "Social Media",  // titre de l'option de menu
        "manage_options", // droits requis pour voir l'option de menu
        "SocialMedia_menu_admin", // slug
        "SocialMedia_create_page_settings", // fonction de rappel pour créer la page
        "dashicons-share"
    ); 

    add_submenu_page(
        'SocialMedia_menu_admin',
        'Ajouter un réseau social',
        'Ajouter un réseau social',
        'manage_options',
        'SocialMedia_submenu_page',
        'SocialMedia_submenu_page_settings'
    );
}

add_action("admin_menu", "SocialMedia_add_menu_dashboard");


function SocialMedia_create_page_settings()
{

    global $title;   // title menu page

    global $wpdb;
    $table_name = $wpdb->prefix . 'social';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
    ?>

    <div class="wrap" id="wrap">

        <h2><?php echo $title; ?></h2>

        <form id="form_socialmedia" action="" method="post">

        <?php   
        foreach($results as $data): ?>
        <div id="social_wrap">
            <div>
                <input type="hidden" name="id_social[]" value="<?=$data->id_social;?>">
            </div>
            <div class="name-reseaux"
                <div class="image">
                    <img id="preview" src="<?=SOCIALMEDIAPATH .'icons/'. $data->img_social;?>" alt="<?=$data->name_social;?>" />
                </div>
                <div class="social">
                    <?=$data->name_social;?></p>
                </div>
            </div>
            <div>
                <label for="link_social">Lien</label>
                <input type="text" name="link_social[]" value="<?=$data->link_social;?>">
            </div>
        </div>
            <?php 
            
            
            endforeach ?>
            <input type="submit" value="Mettre à jour" name="submit">
        </form> 
    </div>
<?php
    
 if(isset($_POST['submit'])){
     $number = count($results);
    for($i=0; $i <= $number; $i++){
       

        $wpdb->update( 
        $table_name, 
        array( 
            'link_social' =>  $_POST['link_social'][$i], 
        ), 
        array( 'id_social' => $_POST['id_social'][$i]), 
        array( 
            '%s', 
        ) 
    );
    }
 }
}


function SocialMedia_submenu_page_settings()
{
    ?>

<div class="wrap" id="wrap">

<h2>Ajouter un réseau social</h2>

<form id="form_add_socialmedia" action="" method="post" enctype="multipart/form-data"> 

<div id="social_wrap">
  
    <div id="image">
        <label for="img_social">Choisir une image</label>
        <input type="file" name="img_social" accept=".svg" id="imgInp" value="<?=SOCIALMEDIAPATH .'icons/';?>" required>
        <img id="preview" src="<?=SOCIALMEDIAPATH .'icons/image.svg';?>" alt="your image" />
        <i>Format accepté : 'SVG'.</i>
    </div>
    <div>
        <label for="name_social">Nom du réseau social</label>
        <input type="text" name="name_social" required>
    </div>
    <div>
        <label for="link_social">Lien</label>
        <input type="text" name="link_social">
    </div>
</div>
    <input type="submit" value="Mettre à jour" name="save">
</form>
    
</div> 
<?php
    if(isset($_POST['save'])){
        addsocial();
    }

}

/// Function sql request insertion social media and move upload img
function addsocial(){
     
    $dossier = SOCIALMEDIA__PLUGIN_DIR .'icons/';
    $filename = basename($_FILES['img_social']['name']);
    $ext = strtoupper(pathinfo($filename, PATHINFO_EXTENSION));
    $file_tmp = $_FILES['img_social']['tmp_name'];
    $rename = $filename . uniqid(date("Ymd")) . '.' . $ext;
    $file = $dossier . $filename;
    $file_rename = $dossier . $rename;

    if (file_exists("icons/" . $_FILES["img_social"]["name"])) {
        move_uploaded_file($file_tmp, $file_rename);
        $return_name = $rename;
    } else {
        move_uploaded_file($file_tmp, $file);
        $return_name =  $_FILES['img_social']['name'];
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'social';

    $wpdb->insert( 
        $table_name, 
        array( 
            'name_social' => $_POST['name_social'], 
            'link_social' => $_POST['link_social'], 
            'img_social' => $return_name, 
        ), 
        array( 
            '%s', 
            '%s', 
            '%s'
        ) 
    ); 
}