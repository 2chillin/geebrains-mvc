<?php

namespace application\controller;

use \application\service\FrontController;
use \application\model\UserModel;


class UserController extends FrontController {

	public function action_index() {

		$this->session->get("user");
		$user = $this->session->get("user");
		return $this->view->render("user/index", [
			"user" => $user,
			"title" => "Личный кабинет"
		]);
	}

	public function after() {
		return true;
	}

	public function action_update() {

		$user = $this->session->get("user");

		$userModel = new UserModel();
		$user = $userModel->getUserById($user["id"]);

		return $this->view->render("user/index", [
			"user" => $user
		]);
	}
	
	public function action_orders() {

		$user = $this->session->get("user");

		$orderModel = new OrderModel();
		$orders = $orderModel->getUserOrders($user["id"]);

		return $this->view->render("user/orders", [
			"orders" => $orders
		]);
	}	

}