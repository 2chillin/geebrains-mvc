<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class UserModel extends BaseModel {

	public function getAllUsers () {
		$statement = self::$connection->prepare("SELECT * FROM users");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getUserByLogin($login) {
		$statement = self::$connection->prepare("SELECT * FROM users WHERE user_login = :login");
		$statement->bindValue(':login', $login, \PDO::PARAM_STR);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function login ($login, $pass) {

		$users = $this->getAllUsers();

		foreach ($users as $user) {
			if($login == $user['user_login'] && md5($pass) == $user['user_password']){
				session_start();
				$_SESSION['login'] = $login;
				$_SESSION['pass'] = $pass;
				$message = "Успешная авторизация!";
				break;
			} else {
				$message = "Неправильный логин или пароль!";
			}
		}
		return $message;
	}

	public function logout () {
		session_start();
		unset($_SESSION['login']);
		unset($_SESSION['pass']);
		session_destroy();
	}

	public function isAuth() {
		session_start();
		if ( isset($_SESSION['login']) && isset($_SESSION['pass'])  ) {
			return $_SESSION['login'];
		} else {
			return false;
		}
	}
}

?>