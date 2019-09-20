<?php
class body extends xlib {

	/**
	 * Главная страница
	 */
	function execute () {
		echo 'Привет мир';
	}

	/**
	 * Ошибка 403
	 */
	function layout_403 () {
		echo "403 Ошибка доступа";
	}

	/**
	 * Ошибка 404
	 */
	function layout_404 () {
		echo "404 страница не найдена";
	}
}