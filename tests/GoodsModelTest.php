<?php
namespace tests;

use tests\BaseTest;
use application\model\GoodsModel;

final class GoodsModelTest extends BaseTest {

	public function testFileExists() {
		$this->assertFileExists('/application/model/GoodsModel.php');
	}

	public function testPrice () {
		$goodsModel = new GoodsModel();
		$prod = $goodsModel->getById(1);
		$this->assertIsInt($prod->price);
	}
}

