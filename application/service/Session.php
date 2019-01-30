<?php

namespace application\service;

class Session {

	public function __construct() {
		session_start();
	}

	public function get($key) {
		return $_SESSION[$key];
	}

	public function destroy() {
		session_destroy();
	}
}