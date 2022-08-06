<?php
/*
Plugin Name: Advanced Custom Fields: Location shortcode
Plugin Slug: acf-placement-shortcode
Plugin URI: https://github.com/tarnament/acf-placement-shortcode
Description: Custom rule to show ACF group if post has specific shortcode
Version: 0.1
Author: Alexander Truhachov
Author URI: https://github.com/tarnament
License: GNU GENERAL PUBLIC LICENSE
Copyright: Alexander Truhachov
*/

acf_register_location_type( 'ACF_Location_shortcode' );

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
		if( isset($screen['post_id']) ) {
			$post_id = $screen['post_id'];
		} else {
			return false;
		}

		// Load the post object for this edit screen.
		$post = get_post( $post_id );
		if( !$post ) {
			return false;
		}
		
		// If post has selected shortcode
		$result = has_shortcode( $post->post_content, $rule['value']);

		// Return result taking into account the operator type.
		if( $rule['operator'] == '!=' ) {
			return !$result;
		}
		return $result;
	}

}

?>