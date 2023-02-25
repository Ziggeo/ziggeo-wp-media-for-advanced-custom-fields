<?php

// ziggeoacf_prepare_choices_settings
// ziggeoacf_should_use
// ziggeoacf_get_player_code
// ziggeoacf_get_recorder_code
// ziggeoacf_get_plugin_options_defaults
// ziggeoacf_get_plugin_options
// ziggeoacf_get_videowall_code

function ziggeoacf_prepare_choices_settings($values, $selected = null) {

	$choices = [];

	for($i = 0, $c = count($values); $i < $c; $i++) {
		$t_value = str_replace(' ', '_', strtolower($values[$i]));

		$choices[$t_value] = $values[$i];
	}

	return $choices;
}

function ziggeoacf_should_use($field, $key = null, $type = 'text', $value = '') {

	if($field === null || $key === null) {
		return false;
	}

	if(isset($field[$key])) {

		if($type === 'text' && $field[$key] === $value) {
			return false;
		}
		elseif($type === 'bool' && (bool)$field[$key] === (bool)$value) {
			return false;
		}

		return true;
	}

	return false;
}

//function to return the player parameters code using provided field data
function ziggeoacf_get_player_code($field) {
	$code = '';

	//if video token is present, lets add it
	if(ziggeoacf_should_use($field, 'video_token')) {
		$code .= ' ziggeo-video="' . $field['video_token'] . '" ';
	}

	//if theme is set
	if(ziggeoacf_should_use($field, 'theme')) {
		$code .= ' ziggeo-theme="' . $field['theme'] . '" ';
	}

	//if theme color is set
	if(ziggeoacf_should_use($field, 'theme_color')) {
		$code .= ' ziggeo-themecolor="' . $field['theme_color'] . '" ';
	}

	//if width is set
	if(ziggeoacf_should_use($field, 'width')) {
		$code .= ' ziggeo-width="' . $field['width'] . '" ';
	}

	//if height is set
	if(ziggeoacf_should_use($field, 'height')) {
		$code .= ' ziggeo-height="' . $field['height'] . '" ';
	}

	//if popup is set
	if(ziggeoacf_should_use($field, 'popup', 'bool', 0)) {
		$code .= ' ziggeo-popup="' . (bool)$field['popup'] . '" ';

		//if popup_width is set
		if(ziggeoacf_should_use($field, 'popup_width')) {
			$code .= ' ziggeo-popup-width="' . $field['popup_width'] . '" ';
		}

		//if popup_height is set
		if(ziggeoacf_should_use($field, 'popup_height')) {
			$code .= ' ziggeo-popup-height="' . $field['popup_height'] . '" ';
		}
	}

	//if effect profile is present
	if(ziggeoacf_should_use($field, 'effect_profiles')) {
		$code .= ' ziggeo-effect-profile="' . $field['effect_profiles'] . '" ';
	}

	//if video profile is present
	if(ziggeoacf_should_use($field, 'video_profile')) {
		$code .= ' ziggeo-video-profile="' . $field['video_profile'] . '" ';
	}

	//if client auth is present
	if(ziggeoacf_should_use($field, 'client_auth')) {
		$code .= ' ziggeo-client-auth="' . $field['client_auth'] . '" ';
	}

	//if client auth is present
	if(ziggeoacf_should_use($field, 'server_auth')) {
		$code .= ' ziggeo-server-auth="' . $field['server_auth'] . '" ';
	}

	//Lets return it
	return $code;
}

//function to return the recorder parameters code using provided field data
function ziggeoacf_get_recorder_code($field) {
	$code = '';

	//if theme is set
	if(ziggeoacf_should_use($field, 'theme')) {
		$code .= ' ziggeo-theme="' . $field['theme'] . '" ';
	}

	//if theme color is set
	if(ziggeoacf_should_use($field, 'theme_color')) {
		$code .= ' ziggeo-themecolor="' . $field['theme_color'] . '" ';
	}

	//if width is set
	if(ziggeoacf_should_use($field, 'width')) {
		$code .= ' ziggeo-width="' . $field['width'] . '" ';
	}

	//if height is set
	if(ziggeoacf_should_use($field, 'height')) {
		$code .= ' ziggeo-height="' . $field['height'] . '" ';
	}

	//if popup is set
	if(ziggeoacf_should_use($field, 'popup', 'bool', 0)) {
		$code .= ' ziggeo-popup="' . (bool)$field['popup'] . '" ';

		//if popup_width is set
		if(ziggeoacf_should_use($field, 'popup_width')) {
			$code .= ' ziggeo-popup-width="' . $field['popup_width'] . '" ';
		}

		//if popup_height is set
		if(ziggeoacf_should_use($field, 'popup_height')) {
			$code .= ' ziggeo-popup-height="' . $field['popup_height'] . '" ';
		}
	}

	//if faceoutline is set
	if(ziggeoacf_should_use($field, 'faceoutline', 'bool', 0)) {
		$code .= ' ziggeo-faceoutline="true" ';
	}

	//if recording_width is set
	if(ziggeoacf_should_use($field, 'recording_width', 'int', 640)) {
		$code .= ' ziggeo-recordingwidth="' . $field['recording_width'] . '" ';
	}

	//if recording_height is set
	if(ziggeoacf_should_use($field, 'recording_height', 'int', 480)) {
		$code .= ' ziggeo-recordingheight="' . $field['recording_height'] . '" ';
	}

	//if timelimit is set
	if(ziggeoacf_should_use($field, 'recording_time_max', 'int', 0)) {
		$code .= ' ziggeo-timelimit="' . $field['recording_time_max'] . '" ';
	}

	//if mintimelimit is set
	if(ziggeoacf_should_use($field, 'recording_time_min', 'int', 0)) {
		$code .= ' ziggeo-mintimelimit="' . $field['recording_time_min'] . '" ';
	}

	//if countdown is set
	if(ziggeoacf_should_use($field, 'recording_countdown', 'int', 3)) {
		$code .= ' ziggeo-countdown="' . $field['recording_countdown'] . '" ';
	}

	//if recordings (number of allowed recordings) is set
	if(ziggeoacf_should_use($field, 'recording_amount', 'int', 0)) {
		$code .= ' ziggeo-recordings="' . $field['recording_amount'] . '" ';
	}

	//if effect profile is present
	if(ziggeoacf_should_use($field, 'effect_profiles')) {
		$code .= ' ziggeo-effect-profile="' . $field['effect_profiles'] . '" ';
	}

	//if video profile is present
	if(ziggeoacf_should_use($field, 'video_profile')) {
		$code .= ' ziggeo-video-profile="' . $field['video_profile'] . '" ';
	}

	//if meta profile is present
	if(ziggeoacf_should_use($field, 'meta_profile')) {
		$code .= ' ziggeo-meta-profile="' . $field['meta_profile'] . '" ';
	}

	//if client auth is present
	if(ziggeoacf_should_use($field, 'client_auth')) {
		$code .= ' ziggeo-client-auth="' . $field['client_auth'] . '" ';
	}

	//if client auth is present
	if(ziggeoacf_should_use($field, 'server_auth')) {
		$code .= ' ziggeo-server-auth="' . $field['server_auth'] . '" ';
	}

	//Lets return it
	return $code;
}

//Get plugin defaults
function ziggeoacf_get_plugin_options_defaults() {
	$defaults = array(
		'version'                   => ZIGGEO_VERSION,
		'capture_content'           => ''
	);

	return $defaults;
}

// Returns all plugin settings or defaults if not existing
function ziggeoacf_get_plugin_options($specific = null) {
	$options = get_option('ziggeoacf');

	$defaults = ziggeoacf_get_plugin_options_defaults();

	//in case we need to get the defaults
	if($options === false || $options === '') {
		// the defaults need to be applied
		$options = $defaults;
	}

	// In case we are after a specific one.
	if($specific !== null) {
		if(isset($options[$specific])) {
			return $options[$specific];
		}
		elseif(isset($defaults[$specific])) {
			return $defaults[$specific];
		}
	}
	else {
		return $options;
	}

	return false;
}


//function to return the videowall parameters code using provided field data
function ziggeoacf_get_videowall_code($field) {
	$code = '';

	//Walls are processed on backend and entire code is placed on the front page, unlike the player and recorder which are processed by JavaScript.
	$wall = '[ziggeovideowall ';

	if(isset($field['design'])) {
		$wall .= 'wall_design="' . $field['design'] . '" ';
	}
	if(isset($field['videos_per_page']) && $field['videos_per_page'] !== '') {
		$wall .= 'videos_per_page="' . $field['videos_per_page'] . '" ';
	}
	if(isset($field['videos_to_show']) && $field['videos_to_show'] !== '') {
		$wall .= 'videos_to_show="' . $field['videos_to_show'] . '" ';
	}
	if(isset($field['message']) && $field['message'] !== '') {
		$wall .= 'message="' . $field['message'] . '" ';
	}
	if(isset($field['no_videos']) && $field['no_videos'] !== '') {
		$wall .= 'on_no_videos="' . $field['no_videos'] . '" ';
	}
	if(isset($field['show_videos']) && $field['show_videos'] !== '') {
		$wall .= 'show_videos="' . $field['show_videos'] . '" ';
	}
	if(isset($field['show']) && $field['show'] !== '') {
		$wall .=	'show="' . $field['show'] . '" ';
	}
	if(isset($field['autoplay']) && $field['autoplay'] !== '') {
		$wall .= 'autoplay="' . $field['autoplay'] . '" ';
	}
	if(isset($field['title']) && $field['title'] !== '') {
		$wall .= 'title="' . $field['title'] . '" ';
	}
	if(isset($field['videowidth']) && $field['videowidth'] !== '') {
		$wall .= 'video_width="' . $field['videowidth'] . '" ';
	}
	if(isset($field['videoheight']) && $field['videoheight'] !== '') {
		$wall .= 'video_height="' . $field['videoheight'] . '" ';
	}
	if(isset($field['template_name']) && $field['template_name'] !== '') {
		$wall .= 'template_name="' . $field['template_name'] . '" ';
	}

	$replace = array();
	$replace[] = array(
		'from'	=> '<',
		'to'	=> '&lt;'
	);
	$replace[] = array(
		'from'	=> '>',
		'to'	=> '&gt;'
	);

	$code = ziggeo_clean_text_values(ziggeo_line_min(videowallsz_content_parse_videowall($wall, false)), $replace);

	//Lets return it
	return $code;
}
