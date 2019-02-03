<?php

namespace application\model;

class OrdersModel extends BaseModel {

	public function getAllOrders( $id ) {
		$statement = self::$connection->prepare( "SELECT * FROM orders WHERE user_id=:id" );
		$statement->bindValue( ':id', $id, \PDO::PARAM_INT );
		$statement->execute();

		return $statement->fetchAll( \PDO::FETCH_ASSOC );
	}

	public function statusChange($id, $status) {
		$statement = self::$connection->prepare( "UPDATE orders SET status=:status WHERE id=:id" );
		$statement->bindValue( ':id', $id, \PDO::PARAM_INT );
		$statement->bindValue( ':status', $status, \PDO::PARAM_STR );
		$statement->execute();
	}
}

?>