<?php

class Carousel_Slider_Public {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {

        wp_register_style('owl-carousel', plugin_dir_url(__FILE__) . 'css/owl.carousel.css', array(), '1.3.2', 'all');
        wp_register_style('owl-theme', plugin_dir_url(__FILE__) . 'css/owl.theme.css', array(), '1.3.2', 'all');
        wp_register_style('owl-transitions', plugin_dir_url(__FILE__) . 'css/owl.transitions.css', array(), '1.3.2', 'all');

        wp_enqueue_style('owl-carousel');
        wp_enqueue_style('owl-theme');
        wp_enqueue_style('owl-transitions');
    }

    public function enqueue_scripts() {

        wp_register_script('owl-carousel', plugin_dir_url(__FILE__) . 'js/owl.carousel.js', array('jquery'), '1.3.2', true);

        wp_enqueue_script('jquery');
        wp_enqueue_script('owl-carousel');
    }

    public function inline_styles() {
        $this->options = get_option('sis_carousel_settings');
        ?>
        <style>
            .owl-buttons, .owl-theme .owl-controls .owl-page span.owl-numbers {
                color: <?php echo (isset($this->options['btn_color'])) ? $this->options['btn_color'] : '#dddddd'; ?>;
            }
            .owl-theme .owl-buttons .owl-prev,
            .owl-theme .owl-buttons .owl-next,
            .owl-theme .owl-controls .owl-page span{
                background: <?php echo (isset($this->options['btn_bg_color'])) ? $this->options['btn_bg_color'] : '#666666'; ?>;
            }
            .owl-theme .owl-buttons .owl-prev,
            .owl-theme .owl-buttons .owl-next,
            .owl-theme .owl-controls .owl-page span{
                opacity: <?php echo (isset($this->options['btn_opacity'])) ? $this->options['btn_opacity'] : '.4'; ?>;
            }
        </style>
        <?php
    }

}//end of class
