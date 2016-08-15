<?php

$_ENV = include __DIR__ . '/../env.php';

abstract class Model {

	protected static $dbc;
	protected static $table;

	public $attributes = [];

	public function __construct(array $attributes = array()) {
		self::dbConnect();
		$this->attributes = $attributes;
	}

	public function __get($key) {
		return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : null;
	}

	public function __set($name, $value) {
		$this->attributes[$name] = $value;
	}

	protected static function dbConnect() {
		if (!self::$dbc) {
			require_once __DIR__ . '/../database/db_connect.php';
			self::$dbc = $dbc;
		}
	}

	public function save() {
		if ($_REQUEST["submit"] == "register") {
			$this->saveUser();
		} elseif ($_REQUEST["submit"] == "add_new_item" or $_REQUEST["submit"] == "update"){
			$this->saveItem();
		}
	}

	protected function delete() {
        $query = 'DELETE FROM ' . static::$table . ' WHERE id = :id';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $this->attributes['id'], PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function find($id) {
		self::dbConnect();
		$find = "SELECT * FROM users WHERE id = :id";
		$stmt = self::$dbc->prepare($find);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);

		if ($this->bindValuesAndExecuteQuery($stmt)) {
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
			return $stmt->fetch();
		}
	}
	
	public static function getDB(){
		self::dbConnect();
		return self::$dbc;
	}
}
