<?php

require_once __DIR__ . '/Model.php';

class Item extends Model {

	public static function all() {
		self::dbConnect();
		$select = "SELECT * FROM items";
		$stmt = self::$dbc->query($select);
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Item');
		$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $items;
	}

	public static function saveUploadedImage($input_name) {
		if(isset($_FILES[$input_name])){

		  $UploadName = $_FILES[$input_name]['name'];
		  $UploadTmp = $_FILES[$input_name]['tmp_name'];
		  $UploadType = $_FILES[$input_name]['type'];
		  $FileSize = $_FILES[$input_name]['size'];

		  $UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);

			if(!checkFileType($UploadName)){
				die('Error - File must be .jpeg or .png')
			}

		  if(($FileSize > 50000)){
		    die('Error - File too big.');
		  }

		  if(!$UploadTmp) {
		    die("No File Selected. Please upload a file.");
		  } else {

		    //Must first figure out where the directory path should be for
		    //when uploading files. All uploaded images should be placed in
		    //  /img directory.
				$image_url = self::convert($UploadName);
		    move_uploaded_file($UploadTmp, "$image_url");
				return $image_url;
		  }

		}
	}

	public static function convert($UploadName) {
		$Uploadname = "/img" . "/{$UploadName}";
		return $UploadName;
	}

	public function save() {
			if (!empty($this->attributes) && isset($this->attributes['item_id'])) {
					$this->update($item_id);
			} else {
				$query = self::insert();
				$stmt = self::$dbc->prepare($query);

				foreach ($this->attributes as $column => $value) {
					if($column == 'item_price') {
						$stmt->bindValue(':' . $column, $value, PDO::PARAM_INT);
					}
					if($column == 'image_path') {
						$value = saveUploadedImage($value);
						$stmt->bindValue(':' . $column, $value, PDO::PARAM_STR);
					}
					$stmt->bindValue(':' . $column, $value, PDO::PARAM_STR);
				}
			}
			$stmt->execute();
			$this->attributes['item_id'] = self::$dbc->lastInsertId();
	 }

	 protected function update($item_id) {
 		$query = "UPDATE " . static::$table . " SET ";
 		$first_value = true;

 		foreach ($this->attributes as $key => $value) {
			if ( $key == 'item_id'){
 				continue;
 			}

 			if ( $first_value ){
 				$first_value = false;
 				$query .= $key . ' = :' . $key;
 			} else {
				$query .= ', ' . $key . ' = :' . $key;
 			}
 		}

 		$query .= ' WHERE item_id = :item_id';
 		$stmt = self::$dbc->prepare($query);

 		foreach ($this->attributes as $key => $value)	{
			if($key == 'item_price') {
				$stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
			}
			if($key == 'image_path') {
				$value = saveUploadedImage($value);
				$stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
			}
			$stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
 		}

 		$stmt->execute();
 	}

	public function delete() {
		$query = 'DELETE FROM ' . static::$table . ' WHERE item_id = :item_id';
		$stmt = self::$dbc->prepare($query);
		$stmt->bindValue(':item_id', $this->attributes['item_id'], PDO::PARAM_INT);
		$stmt->execute();
	}

	public static function checkFileType($Uploadname) {
		$file_parts = pathinfo($Uploadname);

		switch($file_parts['extension']) {
		    case "jpeg":
					return true;
			    break;

		    case "png":
					return true;
					break;

		    default:
					return false;
		}
	}

	public static function find($item_id) {
	        self::dbConnect();
	        $find = "SELECT * FROM items WHERE item_id = :item_id";
	        $stmt = self::$dbc->prepare($find);
	        $stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);

	        if (bindValuesAndExecuteQuery($stmt)) {
	            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Item');
	            return $stmt->fetch();
	        }
	}

	public function insert(){
		protected function insert() {
			$columns = '';
			$value_placeholders = '';

			foreach ($this->attributes as $column => $value) {
				if ($columns == '' && $value_placeholders == '') {
					$columns .= $column;
					$value_placeholders .= ':' . $column;
				} else {
					$columns .= ', ' . $column;
					$value_placeholders .= ', :' . $column;
				}
			}

			$query = "INSERT INTO " . static::$table . " ({$columns}) VALUES ({$value_placeholders})";
	    return $query;
		}
	}

	protected static function findItemById()
}
