<?php
class options {
    /**
     * Опции фреймворка
     * false - логирование сервера
     * test - Имя темы
     * test - Точка запуска темы (index.php)
     * linux - Имя устройства темы (auto)
     * page - Либы где находится php
     */
    public $log = false;
    public $theme = 'test';
    public $execute = 'test';
    public $platform = 'linux';
    public $libphp = 'page';
}
