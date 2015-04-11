<?php 

function register_testimonial_posts() {
 
    $labels = array(
        'name' => _x( 'Testimonial', 'testimonial_posts' ),
        'singular_name' => _x( 'Testimonial', 'testimonial_posts' ),
        'add_new' => _x( 'Add New', 'testimonial_posts' ),
        'add_new_item' => _x( 'Add New Testimonial', 'testimonial_posts' ),
        'edit_item' => _x( 'Edit Testimonial', 'testimonial_posts' ),
        'new_item' => _x( 'New Testimonial', 'testimonial_posts' ),
        'view_item' => _x( 'View Testimonial', 'testimonial_posts' ),
        'search_items' => _x( 'Search Testimonials', 'testimonial_posts' ),
        'not_found' => _x( 'No Testimonials found', 'testimonial_posts' ),
        'not_found_in_trash' => _x( 'No Testimonials found in Trash', 'testimonial_posts' ),
        'parent_item_colon' => _x( 'Parent Testimonial:', 'testimonial_posts' ),
        'menu_name' => _x( 'Testimonials', 'testimonial_posts' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Testimonials filterable by Name',
        'supports' => array( 'title', 'editor', 'comments' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-status',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'testimonial-post', $args );
}
 
add_action( 'init', 'register_testimonial_posts' );


function testimonial_save_metabox_post( $post_id, $post ) {
/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['testimonial_nonce'] ) || !wp_verify_nonce( $_POST['testimonial_nonce'], basename( __FILE__ ) ) )
	return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
	return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	
$author_name   = ( isset( $_POST['author_name'] ) ? sanitize_text_field( $_POST['author_name'] ) : '' );
$author_destination   = ( isset( $_POST['author_destination'] ) ? sanitize_text_field( $_POST['author_destination'] ) : '' );
$author_description   = ( isset( $_POST['author_description'] ) ? sanitize_text_field( $_POST['author_description'] ) : '' );
$video_link   = ( isset( $_POST['video_link'] ) ? sanitize_text_field( $_POST['video_link'] ) : '' );
	
	
		/* Get the meta key. */
	$author_key   = 'author_name';
	$author_destination_key   = 'author_destination';
	$author_description_key   = 'author_description';
	$video_link_key   = 'video_link';
	
	/* Get the meta value of the custom field key. */
	$author_name_value   = get_post_meta( $post_id, $author_key, true );
	$author_destination_value   = get_post_meta( $post_id, $author_destination_key, true );
	$author_description_value   = get_post_meta( $post_id, $author_description_key, true );
	$video_link_value   = get_post_meta( $post_id, $video_link_key, true );	
		
			/**************************
				author_name
			*************************/	
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $author_name && '' == $author_name_value )
	add_post_meta( $post_id, $author_key, $author_name, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $author_name && $author_name != $author_name_value )
	update_post_meta( $post_id, $author_key, $author_name );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $author_name && $author_name_value )
	delete_post_meta( $post_id, $author_key, $author_name_value );
	
	
			/**************************
				destination_name
			*************************/	
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $author_destination && '' == $author_destination_value )
	add_post_meta( $post_id, $author_destination_key, $author_destination, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $author_destination && $author_destination != $author_destination_value )
	update_post_meta( $post_id, $author_destination_key, $author_destination );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $author_destination && $author_destination_value )
	delete_post_meta( $post_id, $author_destination_key, $author_destination_value );
	
	
			/**************************
				Author Description
			*************************/	
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $author_description && '' == $author_description_value )
	add_post_meta( $post_id, $author_description_key, $author_description, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $author_description && $author_description != $author_description_value )
	update_post_meta( $post_id, $author_description_key, $author_description );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $author_description && $author_description_value )
	delete_post_meta( $post_id, $author_description_key, $author_description_value );
	
	
			/**************************
				video_link
			*************************/	
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $video_link && '' == $video_link_value )
	add_post_meta( $post_id, $video_link_key, $video_link, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $video_link && $video_link != $video_link_value )
	update_post_meta( $post_id, $video_link_key, $video_link );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $video_link && $video_link_value )
	delete_post_meta( $post_id, $video_link_key, $video_link_value );	
}


add_action( 'load-post.php', 'testimonial_metabox_setup_new' );
add_action( 'load-post-new.php', 'testimonial_metabox_setup_new' );

function testimonial_metabox_setup_new() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'vh_add_metabox_testimonial' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'testimonial_save_metabox_post', 10, 2 );
}

function vh_add_metabox_testimonial() {

	add_meta_box(
		'testimonial_metabox',                                   // Unique ID
		esc_html__( 'Testimonials Advance Fields', 'vh' ),  // Title
		'testimonial_metabox_function_new',                          // Callback function
		'testimonial-post',                                           // Admin page (or post type)
		'normal',                                           // Context
		'high'                                              // Priority
	);

}


function testimonial_metabox_function_new( $object, $box ) { 

wp_nonce_field( basename( __FILE__ ), 'testimonial_nonce' ); 
?>

<div class="testimonail-feilds">
  <p>
    <label for="author_name">
      <?php _e( "Name", 'vh' ); ?>
    </label>
    :
    <input class="widefat" type="text" name="author_name" id="author_name" value="<?php echo esc_attr( get_post_meta( $object->ID, 'author_name', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="author_destination">
      <?php _e( "Destination", 'vh' ); ?>
    </label>
    :
    <input class="widefat" type="text" name="author_destination" id="author_destination" value="<?php echo esc_attr( get_post_meta( $object->ID, 'author_destination', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="author_description">
      <?php _e( "Description", 'vh' ); ?>
    </label>
    :
    <textarea class="widefat" type="text" name="author_description" id="author_description" ><?php echo esc_attr( get_post_meta( $object->ID, 'author_description', true ) ); ?></textarea>
  </p>
  <p>
    <label for="video_link">
      <?php _e( "Video Link", 'vh' ); ?>
    </label>
    <small>(Example: https://www.youtube.com/embed/Tbj27Md48uk/)</small> :
    <input class="widefat" type="url" name="video_link" id="video_link" value="<?php echo esc_attr( get_post_meta( $object->ID, 'video_link', true ) ); ?>" />
  </p>
</div>
<?php 

}
    


class create_meta_boxes_music {
	private $config;
	protected $options;

	public function __construct($config, $options) {
		$this->config = $config;
		$this->options = $options;

		add_action('add_meta_boxes', array(&$this, 'new_meta_boxes'));
		add_action('save_post', array(&$this, 'save_meta_boxes'));
	}

	// Adds a meta box
	public function new_meta_boxes() {
		if (function_exists('add_meta_box')) {
			if (!empty($this->config['callback']) && function_exists($this->config['callback'])) {
				$callback = $this->config['callback'];
			} else {
				$callback = array(&$this, 'render');
			}

			foreach($this->config['pages'] as $page) {
				add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
			}
		}
	}

	// When the post is saved, saves our custom data
	public function save_meta_boxes($post_id) {
		if(!isset($_POST[$this->config['id'] . '_noncename']))
			return $post_id;

		// Verify this came from the our screen and with proper authorization,
		// ..because save_post can be triggered at other times
		if(!wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__)))
			return $post_id;

		// Check permissions
		if('page' == $_POST['post_type'] && !current_user_can('edit_page', $post_id)) {
			if(!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}

		} elseif(!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}

		// Verify if this is an auto save routine
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		foreach($this->options as $option) {
			if (isset($option['id']) && ! empty($option['id'])) {
				if(!isset($option['only']) || $option['only'] == $_POST['post_type'] || in_array($_POST['post_type'], explode(',', $option['only']))) {
					if(isset($_POST[$option['id']])) {
						$value = $_POST[$option['id']];
					} else {
						$value = false;
					}

					// Find and save the data
					if($value != '') {
						update_post_meta($post_id, $option['id'], $value);
					} else {
						delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
					}
				}
			}
		}
	}

	// Render Meta Box content
	public function render() {
		global $post;

		echo '
			<div class="meta-box-container">';

		foreach($this->options as $option) {
			if( !isset($option['only']) || $option['only'] == $post->post_type || in_array($post->post_type, explode(',', $option['only']))) {
				if (isset($option['id'])) {
					$default = get_post_meta($post->ID, $option['id'], true);
					if ($default != "") {
						$option['default'] = $default;
					}
				}

				// Load template file
				$this->load_template($option['type'], $option);
			}
		}
		echo '
				<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />
			</div>';
	}



}



// Add to admin_init function
add_filter('manage_edit-testimonial-post_columns', 'add_new_testimonial_columns');
function add_new_testimonial_columns($testimonial_columns) {
	
	$new_columns['cb'] = '<input type="checkbox" />';
     
   // $new_columns['id'] = __('ID');
	
    $new_columns['title'] = _x('Testimonial Title', 'column name');
	$new_columns['images'] = __('Images' , 'column name');
	$new_columns['name'] = __('Name' , 'column name');
    $new_columns['date'] = _x('Date', 'column name');
 
    return $new_columns;
}


    // Add to admin_init function
add_action('manage_testimonial-post_posts_custom_column', 'manage_testimonial_columns', 10, 2);
 
function manage_testimonial_columns($column_name, $id) {
    global $wpdb;
	
    switch ($column_name) {
      case 'images':
        // Get number of images in gallery
$attachment_id = ahi_mfi_get_featured_image_id('testimonial-image', 'testimonial-post' );
$image = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
if(!empty($image)){
echo '<img src="'. $image[0] .'" width="50" alt="" />';
} else {
	echo '<img src="'. plugin_dir_url( __FILE__ ) . 'images/no-img-avail.png" width="50" alt="" />';
}

        break;

	case 'name':
	echo get_post_meta($id,'author_name', true);
        break;
    default:
        break;
    } // end switch
} 