<?php
error_reporting(0);

/**
 * Загрузка модулей
 */
function loadedModules () {
	autoloader('module');
	$module = new module();
	$module->load();
}

/**
 * Загрузка модулей и отоброжение
 */
function load () {
	autoloader('module');
	$module = new module();
	$module->load();
	autoloader('view');
	$view = new view();
	$view->set_theme();
}

/**
 * Подгрузка классов
 */
function autoloader ($class) {
    require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . 'options.php';
    $options = new options();
    $log = $options->log;
    //-----------------------------------
    $execute = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($execute)) {
            if($log == true) {
                echo "<p>[Инфо][Подгрузка] Загружена => \"{$class}\" :)</p>";
            }
            require_once $execute;
            return true;
        }
    return false;
}
spl_autoload_register('autoloader');
if(!$_GET || $_GET['page'] >= 0 && isset($_GET['page'])) {
	load();
} else {
	loadedModules();
}
