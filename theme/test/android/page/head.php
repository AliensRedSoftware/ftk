<?php
class head extends xlib {

	/**
	 * Выполнение
	 */
	function execute ($title) {
		echo "<head>";
		$this->setTitle($title);
		$this->utf8();
		$this->description('');//О сайте
		$this->tag('');
		$this->loader_css('css');
		echo "</head>";
	}
}