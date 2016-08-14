<?php
require_once __DIR__ . '/../../database/seeds/items_seeder.php';
require_once __DIR__ . '/../../utils/Input.php';
if(!Input::has('item') && count($_GET)>0){
	echo '<div style="width:100px">';
	echo populateSidebar($dbc);
	echo '</div>';
	echo "<div class='container'>" . generateTable($dbc) ."</div>";
	echo generatePageLinks(runQuery($dbc,false));
}
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
function runQuery($dbc,$limit=true){
	if(empty($_GET)){
		return '';
	}
	if($limit==false){
		$query=generateQuery($dbc,$limit);
	}else{
		$query=generateQuery($dbc);
	}
	$result=$dbc->prepare($query);
	if(Input::has('search')){
		$result->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
	}
	if(Input::has('category')){
		$result->bindValue(':category',Input::get('category'),PDO::PARAM_STR);
	}
	if(Input::has('min')){
		$result->bindValue(':min',Input::get('min'),PDO::PARAM_INT);
	}
	if(Input::has('max')){
		$result->bindValue(':max',Input::get('min'),PDO::PARAM_INT);
	}
	if((Input::get('search')=='viewAll') and count($_GET)==1){
		$result=$dbc->query($query);
	}else{
		$result->execute();
	}
	$allItems=$result->fetchAll(PDO::FETCH_ASSOC);
	return $allItems;
}
function generateTable($dbc){
	$allItems=runQuery($dbc);
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
//Fix for when only has category
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
		$sidebar.='Filter By Price<ul>
		<li><a href="' . generateURl() .'max=100">0-100GP (' . $searchResults[0]['less_than_100'] .')</li></a>
		<li><a href="' . generateURl() .'&min=100&max=500">100-500GP (' . $searchResults[0]['100_500'] . ')</a></li>
		<li><a href="' . generateURl() . '&min=500&max=1000">500-1000GP (' . $searchResults[0]['500_1000'] . ')</li></a>
		<li><a href="' . generateURl() . '&min=1000">1000GP+ (' . $searchResults[0]['1000_'] . ')</li></a>
		</ul>';
	}
	return $sidebar;
}
function generateQuery($dbc,$limit=true){
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
		$query.=' LIMIT 5 OFFSET ' .getOffset($dbc,5) * 5;
	}
	return $query;
}
function generateURL(){
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
function generatePageLinks($itemArray){
	$pageLinkHTML='';
	$totalItems=count($itemArray);
	if($totalItems%5==0){
		$pages=$totalItems/5;
	}else{
		$pages=($totalItems/5)+1;
	}
	for($i=1;$i<$pages;$i++){
		$pageLinkHTML.='<a href="' . generateURl() . '">' . $i . '</a>';
	}
	return $pageLinkHTML;
}