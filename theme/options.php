<?php
class options {
<<<<<<< HEAD
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
=======
    public $log = false;//логирование сервера
    public $theme = 'test'; //Имя темы
    public $execute = 'test';//Название файла точка запуска темы Начальная_страница
    public $libphp = 'page';//Папка где находится либы с php
>>>>>>> 6685676f20f60aaee269b46f1fa286d2640d3c19
}
