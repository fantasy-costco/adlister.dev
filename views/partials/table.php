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
	$body='';
	if(Input::has('search')){
		if(Input::get('search')!='viewAll'){
			$body=searchResults($dbc);
		}else{
			$body=viewAll($dbc);
		}
	}else if(Input::has('category')){
		$body=viewByCategory($dbc);
	}
	return $body;
}
function viewAll($dbc){
	if(Input::has('category')){
		$query=("SELECT * FROM items WHERE category=:category ORDER BY item_name LIMIT 5 OFFSET " .getOffset($dbc,5) * 5);
		$result=$dbc->prepare($query);
		$result->bindValue(':category',Input::get('category'),PDO::PARAM_STR);
		$result->execute();
		$allItems=$result->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$allItems=$dbc->query("SELECT * FROM items ORDER BY item_name LIMIT 5 OFFSET " .getOffset($dbc,5) * 5)->fetchAll(PDO::FETCH_ASSOC);
	}
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
			<td>' . $value['keywords'] . '</td>
		</tr>';
	}
	$body.='</table>';
	return $body;
}
function searchResults($dbc){
	//Search results if not filtered by category
	if(!Input::has('category')){
		$search=$dbc->prepare('SELECT * FROM items WHERE item_name LIKE :searchterm OR keywords LIKE :searchterm ORDER BY item_name LIMIT 5 OFFSET ' .  getOffset($dbc,5)*5);
		$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
		$search->execute();
	}
	//Searchc resuls if filtered by category
	else{
		$search=$dbc->prepare('SELECT * FROM items WHERE (item_name LIKE :searchterm OR keywords LIKE :searchterm) AND category=:category ORDER BY item_name LIMIT 5 OFFSET ' .  getOffset($dbc,5)*5);
		$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
		$search->bindValue(':category',Input::get('category',PDO::PARAM_STR));
		$search->execute();
	}
	$body='<div>';
	$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
	if(count($searchResults)<1){
		$body.='No search results found';
	}else{
		$body.='<table>
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
				<td>' . $value['keywords'] . '</td>
			</tr>';
		}
		$body.='</table>';
	}
	return $body . '</div>';
}
function populateSidebar($dbc){
	$sidebar='';
	if(Input::has('search')){
		if(Input::get('search')=='viewAll'){
			$searchResults=$dbc->query('SELECT category, count(*) as count FROM items GROUP BY category')->fetchAll(PDO::PARAM_STR);
		}else{
			$search=$dbc->prepare('SELECT category, count(category) as count  FROM items WHERE item_name LIKE :searchterm OR keywords LIKE :searchterm GROUP BY category LIMIT 5 OFFSET ' .  getOffset($dbc,5)*5);
			$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
			$search->execute();
			$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
		}
			$sidebar="<div><a href='http://adlister.dev?search=viewAll'>View All</a>\nCategories:\n<ul>";
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
			$searchResults=$dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);
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
			$search=$dbc->prepare($query);
			$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
			$search->execute();
			$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
		}
		$sidebar.='By Price<ul>
		<li>0-100 (' . $searchResults[0]['less_than_100'] .')</li>
		<li>1000-500 (' . $searchResults[0]['100_500'] . ')</li>
		<li>5000-1000 (' . $searchResults[0]['500_1000'] . ')</li>
		<li>1000+ (' . $searchResults[0]['1000_'] . ')</li>
		</ul></div>';
	}
	return $sidebar;
}
function viewByCategory($dbc){
	$query="SELECT * FROM items WHERE category=:category ORDER BY item_name LIMIT 5 OFFSET " .getOffset($dbc,5) * 5;
	$filterByCategory=$dbc->prepare($query);
	$filterByCategory->bindValue(':category',Input::get('category'));
	$filterByCategory->execute();
	$categoryArray=$filterByCategory->fetchAll(PDO::FETCH_ASSOC);
	$body='<table>
	<th>Picture</th>
	<th>Item Name</th>
	<th>Price</th>
	<th>Short Description</th>';
	foreach($categoryArray as $key=>$value){
		$body.='<tr>
			<td><img src="' . $value['img_path'] .'"></td>
			<td>' . $value['item_name'] .'</td>
			<td>' . $value['item_price'] . '</td>
			<td>' . $value['short_description'] . '</td>
			<td>' . $value['keywords'] . '</td>
		</tr>';
	}
	$body.='</table>';
	return $body;
}