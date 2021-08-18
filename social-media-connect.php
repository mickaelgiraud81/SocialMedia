<?php 

global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$social_table_name = $wpdb->prefix . 'social';

$social_sql = "CREATE TABLE IF NOT EXISTS  $social_table_name (
    id_social int NOT NULL AUTO_INCREMENT,
    name_social varchar(100) DEFAULT NULL,
    link_social varchar(200) DEFAULT NULL,
    img_social varchar(200) DEFAULT NULL,

    PRIMARY KEY  (id)
)$charset_collate;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

dbDelta($social_sql);
