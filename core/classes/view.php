<?php
class view extends controller {
    protected $theme , $log;
	public function set_theme () {//Установка темы
		$this->loadsettings();
	}
    public function loadtheme ($uri , $uri_folder) {//Загрузка темы
        require_once 'theme' . DIRECTORY_SEPARATOR . 'options.php';
        $options = new options();
        $this->theme = $options->theme;//Установка вар
        $this->log = $options->log;//Установка log
        if($this->log == true) {
            $path = 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . $uri_folder . $uri . '.php';
            echo "<p>[info][uri][path] => \"{$path}\"</p>";
            echo "<p>[info][uri] execute => \"{$uri}\" :)</p>";
            echo "<p>[info][uri_folder] execute => \"{$uri_folder}\" :)</p>";
            if ($not_found == true) {
                echo "<p>[info][not_found] execute => \"{$not_found}\" :)</p>";
            }
        }
        if (file_exists('theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . $uri_folder . $uri . '.php')) {
            require_once 'theme' .  DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . $uri_folder . $uri . '.php';
            $ftk = new ftk();
        } else {
            require_once 'theme' . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . '404' . '.php';
            $ftk = new ftk();
        }
	}
}