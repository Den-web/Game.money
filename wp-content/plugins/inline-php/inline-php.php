<?php
/*
Plugin Name: Inline PHP
Plugin URI: http://blog.codexpress.cn/php/wordpress-plugin-inline-php/
Description: This plugin lets users write php code in their posts/pages, and the php code will be executed there, and the output will be displayed. Use "&lt;exec>...&lt;/exec>" or "[exec]...[/exec] "(case sensitive) to quote what you want to execute.
Version: 1.2.2
Author: kukukuan
Author URI: http://blog.codexpress.cn/
*/


define('IS_PHP5', version_compare(phpversion(), '5.0.0')>-1);

if(IS_PHP5){
	require_once(dirname(__FILE__).'/exec_php.php5');
}else{
	require_once(dirname(__FILE__).'/exec_php.php4');
}

function inline_php($content){
//	if(function_exists('preg_replace_callback')) return "asdfasdfas";
	$content = preg_replace_callback('/<exec>((.|\n)*?)<\/exec>/', 'exec_php', $content);
	$content = preg_replace_callback('/\[exec\]((.|\n)*?)\[\/exec\]/', 'exec_php', $content);
	$content = preg_replace('/<exec off>((.|\n)*?)<\/exec>/', '<exec>$1</exec>', $content);
	$content = preg_replace('/\[exec off\]((.|\n)*?)\[\/exec\]/', '<exec>$1</exec>', $content);
	return $content;
}

add_filter('the_content', 'inline_php', 0);
?>
