<?php
/*
Plugin Name: Ziggeo Media for ACF
Plugin URI: https://ziggeo.com/integrations/wordpress
Description: Combine the power of Ziggeo API and the power of Advanced Custom Fields
Author: Ziggeo
Version: 1.1
Author URI: https://ziggeo.com
*/

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();


//rooth path
define('ZIGGEOACF_ROOT_PATH', plugin_dir_path(__FILE__) );

//Setting up the URL so that we can get/built on it later on from the plugin root
define('ZIGGEOACF_ROOT_URL', plugins_url('', __FILE__) . '/');

//plugin version - this way other plugins can get it as well and we will be updating this file for each version change as is
define('ZIGGEOACF_VERSION', '1.1');

//Include files
include_once(ZIGGEOACF_ROOT_PATH . 'core/run.php');

?>