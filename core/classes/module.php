<?php

/**
 * Подгрузка модулей
 */
class module extends options {

	/**
	 * Загрузка модулей
	 */
	public function load () {
		$dirmodules = scandir($this->getTheme_path() . 'modules');
		foreach ($dirmodules as $module) {
			if ($module != '.' && $module != '..') {
				if ($this->log == true) {
					echo "<p>[info][modules] loaded => \"{$module}\" :)</p>";
				}
				require_once $this->path($module);
			}
		}
	}
    
	/**
	 * Возвращает модуль
	 */
	public function path ($name) {
		return mb_substr($this->getTheme_path() . 'modules' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $name . '.php', 1);
	}

	/**
	 * Возвращает путь выбранной темы
	 */
	public function getTheme_path() {
		return DIRECTORY_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR;
	}
}