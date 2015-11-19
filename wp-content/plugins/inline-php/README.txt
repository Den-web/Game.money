=== Inline PHP ===
Contributors: kukukuan
Donate link: 
Tags: post, pages, posts, code, php
Requires at least: 1.5.0
Tested up to: 2.2.1
Stable tag: 1.2.2

The plugin can execute php string in posts/pages, and display the output as the contents of posts/pages.(PHP 5 or above prefered, may work on PHP 4, but not tested)

== Description ==

The plugin can execute php string in posts/pages, and display the output as the contents of posts/pages. Just quote what you want to execute in `<exec>...</exec>` or `[exec]...[/exec]` tag.

Here is a simple demo:
`   <exec>
      echo 'This is a test';
   </exec>`
OR
`   [exec]
      echo 'This is a test';
   [/exec]`

An advanced demo may look like this:
`
   <exec>
       $filestr = file_get_contents('http://www.seocompany.ca/pagerank/page-rank-update-list.html');
       if (preg_match('/<p>.*<\/p>/ums', $filestr, $matches)){
           echo str_replace("<p><a href=\"#page-rank-update-list-history\">Top of Page Rank Update List History</a></p>", "", str_replace("<table width=\"65%\">", "<table width=\"100%\">", $matches[0]));
       }
   </exec>
`
Here is a post to show PageRank Export History with the code above. [HERE](http://blog.gmap2.net/2007/04/10/page-rank-export-list-history/ "Page Rank Export List History")
(Notice: I also add some CSS style to make the output nicer.)

== Installation ==

1. Upload `inline-php.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use `<exec>...</exec>` or `[exec]...[/exec]` to quote php code that you wish to execute in your posts/pages

== Screenshots ==

== Frequently Asked Questions ==

1. Why the plugin failed to work?
First, check your php version. This plugin requires php 5. Version 1.1 may work under php4, but has not been tested yet. Then, check your php code and make sure it is correct. If problems still exist, visit [Plugin Homepage](http://blog.gmap2.net/2007/04/12/wordpress-plugin-inline-php/ "Plugin Homepage") to report a bug.

1. I just wish to display `<exec>...</exec>` rather than execute any code, what should I do?
Use `<exec off>...</exec>` instead; it won't execute anything but display `<exec>...</exec>` and text in it.

