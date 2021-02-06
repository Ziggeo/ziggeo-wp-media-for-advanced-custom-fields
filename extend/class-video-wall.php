<?php

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();

// check if class already exists
if( !class_exists('Ziggeo_acf_field_videowalls') ) {

	class Ziggeo_acf_field_videowalls extends acf_field {

		protected $title  = '';
		protected $key    = 'video-wall';
		protected $group  = 'ziggeo';
		protected $icon   = 'dashicons dashicons-playlist-video ziggeo-ff-field';
		protected $index  = 2;
		protected $tags   = ['ziggeo', 'video', 'videowall', 'playlist', 'wall'];

		function __construct( $settings ) {

			// name (string) Single word, no spaces. Underscores allowed
			$this->name = 'video_wall';

			// label (string) Multiple words, can include spaces, visible when selecting a field type
			$this->label = __('Video Wall', 'ziggeoacf');

			// category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
			$this->category = 'Ziggeo';

			// defaults (array) Array of default settings which are merged into the field object. These are used later in settings
			$this->defaults = array(
				'title'						=> '',
				'design'					=> 'default',
				'videowidth'				=> '',
				'videoheight'				=> '',
				'videos_per_page'			=> '',

				'autoplay'					=> 'no',
				'show'						=> 'yes',
				'no_videos'					=> 'showmessage',
				'message'					=> 'No videos found',
				'template_name'				=> '',
				'show_videos'				=> 'approved',
				'videos_to_show'			=> ''
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

			//Videowall title
			acf_render_field_setting( $field, array(
				'label'			=> __('Videowall title','ziggeoacf'),
				'instructions'	=> __('Set the heading / title of your video wall.','ziggeoacf'),
				'type'			=> 'text',
				'name'			=> 'title'
			));

			//Videowall design
			acf_render_field_setting( $field, array(
				'label'         => __('Videowall design','ziggeoacf'),
				'instructions'  => __('Select the design of your videowall.','ziggeoacf'),
				'type'          => 'select',
				'name'          => 'design',
				'choices'       => ziggeoacf_prepare_choices_settings(array('Default', 'Show Pages', 'Slide Wall', 'Mosaic Grid', 'Chessboard Grid', 'Videosite Playlist'), 'Default')
			));

			//player width
			acf_render_field_setting( $field, array(
				'label'         => __('Player Width','ziggeoacf'),
				'instructions'	=> __('This is the width of player within the videowall. It will affect video players in different designs differently.','ziggeoacf'),
				'type'          => 'text',
				'name'          => 'videowidth'
			));

			//player height
			acf_render_field_setting( $field, array(
				'label'         => __('Player Height','ziggeoacf'),
				'instructions'  => __('This is the height of player within the videowall. It will affect video players in different designs differently.','ziggeoacf'),
				'type'          => 'text',
				'name'          => 'videoheight'
			));

			//Videos per page
			acf_render_field_setting( $field, array(
				'label'          => __('Videos Per Page','ziggeoacf'),
				'instructions'	=> __('How many videos should be shown in a page? Used only in paged videowall designs.','ziggeoacf'),
				'type'          => 'text',
				'name'          => 'videos_per_page'
			));

			//Enable Autoplay
			acf_render_field_setting( $field, array(
				'label'         => __('Enable Autoplay?','ziggeoacf'),
				'instructions'  => __('This will turn on the autoplay for videos. Autoplay might not work as it depends on many factors!','ziggeoacf'),
				'type'          => 'select',
				'name'          => 'autoplay',
				'choices'       => ziggeoacf_prepare_choices_settings(array('Yes', 'No'), 'Yes')
			));

			//Show Videowall on creation?
			acf_render_field_setting( $field, array(
				'label'         => __('Show Videowall?','ziggeoacf'),
				'instructions'  => __('The wall is hidden by default until you make a recording on same page. Turning this on will show it on load.','ziggeoacf'),
				'type'          => 'select',
				'name'          => 'show',
				'choices'       => ziggeoacf_prepare_choices_settings(array('Yes', 'No'), 'Yes')
			));

			//No Videos handling
			acf_render_field_setting( $field, array(
				'label'         => __('What happens on no videos?','ziggeoacf'),
				'instructions'  => __('When the query returns no videos, what do you want to have happen?','ziggeoacf'),
				'type'          => 'select',
				'name'          => 'no_videos',
				'choices'       => ziggeoacf_prepare_choices_settings(array('Show Message', 'Show Template', 'Hide Wall'), 'Show Message')
			));

			//Message
			acf_render_field_setting( $field, array(
				'label'         => __('Message to show','ziggeoacf'),
				'instructions'  => __('This message will be used on no videos found','ziggeoacf'),
				'type'          => 'text',
				'name'          => 'message'
			));

			//Template name to use
			acf_render_field_setting( $field, array(
				'label'         => __('Template to show','ziggeoacf'),
				'instructions'  => __('The template to show if there are no videos found','ziggeoacf'),
				'type'          => 'text',
				'name'          => 'template_name'
			));

			//Show videos
			acf_render_field_setting( $field, array(
				'label'         => __('What videos to show?','ziggeoacf'),
				'instructions'  => __('Videos to be shown per their status.','ziggeoacf'),
				'type'          => 'select',
				'name'          => 'show_videos',
				'choices'       => ziggeoacf_prepare_choices_settings(array('All', 'Approved', 'Rejected', 'Pending'), 'Approved')
			));

			//Template name to use
			acf_render_field_setting( $field, array(
				'label'         => __('What videos to search for?','ziggeoacf'),
				'instructions'  => __('Comma separated string of tags to search for.','ziggeoacf'),
				'type'          => 'text',
				'name'          => 'videos_to_show'
			));

		}

		// Create the HTML interface for your field
		function render_field( $field ) {

			if(!isset($field['name'])) {
				$field['name'] = '';
			}

			$field_id = 'acf-video-player-' . $field['ID'] . '-' . $field['key'];

			$_tmp_field = ziggeoacf_get_videowall_code($field);

			//Needed on this side
			$_tmp_field = str_replace('&lt;', '<', $_tmp_field);
			$_tmp_field = str_replace('&gt;', '>', $_tmp_field);
			$_tmp_field = str_replace('&quot;', '"', $_tmp_field);
			$_tmp_field = str_replace('&apos;', "'", $_tmp_field);

			$field_output = ziggeo_p_integrations_field_add_custom_tag($_tmp_field, 'data-id="' . $field_id . '"' . ' data-is-acf="true" ');

			echo '<input id="' . $field_id . '" name="' . $field['name'] . '" type="hidden">';
			echo $field_output;
		}

	}

	// initialize
	new Ziggeo_acf_field_videowalls( $this->settings );
}

?>