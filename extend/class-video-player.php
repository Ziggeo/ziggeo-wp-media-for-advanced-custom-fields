<?php

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();

// check if class already exists
if( !class_exists('Ziggeo_acf_field_video_player') ) {


	class Ziggeo_acf_field_video_player extends acf_field {

		function __construct( $settings ) {

			// name (string) Single word, no spaces. Underscores allowed
			$this->name = 'video_player';

			// label (string) Multiple words, can include spaces, visible when selecting a field type
			$this->label = __('Video Player', 'ziggeoacf');

			// category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
			$this->category = 'Ziggeo';

			// defaults (array) Array of default settings which are merged into the field object. These are used later in settings
			$this->defaults = array(
				'video_token'       => '',
				'theme'             => 'Default',
				'theme_color'       => 'Blue',
				'width'             => '100%',
				'height'            => '',
				'popup'             => false,
				'popup_width'       => false,
				'popup_height'      => false,
				'effect_profiles'	=> '',
				'video_profile'     => '',
				'client_auth'       => '',
				'server_auth'       => ''
			);

			//  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
			//  var message = acf._e('FIELD_NAME', 'error');
			$this->l10n = array(
				//'error'	=> __('Error! Please enter a higher value', 'ziggeoacf'),
			);

			// settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
			$this->settings = $settings;

			// do not delete!
			parent::__construct();
		}

		//  Create extra settings for your field. These are visible when editing a field
		function render_field_settings( $field ) {

			//Any setting added here has to be in the $this->defaults above as well, where it's default value is set

			//Video token
			acf_render_field_setting( $field, array(
				'label'			=> __('Video Token','ziggeoacf'),
				'instructions'	=> __('Add the video token to be played back','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'video_token',
				'prepend'		=> '',
			));

			//Player Theme
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Theme','ziggeoacf'),
				'instructions'	=> __('Select the theme of your player.','ziggeoacf'),
				'type'			=> 'select',
				'name'			=> 'theme',
				'choices'		=> ziggeoacf_prepare_choices_settings(array('Default', 'Modern', 'Cube', 'Space', 'Minimalist', 'Elevate', 'Theatre'), 'Default')
			));

			//Theme Color
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Theme Color','ziggeoacf'),
				'instructions'	=> __('Select the theme color.','ziggeoacf'),
				'type'			=> 'select',
				'name'			=> 'theme_color',
				'choices'		=> ziggeoacf_prepare_choices_settings(array('Blue', 'Green', 'Red'), 'Blue')
			));

			//Player width
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Width','ziggeoacf'),
				'instructions'	=> __('Set the width of your player.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'width'
			));

			//Player height
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Height','ziggeoacf'),
				'instructions'	=> __('Set the height of your player.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'height'
			));

			//Player as a popup?
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Popup','ziggeoacf'),
				'instructions'	=> __('Set the player to be played within a popup.','ziggeoacf'),
				'type'			=> 'true_false',
				'name'			=> 'popup'
			));

			//Player popup width
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Popup Width','ziggeoacf'),
				'instructions'	=> __('Set the width of the player within the popup.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'popup_width'
			));

			//Player popup height
			acf_render_field_setting( $field, array(
				'label'			=> __('Player Popup Height','ziggeoacf'),
				'instructions'	=> __('Set the height of the player within the popup.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'popup_height'
			));

			//Effect Profile
			acf_render_field_setting( $field, array(
				'label'			=> __('Effect Profile Token','ziggeoacf'),
				'instructions'	=> __('Use specific effect stream.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'effect_profiles'
			));

			//Video Profile
			acf_render_field_setting( $field, array(
				'label'			=> __('Video Profile Token','ziggeoacf'),
				'instructions'	=> __('Use specific video stream.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'video_profile'
			));

			//Client Auth
			acf_render_field_setting( $field, array(
				'label'			=> __('Client Auth Token','ziggeoacf'),
				'instructions'	=> __('Use client auth token.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'client_auth'
			));

			//Server Auth
			acf_render_field_setting( $field, array(
				'label'			=> __('Server Auth Token','ziggeoacf'),
				'instructions'	=> __('Use server auth token.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'server_auth'
			));
		}

		// Create the HTML interface for your field
		function render_field( $field ) {

			if(!isset($field['name'])) {
				$field['name'] = '';
			}

			$field_id = 'acf-video-player-' . $field['ID'] . '-' . $field['key'];
			//echo '<input id="' . $field_id . '" name="' . $field['name'] . '" type="text" value="' . $field['video_token'] .'">';
			echo '<input id="' . $field_id . '" name="' . $field['name'] . '" type="hidden">';
			echo '<ziggeoplayer data-id="' . $field_id . '"' . ' data-is-acf="true"' . ziggeoacf_get_player_code($field) . '></ziggeoplayer>';

			//
			// Create a simple text input using the 'font_size' setting.
			/*<input type="text" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo esc_attr($field['value']) ?>" style="font-size:<?php echo $field['font_size'] ?>px;" />*/
		}

		function load_value( $value, $post_id, $field ) {

			$original_value = $value;

			$value = '<ziggeoplayer ' . ziggeoacf_get_player_code($field) . '></ziggeoplayer>';

			$value = apply_filters('ziggeoacf_value_output_player', $value, $original_value, $field, $post_id);

			return $value;
		}

	}

	// initialize
	new Ziggeo_acf_field_video_player( $this->settings );

}

?>