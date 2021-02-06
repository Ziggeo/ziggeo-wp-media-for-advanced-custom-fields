<?php

//
//	This file represents the integration module for ACF and Ziggeo
//

// Index
//	1. Hooks
//		1.1. ziggeo_list_integration
//		1.2. plugins_loaded
//	2. Functionality
//		2.1. ziggeoacf_get_int_version()
//		2.2. ziggeoacf_init()
//		2.3. ziggeoacf_run()

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();

//Show the entry in the integrations panel
add_filter('ziggeo_list_integration', function($integrations) {

	$current = array(
		//This section is related to the plugin that we are combining with the Ziggeo, not the plugin/module that does it
		'integration_title'		=> 'Advanced Custom Fields', //Name of the plugin
		'integration_origin'	=> 'https://www.advancedcustomfields.com', //Where you can download it from

		//This section is related to the plugin or module that is making the connection between Ziggeo and the other plugin.
		'title'					=> 'Ziggeo Media for ACF', //the name of the module
		'author'				=> 'Ziggeo', //the name of the author
		'author_url'			=> 'https://ziggeo.com/', //URL for author website
		'message'				=> 'Add multimedia to ACF all over your Wordpress', //Any sort of message to show to customers
		'status'				=> true, //Is it turned on or off?
		'slug'					=> 'ziggeo-media-for-acf', //slug of the module
		//URL to image (not path). Can be of the original plugin, or the bridge
		'logo'					=> ZIGGEOACF_ROOT_URL . 'assets/images/logo.png',
		'version'				=> ZIGGEOACF_VERSION
	);

	//Check current Ziggeo version
	if(ziggeoacf_run() === true) {
		$current['status'] = true;
	}
	else {
		$current['status'] = false;
	}

	$integrations[] = $current;

	return $integrations;
});

add_action('plugins_loaded', function() {
	ziggeoacf_run();
});

//Checks if the ACF exists and returns the version of it
function ziggeoacf_get_int_version() {

	if(!defined( 'ACF_VERSION' ) ) {
		return 0;
	}

	return ACF_VERSION;
}

//Include all of the needed plugin files
function ziggeoacf_include_plugin_files() {

	//Include the files only if we are running this plugin
	
	include_once(ZIGGEOACF_ROOT_PATH . 'core/simplifiers.php');
	include_once(ZIGGEOACF_ROOT_PATH . 'core/assets.php');
	include_once(ZIGGEOACF_ROOT_PATH . 'core/hooks.php');

	//Fields specific
	require_once(ZIGGEOACF_ROOT_PATH . 'extend/video-fields-init.php');
	require_once(ZIGGEOACF_ROOT_PATH . 'extend/ziggeo-fields-init.php');

}

//We add all of the hooks we need
function ziggeoacf_init() {

	//Lets include all of the files we need
	ziggeoacf_include_plugin_files();
}

//Function that we use to run the module 
function ziggeoacf_run() {

	//Needed during activation of the plugin
	if(!function_exists('ziggeo_get_version')) {
		return false;
	}

	//Check current Ziggeo version
	if( version_compare(ziggeo_get_version(), '2.0') >= 0 &&
		//check the ACF version
		version_compare(ziggeoacf_get_int_version(), '5.8.12') >= 0) {

		if(ziggeo_integration_is_enabled('ziggeo-media-for-acf')) {
			ziggeoacf_init();
			return true;
		}
	}

	return false;
}


?>