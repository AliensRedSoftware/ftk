<?php
error_reporting(0);
use view;

/**
 * Подгрузка контроллера
 */
class controller {
	public $url;
	public function loadsettings() {
		$this->loadtheme($this->get_uri(), $this->get_uri_folder());
	}

	public function get_uri () {
		$uri = explode (DIRECTORY_SEPARATOR , urldecode($_SERVER['REQUEST_URI']));
		$count = count($uri) - 1;
		if ($uri[$count] == null) {
			require_once 'theme' . DIRECTORY_SEPARATOR . 'options.php';
			$options = new options();
			return $options->execute;
		} else {
			return $uri[$count];
		}
	}
	public function get_uri_folder () {
		$uri = explode(DIRECTORY_SEPARATOR , urldecode($_SERVER['REQUEST_URI']));
		for ($i = 1; $i <= count ($uri) - 2; $i++) {
			$this->url .= $uri[$i] . DIRECTORY_SEPARATOR;
		}
		return $this->url;
	}
<<<<<<< HEAD
}
=======
}  
>>>>>>> 6685676f20f60aaee269b46f1fa286d2640d3c19
