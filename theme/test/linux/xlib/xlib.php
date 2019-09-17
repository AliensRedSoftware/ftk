<?php

/**
 * Стандартный модуль для создание сайта
 * v2.0
 */
class xlib {

    /**
     * Действие при подключение
     */
    function execute () {
		error_reporting(0);
        xlib::getmysql();
    }

    /**
     * Возвращает массив с модулями
     */
    public function getModules() {
        $modules = scandir('.' . $this->getPathModules(null));
        $output = [];
        foreach ($modules as $value) {
            if ($value != '.' && $value != '..') {
                array_push($output, $value);
            }
        }
        return $output;
    }

    /*
     * Возвращает простой html код
     * $html - код на хтмл
     * @return string
     */
    public function getHtml ($code) {
        return $code;
    }

    /*
     * Устанавливает простой html код
     * $html - код на хтмл
     */
    public function setHtml ($code) {
        echo $code;
    }

    /*
     * Устанавливает загаловок
     * $title - Загаловок
     * @return string
     */
    public function setTitle($title) {
        echo "<title>$title</title>";
    }

    /**
     * Добавление css style
     * $style - стиль код css
     */
    public function style ($style) {
        echo "<style>$style</style>";
    }

    /**
      * Добавление js скрипта
      * $js - код js
      */
    public function js ($js) {
        echo "<script defer async>$js</script>";
    }

    /**
     * Возвращает путь выбранной темы
     * @return string
     */
    public function getTheme () {
        require_once '.' . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . 'options.php';
        $options = new options();
        return DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $options->theme . DIRECTORY_SEPARATOR;
    }

    /**
     * Возвращает платформу
     * @return string
     */
    public function getPlatform() {
        require_once '.' . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR .'options.php';
        $options = new options();
        //user-agent
        $browser = $_SERVER['HTTP_USER_AGENT'];
        if ($options->platform == 'auto') {
            if (preg_match('/android/i', $browser)) {
                $platform = 'android';
            } else {
                $platform = 'linux';
            }
        } else {
            $platform = $options->platform;
        }
        return $platform;
    }

    /**
     * Автодобавление всех стилей из папки
     * $folder_css - папка с css стилей
     */
    public function loader_css($folder_css = "css") {
        $path = $this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR . $folder_css . DIRECTORY_SEPARATOR;
        $cssfile = scandir('.' . $path);
        foreach($cssfile as $css){
            if ($css != '.' && $css != '..') {
                echo "<link rel=\"stylesheet\" text=\"type/css\" href=\"$path$css\">";
            }
        }
    }

    /**
     * Автодобавление всех js из папки
     * $folder_js - папка с js скриптами
     */
    public function loader_js($folder_js = "js") {
        $path = $this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR . $folder_js . DIRECTORY_SEPARATOR;
        $jsfile = scandir('.' . $path);
        foreach($jsfile as $js){
            if ($js != '.' && $js != '..') {
                echo "<script type=\"text/javascript\" src=\"$path$js\"></script>";
            }
        }
    }

    /**
     * Добавление js из папки
     * $js - Массив файлов js
     * $folder_js - папка где лежат js
     */
    public function add_js(array $js, $folder_js = 'js') {
        foreach($js as $js){
            $path = $this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR . $folder_js . DIRECTORY_SEPARATOR . $js;
            echo "<script type=\"text/javascript\" src=\"$path\"></script>";
        }
    }

    /**
     * Добавление css из папки
     * $css - Массив файлов css
     * $folder_css - папка где лежат css
     */
    public function add_css(array $css, $folder_css = 'css') {
        foreach($css as $css){
            $path = $this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR . $folder_css . DIRECTORY_SEPARATOR . $css;
            echo "<link rel=\"stylesheet\" text=\"type/css\" href=\"$path\">";
        }
    }

    /**
     * Возвращает mysql подключение
     * @return sql
     */
    public function getmysql () {
        require_once 'theme/mysql.php';
        $mysql = new mysql();
        $sql = mysqli_connect($mysql->ip , $mysql->user , $mysql->password , $mysql->database);
        if (!$sql) {
            echo "Ошибка подключение sql!";
            die();
        } else {
            return $sql;
        }
    }

    /**
     * Возвращает подключение php
     * $file - массив страниц
     */
    public function req (array $file){
        foreach ($file as $val) {
            require_once $this->path($val);
        }
    }

    /**
     * Возвращает путь php скрипты либы
     * @return string
     */
    public function getLibPath() {
        require_once 'theme/options.php';
        $options = new options();
        return $options->libphp;
    }

    /**
     * Возвращает путь к libphp
     */
    public function path ($file) {
        return mb_substr($this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR . $this->getLibPath() . DIRECTORY_SEPARATOR . $file . '.php', 1);
    }

    /**
     * Установка utf8 кодировка
     */
    public function utf8 () {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
    }

    /**
     * Установка описание сайта
     */
    public function description ($text) {
        echo "<meta name=\"description\" content=\"$text\">"; 
    }

    /**
     * Установка тегов сайта
     */
    public function tag ($tag) {
        echo "<meta name=\"Keywords\" content=\"$tag\">";
    }

    /**
     * Выполняет js код
     */
    public function script ($code) {
        echo "<script>$code</script>";
    }

    /**
     * Установка ico сайта
     * $ico - путь к иконки
     */
    public function ico ($ico) {
        $path = $this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR;
        echo "<link rel='shortcut icon' type='image/png' href=$path$ico>";
    }

    /**
     * Возвращает рандомный массив
     * $iteam - Массив
     * @return string
     */
    public function getrand(array $iteam) {
        return $iteam[rand(0 , count($iteam) - 1)];
    }

    /**
     * Возвращает имя ссылки
     * $value - ступень обозночение
     * @return string
     */
    public function geturi ($value = 0) {
        return urldecode(trim(explode('/', $_SERVER['REQUEST_URI'])[$value]));
    }

    /**
     * Проверяет есть папка или нету если нету то создает
     */
    public function isDir($dir) {
        if (is_dir($dir) == false) {
            mkdir($dir , 0777);
        }
    }

    /**
     * Проверка есть такой символ или нету 
     * Возвращает true если есть такой символ :)
     * $nochar - массив с символами
     * $inputtext - текст
     */
    public function isCharArray(array $nochar, $inputtext) {
        foreach($nochar as $valuenochar) {
            $outputtext = strpos($inputtext , $valuenochar);
            if ($outputtext !== false) {
                return $valuenochar;
            }
        }
        return false;
    }

    /**
     * Возвращает анимацию
     * $content - Контент
     * $animate - Анимация название
     * @return string
     */
    public function anim ($content = null, $animate) {
        return "<div class='animated $animate'>$content</div>";
    }

    /**
     * Отступы по всей
     * content - Контент
     * padding - значение отступа
     * @return string 
     */
    public function padding (array $options = ['content', 'all', 'left', 'top', 'right', 'bottom', 'style']) {
        $optionsOLD = [
            'content' => null,
            'all' => 0,
            'left' => 0,
            'top' => 0,
            'right' => 0,
            'bottom' => 0,
            'style' => null
        ];
        $content = $options['content'];
        $all = $options['all'];
        $left = $options['left'];
        $top = $options['top'];
        $right = $options['right'];
        $bottom = $options['bottom'];
        $style = $options['style'];
        if ($content == null) {
            $content = $optionsOLD['content'];
        }
        if ($all == null) {
            $all = $optionsOLD['all'];
        }
        if ($left == null) {
            $left = $optionsOLD['left'];
        }
        if ($top == null) {
            $top = $optionsOLD['top'];
        }
        if ($right == null) {
            $right = $optionsOLD['right'];
        }
        if ($bottom == null) {
            $bottom = $optionsOLD['bottom'];
        }
        if ($all == null) {
			if ($style == null) {
				return "<div style=\"padding-left: $left; padding-top: $top; padding-right: $right; padding-bottom: $bottom;\">$content</div>";
			} else {
				return "<div style=\"padding-left: $left; padding-top: $top; padding-right: $right; padding-bottom: $bottom;$style\">$content</div>";
			}
        } else {
			if ($style == null) {
				return "<div style=\"padding-left: $left; padding-top: $top; padding-right: $right; padding-bottom: $bottom; padding: $all;\">$content</div>";
			} else {
				return "<div style=\"padding-left: $left; padding-top: $top; padding-right: $right; padding-bottom: $bottom;padding: $all; $style\">$content</div>";
			}
        }
    }

    /**
     * Отступы по всей
     * content - Контент
     * margin - значение отступа
     * @return string
     */
    public function margin (array $options = ['content', 'all', 'left', 'top', 'right', 'bottom']) {
        $optionsOLD = [
            'content' => null,
            'all' => 0,
            'left' => 0,
            'top' => 0,
            'right' => 0,
            'bottom' => 0
        ];
        $content = $options['content'];
        $all = $options['all'];
        $left = $options['left'];
        $top = $options['top'];
        $right = $options['right'];
        $bottom = $options['bottom'];
        if ($content == null) {
            $content = $optionsOLD['content'];
        }
        if ($all == null) {
            $all = $optionsOLD['all'];
        }
        if ($left == null) {
            $left = $optionsOLD['left'];
        }
        if ($top == null) {
            $top = $optionsOLD['top'];
        }
        if ($right == null) {
            $right = $optionsOLD['right'];
        }
        if ($bottom == null) {
            $bottom = $optionsOLD['bottom'];
        }
        if ($all == null) {
            return "<div style=\"margin-left: $left; margin-top: $top; margin-right: $right; margin-bottom: $bottom;\">$content</div>";
        } else {
            return "<div style=\"margin: $all;\">$content</div>";
        }
    }

    /**
     * Форма действие
     * content - Контент
     * id - индентификатор
     * method - метод отправки post, get , put
     * @return string
     */
    public function evnform (array $options = ['content', 'id', 'method']) {
        $optionsOLD = [
            'content' => null,
            'id' => 'testid',
            'method' => 'post'
        ];
        $content = $options['content'];
        $id = $options['id'];
        $method = $options['method'];
        if ($content == null) {
            $content = $optionsOLD['content'];
        }
        if ($id == null) {
            $id = $optionsOLD['id'];
        }
        if ($method == null) {
            $method = $optionsOLD['method'];
        }
        return "<form method='$method' id='$id' style='margin-block-end: 0em;'>$content</form>";
    }

    /**
     * Возвращаем блок
     * content - Контент
     * id - индентификатор
     * class - класс
     * @return string
     */
    public function div (array $options = ['content', 'class', 'id', 'style']) {
        $optionsOLD = [
            'content' => null,
            'class' => null,
            'style' => '/* style */',
            'id' => null
        ];
        $content = $options['content'];
        $class = $options['class'];
        $style = $options['style'];
        $id = $options['id'];
        if ($content == null) {
            $content = $optionsOLD['content'];
        }
        if ($class == null) {
            $class = $optionsOLD['class'];
        }
        if ($style == null) {
            $style = $optionsOLD['style'];
        }
        if ($id == null) {
            $id = $optionsOLD['id'];
        }
        if ($class == null && $id == null) {
            return "<div style='$style'>$content</div>";
        } 
        if ($id != null && $class == null){
            return "<div id='$id' style='$style'>$content</div>";
        } 
        return "<div class='$class' id='$id' style='$style'>$content</div>";
    }

    /**
     * Возвращает p
     * $content - Контент
     * @return string
     */
    public function p ($content = "Привет") {
        return "<p>$content</p>";
    }

    /**
     * Возвращает z кординату
     * Возможно нужна чтобы элемент был сверху :)
     * $content - Контент
     * $value - расстояние
     * @return string
     */
    public function z($content = null, $value = 5) {
        return "<div style='z-index: $value;position: relative;'>$content</div>";
    }

    /**
     * Возвращает скрытый элемент поля
     * $value - Значение
     * $id - индентификатор
     * @return object
     */
    public function inputhidden($value = "Пустое значение", $id = 'id') {
        return "<p><input class='form-control' type='hidden' name='$id' id='$id' value='$value'/></p>";
    }

    /**
     * Проверка на хеш сумму md5 массив картинок
     * Возвращает массив с проверенным md5 картинок
     * $iteam - Массив картинок
     * @return array
     */
    public function getCheckMd5Array (array $iteam) {
        $successlistimg = [];
        foreach ($iteam as $value_img) {
            if (trim($value_img) != null) {
                $imagefile = getimagesize($value_img);
                $width = $imagefile[0];
                $height = $imagefile[1];
                if ($width == 0 && $height == 0) {
                } else {
                    $currentmd5 = md5_file($value_img);
                    array_push($successlistimg, $value_img);
                    array_shift($iteam);
                    $next = $iteam;
                    foreach ($next as $key) {
                        if ($currentmd5 == md5_file($key)) {
                            array_pop($successlistimg);
                        }
                    }
                }
            }
        }
        return $successlistimg;
    }

    /**
     * Возвращает картинку
     * $src - путь или ссылка
     * $width - ширина
     * $height - высота
     */
    public function img ($src = 'https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fteapoetry.com%2Fwp-content%2Fuploads%2F2016%2F06%2Frabstol_net_tea_14.jpg&f=1', $width = '25%', $height = 'auto') {
        return "<img src='$src' style=\"width: $width;height: $height;\"/>";
    }

    /**
     * Возвращает абсалютный путь к модулю
     */
    public function getPathModules($path) {
        return $this->getTheme() . $this->getPlatform() . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * Возвращает 1 символ
     */
    public function startWith ($delimater,$txt) {
        $txt = preg_split('//', $txt, -1, PREG_SPLIT_NO_EMPTY);
        if ($txt[0] == $delimater) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Возвращает символы в виде массива
     */
    public function getCharToArray() {
        return [
            '!', '"', '№', ';', '%', ':', '?', '*', '(', ')',
            '@','#','$','%','^','&','*', '[', ']', '{', '}',
            "'", "|", '/', '.', ',', '-', '+', '=', '`', '~', '\\',
            '_'
        ];
    }

    /**
     * Возвращает символы цифры в виде массива
     */
    public function getNumberToArray() {
        return ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
    }

    /**
     * Возвращает каждый символ в виде массива utf8
     */
    public function mb_str_split($str) {
        preg_match_all('#.{1}#uis', $str, $out);
        return $out[0];
    }

    /**
     * Возвращает проверенную строку на подлинность
     */
    public function islowupper ($str = 'java') {
        $strlower = $this->mb_str_split($str);
        $strArray = $this->mb_str_split($str);
        array_shift($strArray);
        foreach ($strArray as $val) {
            $i++;
            if ($val != mb_strtolower($strlower[$i])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Возвращает чекс-бокс
     */
    public function checkbox ($id = 'checkbox', $value = 'ЧексБокс', $selected = false) {
        if ($selected == true) {
            $selected = 'checked';
        } else {
            $selected = null;
        }
        return "<input type='checkbox' name='$id' id='$id' value='$value' $selected><label>$value</label>";
    }

    /**
     * Возвращает uuidv4
     */
    public function uuidv4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

          // 32 bits for "time_low"
          mt_rand(0, 0xffff), mt_rand(0, 0xffff),

          // 16 bits for "time_mid"
          mt_rand(0, 0xffff),

          // 16 bits for "time_hi_and_version",
          // four most significant bits holds version number 4
          mt_rand(0, 0x0fff) | 0x4000,

          // 16 bits, 8 bits for "clk_seq_hi_res",
          // 8 bits for "clk_seq_low",
          // two most significant bits holds zero and one for variant DCE1.1
          mt_rand(0, 0x3fff) | 0x8000,

          // 48 bits for "node"
          mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Возвращает валидный ли uuidv4
     */
    public function is_uuidv4 ($value) {
        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        if(preg_match($UUIDv4, $value) == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Возвращает сообщение стандартное об ошибки
     */
    public function alert () {
        $css = '../../../css/alert.css';
        $uuidlogin = $this->uuidv4();
        $name = $_SERVER['SERVER_NAME'];
        return "<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' hasBrowserHandlers='true'>
    <head>
        <title>Попытка соединения не удалась</title>
        <link rel='stylesheet' href='$css' type='text/css' media='all' />
        <link rel='icon' type='image/png' id='favicon' href='https://findicons.com/files/icons/99/office/16/alert.png'/>
    </head>
    <body dir='ltr'>
        <div id='errorPageContainer' class='$uuidlogin'>
            <div id='errorTitle'>
                <h1 id='errorTitleText'>Попытка соединения не удалась</h1>
            </div>
            <div id='errorLongContent'>
                <div id='errorShortDesc'>
                    <p id='errorShortDescText'>Модем не может установить соединение с сервером c $name</p>
                </div>
                <div id='errorLongDesc'>
                    <ul>
                        <li>Возможно, сайт временно недоступен, в этом случае подождите некоторое время и попробуйте снова.</li>
                        <li>Если вам не удалось открыть другие сайты, проверьте настройки соединения компьютера с сетью.</li>
                        <li>Если ваш компьютер или локальная сеть защищены межсетевым экраном или прокси-сервером, проверьте их, так как неверные настройки могут помешать просмотру веб-сайтов.</li>
                    </ul>
                </div>
            </div>
            <button id='errorTryAgain' autocomplete='off' onclick='location.reload();' autofocus='true'>Попробовать снова!</button>
        </div>
    </body>
</html>";
    }
}
