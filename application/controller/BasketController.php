<?php

namespace application\controller;

use \application\service\Service;
use \application\controller\BaseController;
use \application\model\BasketModel;

/**
 * /?path=basket/{action}
 */
class BasketController extends BaseController {

	public function action_index() {

		$user = $this->session->get("user");
		$basketModel = new BasketModel();
		
		$items = $basketModel->getUserItems($user["id"]);

		return $this->view->render("basket/index", [
			"items"=>$items
		]);
	}	

	public function action_delete() {
		$id = $this->request->get("id");
		
		$basketModel = new BasketModel();
		$basketModel->deleteByBasketId($id);

		$this->request->redirect("/?path=basket/index");
	}

	public function action_increase_amount() {
		$amount = $this->session->get("amount");
		$id = $this->request->get("id");
		
		$basketModel = new BasketModel();
		$basketModel->updateAmount($id, $amount);

		$this->request->redirect("/?path=basket/index");
	}	

	public function action_order() {
		if (!$this->request->isPost()) {
			$this->request->redirect("/?path=basket/index");				
		}

		$user = $this->session->get("user");
		$goods = $this->request->get("goods");
		
		$orderModel = new OrderModel();
		$orderModel->create($user, $goods);

		$this->request->redirect("/?path=basket/index");
	}	
}