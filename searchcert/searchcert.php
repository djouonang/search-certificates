<?php

/*
Plugin Name: Search Certificates
Plugin URI: http://noiaa.com/
Description: form to search certificates in the database
Version: 1.0
Author: Powered by Djouonang Landry
Author URI: http://noiaa.com/

*/

include dirname( __FILE__ ) .'/admin/admin.php';
include dirname( __FILE__ ) .'/searchform.php';

function esearch_head() {
 
	wp_register_style( 'noiaa-css', plugins_url( '/style.css' , __FILE__ ) );
 
        if ((is_page('13018') ) )
    {
    
    wp_enqueue_style('noiaa-css');
	}
}
 
add_action( 'wp_enqueue_scripts', 'esearch_head' );

function searchform_create_db() {

	global $wpdb;
	$table_name = $wpdb->prefix . 'certificate';
    $table_name1 = $wpdb->prefix . 'formation';
	$table_name2 = $wpdb->prefix . 'societe';
	
	$sql1 = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		idcertificat VARCHAR(30) NOT NULL,
		nom VARCHAR(30) NOT NULL,
		numero VARCHAR(30) NOT NULL,
		idformation VARCHAR(30) NOT NULL,
		idsociete VARCHAR(30) NOT NULL,
		date_formation datetime  NOT NULL,
		date_expiration datetime  NOT NULL,
		createur VARCHAR(30) NOT NULL,
		modificateur VARCHAR(30) NOT NULL,
		date_creation datetime  NOT NULL,
		date_modification datetime  NOT NULL,
		etat VARCHAR(30) NOT NULL,
		Primary KEY (id)
	);";
	
	$sql2 = "CREATE TABLE $table_name1 (
	
	    id mediumint(9) NOT NULL AUTO_INCREMENT,
		idformation VARCHAR(30) NOT NULL,
		titre VARCHAR(30) NOT NULL,
		Primary KEY (id)
	);";
	
	$sql3 = "CREATE TABLE $table_name2 (
	    id mediumint(9) NOT NULL AUTO_INCREMENT,
		idsociete VARCHAR(30) NOT NULL,
		titre VARCHAR(30) NOT NULL,
		Primary KEY (id)
	);";
	
	$sql = [$sql1, $sql2, $sql3];

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

}

register_activation_hook( __FILE__, 'searchform_create_db' );
