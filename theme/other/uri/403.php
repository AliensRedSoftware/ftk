<?php
class ftk extends xlib {
    function __construct () {
        $this->req(["head", "body", "footer"]);
        $head = new head();
        $body = new body();
        $footer = new footer();
        $this->execute($head, $body, $footer);
    }

    function execute($head, $body, $footer) {
        $head->execute('Ошибка доступ к папкам запрещен!');
        $body->layout_403();
        $footer->execute();
    }
}