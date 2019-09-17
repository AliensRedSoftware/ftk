<?php

/**
 * Стандартный модуль для работы упрошенный php
 */
class xlib {

    /**
     * Возвращает простой html код
     */
	public function html ($code) {
		return $code;
	}
    
    /**
     * Возвращает элемент картинки
     */
     public function imglightbox ($url = "https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fteapoetry.com%2Fwp-content%2Fuploads%2F2016%2F06%2Frabstol_net_tea_14.jpg&f=1") {
         return "<a class='example-image-link' href=$url style=\"width:50%;\" data-lightbox='example-1'><img class='example-image' src=$url alt='image-1' style=\"width:50%;\"/></a>";
     }

	/**
	 * Добавление css style
	 */
	public function style ($style) {
        echo "<style>$style</style>";
	}

	/**
	  * Добавление js скрипта
	  */
	public function js ($js) {
        echo "<script>$js</script>"; 
	}

	/**
     * Возвращает пути выбранной темы
     */
	public function get_theme () {
		require_once 'theme/options.php';
		$options = new options();
		return DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . $options->theme . DIRECTORY_SEPARATOR;
	}

	/**
     * Автодобавление всех стилей из папки
     * $folder_css - папка с css стилей
     */
    public function loader_css($folder_css = "css") {
        $path = "." . $this->get_theme() . $folder_css . DIRECTORY_SEPARATOR;
        $cssfile = scandir($path);
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
        $path = "." . $this->get_theme() . $folder_js . DIRECTORY_SEPARATOR;
        $jsfile = scandir($path);
		foreach($jsfile as $js){
            if ($js != '.' && $js != '..') {
                echo "<script type=\"text/javascript\" src=\"$path$js\"></script>";
            }
		}
    }

    /**
     * Добавление js из папки
     */
    public function add_js(array $js, $folder_js = 'js') {
        foreach($js as $js){
            $path = "." . $this->get_theme() . $folder_js . DIRECTORY_SEPARATOR . $js;
            echo "<script type=\"text/javascript\" src=\"$path\"></script>";
        }
    }

    /**
     * Добавление css из папки
     */
    public function add_css(array $css, $folder_css = 'css') {
        foreach($css as $css){
            $path = "." . $this->get_theme() . $folder_css . DIRECTORY_SEPARATOR . $css;
            echo "<link rel=\"stylesheet\" text=\"type/css\" href=\"$path\">";
        }
    }

    /**
     * Возвращает mysql подключенние
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
	 * Возвращает подключенные хуйни чтобы юзать php либы )
	 */
	public function req (array $file){
		foreach ($file as $val) {
			require_once $val;
		}
	}

	/**
     * Возвращает путь php скрипты либы
     */
	public function get_path() {
		require_once 'theme/options.php';
		$options = new options();
		return $options->libphp;
	}

	/**
     * Возвращает php скрипты либы
     */
	public function path ($file) {
		return mb_substr($this->get_theme() . $this->get_path() . DIRECTORY_SEPARATOR . $file . '.php', 1);
	}

	/**
     * Возвращает utf8 кодировка
     */
	public function utf8 () {
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
	}

	/**
     * Возвращает description сайта
     */
	public function description ($text) {
		echo "<meta name=\"description\" content=\"$text\">"; 
	}

	/**
     * Возвращает tag сайта
     */
	public function tag ($tag) {
		echo "<meta name=\"Keywords\" content=\"$tag\">";
	}

	/**
     * Возвращает scripts на js
     */
	public function scripts ($code) {
		echo "
        <script>
            $code
        </script>
        ";
	}

	/**
     * Возвращает ico сайта
     */
	public function ico ($ico) {
        $path = $this->get_theme();
		echo "<link rel='shortcut icon' type='image/png' href=$path$ico>";
	}

	/**
     * Возвращает рандомное значение 
     */
	public function getrand(array $iteam) {
		return $iteam[rand(0 , count($iteam) - 1)];
	}

	/**
	 * Возвращает цвет 
	 */
	public function getTheme() {
		return $GLOBALS['theme'];
	}

	/**
	 * Установить цвет 
	 */
	public function setTheme($theme) {
		$GLOBALS['theme'] = $theme;
	}
	/**
	 * Возвращает имя ссылки
	 */
	public function geturi ($value = 0) {
		return urldecode(trim(explode('/', $_SERVER['REQUEST_URI'])[$value]));
	}

	/**
	 * Проверяет есть папка или нету если нету то создает
	 */
	public function isdirToCreate($dir) {
		if (is_dir($dir) == false) {
			mkdir($dir , 0777);
		}
	}

	/**
     * Проверка есть такой символ или нету 
     * Возвращает true если есть такой символ :)
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
     * контент Имя_анимаций
     */
    public function anim ($content, $animate) {
        return "<div class='animated $animate'>$content</div>";
    }
    
    /**
     * Отступы по всей
     */
    public function padding ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"padding: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от левого края
     */
    public function padding_left ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"padding-left: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от правого края
     */
    public function padding_right ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"padding-right: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от вверха
     */
    public function padding_top ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"padding-top: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от низа
     */
    public function padding_bottom ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"padding-bottom: $padding;\">$content</div>";
    }
        
    /**
     * Отступы по всей
     */
    public function margin ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"margin: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от левого края
     */
    public function margin_left ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"margin-left: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от правого края
     */
    public function margin_right ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"margin-right: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от вверха
     */
    public function margin_top ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"margin-top: $padding;\">$content</div>";
    }
    
    /**
     * Отступы от низа
     */
    public function margin_bottom ($content, $padding = 5) {
        $padding .= 'px';
        return "<div style=\"margin-bottom: $padding;\">$content</div>";
    }
    
    /**
     * Форма отправки
     */
    public function evnform ($content,$id = 'testid',$method = 'post') {
        return "<form method='$method' id='$id'>$content</form>";
    }
    
    /**
     * Возвращаем блок
     */
    public function div ($content, $class = 'response', $id = 'response') {
        return "<div class='$class' id='$id' >$content</div>";
    }
    
    /**
     * Возвращает p
     */
    public function p ($content = "Привет") {
        return "<p>$content</p>";
    }
    
    /**
     * Возвращает z кординату
     * Возможно нужна чтобы элемент был сверху :)
     */
    public function z($content, $value = 5) {
        return "<div style='z-index: $value;position: relative;'>$content</div>";
    }
    
    /**
     * Возвращает блок стиль 
     */
    public function divcss($content, $style = 'position: absolute;') {
        return "<div style='$style'>$content</div>";
    }
    
    /**
     * Возвращает скрытый элемент
     */
    public function inputhidden($value = "val1337", $id = 'id') {
        return "<p><input class='form-control' type='hidden' name='$id' value='$value'/></p>";
    }
}