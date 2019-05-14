### Описание ###
ftk - фреймворк
* * *

### Возможности ###

+ Контент
    * Добавление видео с ютуба
    * Добавление картинок url , gif
    * Простой текст отправка

* * *

### Структура фреймворк ftk ###

* .htaccess -> Редирект и прочее
* bootstrap.php -> Загрузчик
* index.php -> Главный загружаемый файл
+ core -> Движок
    + classes -> Классы
        * controller.php -> Контроллер
        + module.php -> Модули доп.функции
            * html($code) -> Возвращает простой html код
            * get_theme() -> Возвращает имя выбранной темы /theme/testthemes/
            * add_css([$path . 'css/animate.css' , $path . 'css/bootstrap.css']); -> Подключение css стилей
            * add_js([$path . 'js/event.js' , $path . 'js/jquery.lazy.js']); -> Подключение js
            * getmysql(); -> Возвращает mysql данные ;)
            + req([$ftk->path('head') , $ftk->path('body')]); -> Подключение классов и извлечение функций ))
                * head , body подключился (Соблюдать последовательность!!)
                * $head = new head(); $body = new body();
                + Пример
                    * $ftk->req([$ftk->path('head') , $ftk->path('body')]);
                     $head = new head();
                     $body = new body();
            * path($file); -> пути к скриптам
            * utf8(); -> установка utf8 кодировка сайта
            * description($txt); -> Описание сайта
            * tag($txt); -> tag через ,
            * scripts($code); -> Выполнение js кода
            * ico($path); -> установка ico
            * alert_bootstrap($type , $title , $text); -> вывод msg тип title | text
        * view.php -> Работа с темами
    + composer -> композер
        * Пусто :)
+ theme -> Темы (сайты)
    + borda -> Тема борда типа lolifox и тд )
        * Файлы[]
    + testthemes -> Тема тестовая
        + uri -> Папка в которой страницы
            * index.php -> Главный файл для этой темы с него запуск сайта!
    + options.php -> Настройки темы
        + $log -> лог сервера
            * [info][autoload] execute => "module" :) -> загрузка module
            * [info][autoload] execute => "view" :) -> загрузка view
            * [info][autoload] execute => "controller" :) -> загрузка controller
            * [info][uri][path] => "theme/testthemes/uri/index.php" -> путь какая страница открыта
            * [info][uri] execute => "index" :) -> название файла какая страница была открыта
            * [info][uri_folder] execute => "o/" :) -> имя папки какая страница была открыта
        * $theme -> имя темы
        * $execute -> Выбор файла запуска темы = "index" (Пример с темы testthemes)
        * $page -> страница её не трогать!
+ Установка
	1. Скачать и извечь в папку с сервером
	2. Изменить данные mysql в mysql.php
	3. Готова :) (Изменить тему можно в папке themes => options.php)
   
* * *
### Подключение борды ###
    + Установка
        1. Скачать и установить ftk
        2. Изменить данные mysql => ./theme/mysql.php
        3. Импортировать sql в mysql => ./theme/borda/database.sql
        4. Готово :)
    + Создание доски
        1. Сверху в шапке кнопка => общение
        2. Создать доску
        3. Название и краткое описание доски
        4. Готово :) => можно перейти на эту доску ну она будет пустая в ней нужно создать тред
    + Создание треда
        1. Сверху в шапке кнопка => общение
        2. Создать тред
        3. Выбрать доску в которой будет лежать тред
        4. Название треда и описание его
        5. Готово :) теперь можно перейти в этот тред и постить картинки ;)

* * *
### Возможности ftk ###
    * Логирование
    * Загрузка темы
    * база данных mysql
    * Модули
    
[bftk - Упрощенной билдер](https://github.com/AliensRedSoftware/bftk "Упрощенной билдер")

### О ftk ###
* FTK Framework
* Версия => 0.125

