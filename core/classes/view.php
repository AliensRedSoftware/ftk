<?php
error_reporting(0);

/**
 * Загрузка темы
 * -------------
 */
class view extends controller {

    protected $theme, $log;

	/**
	 * Установить тему
	 * ---------------
	 */
	public function set_theme () {
		$this->loadsettings();
	}

	/**
	 * Установить загрузку view
	 */
	public function setDisabled ($enable) {
		$GLOBALS['VIEW_ENABLE'] = $enable;
	}

	/**
	 * Возвращаем загрузку view
	 */
	public function getDisabled () {
		return $GLOBALS['VIEW_ENABLE'];
	}

	/**
	 * Установить путь к теме
	 */
	public function setPath ($path) {
		$GLOBALS['VIEW_PATH'] = $path;
	}

	/**
	 * Возвращаем путь к теме
	 */
	public function getPath () {
		return $GLOBALS['VIEW_PATH'];
	}

	/**
	 * Загрузка темы
	 * -------------
	 */
	public function loadtheme ($uri, $uri_folder) {
		require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . 'options.php';
		$options = new options();
		$this->theme = $options->theme;//Установка вар
		$this->log = $options->log;//Установка log
		if ($this->getDisabled()) {
			die();
		}
		$file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . $uri_folder . $uri . '.php';
    	$file = explode('?', $file);
		if ($file[1]) {
			$file[0] .= '.php';
		}
		if (file_exists($file[0])) {
			require_once $file[0];
			$ftk = new ftk();
		} else {
			if($_SERVER["REDIRECT_STATUS"] == 403){
				$successlist = true;
				require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . '403' . '.php';
				$ftk = new ftk();
			} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
				$not_found = true;
				require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . '404' . '.php';
				$ftk = new ftk();
			}
		}
        //-->Выполнение кода после загрузки страницы
		$dirmodules = scandir($this->getTheme_path() . 'plugins');
		foreach ($dirmodules as $module) {
			if ($module != '.' && $module != '..') {
				if(is_callable(array($module, 'footerExecute'))) {
					$func = array($module, 'footerExecute');
					$func();
				}
			}
		}
		if($this->log == true) {
			echo "<p>[Инфо][uri][Путь] => \"{$file}\"</p>";
			echo "<p>[Инфо][uri][Выполнение] => \"{$uri}\" :)</p>";
			echo "<p>[Инфо][uri_folder][Выполнение папки] => \"{$uri_folder}\" :)</p>";
			echo "<p>[Инфо][Платформа] => $platform</p>";
			if ($not_found == true) {
				echo "<p>[Инфо][not_found][Выполнение] => \"{$not_found}\" :(</p>";
			}
			if ($successlist == true) {
				echo "<p>[Инфо][Открытие папки][Выполнение] => \"{$successlist}\" :(</p>";
			}
		}
	}

	/**
	 * Возвращает путь выбранной темы
	 */
	public function getTheme_path() {
		require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . 'options.php';
		$options = new options();
		$browser = $_SERVER['HTTP_USER_AGENT'];
		if ($options->platform == 'auto') {
			if (preg_match('/android/i', $browser)) {
				$platform = 'android';
			} else {
				$platform = 'linux';
			}
		} else {
			$platform = $options->platform;
		}
		return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $options->theme . DIRECTORY_SEPARATOR . $platform . DIRECTORY_SEPARATOR;
	}
}
