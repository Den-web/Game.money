<?php
	function exec_php($matches){
		try {
			eval('ob_start();'.$matches[1].'$inline_execute_output = ob_get_contents();ob_end_clean();');
		} catch (Exception $e) {
		}
		return $inline_execute_output;
	}
?>