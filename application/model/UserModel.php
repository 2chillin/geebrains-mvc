<?php

namespace application\model;

use application\service\FrontController;
use application\service\Service;
use application\model\BaseModel;

class UserModel extends BaseModel {

	public function getUserByNameAndPassword( $login, $password ) {
		$statement = self::$connection->prepare( "SELECT * FROM user WHERE login=:login AND password=:password" );
		$statement->bindValue( ':login', $login, \PDO::PARAM_STR );
		$statement->bindValue( ':password', md5( $password ), \PDO::PARAM_STR );
		$statement->execute();

		return $statement->fetchAll( \PDO::FETCH_ASSOC );
	}

	public function getUserById( $id ) {
		$statement = self::$connection->prepare( "SELECT * FROM user WHERE id=:id" );
		$statement->bindValue( ':id', $id, \PDO::PARAM_INT );
		$statement->execute();

		return $statement->fetchAll( \PDO::FETCH_ASSOC );
	}

	public function getIdByUser( $login ) {
		$statement = self::$connection->prepare( "SELECT id FROM user WHERE login=:login" );
		$statement->bindValue( ':login', $login, \PDO::PARAM_STR );
		$statement->execute();

		return $statement->fetchAll( \PDO::FETCH_ASSOC );
	}
}