<?php
require_once __DIR__ . '/../../database/seeds/items_seeder.php';
require_once __DIR__ . '/../../utils/Input.php';
function getOffset($dbc,$limit){
	$offset=intval(Input::get('page'));
	$pageCount=pageCount($dbc,5);
	if($offset<0){
		$offset=0;
	}elseif($offset>=pageCount($dbc,5)){
		$offset=pageCount($dbc,5)-2;
	}
	return $offset;
}
function pageCount($dbc,$limit){
	$allItems=$dbc->query("SELECT * FROM items")->fetchAll(PDO::FETCH_ASSOC);
	$count=count($allItems)/$limit;
	if($count%$limit!=0){
		return $count+1;
	}
		return $count;
}
function generateBodyHTML($dbc){
	if(Input::has('search')){
		$body=searchResults($dbc);
	}else{
		$body=viewAll($dbc);
	}
	return $body;
}
function viewAll($dbc){
	$allItems=$dbc->query("SELECT * FROM items LIMIT 5 OFFSET " .getOffset($dbc,5) * 5)->fetchAll(PDO::FETCH_ASSOC);
	$body='<table>
	<th>Picture</th>
	<th>Item Name</th>
	<th>Price</th>
	<th>Short Description</th>';
	foreach($allItems as $key=>$value){
		$body.='<tr>
			<td><img src="' . $value['img_path'] .'"></td>
			<td>' . $value['item_name'] .'</td>
			<td>' . $value['item_price'] . '</td>
			<td>' . $value['short_description'] . '</td>
		</tr>';
	}
	$body.='</table>';
	return $body;
}
function searchResults($dbc){
	$search=$dbc->prepare('SELECT * FROM items WHERE item_name LIKE :searchterm LIMIT 5 OFFSET ' .  getOffset($dbc,5)*5);
	$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
	$search->execute();
	//What if they don't find anything
	$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
		$body='<table>
	<th>Picture</th>
	<th>Item Name</th>
	<th>Price</th>
	<th>Short Description</th>';
	foreach($searchResults as $key=>$value){
		$body.='<tr>
			<td><img src="' . $value['img_path'] .'"></td>
			<td>' . $value['item_name'] .'</td>
			<td>' . $value['item_price'] . '</td>
			<td>' . $value['short_description'] . '</td>
		</tr>';
	}
	$body.='</table>';
	return $body;
}