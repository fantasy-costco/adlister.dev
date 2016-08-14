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

	public function saveUploadedImage() {
		if(isset($_FILES['img_path'])){
		  $UploadName = $_FILES['img_path']['name'];
		  $UploadTmp = $_FILES['img_path']['tmp_name'];
		  $UploadType = $_FILES['img_path']['type'];
		  $FileSize = $_FILES['img_path']['size'];

		  $UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);

			if(!$this->checkFileType($UploadName)){
				die('Error - File must be .jpeg or .png');
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
				$image_url = $this->convert($UploadName);
		    move_uploaded_file($UploadTmp, __DIR__ . '/../public/' . $image_url);
				return $image_url;
		  }

		}
	}

	protected function convert($UploadName) {
		$UploadName = "/img/" . $UploadName;
		return $UploadName;
	}

	protected function insert() {
		$new_img_url = $this->convert($this->attributes['img_path']);

		$insert = "INSERT INTO items (item_name, item_price, item_description, img_path, short_description, keywords, category) VALUES (:item_name, :item_price, :item_description, :img_path, :short_description, :keywords, :category)";
		$stmt = self::$dbc->prepare($insert);
		$stmt->bindValue(':item_name', $this->attributes['item_name'], PDO::PARAM_STR);
		$stmt->bindValue(':item_price', $this->attributes['item_price'], PDO::PARAM_INT);
		$stmt->bindValue(':item_description', $this->attributes['item_description'], PDO::PARAM_STR);
		$stmt->bindValue(':img_path', $new_img_url, PDO::PARAM_STR);
		$stmt->bindValue(':short_description', $this->attributes['short_description'], PDO::PARAM_INT);
		$stmt->bindValue(':keywords', $this->attributes['keywords'], PDO::PARAM_STR);
		$stmt->bindValue(':category', $this->attributes['category'], PDO::PARAM_STR);
		$stmt->execute();
		$this->attributes['id'] = self::$dbc->lastInsertId();
	}

	public function saveItem() {
			if (!empty($this->attributes) && isset($this->attributes['item_id'])) {
					self::updateItem($item_id);
			} else {
				$this->insert();
				$this->saveUploadedImage($this->attributes['img_path']);
			}
	 }

	 public function updateItem($item_id) {
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
				$value = $this->saveUploadedImage($value);
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

	public function checkFileType($Uploadname) {
		$file_parts = pathinfo($Uploadname);

		switch($file_parts['extension']) {
		    case "jpeg":
					return true;
			    break;

				case "jpg":
					return true;

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


		public function update(){

		}
	// protected static function findItemById();
}
