<?php

/**
 * Загрузка модулей
 */
function load () {
    __autoload('module');
    $module = new module();
    $module->load();
    __autoload('view');
    $view = new view();
    $view->set_theme();
}

/**
 * Подгрузка классов
 */
function __autoload ($class) {
    require_once 'theme/options.php';
    $option = new options();
    $log = $option->log;
    //-----------------------------------
    $execute =  $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($execute)) {
            if($log == true) {
                echo "<p>[info][autoload] loaded => \"{$class}\" :)</p>";
            }
            require_once $execute;
            return true;
        }
    
    return false;
}
load();