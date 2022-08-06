<?php
/*
Plugin Name: Advanced Custom Fields: Location shortcode
Plugin Slug: acf-placement-shortcode
Plugin URI: https://github.com/tarnament/acf-placement-shortcode
Description: Custom rule to show ACF group if post has specific shortcode
Version: 1.0.0
Author: Alexander Truhachov
Author URI: https://github.com/tarnament
License: GNU GENERAL PUBLIC LICENSE
Copyright: Alexander Truhachov
*/

if( ! defined( 'ABSPATH' ) ) exit;

add_action( 'acf/init', function(){
	// Check function exists, then include and register the custom location type class.
	include_once( 'inc/acf-location-shortcode.php' );
    if( function_exists('acf_register_location_type') ) acf_register_location_type( 'ACF_Location_shortcode' );
});

?>