<?php
require('..\Documents\test\Game.php');
/*********************************************************************************
* nom : 
* descriptif : Programme de lancement des jeux de déplacement
* créée le 22/03/2025 par Jean-Baptiste AILLET
* modifications :
*********************************************************************************/

try {
	echo "Lancement jeu 1\n";
	$arr_initialPosition1 = array(3,0);
	$str_movements1 = "SSSSEEEEEENN";
	$obj_map1 = new Map("..\\Documents\\test","cartev2.txt");
	$obj_game1 = new Game($obj_map1);
	$arr_finalPosition1 = $obj_game1->go($arr_initialPosition1, $str_movements1);
	echo "Le personnage se trouve en ($arr_finalPosition1[0],$arr_finalPosition1[1])\n";
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
echo "\n\n";
try {
	echo "Lancement jeu 2\n";
	$arr_initialPosition2 = array(6,7);
	$str_movements2 = "OONOOOSSO";
	$obj_map2 = new Map("..\\Documents\\test","cartev2.txt");
	$obj_game2 = new Game($obj_map2);
	$arr_finalPosition2 = $obj_game2->go($arr_initialPosition2, $str_movements2);
	echo "Le personnage se trouve en ($arr_finalPosition2[0],$arr_finalPosition2[1])\n";
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

?>
