<?php

class Input {

	public static function has($key) {
		return isset($_REQUEST[$key]);
	}

	public static function get($key, $default = null) {
		return static::has($key) ? $_REQUEST[$key] : $default;
	}

	public static function isPost(){
	 	return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	public static function getString($key, $min = 1, $max = 255) {
		$value = static::get(trim($key));
		$value = htmlspecialchars(strip_tags($value));

		if (!is_string($key) || !is_numeric($min) || !is_numeric($max)) {
			throw new InvalidArgumentException ("$key, min and max values must be numbers.");
		} elseif (!static::has($key)) {
			throw new OutOfRangeException ("Please enter a $key.");
		} elseif (!is_string(trim($value))) {
			throw new DomainException ("$key is the wrong type. It should be a string.");
		} elseif (mb_strlen($value) < $min || mb_strlen($value) > $max) {
			throw new LengthException ("$key is outside of the min-max range.");
		}
		return $value;
	}

	public static function getNumber($key, $min = 1, $max = 20, $default = 0) {
		$value = static::get($key);
		$value = htmlspecialchars(strip_tags($value));

		if (!is_numeric($key) || !is_numeric($min) || !is_numeric($max)) {
			throw new InvalidArgumentException ("$key, min and max values must be numbers.");
		} elseif (!static::has($key)) {
			throw new OutOfRangeException ("Please enter a $key.");
		} elseif (!is_numeric($value)) {
			throw new DomainException ("$key is the wrong type. It should be a number.");
		} elseif (mb_strlen($value) < $min || mb_strlen($value) > $max) {
			throw new RangeException ("$key is outside of the min-max range.");
		}
		return floatval($value);
	}

	public static function getDate($key) {
		$value = static::get($key);
		if (!strtotime($value)) {
			throw new Exception ("The value for $key should be a date.");
		} else {
			return new DateTime($value);
		}
	}

	private function __construct() {}
}