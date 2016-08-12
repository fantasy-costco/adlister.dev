<?php

require_once __DIR__ . '/Model.php';

class User extends Model {

	protected function insert() {
		$insert = "INSERT INTO users (first_name, last_name, current_balance, email, username, password, admin) VALUES (:first_name, :last_name, :current_balance, :email, :username, :password, :admin)";
		$stmt = self::$dbc->prepare($insert);
		foreach ($this->attributes as $attribute => $value) {
			if ($attribute == "current_balance") {
				$stmt->bindValue(':current_balance', 2000, PDO::PARAM_INT);
			} elseif ($attribute == "admin") {
				$stmt->bindValue(':admin', 0, PDO::PARAM_INT);
			} else {
				$stmt->bindValue(':$attribute', $value, PDO::PARAM_STR);
			}
			$stmt->execute();
		}
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

		if (bindValuesAndExecuteQuery($stmt)) {
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
			return $stmt->fetch();
		}
	}

	protected static function saveUser($key) {
		if(array_key_exists($key, $this->attributes)) {
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
			$stmt->bindValue(':$attribute', $value, PDO::PARAM_STR);
		}
		$stmt->execute();
	}
}