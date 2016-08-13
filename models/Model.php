<?php

$_ENV = include __DIR__ . '/../env.php';

abstract class Model {

	protected static $dbc;
	protected static $table;

	protected $attributes = [];

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
		}
	}

	protected abstract function insert();
	protected abstract function update();

}