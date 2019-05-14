<?php
class ftk extends xlib {
    function __construct () {
        $this->req([$this->path("head"), $this->path("body"), $this->path("footer")]);
        $head = new head();
        $body = new body();
        $footer = new footer();
        $this->execute($head, $body, $footer);
    }

    function execute($head, $body, $footer) {
        $head->execute('test');
        $body->execute();
        $footer->execute();
    }
}
