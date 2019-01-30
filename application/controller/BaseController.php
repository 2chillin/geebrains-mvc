<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;

class BaseController extends FrontController {

	public function before() {
		$st = $_COOKIE["st"];

		$sessionModel = new SessionModel();

		$user = $sessionModel->getUserByToken($st);
		if (!$user){
			return false;
		}

		$this->session->set("user", $user);

		return true;
	}
}