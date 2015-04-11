<?php
/**
 * Plugin Name: Simple WP Testimonials.
 * Plugin URI: http://dswebsolutions.in
 * Description: Simple WP Testimonials is a plugin that allows you to manage and display testimonials for your blog.
 * Version: 1.0.0
 * Author: Deepak Shrama
 * Author URI: http://dswebsolutions.in
 * License: GPL2
 */
 
 function plugin_testimonial_themes_css() {
	wp_enqueue_style( 'testimonials-css', plugin_dir_url( __FILE__ ) . 'css/style.css' );
}

add_action( 'wp_head', 'plugin_testimonial_themes_css' );


 require_once(dirname(__FILE__) . '/admin-functions.php'); 
  require_once(dirname(__FILE__) . '/shortcode.php'); 
  
  require_once(dirname(__FILE__) . '/author-image.php'); 
 
 if( class_exists( 'ahFeaturedImages' ) ) {
		$args = array(
			'id'        => 'testimonial-image',
			'post_type' => 'testimonial-post', // Set this to post or page
			'labels'    => array(
				'name'   => 'Testimonial Image',
				'set'    => 'Testimonial Image',
				'remove' => 'Remove Testimonial Image',
				'use'    => 'Use as Testimonial Image',
			)
		);

		new ahFeaturedImages( $args );
}