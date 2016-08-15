<?php
//require_once __DIR__ . '/../../database/seeds/items_seeder.php';
require_once __DIR__ . '/../../utils/Input.php'; 
require_once __DIR__ . '/../../models/Item.php'; 
if(!Input::has('item') && count($_GET)>0){
$output=<<<'DOC'
	<div style="display:flex;position:relative;flex-direction:row;margin-bottom:200px">
    <div style="position:relative;display:flex;width:100%;height:auto;marigin:auto">
    	<div class="col-1"style="position:relative;height:400px;min-width:150px;max-width:150px;">
DOC;
$output.=Item::populateSidebar() . '
    	</div>
    	<div class="col-11" style="display:inline;position:relative;height:auto;">' .
    	Item::generateTable() .'<div><span style="text-align:center' .
    	generatePageLinks(Item::runQuery(Item::generateQuery())) .
    	'</span></div>
    </div></div></div>';
echo $output;
}
//Fix for when only has category
function generatePageLinks($itemArray){
	$totalItems=count($itemArray);
	if($totalItems%5==0){
		$pages=$totalItems/5;
	}else{
		$pages=($totalItems/5)+1;
	}
	$pageLinkHTML='<a href="' . Item::generateURL() . '&page=' .(Input::get('page')-1) .'"><</a>';
	for($i=1;$i<$pages;$i++){
		$pageLinkHTML.='<a href="' . Item::generateURl() . '&page=' . ($i-1) .'">' . $i . '</a>';
	}
	$pageLinkHTML.='<a href="' . Item::generateURL() . '&page=' .(Input::get('page')+1) .'">></a>';
	return $pageLinkHTML;
}
