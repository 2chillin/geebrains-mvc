<?php

namespace application\controller;

use \application\service\FrontController;
use \application\model\CategoryModel;


class ProductController extends FrontController {

	public function action_index() {

		$categoryModel = new CategoryModel();
		$categories = $categoryModel->getAllCategories();

		$this->view->render("product/index", [
			"title" => "Каталог товаров",
			"categories" => $categories
		]);
	}

	/**
	 * /?path=product/category&id=1
	 */
	public function action_category() {

		$id = $this->request->get("id");
		$categoryModel = new CategoryModel();
		$categoryWithProducts = $categoryModel->getCategoryWithProducts($id);

		return $this->view->render("product/category", [
			"categoryWithProducts"=>$categoryWithProducts
		]);		
	}	

	/**
	 * /?path=product/show&id=1
	 */
	public function action_show() {

		$id = $this->request->get("id");

		$goodsModel = new GoodsModel();
		$product = $goodsModel->getById($id);

		return $this->view->render("product/show", [
			"product"=>$product
		]);		
	}

	/**
	 * /?path=product/add_to_basket&id=1
	 */
	public function action_add_to_basket() {

		$user = $this->session->get("user");
		$id = $this->request->get("id");

		$basketModel = new BasketModel();
		$result = $basketModel->create($user, $id);

		return $this->view->render("product/show", [
			"result"=>$result
		]);		
	}	
}