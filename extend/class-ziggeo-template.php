<?php

//Checking if WP is running or if this is a direct call..
defined('ABSPATH') or die();

// check if class already exists
if( !class_exists('Ziggeo_acf_field_ziggeo_template') ) {

	class Ziggeo_acf_field_ziggeo_template extends acf_field {

		function __construct( $settings ) {

			// name (string) Single word, no spaces. Underscores allowed
			$this->name = 'ziggeo_template';

			// label (string) Multiple words, can include spaces, visible when selecting a field type
			$this->label = __('Ziggeo Template', 'ziggeoacf');

			// category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
			$this->category = 'Ziggeo';

			// defaults (array) Array of default settings which are merged into the field object. These are used later in settings
			$this->defaults = array(
				'template_id'       => ''
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

			$list = ziggeo_p_templates_index();
			$templates = array();
			if($list) {
				foreach($list as $template_id => $template_code) {
					if($template_id !== '') {
						$templates[] = $template_id;
					}
				}
			}

			if(count($templates) == 0) {
				$templates[] = 'No Templates Found';
			}

			//Recorder Theme
			acf_render_field_setting( $field, array(
				'label'			=> __('Template ID','ziggeoacf'),
				'instructions'	=> __('Select template ID of the template you wish to load.','ziggeoacf'),
				'type'			=> 'select',
				'name'			=> 'template_id',
				'choices'		=> ziggeoacf_prepare_choices_settings($templates)
			));

		}

		// Create the HTML interface for your field
		function render_field( $field ) {

			if(!isset($field['name'])) {
				$field['name'] = '';
			}

			$field_id = 'acf-video-player-' . $field['ID'] . '-' . $field['key'];

			if(ziggeo_p_template_exists($field['template_id'])) {

				$_tmp_field = ziggeo_p_content_filter(ziggeo_p_template_exists($field['template_id']));

				$_slice_point = stripos($_tmp_field, ' ', stripos($_tmp_field, '<ziggeo'));

				$_tmp_field = substr($_tmp_field, 0, $_slice_point) . ' data-id="' . $field_id . '"' .
								' data-is-acf="true" ' . substr($_tmp_field, $_slice_point);

				$field_output = $_tmp_field;
			}
			else {
				$field_output = ziggeo_p_content_filter('[ziggeo data-is-acf="true" ' . $field['template_id'] . ']');
			}

			echo '<input id="' . $field_id . '" name="' . $field['name'] . '" type="hidden">';
			echo $field_output;
		}

	}

	// initialize
	new Ziggeo_acf_field_ziggeo_template( $this->settings );
}

?>