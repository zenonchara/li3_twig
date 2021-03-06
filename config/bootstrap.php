<?php
use lithium\core\Libraries;
use lithium\net\http\Media;

/**
 * This is the path to the li3_twig plugin, used for Libraries path resolution.
 */
define('LI3_TWIG_PATH', dirname(__DIR__));

/**
 * Register the Twig media type.
 * The default renderer is still accessible if needed. (default exception handling for example).
 */
Media::type('twig', array('text/html', 'application/xhtml+xml', '*/*'), array(
	'view' => 'li3_twig\template\View',
	'loader' => 'li3_twig\template\Loader',
	'renderer' => 'li3_twig\template\view\adapter\Twig',
	'paths' => array(
		'template' => array(
			'{:library}/views/{:controller}/{:template}.html.twig',
			'{:library}/views/layouts'
		)
	)
));

?>