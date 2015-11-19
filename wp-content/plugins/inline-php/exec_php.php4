<?php
	function exec_php($matches){
		error_reporting(0);
		eval('ob_start();'.$matches[1].'$inline_execute_output = ob_get_contents();ob_end_clean();');
		return $inline_execute_output;
	}
?>