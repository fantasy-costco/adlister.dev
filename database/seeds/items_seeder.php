<?php
require_once __DIR__ . '/../migrations/items_migration.php';
$items=[1 => ['name' =>'Stones of Far Speech','price' => 50,'description' => 'Plain looking stones that allow walkie-talkie-like communication with other stones of far speech. Basically like walkie talkies, but magic','img_path' => '/img/1.png','keywords' =>'communication,magic walkie talkie,any class','category'=>'Misc'],
  2 =>['name' =>'Phantom Fist','price' => 400,'description' =>'A glove made of spider silk. Makes your unarmed attacks a little bit stronger.Allows you to knock enemies back with unarmed blows','img_path'=>'/img/2.png','keywords' =>'combat, weapon, equipment,hand slot,unarmed,strength,any class','category'=>'Equipment'],
  3 =>['name' => 'Xtreme Teen Bible','price' => 75,'description' =>'A +1 holy symbol whose cover features a rad skateboarder. Can more easily spread the good word to teens.','img_path' =>'/img/3.png',
      'keywords' =>'cleric,paladin,holy,holy symbol,equipment,','category'=>'Equipment'],
  4 =>['name' =>'Ring of Pointing','price' => 25,'description' =>'Copper ring with an inlaid ruby that can shoot a laser out. Can be used as a distraction or highlight salient information during a buisiness meeting','img_path' =>'/img/4.png','keywords' => ',ring,hand slot,equipment,laser pointer,ruby,any class','category'=>'Equipment'],
  5 => ['name' =>'Unlimited Pasta Pass','price' =>100,'description' =>'Can be used at any participating fantasy Olive Garden for free unlimited pasta for the owner and free unlimited soft drinks for the guests',
      'img_path' => '/img/5.png','keywords' =>',food,any class,olive garden','category'=>'Misc'],
  6 => ['name' =>'Wand of Switcharoo','price' =>300,
      'description' =>'A wooden wand that poops glitter when used. When pointed at another creature that lies within 100ft, it will switch places with the target if willing. Must make a DC 17 Constitution Saving throw to stay in place. Can only be used once per day.','img_path' =>'/img/6.png',
      'keywords' => ',right,left,main,off,magic,combat,hand slot,equipment,wizard,want','category'=>'Weapon'],
  7 => ['name' =>'Scuttle Buddy','price' => 150,'description' => 'Mechanical beetle that you can use as a spy. It can talk to you, but it won’t have anything interesting to say beyond its primary functions. Can only be wound up four times before it breaks.',
      'img_path' => '/img/7.png','keywords' =>',communication,beetle,living,insect,spy,mechanical,animal,any class','category'=>'Misc'],
  8 => ['name' =>'Tankard of Potent Drink','price' => 100,
      'description' =>'A big tankard with pictures of spudz  on it. Makes alcoholic beverages more alcoholic. Drinking water from this tankard makes you instantly sober; if sober it can cure a hangover.','img_path' =>'/img/8.png','keywords' => ',food,consumable,container,drink,beverage,alcohol','category'=>'Misc'],
  9 => ['name' =>'Glasses of Lightning Comprehension','price' => 100, 'description' =>'A set of glasses with a whole bunch of lenses on them.Allows you to read and understand any language you know ten times as fast.',
      'img_path' => '/img/9.png','keywords' =>',magic,equipment,head slot,glasses,knowledge,intelligence,language','category'=>'Equipment'],
  10 => ['name' => "Lens of Straight Creepin’",'price' => 100,'description' =>'Glasses that make it look like your eyes are closed. Allows you to find footprints, tracks, or markings of anything that traveled through the air once per day.','img_path' =>'/img/10.png',
      'keywords' =>',magic,equipment,lens,accessory,off,hand,history,arcane','category'=>'Equipment'],
  11 =>['name' =>'Ring of Recall','price' => 700,'description' =>'Gold ring with a purple stone. Allows you to regain a spell slot for a failed spell casting',
      'img_path' => '/img/11.png','keywords' =>'equipment,magic,non-combat,wizard,hand slot,spell,slot,ring,jewelry,wizard,accessory,arcane','category'=>'Equipment'],
  12 => ['name' =>'Bag of Mystery','price' => 300,
      'description' => 'Small, patchwork leather bag about the size of a fantasy softball. There appears to be some kind of spherical object inside. What’s in the bag?','img_path' =>'/img/12.png','keywords' => 'magic,bag,mystery,not a fish,random,accessory,???','category'=>'Misc'],
  13 => ['name' => 'Pocket Spa','price' => 900,'description' =>'A bag that when opened magically becomes a small spa. Regain extra hit points whenever you take a short rest.','img_path' => '/img/13.png','keywords' => ',magic,relax,spa,bag,healing,spatial,restoration','category'=>'Misc'],
  14 => ['name' => 'Rusted Can of Cheerwine','price' => 400,
      'description' => 'Has seen some shit, but seems to be radiating with vital energies. Grants +5 max HP',
      'img_path' => '/img/14.png','keywords' =>'magic,food,consumable,healing,can,restoration,cheerwine','category'=>'Consumable'],
  15 => ['name' =>"Virtuoso’s Mask",'price' => 1100,'description' =>'Allows you to cast Disguse Self as a Cantrip instead of a 1st Level Spell.','img_path' => '/img/15.png','keywords' => 'disguise,spy,illusion,cantrip,magic,wizard,rogue,head slot','category'=>'Equipment'],
  16 => ['name' => 'Throwing Shield','price' => 1200,'description' => 'Confers the same AC bonus as a regular shield, and can be used as a thrown weapon. Can travel IN A STRAIGHT LINE up to 30 feet, and deals 1d8 + STR/Prof. Damage. IT DOESN’T COME BACK TO YOU AFTERWARDS. AND DON’T TRY TO RICOCHET THIS SHIT','img_path' => '/img/16.png','keywords' => 'combat,shield,hand slot,fighter,paladin,off,hand,captain america,armor,ranged','category'=>'Equipment'],
  17 => ['name' =>'Alchemist’s Ring','price' => 500,'description' => 'When the wearer of this ring imbibes a healing potion, they receive 1d6 additional healing.','img_path' => '/img/17.png','keywords' => 'magic,ring,hand slot,healing,restoration,augmentation,any class,','category'=>'Equipment'],
  18 => ['name' => 'Healing Potion','price' => 50,'description' => 'Heals the imbiber for 2d4+2 HP','img_path' => '/img/18.png','keywords' => 'non-magic,food,consumable,healing,restoration,any class','category'=>'Consumable'],
  19 => ['name' => 'Haunted Doll','price' => 100,'description' => 'A creepy doll with the soul of a cat lady inside.This doll is very creepy. If its owner ever fails a third death save, the doll will take the hit instead, and will die in place of its owner.','img_path' => '/img/19.png','keywords' => 'magic,combat,death save,creepy,haunted,doll,spooky,any class','category'=>'Misc'],
  20 => ['name' => 'SHIELD OF HEROIC MEMORIES','price' => 1200,'description' => "This perfectly round silver shield initially has a mirror finish. As a hero takes it into battle it remembers the enemies encountered, gaining a +1 to AC on any subsequent battle with creatures of that type. The events of the battle are intricately engraved onto the shield’s surface (which has a seemingly endless capacity for detail).\nThe bearer of the shield may also attempt to recount past battles (real or imagined) to the shield. Upon a DC 10 charisma check or DC 15 bluff check, the shield confers a +1 AC against the creatures described in the tall tales.\n3 failed attempts at recounting stories cause the shield to be cleared of all of its memories. The engravings disappear. It reverts to its mirror finish. All bonuses are lost.",'img_path' => '/img/20.png','keywords' =>'combat,shield,hand slot,fighter,armor,bluff,memories,paladin','category'=>'Equipment'],
  21 = >['name'=>'Anti-gravity Sphere','description'=>'A small fist-sized glass ball filled with a silvery smoke. When the sphere is destroyed, it disables the effect of gravity on everything in a 30ft radius.','price'=>500,'img_path'=>'/img/21.png','keywords'=>'magic,non-combat,consumable'],
  22 => ['name' =>'The Glutton’s Fork','price' => 750, 'description' => 'Once a day this fork will allow the user to eat any non-magical item they can fit in their mouth and gain 2d6 points of health. Just tap the fork on the item and it will turn edible.','img_path' => '/img/22.png','keywords' =>'magic,healing,restoration,fork,glutton,eating,food,any class','category'=>'Misc'],
  23 => ['name' => 'The Champion’s Belt','price' => 800,'description' => 'This ornate belt is given to someone who has bested all opponents in a test of strength.  Once per day the wearer may substitute their Strength score for their Wisdom or Charisma when making a stat check.','img_path' => '/img/23.png','keywords' => 'magic,waist item,chapion,belt,strength,wisdom,charisma,any class','category'=>'Equipment'],
  24 => ['name' => 'Phone a friend scrying bones','price' => 500,'description' => 'Once per day, can be used to ask a yes, no, or maybe question to the fates (DM). There are three bones carved into people with happy faces and sad faces. All happy faces means yes, all sad faces mean no, anything in between means maybe. The DM can respond or choose not to answer.','img_path' => '/img/24.png','keywords' =>'magic,communication,divination,friend,bones,any class','category'=>'Equipment'],
  25 => ['name' => 'The Nit Picker','price' => 900,'description' => "Resembles a miniature garden gnome that carries lock picking tools in his hands. When not in use, looks like a 4" . '"' . "tall statue.</p><p>Twice daily, can be placed in front of a locked object to unlock it (functions as the spell 'Knock'). At this point, the statue comes to life in order to pick the lock. After the lock is picked (or if he is unable to open it), reverts back to an inanimate statue.\nWhile picking the lock, the Nit Picker critiques any or all members of the party on their recent performance in the campaign. Nothing escapes the critical eye of the Nit Picker, no matter how small the perceived offense.",'img_path' => '/img/25.png','keywords' => 'magic,nit,picker,gnome,any class,spy,lockpick,mean,knock,living,spy','category'=>'Tool'],
  26 => ['name' => 'Plastic Sheriff Badge','price' =>500,'description' => 'Adds +3 to bluff checks when impersonating a person of authority.','img_path' => '/img/26.png','keywords' => 'magic,bluff,sheriff,any class,badge,spy,impersonating,performance','category'=>'Equipment'], 
  27 => ['name' => 'Flaming Poisoning Raging Sword of Doom',
      'price' => 60000,'description' =>'A sword with a gigantic blade, wreathed in flames and with a crooked, oozing scorpion’s stinger affixed to its point. Deals an extra 20 melee damage.','img_path' => '/img/27.png','keywords' => 'combat,hand slot,weapon,fighter,sword,flaming,poison,doom,fire,paladin','category'=>'Weapon'],
  28 => ['name' => 'No-Sodium Salt Shaker','price' => 400,'description' =>'A simple salt shaker, the contents of which have been bewitched to turn a bright shade of pink if sprinkled over food or drink that contains poison.','img_path' => '/img/28.png','keywords' => 'magic,non-combat,poison,poison detector,food,drink, salt, sharker,any class','category'=>'Misc'],
  29 => ['name' => 'The Immovable Rod','price' => 1100,'description' => 'This rod is a flat iron bar with a small button on one end. When the button is pushed (a move action), the rod does not move from where it is, even if staying in place defies gravity. Thus, the owner can lift or place the rod wherever he wishes, push the button, and let go. Several immovable rods can even make a ladder when used together (although only two are needed). An immovable rod can support up to 8,000 pounds before falling to the ground. If a creature pushes against an immovable rod, it must make a DC 30 Strength check to move the rod up to 10 feet in a single round.','img_path' => '/img/29.png','keywords' => 'magic,non-combat,accessory,any class,immoveable,rod,strength,ladder,climb,climbing,strength','category'=>'Tool'],
  30 => ['name' => 'Diadem of Fabulous Truthiness!','price' => 900,'description' => 'Once per long rest, you can channel your terminal fabulousity into this simple circlet and cast a free Zone of Truth, limited to a single target rather than a radius. Confound your enemies, emasculate your friends, and free up your cleric’s spell slots so he can do some actual healing.','img_path' =>'/img/30.png','keywords' =>'magic,non-combat,cleric,zone of truth,arcane,equipment,armor','category'=>'Equipment']];

$insert=$dbc->prepare("INSERT INTO items (item_name,item_price,img_path,short_description, item_description,keywords,category) VALUES (:name,:price,:img_path,:short_description, :description,:keywords,:category)");
foreach($items as $key=>$value){
		if(strlen($value['name'])>0){
			$insert->bindValue(':name',$value['name'],PDO::PARAM_STR);
			$insert->bindValue(':price',(int)$value['price'],PDO::PARAM_INT);
			$insert->bindValue(':img_path','/img' . '/' . $key . '.png',PDO::PARAM_STR);
			$insert->bindValue(':description',$value['description'],PDO::PARAM_STR);
			$insert->bindValue(':short_description',generateShortDescription($value['description']),PDO::PARAM_STR);
			$insert->bindValue(':keywords',$value['keywords'],PDO::PARAM_STR);
			$insert->bindValue(':category',$value['category'],PDO::PARAM_STR);
			$insert->execute();
		}
}
function generateShortDescription($description){
	if(strlen($description)>100){
		$shortDescription=substr($description,0,97) . '...';
	}else{
		$shortDescription=$description;
	}
	return $shortDescription;
}
