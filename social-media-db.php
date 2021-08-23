<?php

global $social_db_version;
$social_db_version = '1.0';

function social_install()
{

    global $wpdb;
    global $social_db_version;

    $charset_collate = $wpdb->get_charset_collate();

    $social_table_name = $wpdb->prefix . 'social';

    $social_sql = "CREATE TABLE IF NOT EXISTS  $social_table_name (
    id_social int NOT NULL AUTO_INCREMENT,
    name_social varchar(100) DEFAULT NULL,
    link_social varchar(200) DEFAULT NULL,
    img_social varchar(200) DEFAULT NULL,
    PRIMARY KEY  (id_social)
    )$charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($social_sql);

    add_option( 'social_db_version', $social_db_version );
}


function social_install_data() {
	global $wpdb;
	
    $name = ['facebook', 'instagram', 'youtube', 'linkedin'];
    $image = ['facebook.svg', 'instagram.svg', 'youtube.svg', 'linkedin.svg'];
	
	$social_table_name = $wpdb->prefix . 'social';

	for($i=0; $i < 4; $i++){
        $wpdb->insert( 
            $social_table_name, 
            array( 
                'name_social' => $name[$i],
                'img_social' => $image[$i],
            
            )   
        );
    }  
}

function insert_link($instance) {
    if (isset($_POST['save'])) {
        global $wpdb;
        $wpdb->insert( "INSERT INTO  {$wpdb->prefix}social (link_social) VALUES ($instance) WHERE id_social = 1");  
    }
}

///truncate table when the plugin is desactivate
function truncateTable()
{
global $wpdb;
$table_name = $wpdb->prefix . 'social';

$wpdb->query('TRUNCATE TABLE ' . $table_name . '');
}





