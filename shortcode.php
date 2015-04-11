<?php 
add_shortcode( 'testimonials', 'new_testimonial_shortcode' );

function new_testimonial_shortcode($atts, $content = null){ 
	extract( shortcode_atts( array(
			'title'             => '',
			'destination'             => '',
			'video'             => '',
			), $atts ) );
			
$output = '';
$output .= $video; 
$argsquery = array(
	'post_type' => 'testimonial-post',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	);

$output .= '<div class="sign-main"><div class="dis-cousrs">';
	$the_query = new WP_Query( $argsquery );
	if( $the_query->have_posts() ) {
		$i=1;
		while ( $the_query->have_posts() ) {
	$the_query->the_post();
	$output .= '<div class="box' . (++$i%2 ? "evenpost" : "oddpost") . '">';
	$output .= '<div class="site testi">';
	if($video=='yes') {
	$output .= '<div class="imgpic"><iframe width="90%" height="245" src="'.get_post_meta( get_the_ID(), 'video_link', true ).'" frameborder="0" allowfullscreen></iframe> </div>';
	$output .= '<div class="box-con">';
	} else {
	$output .= '<div class="box-con-full">';
	}
	if($title == 'yes') {
	 $output .= '<h2>'.get_the_title().'</h2>';
	}
$attachment_id = ahi_mfi_get_featured_image_id( 'testimonial-image', 'testimonial-post' );
$image = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
if(!empty($image)) {
$output .= '<div class="testimoiamge"> <img src="'. $image[0] .'" class="open_entry_image" alt="" />   </div>'; 
} else {
$output .= '<div class="testimoiamge"> <img src="'. plugin_dir_url( __FILE__ ) . 'images/no-img-avail.png" class="open_entry_image" alt="" />   </div>'; 	
}

$output .= '<p>'.get_the_excerpt().'</p> ';

$output .= '<div class="trr" style="padding-right:10px; line-height: 17px;"><strong class="blue">'.get_post_meta( get_the_ID(), 'author_name', true ).'</strong><br/>';
if($destination == 'yes') {
	$output .= ' <small>'.get_post_meta( get_the_ID(), 'author_destination', true ).'</small>';
}
$output .= '</div>';
$output .= ' </div>  <div class="cls"></div> </div> </div>';
		
		}
	
		$output .= ' <div class="cls"> </div> </div> </div>';
	}
	return $output;
}



    
  
   
   
