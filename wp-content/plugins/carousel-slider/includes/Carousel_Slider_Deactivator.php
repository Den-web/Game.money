<?php

class Carousel_Slider_Deactivator {

	public static function deactivate() {
		flush_rewrite_rules();
	}

}
