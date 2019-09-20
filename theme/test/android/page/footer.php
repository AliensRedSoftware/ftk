<?php
class footer extends xlib {

	/**
	 * Выполнение
	 */
	function execute () {
		echo "<footer>";
		$this->loader_js('js');
		echo "</footer>";
	}
}