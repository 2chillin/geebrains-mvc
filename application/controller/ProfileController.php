<?php

namespace application\controller;

use \application\service\Service;
use \application\service\Request;
use \application\service\FrontController;
use \application\model\UserModel;

class ProfileController extends FrontController {

	public function action_index() {
		$user = new UserModel;
		$this->view->render( "profile/index", [
			"title" => "Личный кабиент",
			"auth" => $user->isAuth()
		]);
	}

	public function action_login() {
		$login = Request::$postData['login'];
		$pass =  Request::$postData['pass'];
		$user = new UserModel;
		$message = $user->login($login, $pass);
		$this->view->render("profile/index", [
			"title"	=> "Личный кабиент",
			"auth" => $user->isAuth(),
			"message" => $message
		]);
	}

	public function action_logout() {
			$user = new UserModel;
			$user->logout();
			$this->view->render("profile/index", [
			"title"	=> "Личный кабиент",
			"auth" => $user->isAuth()
		]);
	}
}