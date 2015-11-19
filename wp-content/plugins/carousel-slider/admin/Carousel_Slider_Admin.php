<?php

class Carousel_Slider_Admin {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function mce_plugin($plugin_array) {
		$plugin_array['carousel_slider'] = plugin_dir_url( __FILE__ ) . 'js/carousel-button.js';
		return $plugin_array;
	}

	public function mce_button($buttons) {
		array_push ($buttons, 'carousel_slider_button');
		return $buttons;
	}

	public function carousel_admin_color( $hook_suffix ) {
	    wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( $this->plugin_name.'color', plugin_dir_url( __FILE__ ) . 'js/carousel-color-script.js', array( 'wp-color-picker' ), false, true );
	}

	public function carousel_post_type() {

		$labels = array(
			'name'                => _x( 'Carousels', 'Post Type General Name', 'carouselslider' ),
			'singular_name'       => _x( 'Carousel', 'Post Type Singular Name', 'carouselslider' ),
			'menu_name'           => __( 'Carousels', 'carouselslider' ),
			'parent_item_colon'   => __( 'Parent Carousel:', 'carouselslider' ),
			'all_items'           => __( 'All Carousels', 'carouselslider' ),
			'view_item'           => __( 'View Carousel', 'carouselslider' ),
			'add_new_item'        => __( 'Add New Carousel', 'carouselslider' ),
			'add_new'             => __( 'Add New', 'carouselslider' ),
			'edit_item'           => __( 'Edit Carousel', 'carouselslider' ),
			'update_item'         => __( 'Update Carousel', 'carouselslider' ),
			'search_items'        => __( 'Search Carousel', 'carouselslider' ),
			'not_found'           => __( 'Not found', 'carouselslider' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'carouselslider' ),
		);
		$args = array(
			'label'               => __( 'Carousel', 'carouselslider' ),
			'description'         => __( 'Carousel', 'carouselslider' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-slides',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);
		register_post_type( 'carousel', $args );

	}

	public function custom_image_size(){
		$this->options = get_option('sis_carousel_settings');

        if ( isset($this->options['image_size']) && $this->options['image_size'] == 'carousel-thumb') {

			if (isset($this->options['img_crop']) && $this->options['img_crop'] == 'false') {

				add_image_size( 'carousel-thumb', $this->options['img_width'], $this->options['img_height'] );

			} else {
				add_image_size( 'carousel-thumb', $this->options['img_width'], $this->options['img_height'], true );
			}

        }
	}

	public function carousel_image_box() {
	    remove_meta_box( 'postimagediv', 'carousel', 'side' );
	    add_meta_box('postimagediv', __('Upload Carousel Image', 'carouselslider'), 'post_thumbnail_meta_box', 'carousel', 'normal', 'high');
	}
	// Register Custom Taxonomy
	public function custom_taxonomy() {

	    $labels = array(
	        'name'                       => _x( 'Carousel Categories', 'Taxonomy General Name', 'carouselslider' ),
	        'singular_name'              => _x( 'Carousel Category', 'Taxonomy Singular Name', 'carouselslider' ),
	        'menu_name'                  => __( 'Carousel Categories', 'carouselslider' ),
	        'all_items'                  => __( 'All Carousel Categories', 'carouselslider' ),
	        'parent_item'                => __( 'Parent Carousel Category', 'carouselslider' ),
	        'parent_item_colon'          => __( 'Parent Carousel Category:', 'carouselslider' ),
	        'new_item_name'              => __( 'New Carousel Category Name', 'carouselslider' ),
	        'add_new_item'               => __( 'Add New Carousel Category', 'carouselslider' ),
	        'edit_item'                  => __( 'Edit Carousel Category', 'carouselslider' ),
	        'update_item'                => __( 'Update Carousel Category', 'carouselslider' ),
	        'separate_items_with_commas' => __( 'Separate Carousel Categories with commas', 'carouselslider' ),
	        'search_items'               => __( 'Search Carousel Categories', 'carouselslider' ),
	        'add_or_remove_items'        => __( 'Add or remove Carousel Categories', 'carouselslider' ),
	        'choose_from_most_used'      => __( 'Choose from the most used Carousel Categories', 'carouselslider' ),
	        'not_found'                  => __( 'Not Found', 'carouselslider' ),
	    );
	    $args = array(
	        'labels'                     => $labels,
	        'hierarchical'               => false,
	        'public'                     => true,
	        'show_ui'                    => true,
	        'show_admin_column'          => true,
	        'show_in_nav_menus'          => true,
	        'show_tagcloud'              => true,
	        'rewrite'                    => array( 'slug' => 'carousel-category', ),
	    );
	    register_taxonomy( 'carousel_category', array( 'carousel' ), $args );

	}
	public function add_meta_box() {
	    add_meta_box(
	    	'carousel_slider_id', 
	    	__( 'Carousel Meta Box','carouselslider' ), 
	    	array( $this, 'carousel_slider_meta_box_callback' ), 
	    	'carousel' 
	    );
	}
	public function save_meta_box( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['carousel_slider_meta_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['carousel_slider_meta_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'carousel_slider_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$link_target = sanitize_text_field( $_POST['carousel_slider_slide_link_target'] );

		if ((trim($_POST['carousel_slider_slide_link'])) != '') {

			$carousel_link = esc_url( $_POST['carousel_slider_slide_link'] );

		} else {
			$carousel_link = esc_url(get_permalink());
		}
		
		

		// Update the meta field.
		update_post_meta( $post_id, '_carousel_slider_slide_link_value', $carousel_link );
		update_post_meta( $post_id, '_carousel_slider_slide_link_target_value', $link_target );
	}
	public function carousel_slider_meta_box_callback( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'carousel_slider_inner_custom_box', 'carousel_slider_meta_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$carousel_link = get_post_meta( $post->ID, '_carousel_slider_slide_link_value', true );
		$link_target = get_post_meta( $post->ID, '_carousel_slider_slide_link_target_value', true );

        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="carousel_slider_slide_link">
                        <?php _e('Carousel Link','nivo-image-slider') ?>
                    </label>
                </th>
                <td>
                    <input type="text" class="regular-text" id="carousel_slider_slide_link" name="carousel_slider_slide_link" value="<?php echo esc_attr( $carousel_link ); ?>" style="width:100% !important">
                    <p><?php _e('Write slide link URL. If you want to use current slide link, just leave it blank. If you do not want any link write (#) without bracket or write desired link..','nivo-image-slider'); ?></p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="carousel_slider_slide_link_target">
                        <?php _e('Carousel Link Target','nivo-image-slider') ?>
                    </label>
                </th>
                <td>
                    <select name="carousel_slider_slide_link_target">
                    	<option value="_self" <?php selected( $link_target, '_self' ); ?>>Self</option>
                    	<option value="_blank" <?php selected( $link_target, '_blank' ); ?>>Blank</option>
                    </select>
                    <p><?php _e('Select Self to open the slide in the same frame as it was clicked (this is default) or select Blank open the slide in a new window or tab.','nivo-image-slider'); ?></p>
                </td>
            </tr>
        </table>
        <?php
	}

}
