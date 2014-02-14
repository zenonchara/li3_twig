<?php

namespace li3_twig\extensions\helper;

use Twig_Environment;
use Twig_Loader_String;

class Twig extends \lithium\template\Helper {
	
	public function render ($string, $data = null) {
		$context = $this->_context;
		$data = is_array($data) ? $data : $context->data();
		$loader = new Twig_Loader_String();
		$twig = new Twig_Environment($loader);
		return $twig->render($string, $data);
	}
	
}
