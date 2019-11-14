<?php
class options {
    /**
     * Опции фреймворка
     * false - логирование сервера
     * other - Имя темы
     * other - Точка запуска темы (index.php)
     * linux - Имя устройства темы (auto)
     * page - Либы где находится php
     */
    public $log = false;
    public $theme = 'other';
    public $execute = 'other';
    public $platform = 'linux';
    public $libphp = 'page';
}
