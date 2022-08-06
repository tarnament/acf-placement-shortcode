<?php

if( ! defined( 'ABSPATH' ) ) exit;

class ACF_Location_shortcode extends ACF_Location {

	public function initialize() {
		$this->name = 'post_shortcode';
		$this->label = __( "Post Shortcode", 'acf' );
		$this->category = 'post';
		$this->object_type = 'post';
	}

	public function get_values( $rule ) {
		// Collect all availlable shortcodes for choices
		$choices = array();
		global $shortcode_tags;
		foreach($shortcode_tags as $code => $function){
			$choices[$code] = $code;
		}
		return $choices;
	}

	public function match( $rule, $screen, $field_group ) {
		// Check screen args for "post_id" which will exist when editing a post.
		// Return false for all other edit screens.
		if( !isset($screen['post_id']) ) return false;

		// Load the post object for this edit screen.
		$post = get_post( $screen['post_id'] );
		if( !$post ) return false;

		// If post has selected shortcode
		$result = has_shortcode( $post->post_content, $rule['value']);

		// Return result taking into account the operator type.
		if( $rule['operator'] == '!=' ) return !$result;
		return $result;
	}

}

?>