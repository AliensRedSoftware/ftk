<?php
error_reporting(0);

/**
 * Загрузка модулей
 */
function loadedModules () {
	$module = new module();
	$module->load();
}

/**
 * Загрузка модулей и отоброжение
 */
function load () {
	$module = new module();
	$module->load();
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
            if($log) {
                echo "<p>[Инфо][Подгрузка] Загружена => \"{$class}\" :)</p>";
            }
            require_once $execute;
            return true;
        }
    return false;
}
spl_autoload_register('autoloader');
autoloader('module');
autoloader('view');
if(!$_GET || $_GET['page'] >= 0 && isset($_GET['page'])) {
	load();
} else {
	loadedModules();
}