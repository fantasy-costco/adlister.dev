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
			// Must first figure out where the directory path should be for when uploading files. All uploaded images should be placed in /img directory.
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
			if ($key == 'item_id'){
				continue;
			}
			if ($first_value){
				$first_value = false;
				$query .= $key . ' = :' . $key;
			} else {
				$query .= ', ' . $key . ' = :' . $key;
			}
		}

		$query .= ' WHERE item_id = :item_id';
		$stmt = self::$dbc->prepare($query);

		foreach ($this->attributes as $key => $value)	{
			if ($key == 'item_price') {
				$stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
			}
			if ($key == 'image_path') {
				$value = $this->saveUploadedImage($value);
				$stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
			}
			$stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
		}
		$stmt->execute();
	}

	public function delete() {
		self::dbConnect();
		$query = "DELETE FROM " . "items" . " WHERE item_id = :item_id";
		$stmt = self::$dbc->prepare($query);
		$id = (int) $this->attributes['item_id'];
		$stmt->bindValue(":item_id", $id, PDO::PARAM_INT);
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
		foreach ($this->attributes as $attribute => $value) {
			$stmt->bindValue(":$attribute", $value, PDO::PARAM_STR);
		}
		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Item');
			return $stmt->fetch();
		}
	}

	public static function findItemByName($item_name) {
		self::dbConnect();
		$find = "SELECT * FROM items WHERE item_name = :item_name";
		$stmt = self::$dbc->prepare($find);
		foreach ($this->attributes as $attribute => $value) {
			$stmt->bindValue(":$attribute", $value, PDO::PARAM_STR);
		}
		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Item');
			return $stmt->fetch();
		}
	}

	public function update() {}
	public static function runQuery($query, $limit=false){
		self::dbConnect();
		if(empty($_GET)){
			return '';
		}
		$result=self::$dbc->prepare($query);
		if(Input::has('search') or stripos($query,':searchterm')!=false){
			$result->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
		}
		if(Input::has('category') or stripos($query,':category')!=false){
			$result->bindValue(':category',Input::get('category'),PDO::PARAM_STR);
		}
		if(Input::has('min') or stripos($query,':min')!=false){
			$result->bindValue(':min',Input::get('min'),PDO::PARAM_INT);
		}
		if(Input::has('max') or stripos($query,':max')!=false){
			$result->bindValue(':max',Input::get('min'),PDO::PARAM_INT);
		}
		if((Input::get('search')=='viewAll') and count($_GET)==1){
			$result=self::$dbc->query($query);
		}else{
			var_dump($result);
			$result->execute();
		}
		$allItems=$result->fetchAll(PDO::FETCH_ASSOC);
	return $allItems;
	}
	public function sidebarQuery(){

	}
	// protected static function findItemById();
	public static function generateQuery($limit=true){
		$query='SELECT * FROM items';
		if(Input::has('category')){
			$query.=' WHERE category=:category';
		}
		if(Input::has('search')){
			if(Input::get('search')!='viewAll'){
				if(stripos($query,'WHERE')==false){
				$query.=" WHERE ";
			}else{
				$query.=" AND ";
			}
			$query.='(item_name LIKE :searchterm OR keywords LIKE :searchterm OR item_description LIKE :searchterm)';
			}
		}
		if(Input::has('min')){
			if(stripos($query,'WHERE')==false){
				$query.=" WHERE ";
			}else{
				$query.=" AND ";
			}
			$query.='(item_price >= :min)';
		}
		if(Input::has('max')){
			if(stripos($query,'WHERE')==false){
				$query.=" WHERE ";
			}else{
				$query.=" AND ";
			}
			$query.='(item_price <= :max)';
		}
		$query.=' ORDER BY item_name ';
		if($limit){
			$query.=' LIMIT 5 OFFSET ' . self::getOffset(5) * 5;
		}
		return $query;
	}
	//Fit to code
	public static function getOffset($limit){
		$offset=intval(Input::get('page'));
		$pageCount=self::pageCount(5);
		if($offset<0){
			$offset=0;
		}elseif($offset>=self::pageCount(5)){
			$offset=self::pageCount(5)-2;
		}
		return $offset;
	}
	public static function pageCount($limit){
		$allItems=self::all();
		$count=count($allItems)/$limit;
		if($count%$limit!=0){
			return $count+1;
		}
			return $count;
	}
	public static function generateURL(){
		$url='';
		if(Input::has('search')){
			$url.='?search=' . Input::get('search');
		}
		if(Input::has('category')){
			if(strlen($url)>0){
				$url.='&';
			}
			$url.='category=' . Input::get('category');
		}
		return $url;
	}
	public static function populateSidebar(){
	self::dbConnect();
	$sidebar='';
	if(Input::has('search')){
		if(Input::get('search')=='viewAll'){
			$query=('SELECT category, count(*) as count FROM items GROUP BY category');
			$search=self::$dbc->query($query);
		}else{
			$query='SELECT category, count(category) as count  FROM items GROUP BY category LIMIT 5 OFFSET ' .  Item::getOffset(5)*5;
			$search=self::$dbc->prepare($query);
			$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
			$search->execute();
			$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
		}
	}elseif(Input::has('category')){
		$query='SELECT category, count(category) as count  FROM items WHERE category=:category GROUP BY category';
			$search=self::$dbc->prepare($query);
			$search->bindValue(':category',Input::get('category'),PDO::PARAM_STR);
			$search->execute();
	}
	//$searchResults=Item::runQuery($query);
	$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
	$sidebar="<a href='http://adlister.dev?search=viewAll'>View All</a>\nFilter by Category:\n<ul>";
		foreach($searchResults as $key=>$value){
			$sidebar.='<li><a href=/?search=' . Input::get('search') . '&category=' . $value['category'] .'>' .$value['category'] . '('. $value['count'] .')</a></li>';
		}
		$sidebar.='</ul>';
		if(Input::get('search')=='viewAll'){
			$query='SELECT (
			SELECT count(*) FROM items
			WHERE item_price <= 100)as less_than_100,
			(
			SELECT count(*) FROM items WHERE item_price > 100 AND item_price <=500) as 100_500,
			(
			SELECT count(*) FROM items WHERE (item_price>500 AND item_price <=1000)) as 500_1000,(
			SELECT count(*) FROM items WHERE item_price>1000) as 1000_';
			$searchResults=self::$dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$query='SELECT (
			SELECT count(*) FROM items
			WHERE (item_price <= 100) AND (item_name LIKE :searchterm OR keywords LIKE :searchterm))as less_than_100,
			(
			SELECT count(*) FROM items WHERE (item_price > 100 AND item_price <=500)
			AND (item_name LIKE :searchterm OR keywords LIKE :searchterm)) as 100_500,
			(
			SELECT count(*) FROM items WHERE (item_price>500 AND item_price <=1000) AND (item_name LIKE :searchterm OR keywords LIKE :searchterm)
			) as 500_1000,(
			SELECT count(*) FROM items WHERE item_price>1000 AND (item_name LIKE :searchterm OR keywords LIKE :searchterm)
			)as 1000_';
			$search=self::$dbc->prepare($query);
			$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
			$search->execute();
			$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
		}
		$sidebar.='Filter By Price<ul>
		<li><a href="' . Item::generateURl() .'max=100">0-100GP (' . $searchResults[0]['less_than_100'] .')</li></a>
		<li><a href="' . Item::generateURl() .'&min=100&max=500">100-500GP (' . $searchResults[0]['100_500'] . ')</a></li>
		<li><a href="' . Item::generateURl() . '&min=500&max=1000">500-1000GP (' . $searchResults[0]['500_1000'] . ')</li></a>
		<li><a href="' . Item::generateURl() . '&min=1000">1000GP+ (' . $searchResults[0]['1000_'] . ')</li></a>
		</ul>';
	return $sidebar;
}
public static function generateTable(){
	$allItems=self::runQuery(self::generateQuery());
	$body='<table>
	<th>Picture</th>
	<th>Item Name</th>
	<th>Price</th>
	<th>Short Description</th>';
	foreach($allItems as $key=>$value){
		$body.='<tr>
			<td><a href="/?item=' . $value['item_id'] . '"><img class="productThumb" src="' . $value['img_path'] .'"></a></td>
			<td><a href="/?item=' . $value['item_id'] . '">' . $value['item_name'] .'</a></td>
			<td>' . $value['item_price'] . '</td>
			<td>' . $value['short_description'] . '</td>
			<td>' . $value['keywords'] . '</td>
		</tr>';
	}
	$body.='</table>';
	return $body;
}

}
