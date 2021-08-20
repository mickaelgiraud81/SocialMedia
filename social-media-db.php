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
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$social_table_name = $wpdb->prefix . 'social';
	
	$wpdb->insert( 
		$social_table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
      
}

function insert_link($instance) {
    if (isset($_POST['save'])) {
        global $wpdb;
        $wpdb->insert( "INSERT INTO  {$wpdb->prefix}social (link_social) VALUES ($instance) WHERE id_social = 1");  
    }
}





