<?php

require_once __DIR__ . '/Model.php';

class User extends Model {

	protected function insert() {
		$insert = "INSERT INTO users (first_name, last_name, current_balance, email, username, password, admin) VALUES (:first_name, :last_name, :current_balance, :email, :username, :password, :admin)";
		$stmt = self::$dbc->prepare($insert);
		// $stmt->bindValue(':first_name', $this->attributes['first_name'], PDO::PARAM_STR);
		// $stmt->bindValue(':last_name', $this->attributes['last_name'], PDO::PARAM_STR);
		// $stmt->bindValue(':current_balance', $this->attributes['current_balance'], PDO::PARAM_STR);
		// $stmt->bindValue(':email', $this->attributes['email'], PDO::PARAM_STR);
		// $stmt->bindValue(':username', $this->attributes['username'], PDO::PARAM_STR);
		// $stmt->bindValue(':password', $this->attributes['password'], PDO::PARAM_STR);
		// $stmt->bindValue(':admin', $this->attributes['admin'], PDO::PARAM_BOOL);
		$this->bindValuesAndExecuteQuery($stmt);
		$stmt->execute();
		
		// $this->bindValuesAndExecuteQuery($stmt);
		$this->attributes['user_id'] = self::$dbc->lastInsertId();
	}

	protected function update() {
		$update = "UPDATE users SET first_name = :first_name, last_name = :last_name, current_balance = :current_balance, email = :email, username = :username, password = :password, admin = :admin WHERE user_id = :user_id";
		$stmt = self::$dbc->prepare($update);
		$this->bindValuesAndExecuteQuery($stmt);
	}

	protected function delete() {
		$erase = "DELETE FROM users WHERE user_id = :user_id";
		$stmt = self::$dbc->prepare($erase);
		$stmt->bindValue(':user_id', $this->attributes['user_id'], PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function find($user_id) {
		self::dbConnect();
		$find = "SELECT * FROM users WHERE user_id = :user_id";
		$stmt = self::$dbc->prepare($find);
		$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

		if ($this->bindValuesAndExecuteQuery($stmt)) {
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
			return $stmt->fetch();
		}
	}

	protected function saveUser() {
		if(isset($this->attributes['user_id'])) {
			$this->update();
		} else {
			$this->insert();
		}
	}

	public static function findByUsernameOrEmail($username) {
		self::dbConnect();
		$findBy = "SELECT * FROM users WHERE username = :username";
		$stmt = self::$dbc->prepare($findBy);

		if (bindValuesAndExecuteQuery($stmt)) {
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
			return $stmt->fetch();
		}
	}

	private function bindValuesAndExecuteQuery($stmt) {
		foreach ($this->attributes as $attribute => $value) {
			if ($attribute == 'admin') {
				$stmt->bindValue(':$attribute', $value, PDO::PARAM_BOOL);	
			} else {
				$stmt->bindValue(':$attribute', $value, PDO::PARAM_STR);
			}
		}
		$stmt->execute();
	}
}