<?php
define('DB_HOST','127.0.0.1');
define('DB_NAME','fantasy_costco_db');
define('DB_USER','fc_admin');
define('DB_PASS','sexyg@rfield');
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
		$img=trim(substr($value,$imgLength+4));
		$array[]=['name'=>$name,'price'=>$price,'description'=>$description,'imgpath'=>$img];
	}
	fclose($handle);
	return $array;
}
function connectToDB($echo=false){
	$dbc=NEW PDO('mysql:host=' . DB_HOST . ';dbname=' .DB_NAME,DB_USER,DB_PASS);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($echo==true){
	echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";
	}
	return $dbc;
}
$dbc=connectToDB();
$insert=$dbc->prepare("INSERT INTO items (item_name,item_price,img_path,description) VALUES (:name,:price,:imgpath,:description)");
$itemInventory = createInventory();
foreach($itemInventory as $key=>$value){
		if(strlen($value['name'])>0){
			$description=$value['description'];
			$insert->bindValue(':name',$value['name'],PDO::PARAM_STR);
			$insert->bindValue(':price',(int)$value['price'],PDO::PARAM_INT);
			$insert->bindValue(':imgpath',$value['imgpath'],PDO::PARAM_STR);
			$insert->bindValue(':description',$value['description'],PDO::PARAM_STR);
			$insert->execute();
		}
}