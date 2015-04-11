<?php
/**
 * Plugin Name: Simple WP Testimonials.
 * Plugin URI: http://dswebsolutions.in
 * Description: Simple Testimonials is an easy to use plugin that allows admin to add Testimonials to the sidebar, as a widget, or to embed them into a Page or Post using the shortcode. The Simple Testimonials plugin also allows you to insert a list of all Testimonials. Simple Testimonials allows you to include an image with each testimonial - this is a great feature for adding a photo of the testimonial author. Add Testimonials to Website Testimonials using the shortcode : [testimonials].
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