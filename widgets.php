<?php // =============================== Testimonial Widget ======================================
function register_testimonials_widget() {
    register_widget( 'Testimonials_Widget' );
}

add_action( 'widgets_init', 'register_testimonials_widget' );

class Testimonials_Widget extends WP_Widget {
    function Testimonials_Widget() {
        $widget_ops = array( 'classname' => 'testimo', 'description' => __('A widget that displays the Testimonial Widget', 'example') );
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'testimonial-widget' );
        $this->WP_Widget( 'testimonial-widget', __('Testimonial Widget', 'testimo'), $widget_ops, $control_ops );
    }
    
    function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? '' : apply_filters('widget_count', $instance['count']);
		$slide_align = empty($instance['slide-align']) ? '' : apply_filters('widget_slide_align', $instance['slide-align']);
			$title_testimon = empty($instance['title-testimon']) ? '' : apply_filters('widget_title_testimon', $instance['title-testimon']);
		  $featured = empty($instance['featured-testimon']) ? '' : apply_filters('widget_featured', $instance['featured-testimon']);
		$testdestination = empty($instance['destination-testimon']) ? '' : apply_filters('widget_destination', $instance['destination-testimon']);
		
		 echo $before_widget;
		 if ( $title <> "" ) { echo $before_title . $title . $after_title; } ?>

<script type="text/javascript">

jQuery( document ).ready(function($) {
	$(".testimonial-slidebox").jCarouselLite({
		vertical: <?php echo $slide_align; ?>,
		hoverPause:false,
		btnPrev: ".previous",
		btnNext: ".next",
		visible: 1,
		start: 0,
		scroll: 1,
		circular: true,
		auto:2000,
		speed:2000,				
	});
});
</script>

<div id="slidebox" class="testimonial-slidebox">
<div class="next"></div>
<div class="previous"></div>
	<ul> 
    <?php
	if(empty($count)){
	$new_count = -1;
	} else {
	$new_count = $count; 	
	}
	
	$argsqueryw = array(
	'post_type' => 'testimonial-post',
	'posts_per_page' => $new_count,
	'post_status' => 'publish',
	);
 $the_queryw = new WP_Query( $argsqueryw );
	if( $the_queryw->have_posts() ) {
		$i=1;
		while ( $the_queryw->have_posts() ) {
	$the_queryw->the_post();
	
	echo '<li>';

    echo '<div class="brochr"> ';
if($featured=='on') {
$attachment_id = ahi_mfi_get_featured_image_id( 'testimonial-image', 'testimonial-post' );
$image = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
if(!empty($image)) {
echo '<div class="testi-img"> <img src="'. $image[0] .'" class="open_entry_image" alt="" />   </div>'; 
} else {
echo '<div class="testi-img"> <img src="'. plugin_dir_url( __FILE__ ) . 'images/no-img-avail.png" class="open_entry_image" alt="" />   </div>'; 	
}
 }
 if($title_testimon=='on') {   echo '<div class="title"><a href="'.get_the_permalink().'">'.get_the_title(). '</a></div>'; }
    echo '<div class="testdecrip">'.get_the_excerpt(). '</div>';

     echo '<div class="testiname">'.get_post_meta( get_the_ID(), 'author_name', true ). '</div>';

    if($testdestination=='on') {
      echo '<div class="testidestination">('.get_post_meta( get_the_ID(), 'author_destination', true ). ')</div>';
    }
     echo '</div>';  
	 
	 
	echo '</li>';
	}
	}
 ?>
	</ul>
</div>


	 <?php  echo $after_widget;
                 
	}

        function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['slide-align'] = strip_tags($new_instance['slide-align']);
		$instance['title-testimon'] = strip_tags($new_instance['title-testimon']);
        $instance['featured-testimon'] = strip_tags($new_instance['featured-testimon']);
   	 $instance['destination-testimon'] = strip_tags($new_instance['destination-testimon']);
                 return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );		
		$title = strip_tags($instance['title']);
		$count = strip_tags($instance['count']);
		$slide_align = strip_tags($instance['slide-align']);
		$title_testimon = strip_tags($instance['title-testimon']);
        $featured = strip_tags($instance['featured-testimon']);
    	$testdestination = strip_tags($instance['destination-testimon']);
                ?>
		
		
<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

<p><label for="<?php echo $this->get_field_id('count'); ?>">Show Post: <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo attribute_escape($count); ?>" /></label></p>

<p><label for="<?php echo $this->get_field_id('slide-align'); ?>">Slide Align: <select name="<?php echo $this->get_field_name('slide-align'); ?>" id="<?php echo $this->get_field_id('slide-align'); ?>"> 
<option <?php if($slide_align=='false') {echo 'selected="selected"'; } ?>  value="false"> Horizontal </option>
<option <?php if($slide_align=='true') {echo 'selected="selected"'; } ?> value="true"> Vertical </option> </select>
</label></p>

<p><label for="<?php echo $this->get_field_id('title-testimon'); ?>">Show Testimonial Title: <input class="widefat" id="<?php echo $this->get_field_id('title-testimon'); ?>" name="<?php echo $this->get_field_name('title-testimon'); ?>" type="checkbox" <?php if(attribute_escape($title_testimon)!='') { echo 'checked="checked"'; } ?>  /></label></p>


<p><label for="<?php echo $this->get_field_id('featured-testimon'); ?>">Show Image: <input class="widefat" id="<?php echo $this->get_field_id('featured-testimon'); ?>" name="<?php echo $this->get_field_name('featured-testimon'); ?>" type="checkbox" <?php if(attribute_escape($featured)!='') { echo 'checked="checked"'; } ?>  /></label></p>

<p><label for="<?php echo $this->get_field_id('destination-testimon'); ?>">Show Destination: <input class="widefat" id="<?php echo $this->get_field_id('destination-testimon'); ?>" name="<?php echo $this->get_field_name('destination-testimon'); ?>" type="checkbox" <?php if(attribute_escape($testdestination)!='') { echo 'checked="checked"'; } ?>  /></label></p>
<?php 
	}
        
        }
