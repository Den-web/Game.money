<?php

function carousel_slider_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'id' => '',
        'category_slug' => '',
        'items' => '5',
        'items_desktop' => '5',
        'items_desktop_small' => '3',
        'items_tablet' => '2',
        'items_mobile' => '1',
        'single_item' => 'false',
        'slide_speed' => '200',
        'pagination_speed' => '800',
        'rewind_speed' => '1000',
        'auto_play' => 'true',
        'stop_on_hover' => 'true',
        'navigation' => 'true',
        'scroll_per_page' => 'false',
        'pagination' => 'false',
        'pagination_numbers' => 'false',
        'auto_height' => 'false',
                    ), $atts));

    if (trim($category_slug) != '') {
        $termname = $category_slug;
    } //if
    else {

        function all_terms() {
            // It is blank
        }

        $termname = all_terms();
    }//else

    global $post;

    $options = get_option('sis_carousel_settings');

    ob_start();
    ?>
    <div class="row">
        <div id="carousel_slider <?php echo $id; ?>" class="owl-carousel">
            <?php
            query_posts("post_type=carousel&posts_per_page=-1&carousel_category=$termname");
            if (have_posts()) : while (have_posts()) : the_post();

                    $image_size = (isset($options['image_size'])) ? $options['image_size'] : 'full';

                    $img = get_the_post_thumbnail($post->ID, $image_size);


                    $carousel_link = get_post_meta($post->ID, '_carousel_slider_slide_link_value', true);


                    if (trim($carousel_link) != '') {
                       $carousel_link = $carousel_link;
                    } else {

                        $carousel_link = '#';
                    }

                    $link_target = get_post_meta($post->ID, '_carousel_slider_slide_link_target_value', true);
                    ?>

                    <div class="carousel_img">
                        <a class="slider_butt_bott" target="<?php echo $link_target; ?>" href="<?php echo $carousel_link; ?>">
                            <?php echo $img; ?>
                        </a>
                    </div>

                    <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>

        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#carousel_slider<?php echo $id; ?>").owlCarousel({
                // Most important owl features
                items: <?php echo $items; ?>,
                itemsDesktop: [1199,<?php echo $items_desktop; ?>],
                itemsDesktopSmall: [980,<?php echo $items_desktop_small; ?>],
                itemsTablet: [768,<?php echo $items_tablet; ?>],
                itemsMobile: [479,<?php echo $items_mobile; ?>],
                singleItem: <?php echo $single_item; ?>,
                //Basic Speeds
                slideSpeed: <?php echo $slide_speed; ?>,
                paginationSpeed: <?php echo $pagination_speed; ?>,
                rewindSpeed: <?php echo $rewind_speed; ?>,
                //Autoplay
                autoPlay: <?php echo $auto_play; ?>,
                stopOnHover: <?php echo $stop_on_hover; ?>,
                // Navigation
                navigation: <?php echo $navigation; ?>,
                navigationText: ["&lt;", "&gt;"],
                rewindNav: true,
                scrollPerPage: <?php echo $scroll_per_page; ?>,
                //Pagination
                pagination: <?php echo $pagination; ?>,
                paginationNumbers: <?php echo $pagination_numbers; ?>,
                //Auto height
                autoHeight: <?php echo $auto_height; ?>,
            });
            $(".owl-pagination").css("left", function () {
                return ($(".owl-carousel.owl-theme").width() - $(this).width()) / 2;
            });
        })
    </script>
    <?php
    return ob_get_clean();
}

function carousel_slider_wrapper_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'id' => '',
        'items' => '5',
        'items_desktop' => '5',
        'items_desktop_small' => '3',
        'items_tablet' => '2',
        'items_mobile' => '1',
        'single_item' => 'false',
        'slide_speed' => '200',
        'pagination_speed' => '800',
        'rewind_speed' => '1000',
        'auto_play' => 'false',
        'stop_on_hover' => 'true',
        'navigation' => 'true',
        'scroll_per_page' => 'false',
        'pagination' => 'false',
        'pagination_numbers' => 'false',
        'auto_height' => 'false',),$atts));
    global $post;
    ob_start();
?>
    <div id=" " class="row">
        <div id="carousel_slider<?php echo $id; ?>" class="owl-carousel">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#carousel_slider<?php echo $id; ?>").owlCarousel({
                // Most important owl features
                items: <?php echo $items; ?>,
                itemsDesktop: [1199,<?php echo $items_desktop; ?>],
                itemsDesktopSmall: [980,<?php echo $items_desktop_small; ?>],
                itemsTablet: [768,<?php echo $items_tablet; ?>],
                itemsMobile: [479,<?php echo $items_mobile; ?>],
                singleItem: <?php echo $single_item; ?>,
                //Basic Speeds
                slideSpeed: <?php echo $slide_speed; ?>,
                paginationSpeed: <?php echo $pagination_speed; ?>,
                rewindSpeed: <?php echo $rewind_speed; ?>,
                //Autoplay
                autoPlay: <?php echo $auto_play; ?>,
                stopOnHover: <?php echo $stop_on_hover; ?>,
                // Navigation
                navigation: <?php echo $navigation; ?>,
                navigationText: ["&lt;", "&gt;"],
                rewindNav: true,
                scrollPerPage: <?php echo $scroll_per_page; ?>,
                //Pagination
                pagination: <?php echo $pagination; ?>,
                paginationNumbers: <?php echo $pagination_numbers; ?>,
                //Auto height
                autoHeight: <?php echo $auto_height; ?>,
            });
            $(".owl-pagination").css("left", function () {
                return ($(".owl-carousel.owl-theme").width() - $(this).width()) / 2;
            });
        })
    </script>
    <?php
    return ob_get_clean();
}

function sis_carousel_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'img_link' => '',
        'href' => '#',
        'target' => '_self',), $atts));
    //Добавление кода в этом месте <a class="sec_bottom_butt font-roboto-bold" href="'. $href. '">Купить золото</a>
   
    return '<div class=""><a target="' . 
                $target . '" href="'. 
                $href . '"><img src="' . 
                $img_link . '"></a><a class="sec_bottom_butt font-roboto-bold" href="'. 
                $href. '">Купить золото</a></div>';

   
}//fucntion(sis_carousel_shortcode)

add_shortcode('carousel_slider', 'carousel_slider_shortcode');
add_shortcode('all-carousels', 'carousel_slider_shortcode');
add_shortcode('carousel', 'carousel_slider_wrapper_shortcode');
add_shortcode('item', 'sis_carousel_shortcode');
add_filter('widget_text', 'do_shortcode');
