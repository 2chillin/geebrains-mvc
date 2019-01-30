<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class UserModel extends BaseModel {

	public function getUserByNameAndPassword($login, $password) {
		$statement = self::$connection->prepare("SELECT * FROM user WHERE name = :login AND password=:password");
		$statement->bindValue(':name', $login, \PDO::PARAM_STRING);
		$statement->bindValue(':name', md5($password), \PDO::PARAM_STRING);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
	
}