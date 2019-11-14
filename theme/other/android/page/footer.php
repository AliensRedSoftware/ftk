<?php
class footer extends xlib {
    function execute () {
        echo "<footer>";
        $this->loader_js('js');
        echo "</footer>";
    }
}
