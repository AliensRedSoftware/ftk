<?php
class ftk extends xlib {
    function __construct () {
<<<<<<< HEAD
        $this->req(["head", "body", "footer"]);
=======
        $this->req([$this->path("head"), $this->path("body"), $this->path("footer")]);
>>>>>>> 6685676f20f60aaee269b46f1fa286d2640d3c19
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
