<?php

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();

// check if class already exists
if( !class_exists('Ziggeo_acf_field_video_recorder') ) {


	class Ziggeo_acf_field_video_recorder extends acf_field {

		function __construct( $settings ) {

			// name (string) Single word, no spaces. Underscores allowed
			$this->name = 'video_recorder';

			// label (string) Multiple words, can include spaces, visible when selecting a field type
			$this->label = __('Video Recorder', 'ziggeoacf');

			// category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
			$this->category = 'Ziggeo';

			// defaults (array) Array of default settings which are merged into the field object. These are used later in settings
			$this->defaults = array(
				'video_token'           => '',
				'theme'                 => 'Default',
				'theme_color'           => 'Blue',
				'width'                 => '100%',
				'height'                => '',
				'popup'                 => false,
				'popup_width'           => false,
				'popup_height'          => false,
				'faceoutline'           => false,
				'video_title'           => '',
				'video_description'     => '',
				'video_tags'            => '',
				'custom_data'           => '',
				'recording_width'       => 640,
				'recording_height'      => 480,
				'recording_time_max'    => 0,
				'recording_time_min'    => 0,
				'recording_countdown'   => 3,
				'recording_amount'      => 0,
				'effect_profiles'	    => '',
				'video_profile'         => '',
				'meta_profile'          => '',
				'client_auth'           => '',
				'server_auth'           => ''
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

			//Recorder Theme
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Theme','ziggeoacf'),
				'instructions'	=> __('Select the theme of your recorder.','ziggeoacf'),
				'type'			=> 'select',
				'name'			=> 'theme',
				'choices'		=> ziggeoacf_prepare_choices_settings(array('Default', 'Modern', 'Cube', 'Space', 'Minimalist', 'Elevate', 'Theatre'), 'Default')
			));

			//Theme Color
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Theme Color','ziggeoacf'),
				'instructions'	=> __('Select the theme color.','ziggeoacf'),
				'type'			=> 'select',
				'name'			=> 'theme_color',
				'choices'		=> ziggeoacf_prepare_choices_settings(array('Blue', 'Green', 'Red'), 'Blue')
			));

			//Recorder width
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Width','ziggeoacf'),
				'instructions'	=> __('Set the width of your recorder.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'width'
			));

			//Recorder height
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Height','ziggeoacf'),
				'instructions'	=> __('Set the height of your recorder.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'height'
			));

			//Recorder as a popup?
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Popup','ziggeoacf'),
				'instructions'	=> __('Set the recorder to be played within a popup.','ziggeoacf'),
				'type'			=> 'true_false',
				'name'			=> 'popup'
			));

			//Recorder popup width
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Popup Width','ziggeoacf'),
				'instructions'	=> __('Set the width of the recorder within the popup.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'popup_width'
			));

			//Recorder popup height
			acf_render_field_setting( $field, array(
				'label'			=> __('Recorder Popup Height','ziggeoacf'),
				'instructions'	=> __('Set the height of the recorder within the popup.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'popup_height'
			));

			//Do you want to show faceoutline?
			acf_render_field_setting( $field, array(
				'label'			=> __('Face Outline','ziggeoacf'),
				'instructions'	=> __('Show face outline (will not be captured on video).','ziggeoacf'),
				'type'			=> 'true_false',
				'name'			=> 'faceoutline'
			));

			//Video Title
			acf_render_field_setting( $field, array(
				'label'			=> __('Video Title','ziggeoacf'),
				'instructions'	=> __('Set the title for your video.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'video_title'
			));

			//Video Description
			acf_render_field_setting( $field, array(
				'label'			=> __('Video Description','ziggeoacf'),
				'instructions'	=> __('Set the description for your video.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'video_description'
			));

			//Video Tags
			acf_render_field_setting( $field, array(
				'label'			=> __('Video Tags','ziggeoacf'),
				'instructions'	=> __('Set the tags describing your video.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'video_tags'
			));

			//Video' Custom Data
			acf_render_field_setting( $field, array(
				'label'			=> __('Custom (JSON format only) data','ziggeoacf'),
				'instructions'	=> __('Set the tags describing your video.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'custom_data'
			));

			//Recording width
			acf_render_field_setting( $field, array(
				'label'			=> __('Recording Width','ziggeoacf'),
				'instructions'	=> __('Set the width of the recording.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'recording_width'
			));

			//Recording height
			acf_render_field_setting( $field, array(
				'label'			=> __('Recording Height','ziggeoacf'),
				'instructions'	=> __('Set the height of the recording.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'recording_height'
			));

			//Recording time (MAX)
			acf_render_field_setting( $field, array(
				'label'			=> __('Maximum seconds to record','ziggeoacf'),
				'instructions'	=> __('Set the maximum length of video to capture (0 = unlimited).','ziggeoacf'),
				'type'			=> 'number',
				'name'			=> 'recording_time_max'
			));

			//Recording time (MIN)
			acf_render_field_setting( $field, array(
				'label'			=> __('Minimum seconds to record','ziggeoacf'),
				'instructions'	=> __('Set the minimum length of video to capture (0 = unlimited).','ziggeoacf'),
				'type'			=> 'number',
				'name'			=> 'recording_time_min'
			));

			//Pre-Recording countdown
			acf_render_field_setting( $field, array(
				'label'			=> __('Countdown time','ziggeoacf'),
				'instructions'	=> __('Number of seconds for countdown to recording.','ziggeoacf'),
				'type'			=> 'number',
				'name'			=> 'recording_countdown'
			));

			//Number of recordings
			acf_render_field_setting( $field, array(
				'label'			=> __('Number of recordings allowed','ziggeoacf'),
				'instructions'	=> __('This equals first recording + additional recordings (0 = unlimited).','ziggeoacf'),
				'type'			=> 'number',
				'name'			=> 'recording_amount'
			));

			//Effect Profile
			acf_render_field_setting( $field, array(
				'label'			=> __('Effect Profile Token','ziggeoacf'),
				'instructions'	=> __('Apply specific effect profile (or multiple - comma separated) to new video.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'effect_profiles'
			));

			//Video Profile
			acf_render_field_setting( $field, array(
				'label'			=> __('Video Profile Token','ziggeoacf'),
				'instructions'	=> __('Apply some video profiles.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'video_profile'
			));

			//Meta Profile
			acf_render_field_setting( $field, array(
				'label'			=> __('Meta Profile Token','ziggeoacf'),
				'instructions'	=> __('Apply specific meta profile to your video.','ziggeoacf'),
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
			echo '<ziggeorecorder data-id="' . $field_id . '"' . ' data-is-acf="true"' . ziggeoacf_get_recorder_code($field) . '></ziggeorecorder>';
		}

		// Shows the value on frontend. Would be token if recorded, we now change it to code instead
		function load_value( $value, $post_id, $field ) {

			$original_value = $value;

			//If we have token, we can show it in the player
			if($value !== '') {

				if( stripos($value, 'http') > -1 ) {
					$value = '<ziggeoplayer ziggeo-source="' . $value . '" ' . ziggeo_get_player_code('integrations') . '></ziggeoplayer>';
				}
				else {
					$value = '<ziggeoplayer ziggeo-video="' . $value . '" ' . ziggeo_get_player_code('integrations') . '></ziggeoplayer>';
				}
			}
			else {
				$value = '<ziggeorecorder ' . ziggeoacf_get_recorder_code($field) . '></ziggeorecorder>';
			}


			$value = apply_filters('ziggeoacf_value_output_recorder', $value, $original_value, $field, $post_id);

			return $value;
		}

	}

	// initialize
	new Ziggeo_acf_field_video_recorder( $this->settings );
}

?>