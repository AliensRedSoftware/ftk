<?php
class ftk extends xlib {
    function __construct () {
		$this->req(["head", "body", "footer"]);
		$head = new head();
		$body = new body();
		$footer = new footer();
		$this->execute($head, $body, $footer);
    }

	/**
	 * Выполнение
	 */
	function execute($head, $body, $footer) {
		$head->execute('test');
		$body->execute();
		$footer->execute();
	}
}