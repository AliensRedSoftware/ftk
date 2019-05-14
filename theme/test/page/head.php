<?php
class head extends xlib {
    function execute ($title) {
        $path = $this->get_theme();
        echo "<head>";
        echo "<title>$title</title>";
        $this->utf8();
        $this->description('');//О сайте
        $this->tag('');
        echo "</head>";
    }
}
