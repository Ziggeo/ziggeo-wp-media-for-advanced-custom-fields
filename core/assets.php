<?php

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();

function ziggeoacf_global() {

	//local assets
	//wp_register_style('ziggeoacf-css', ZIGGEOACF_ROOT_URL . 'assets/css/styles.css', array());    
	//wp_enqueue_style('ziggeoacf-css');

	wp_register_script('ziggeoacf-js', ZIGGEOACF_ROOT_URL . 'assets/js/codes.js', array());
	wp_enqueue_script('ziggeoacf-js');
}

//Load the admin scripts (and local)
function ziggeoacf_admin() {

	ziggeoacf_global();

}

add_action('wp_enqueue_scripts', "ziggeoacf_global");
add_action('admin_enqueue_scripts', "ziggeoacf_admin");


?>