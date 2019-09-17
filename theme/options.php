<?php
class options {
    /**
     * Опции фреймворка
     * true - логирование сервера
     * test - Имя темы
     * test - Точка запуска темы (index.php)
     * linux - Имя устройства темы (auto)
     * page - Либы где находится php
     */
    public $log = true;
    public $theme = 'test';
    public $execute = 'test';
    public $platform = 'linux';
    public $libphp = 'page';
}
