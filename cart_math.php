<?php
2000
$cartCount = $_SESSION['CART'].length;
$itemsInCart = $_SESSION['CART'];


$this->userBalance($dbc, $_SESSION);

public function userBalance() {
  $query = "SELECT current_balance FROM users WHERE user_id = :user_id";
  $stmt = self::$dbc->prepare($query);
  $stmt->bindValue(':user_id', $_SESSION['LOGGED_IN_ID'], PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $instance = null;
  if ($result) {
      $instance = new static($result);
  }
  return $instance;
}

public function cartTotal(){
  $query = "SELECT item_cost FROM items WHERE item_id IN";
  $first_value = true;

  foreach($itemsInCart as $item_id) {
    if ( $first_value ){
      $first_value = false;
      $query .= "(" . $item_id;
    } else {
      $query .= ', ' . $item_id . ' = :' . $item_id;
    }
    
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

}

?>
