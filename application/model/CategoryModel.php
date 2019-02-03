<?php
namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class CategoryModel extends BaseModel {

	public function getAllCategories() {
		$statement = self::$connection->prepare("SELECT * FROM category");
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}

?>