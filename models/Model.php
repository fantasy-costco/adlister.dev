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

	// public function save() {
	// 	if ($_REQUEST["submit"] == "register") {
	// 		$this->saveUser();
	// 	}
	// }

	public function save() {
		if (!empty($this->attributes) && isset($this->attributes['id'])) {
			$this->update( $this->attributes['id'] );
		} else {
			$this->insert();
		}
	}

	protected function insert()
    {
        //After insert, add the id back to the attributes array so the object can properly reflect the id
        //Iterate through all the attributes to build the prepared query
        //Use prepared statements to ensure data security
        $columns = '';
        $value_placeholders = '';
        foreach ($this->attributes as $column => $value)
        {
            if ( $columns == '' && $value_placeholders == '')
            {
                $columns .= $column;
                $value_placeholders .= ':' . $column;
            }
            else
            {
                $columns .= ', ' . $column;
                $value_placeholders .= ', :' . $column;
            }
        }
        $query = "INSERT INTO " . static::$table . " ({$columns}) VALUES ({$value_placeholders})";
        $stmt = self::$dbc->prepare($query);
        foreach ($this->attributes as $column => $value) {
            $stmt->bindValue(':' . $column, $value, PDO::PARAM_STR);
        var_dump($stmt);
        }
        // $stmt->execute();
        $this->attributes['id'] = self::$dbc->lastInsertId();
    }

	protected function update($id) {
		$query = "UPDATE " . static::$table . " SET ";
		$first_value = true;

		foreach ($this->attributes as $key => $value) {
			if ($key == 'id'){
				continue;
			}
			if ($first_value) {
				$first_value = false;
				$query .= $key . ' = :' . $key;
			} else{
				$query .= ', ' . $key . ' = :' . $key;
			}
		}
		$query .= ' WHERE id = :id';
		$stmt = self::$dbc->prepare($query);

		foreach ($this->attributes as $key => $value) {
			$stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
		}
		$stmt->execute();
	}

	public function delete() {
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
}