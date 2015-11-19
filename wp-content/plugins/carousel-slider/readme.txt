=== Carousel Slider ===
Contributors: sayful
Tags:  carousel, carousel slider, image carousel, slider, responsive slider,
Requires at least: 3.0
Tested up to: 4.2
Stable tag: 1.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Touch enabled wordpress plugin that lets you create beautiful responsive carousel slider.

== Description ==

Fully written in jQuery, touch enabled wordpress plugin based on [OWL Carousel](http://www.owlgraphic.com/owlcarousel/) that lets you create beautiful responsive carousel slider.

= Usage - Settings, Carousels & Carousel Categories =

After installing or Upgrading go to `Settings >> Carousel Slider` and change the default settings as your need.

Then go to `Carousels >> Add New` and fill all fields as your need and don't forget to give Carousel Categories name if you want to add multiple carousel at your site.

Now go to page or post where you want to add Carousel slider and paste the following shortcode:

`[carousel_slider]`

You can add multiple slider at page or post by Carousel Categories slug from ( plugin version 1.4.0 ). To do this you must create Carousel Categories when you creating New Carousel. Now you can show your Carousel by categories slug. So add the following attribute to your shortcode:

`category_slug=''`

Set category to a comma separated list of Carousel Categories Slug to only show those. You also need to add a mandatory attribute `id=''` if you want to add multiple carousel slider at the same page or post and need to give a number manually that is unique with other carousel slider (It won't conflict with other WordPress IDs). Example:

`[carousel_slider id='1' category_slug='one']`

`[carousel_slider id='2' category_slug='one,two,three,four']`



= Usage - TinyMCE Button =

I am sorry that TinyMCE Button is not fully functional yet but it works well. 

To add carousel slider at your page from TinyMCE visual editor and click on "Add Carousel Slider" button from WordPress visual editor [view screenshot](https://s.w.org/plugins/carousel-slider/screenshot-4.jpg?r=1098179) and it will output the following shortcode:

`[carousel id=""]
	[item href="" img_link=""]
	[item href="" img_link=""]
	[item href="" img_link=""]
	[item href="" img_link=""]
	[item href="" img_link=""]
[/carousel]`

 inside `img_link=''` put you image link and inside href="" put post, page, media or any link that you want to open on click. Repeat `[item href="" img_link=""]` as many image as you want.

= Change Default Functionality =

You can change default functionality by adding following optional attributes at `[carousel_slider]` and `[carousel][/carousel]` shortcode


`items = '4'` : to set the maximum amount of items displayed at a time with the widest browser width (window >= 1200)

`items_desktop = '4'` : This allows you to preset the number of slides visible with (window <= 1199) browser width

`items_desktop_small = '3'` : This allows you to preset the number of slides visible with (window <= 979) browser width

`items_tablet = '2'` : This allows you to preset the number of slides visible with (window <= 768) browser width

`items_mobile = '1'` : This allows you to preset the number of slides visible with (window <= 479) browser width

`single_item = 'false'` : If you set true, it will display only one item

`slide_speed = '200'` : Slide speed in milliseconds

`pagination_speed = '800'` : Pagination speed in milliseconds

`rewind_speed = '1000'` : Rewind speed in milliseconds

`auto_play = 'true'` : Change to any integrer for example auto_play : 5000 to play every 5 seconds. If you set auto_play: true default speed will be 5 seconds.

`stop_on_hover = 'true'` : Stop autoplay on mouse hover

`navigation = 'true'` : Display "next" and "prev" buttons.

`scroll_per_page = 'false'` : Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.

`pagination = 'false'` : Show or hide pagination.

`pagination_numbers = 'false'` : Show or hide numbers inside pagination buttons

`auto_height = 'false'` : Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.

Example 1(Settings, Carousels & Carousel Categories):

`[carousel_slider id='1' category_slug='portfolio,two' items = '3' navigation = 'false']`

Example 2:

`[carousel id=''  items = '3' navigation = 'false' slide_speed = '400']
	[item href='' img_link='']
	[item href='' img_link='']
[/carousel]`



== Installation ==

Installing the plugins is just like installing other WordPress plugins. If you don't know how to install plugins, please review the three options below:

= Install by Search =

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Search for 'Carousel Slider' a plugin will come called 'Carousel Slider by Sayful Islam' and Click 'Install Now' and confirm your installation by clicking 'ok'
* The plugin will download and install. Just click 'Activate Plugin' to activate it.

= Install by ZIP File =

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Select 'Upload' from the set of links at the top of the page (the second link)
* From here, browse for the zip file included in your plugin titled 'carousel-slider.zip' and click the 'Install Now' button
* Once installation is complete, activate the plugin to enable its features.

= Install by FTP =

* Find the directory titles 'carousel-slider' and upload it and all files within to the plugins directory of your WordPress install (WORDPRESS-DIRECTORY/wp-content/plugins/) [e.g. www.yourdomain.com/wp-content/plugins/]
* From your WordPress dashboard, choose 'Installed Plugins' option under the 'Plugins' category
* Locate the newly added plugin and click on the \'Activate\' link to enable its features.


== Frequently Asked Questions ==
Do you have questions or issues with Carousel Slider? [Ask for support here](http://wordpress.org/support/plugin/carousel-slider)

== Screenshots ==

1. Screenshot of Carousel Slider Settings page
2. Screenshot of Carousel Custom Post Type (Add New Carousel)
3. Screenshot of Carousel Custom Post Type Categories
4. Screenshot of Carousel shortcode button.
5. Screenshot of Carousel Front-end Example.

== Changelog ==

= version 1.4.2 =
* Bug fixed release

= version 1.4.1 =
* Bug fixed release

= version 1.4.0 =

* Added option to add custom image size
* Added option to link each slide to a URL
* Added option to open link in the same frame as it was clicked or in a new window or tab.
* Added feature to add multiple slider at page, post or theme by custom post category slug
* Re-write with Object-oriented programming (OOP)


= version 1.3 =

* Tested with WordPress version 4.1

= version 1.2 =

* Fixed bugs regarding shortcode.
* Added href="" to add link to post, page or media
* Translation ready

= version 1.1 =

* Fixed some bugs.

= version 1.0 =

* Implementation of basic functionality.

== Upgrade Notice ==
Upgrade the plugin to get more features and better performance.

== CREDIT ==

1.This plugin was developed by [Sayful Islam](http://sayful.net)
1.Some open source framework have been used. For detail [click here](http://owlgraphic.com/owlcarousel/)

== CONTACT ==

[Sayful Islam](http://sayful1.wordpress.com/100-2/)


== Upgrade Notice ==

1.4.0 is a major update. Some previous settings and shortcode will not work in this version. Check detail description befor upgrading to new version.