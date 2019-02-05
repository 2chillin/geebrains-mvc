<?php
namespace tests;

use tests\BaseTest;
use application\controller\ProductController;

final class ProductControllerTest extends BaseTest {

	public function testFileExists() {
		$this->assertFileExists('/application/controller/ProductController.php');
	}

	public function testPriceLabelExists () {
		$controller = new ProductController();

		$output   = $this->request( "GET", $controller, "action_show" );
		$expected = "<b>Price:</b>";

		$this->assertContains( $expected, $output );
	}
}