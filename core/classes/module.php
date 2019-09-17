<?php
error_reporting(0);

/**
 * Подгрузка модулей
 * -----------------
 */
class module extends options {

	function __construct () {
    	global $startedModules;
    	$startedModules = [];
    }
	/**
	 * Загрузка модулей
	 */
	public function load () {
    	global $startedModules;
		$foo = [];
		$dirmodules = scandir($this->getTheme_path() . 'plugins');
    	array_shift($dirmodules);
    	array_shift($dirmodules);
		foreach ($dirmodules as $module) {
			if ($startedModules[0] == $module) {
				array_push($foo, $module);
				if ($this->log) {
					echo "<p>[Инфо][Плагин][Загружен] => \"{$module}\" :)</p>";
				}
				require_once $this->path($module);
            	array_shift($startedModules);
				if(is_callable(array($module, 'execute'))) {
					$func = array($module, 'execute');
					$func();
				}
			}
		}
    	if ($startedModules[0]) {
        	$this->load();
        }
    	$i = -1;
    	foreach ($dirmodules as $module) {
        	$i++;
            foreach ($foo as $sel) {
            	if ($sel == $module) {
					unset($dirmodules[$i]);
                }
            }
        }
		foreach ($dirmodules as $module) {
			array_push($foo, $module);
			if ($this->log) {
				echo "<p>[Инфо][Плагин][Загружен] => \"{$module}\" :)</p>";
			}
			require_once $this->path($module);
			if(is_callable(array($module, 'execute'))) {
				$func = array($module, 'execute');
				$func();
			}
		}
		define('modules', $foo);
	}

	/**
	 * Возвращает модуль
	 */
	public function path ($name) {
		return $this->getTheme_path() . 'plugins' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $name . '.php';
	}

	/**
	 * Возвращает путь выбранной темы
	 */
	public function getTheme_path() {
        //user-agent
        $browser = $_SERVER['HTTP_USER_AGENT'];
        if ($this->platform == 'auto') {
            if (preg_match('/android/i', $browser)) {
                $platform = 'android';
            } else {
                $platform = 'linux';
            }
        } else {
            $platform = $this->platform;
        }
		return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . $platform . DIRECTORY_SEPARATOR;
	}
}
