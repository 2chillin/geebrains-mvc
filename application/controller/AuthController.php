<?php

namespace application\controller;

use \application\service\FrontController;
use \application\service\Service;
use \application\model\AuthModel;
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
		$password = $this->request->getPost("pass");

		$userModel = new UserModel();
		$user = $userModel->getUserByNameAndPassword($login, $password);
		$this->session->set("user", $user[0]['login']);
		$this->request->redirect('./?path=user/index');
	}

	/**
	 * /?path=auth/logout
	 */
	public function action_logout() {
		$this->session->destroy();
		$this->request->redirect("./?path=home/index");
	}	
}