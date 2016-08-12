<?php

$_ENV = include __DIR__ . '/../env.php';

abstract class Model {

	protected static $dbc;
	protected static $table;

	public $attributes = array();

	public function __construct($attributes = []) {
		self::dbConnect();
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
  		if ($_REQUEST["name"] == "user") {
  			$key = User::find($this->attributes["user_id"]);
  			User::saveUser($key);
  		}
  	}

	// public function delete() {};

	protected abstract function insert();
  	protected abstract function update();

  }