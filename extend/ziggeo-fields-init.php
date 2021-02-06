<?php

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();


// check if class already exists
if( !class_exists('Ziggeo_acf_plugin_ziggeo_fields') ) {

	class Ziggeo_acf_plugin_ziggeo_fields {

		// vars
		var $settings;

		function __construct() {
			
			// settings
			// - these will be passed into the field class.
			$this->settings = array(
				'version'	=> '1.0.0',
				'url'		=> plugin_dir_url( __FILE__ ),
				'path'		=> plugin_dir_path( __FILE__ )
			);

			// include field
			add_action('acf/include_field_types', 	array($this, 'include_field')); // v5
			//add_action('acf/register_fields', 		array($this, 'include_field')); // v4
		}

		//Include field	
		function include_field( $version = false ) {

			// support empty $version
			if( !$version || $version === 4) {
				return false; //We do not support v4
			}

			// include the ACF template
			include_once(ZIGGEOACF_ROOT_PATH . 'extend/class-ziggeo-template.php');

			if(defined('VIDEOWALLSZ_VERSION')) {
				include_once(ZIGGEOACF_ROOT_PATH . 'extend/class-video-wall.php');
			}
		}
		
	}

	// initialize
	new Ziggeo_acf_plugin_ziggeo_fields();
}
	
?>