<?php
require_once __DIR__ . '/../migrations/items_migration.php';
function createInventory(){
	$inventory=array();
	$handle=fopen(__DIR__ . '/txt/Fantasy-Costco-Item-List.txt','r');
	$contents=fread($handle,filesize(__DIR__ . '/txt/Fantasy-Costco-Item-List.txt'));
	$contentsArray=explode("NAME:",trim($contents));
	$array=[];
	foreach($contentsArray as $key=>$value){
		$nameLength=stripos($value,"DESCRIPTION:");
		$name=trim(substr($value,0,$nameLength));
		$descriptionLength=stripos($value,"PRICE:");
		$description=trim(substr($value,$nameLength+12,$descriptionLength-($nameLength+12)));
		$priceLength=stripos($value,"GP");
		$price=trim(substr($value,$descriptionLength+6,$priceLength-($descriptionLength+6)));
		$imgLength=stripos($value,"IMG:");
		$keywordPos=stripos($value,"KEYWORDS:");
		$img=trim(substr($value,$imgLength+4,$keywordPos));
		$keywords=trim(substr($value,$keywordPos+9));
		$array[]=['name'=>$name,'price'=>$price,'description'=>$description,'imgpath'=>$img,'keywords'=>$keywords];
	}
	fclose($handle);
	return $array;
}
$insert=$dbc->prepare("INSERT INTO items (item_name,item_price,img_path,item_description,keywords) VALUES (:name,:price,:imgpath,:description,:keywords)");
$itemInventory = createInventory();
foreach($itemInventory as $key=>$value){
		if(strlen($value['name'])>0){
			$description=$value['description'];
			$insert->bindValue(':name',$value['name'],PDO::PARAM_STR);
			$insert->bindValue(':price',(int)$value['price'],PDO::PARAM_INT);
			$insert->bindValue(':imgpath','/img/' . $key . '.png',PDO::PARAM_STR);
			$insert->bindValue(':description',$value['description'],PDO::PARAM_STR);
			$insert->bindValue(':keywords',$value['keywords'],PDO::PARAM_STR);
			$insert->execute();
		}
}