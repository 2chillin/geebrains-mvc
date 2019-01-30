<?php

namespace application\controller;

use \application\service\Service;
use \application\controller\BaseController;
use \application\model\UserModel;

/**
 * /?path=auth/{action}
 */
class AuthController extends BaseController {

	public function action_index() {
		return $this->view->render("auth/index", [
			"title"=>$this->config->get("title"),
			"version"=>$this->config->get("version")
		]);
	}	

	/**
	 * /?path=auth/login
	 */
	public function action_login() {

		if (!$this->request->isPost()) {
			return $this->view->render("error500");	
		}

		$login = $this->request->getPost("login");
		$password = $this->request->getPost("password");

		$userModel = new UserModel();
		$user = $userModel->getUserByNameAndPassword($login, $password);

		$authModel = new AuthModel();
		$authModel->createSession($user);
	}

	/**
	 * /?path=auth/logout
	 */
	public function action_logout() {
		$this->session->destroy();
		$this->request->redirect("/?path=home/index");
	}	
}