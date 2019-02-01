<?php

namespace application\controller;

use application\model\UserModel;
use application\service\FrontController;
use application\model\OrdersModel;


class OrdersController extends FrontController {

	public function before() {
		if (!$this->session->get("user")) {
			$this->request->redirect("./?path=user/index");
		}

		return true;
	}

	public function action_index() {

		$OrdersModel = new OrdersModel();
		$user = new UserModel();
		$user_id = $user->getIdByUser($this->session->get('user'));
		$orders = $OrdersModel->getAllOrders($user_id);

		$this->view->render("orders/index", [
			"orders" => $orders,
			"title" => 'Ваши заказы'
		]);
	}

	public function action_statusChange() {
		$id = $this->request->getPost('id');
		$status = $this->request->getPost('status');
		$OrdersModel = new OrdersModel();
		$OrdersModel->statusChange($id, $status);
	}
}