<?php

// Create a User class that extends Model. Create insert, update, erase, find, and all methods to interact with the database and return results to the user. Use prepared statements and bind values to all variables for your queries.

// __DIR__ is a *magic constant* with the directory path containing this file. This allows us to correctly require_once Model.php, no matter where this file is being required from.

require_once __DIR__ . '/Model.php';

class User extends Model {

	protected function insert() {
		$insert = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
		$stmt = self::$dbc->prepare($insert);
		$this->bindValuesAndExecuteQuery($stmt);
		$this->attributes['id'] = self::$dbc->lastInsertId();
	}

	protected function update() {
		$update = "UPDATE users SET email = :email, username = :username, password = :password WHERE id = :id";
		$stmt = self::$dbc->prepare($update);
		$this->bindValuesAndExecuteQuery($stmt);
	}

	protected function erase() {
		$erase = "DELETE FROM users WHERE id = :id";
		$stmt = self::$dbc->prepare($erase);
		$stmt->bindValue(':id', $this->attributes['id'], PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function find($id) {
		self::dbConnect();
		$find = "SELECT * FROM users WHERE id = :id";
		$stmt = self::$dbc->prepare($find);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$didExecute = $stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');

		if ($didExecute) {
			$result = $stmt->fetch();
		}

		return $result;
	}

	public static function all() {
		self::dbConnect();
		$select = "SELECT * FROM users"
		$stmt = self::$dbc->query($select);
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
		$users = $stmt->fetchAll();

		return $users;
	}

	private function bindValuesAndExecuteQuery($stmt) {
		foreach ($this->attributes as $attribute => $value) {
			$stmt->bindValue(':$attribute', $value, PDO::PARAM_STR);
		}

		$stmt->execute();
	}
}