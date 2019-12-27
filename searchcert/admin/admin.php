<?php

// This function registers our style sheet

function admin_custom_css()
{
	
	wp_register_style( 'noiaa_stylesheet', plugins_url( '/admin-form.css' , __FILE__ ) );
	
	 if(($_GET["page"] == "certificate_page") || ($_GET["page"] == "trainingcourses_page") || ($_GET["page"] == "company_page") ) // this will test if it is the particular settings page to print out the CSS style.
    {
    
	wp_enqueue_style( 'noiaa_stylesheet'); 
	}
	}

add_action( 'admin_print_styles', 'admin_custom_css' );
add_action('admin_menu', 'noiaa_page_create');

function noiaa_page_create() {
	
    $page_title = 'Add Certificates to Database';
    $menu_title = 'Certificates';
    $capability = 'edit_posts';
    $menu_slug = 'certificate_page';
    $function = 'noiaa_display';
    $icon_url = '';
    $position = 24;
	
	$page_title1 = 'Add Training Courses to Database';
	$submenu_title1 = 'Add Training Courses to Database';
	$submenu1_slug = 'trainingcourses_page';
	$page_callback_function1 = 'noiaa_training';
	
	$page_title2 = 'Add Company to Database';
	$submenu_title2 = 'Add Company to Database';
	$submenu2_slug = 'company_page';
	$page_callback_function2 = 'noiaa_company';
	
	

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $menu_slug, $page_title1, $submenu_title1, 'edit_posts', $submenu1_slug, $page_callback_function1 );
	add_submenu_page( $menu_slug, $page_title2, $submenu_title2, 'edit_posts', $submenu2_slug, $page_callback_function2 );
	
}
	
	
function noiaa_display() {
	
    include 'form-file.php';
	
}

function noiaa_training() {
	
    include 'insert-training.php';
	
}

function noiaa_company() {
	
    include 'insert-company.php';
	
}