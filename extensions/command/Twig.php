<?php

namespace li3_twig\extensions\command;

use lithium\core\Libraries;
use li3_twig\template\view\adapter\Twig as TwigAdapter;

class Twig extends \lithium\console\Command {

	/**
	 * Temporary folder to safely remove the real template cache folder.
	 */
	const PATH_TO_REMOVE = '/twig.tmp';

	/**
	 *
	 */
	protected function _header() {
		$this->out('l3_twig - Twig management');
	}

	/**
	 *
	 */
	public function flush() {
		$this->_header();

		$success = false;
		$config = Libraries::get('app');

		$dir = TwigAdapter::cachePath();
		$trash = $config['resources'] . self::PATH_TO_REMOVE;

		$this->out('Starting cache flush.');

		if (!is_dir($dir)) {
			return $this->error('Cache folder not found... exiting.');
		}

		$this->out('Cache folder found : ' . $dir);

		if (is_dir($trash)) {
			$this->out('Old trash folder found (previous command failure possible), deleting it...');
			$this->_rrmdir($trash);
		}

		$this->out('Moving cache folder to temporary location...');
		rename($dir, $trash);

		$this->out('Deleting temporary cache location...');
		$success = $this->_rrmdir($trash);

		if (!$success) {
			return $this->error('Error while deleting Twig template cache.');
		}

		return $this->out('Success!');
	}

	/**
	 *
	 */
	protected function _rrmdir($dir) {
		if (!is_dir($dir)) {
			return false;
		}

		foreach (glob($dir . '/*') as $file) {
			if (is_dir($file)) {
				$this->_rrmdir($file);
			} else {
				unlink($file);
			}
		}

		return rmdir($dir);
	}
}

?>
