<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;
use \application\model\CustomerModel;

class UserController extends FrontController {

	public function before() {
		if (!$this->session->get("user")) {
			$this->request->redirect("/?path=auth/index");
		}

		return true;
	}

	public function action_index() {

		$user = $this->session->get("user");

		$userModel = new UserModel();
		$user = $userModel->getUserById($user["id"]);

		return $this->view->render("user/index", [
			"user" => $user
		]);
	}

	public function after() {
		//
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