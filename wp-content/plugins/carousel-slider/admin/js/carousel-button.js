(function() {
    tinymce.create('tinymce.plugins.Carousel_Slider', {
 
        init : function(ed, url) {
            ed.addCommand('carousel_slider_button', function() {
                return_text = '[carousel id=""][item href="" img_link=""][item href="" img_link=""][item href="" img_link=""][item href="" img_link=""][item href="" img_link=""][/carousel]';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

           
            ed.addButton('carousel_slider_button', {
                title : 'Add Carousel Slider',
                cmd : 'carousel_slider_button',
                image : url + '/carousel.png'
            });

        },
        createControl : function(n, cm) {
            return null;
        },
    });

    // Register plugin
    tinymce.PluginManager.add('carousel_slider', tinymce.plugins.Carousel_Slider);
})();