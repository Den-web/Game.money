<?php
class Carousel_Slider_Settings {
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        register_activation_hook( __FILE__, array( $this, 'default_options' ));
        $this->options = get_option('sis_carousel_settings');


    }

    public function default_options(){
    
        $options_array = array(
            'image_size'        => 'full',
            'img_width'         => '',
            'img_height'        => '',
            'img_crop'          => '',
            'btn_bg_color'      => '#666666',
            'btn_color'         => '#dddddd',
            'btn_opacity'       => '0.4',
        );

        if ( $this->options !== false ) {

            update_option( 'sis_carousel_settings', $options_array );

        } else{

            add_option( 'sis_carousel_settings', $options_array );
            
        }

    }

    public function custom_image_size(){

        if ( isset($options['image_size']) && $options['image_size'] == 'carousel-thumb') {
            
            add_image_size( 'carousel-thumb', $this->options['img_width'], $this->options['img_height'], $this->options['img_crop'] );
        }
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page( 
            __('Carousel Slider Settings', 'carouselslider'), 
            __('Carousel Slider', 'carouselslider'), 
            'manage_options', 
            'carousel_slider', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'sis_carousel_settings' );
        ?>
        <div class="wrap">
            <h2><?php _e('Carousel Slider Settings' ,'carouselslider'); ?></h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'carousel_slider_option_group' );   
                do_settings_sections( 'carousel_slider' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {

        register_setting(
            'carousel_slider_option_group', // Option group
            'sis_carousel_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            __('Global Settings', 'carouselslider'), // Title
            array( $this, 'print_section_info' ), // Callback
            'carousel_slider' // Page
        );  

        add_settings_field(
            'image_size', // ID
            __('Carousel Images Size', 'carouselslider'), // Title 
            array( $this, 'image_size_callback' ), // Callback
            'carousel_slider', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'custom_image_size', 
            __('Custom Image Size', 'carouselslider'), 
            array( $this, 'custom_image_size_callback' ), 
            'carousel_slider', 
            'setting_section_id'
        );     

        add_settings_field(
            'btn_bg_color', 
            __('Nav Background Color', 'carouselslider'), 
            array( $this, 'btn_bg_color_callback' ), 
            'carousel_slider', 
            'setting_section_id'
        );     

        add_settings_field(
            'btn_color', 
            __('Nav Color', 'carouselslider'), 
            array( $this, 'btn_color_callback' ), 
            'carousel_slider', 
            'setting_section_id'
        );     

        add_settings_field(
            'btn_opacity', 
            __('Nav Opacity', 'carouselslider'), 
            array( $this, 'btn_opacity_callback' ), 
            'carousel_slider', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if ( in_array( $input['image_size'], array( 'thumbnail', 'medium', 'large', 'full', 'carousel-thumb' ), true ) )
            $new_input['image_size'] = $input['image_size'];

        if( isset( $input['img_width'] ) )
            $new_input['img_width'] = absint( $input['img_width'] );

        if( isset( $input['img_height'] ) )
            $new_input['img_height'] = absint( $input['img_height'] );

        if ( in_array( $input['img_crop'], array( 'false', 'true' ), true ) )
            $new_input['img_crop'] = $input['img_crop'];

        if( isset( $input['btn_bg_color'] ) )
            $new_input['btn_bg_color'] = sanitize_text_field( $input['btn_bg_color'] );

        if( isset( $input['btn_color'] ) )
            $new_input['btn_color'] = sanitize_text_field( $input['btn_color'] );

        if( isset( $input['btn_opacity'] ) )
            $new_input['btn_opacity'] = sanitize_text_field( $input['btn_opacity'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Change the global settings for carousel slider. This settings will be applicable for all carousel slider that you used in your site.';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    function image_size_callback() {

        $values = array(
            'full'          => 'Full resolution (original size uploaded)',
            'large'         => 'Large resolution (default 640px x 640px max)',
            'medium'        => 'Medium resolution (default 300px x 300px max)',
            'thumbnail'     => 'Thumbnail (default 150px x 150px max)',
            'carousel-thumb'=> 'Use custom image size',
        );

        ?>
        <select id='image_size' name='sis_carousel_settings[image_size]'>
            <?php
                foreach($values as $code => $label) :
                    if( $code == $this->options['image_size'] ) { $selected = "selected='selected'"; } else { $selected = ''; }
                    echo "<option {$selected} value='{$code}'>{$label}</option>";
                endforeach; 
            ?>
        </select>
        <?php
        echo '<p>' . __( 'Select carousel image size.', 'sandbox' ) . '</p>';
    }
    /** 
     * Get the settings option array and print one of its values
     */
    public function custom_image_size_callback() {

        $values = array(
            'false'     => 'Soft proportional crop mode',
            'true'      => 'Hard crop mode',
        );

        ?>
        <input type='number' class='small-text' name='sis_carousel_settings[img_width]' id='img_width' value='<?php echo (isset($this->options['img_width'])) ? $this->options['img_width'] : '0'; ?>'>
        
        <input type='number' class='small-text' name='sis_carousel_settings[img_height]' id='img_height' value='<?php echo (isset($this->options['img_height'])) ? $this->options['img_height'] : '0'; ?>'>
        <select id='img_crop' name='sis_carousel_settings[img_crop]'>
            <?php
                foreach($values as $code => $label) :
                    if( $code == $this->options['img_crop'] ) { $selected = "selected='selected'"; } else { $selected = ''; }
                    echo "<option {$selected} value='{$code}'>{$label}</option>";
                endforeach; 
            ?>
        </select>
        <p><?php _e( 'Width x Height x Crop. (Carousel Images Size need to be selected as Use custom image size). This settings will not affect for the previously uploaded images. If you want to rebuild previously uploaded images, you can use another WordPress plugin <a target="_blank" href="https://wordpress.org/plugins/ajax-thumbnail-rebuild/">AJAX Thumbnail Rebuild</a>', 'sandbox' ); ?></p>
        <?php

    }

    public function btn_bg_color_callback(){
        ?>
        <input type="text" name="sis_carousel_settings[btn_bg_color]" id="btn_bg_color" data-default-color="#666666" value="<?php echo (isset($this->options['btn_bg_color'])) ? $this->options['btn_bg_color'] : '#666666'; ?>">
        <p><?php _e( 'Choose carousel navigation background color.', 'sandbox' ); ?></p>
        <?php
    }

    public function btn_color_callback(){
        ?>
        <input type="text" name="sis_carousel_settings[btn_color]" id="btn_color" data-default-color="#dddddd" value="<?php echo (isset($this->options['btn_color'])) ? $this->options['btn_color'] : '#dddddd'; ?>">
        <p><?php _e( 'Choose carousel navigation color.', 'sandbox' ); ?></p>
        <?php
    }

    public function btn_opacity_callback(){
        ?>
        <input type="text" class="small-text" name="sis_carousel_settings[btn_opacity]" id="btn_opacity" value="<?php echo (isset($this->options['btn_opacity'])) ? $this->options['btn_opacity'] : '.4'; ?>">
        <p><?php _e( 'Enter button opacity value. min value is 0 and max value is 1. Example 0.2', 'sandbox' ); ?></p>
        <?php
    }
}

if( is_admin() )
    $carousel_slider_settings = new Carousel_Slider_Settings();