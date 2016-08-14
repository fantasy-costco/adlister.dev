<?php
require_once __DIR__ . '/../../database/seeds/items_seeder.php';
require_once __DIR__ . '/../../utils/Input.php';
require_once __DIR__ . '/table.php';

function populateSidebar($dbc){
	$search=$dbc->prepare('SELECT category FROM items WHERE item_name LIKE :searchterm OR keywords LIKE :searchterm GROUP BY category LIMIT 5 OFFSET ' .  getOffset($dbc,5)*5);
	$search->bindValue(':searchterm','%' . Input::get('search') . '%',PDO::PARAM_STR);
	$search->execute();
	//What if they don't find anything
	$searchResults=$search->fetchAll(PDO::FETCH_ASSOC);
		$sidebar='<ul>';
	foreach($searchResults as $key=>$value){
		$sidebar.='<li>' . $value['category'] . '</li>';
	}
	$sidebar.='</table>';
	return $sidebar;
}