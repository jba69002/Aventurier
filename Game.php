<?php
/*********************************************************************************
* nom : Game
* descriptif : Classe permettant de gérer l'enchaînement des déplacements
*              d'un personnage sur une carte.
* créée le 22/03/2025 par Jean-Baptiste AILLET
* modifications :
*********************************************************************************/
require('..\Documents\test\Map.php');

class Game
{
	// Carte
	private ?Map $obj_map = null;
	// liste des valeurs autorisées pour les déplacements
	private $arr_authorizedValues = array('S','N','E','O');
	
	// constructeur
	public function __construct(Map $obj_map) {
		if (is_null($obj_map))
			throw new Exception("Pas de carte.");
		$this->obj_map = $obj_map;
	}

	/*********************************************************************************
	* nom : go
	* descriptif : Fonction appelée pour lancer le déroulement des déplacements
	* paramètres :
	*	$arr_initialPosition : position initiale du personnage
	*	$str_movements : liste des déplacements
	* retour :
	*	position abscisse et ordonnée dans un tableau
	* créée le 22/03/2025 par Jean-Baptiste AILLET
	* modifications :
	*********************************************************************************/
	public function go($arr_initialPosition, $str_movements)
	{
		//Test valisité position initiale
		if (!is_array($arr_initialPosition) || count($arr_initialPosition)<>2 || (!is_int($arr_initialPosition[0]) || !is_int($arr_initialPosition[1]) ||
				$arr_initialPosition[0]<0 || $arr_initialPosition[1]<0)) {
			throw new Exception("la position doit être un tableau de 2 éléments entiers supérieurs ou égale à 0.");
		}
		$int_x = $arr_initialPosition[0];
		$int_y = $arr_initialPosition[1];
		
		//Test validité valeurs des mouvements
	    $str_movements = strtoupper($str_movements);
		foreach(str_split($str_movements) as $str_movement) {
			if (!in_array($str_movement, $this->arr_authorizedValues)) {
				throw new Exception("Caractère $str_movement non autorisé.");
			}
		}
		
		//Déroulement des mouvements
		foreach(str_split($str_movements) as $str_movement) {
			switch ($str_movement) {
				case 'S':
					$int_y++;
					break;
				case 'N':
					$int_y--;
					break;
				case 'E':
					$int_x++;
					break;
				case 'O':
					$int_x--;
					break;
			}
			try {
				$str_value = $this->obj_map->getPosition($int_x, $int_y);
			} catch (Exception $e) {
				throw new Exception("Le personnage ne peut pas aller au-delà des bords de la carte.\n".$e->getMessage()."\n");
			}
			if ($str_value == "#") {
				throw new Exception("Le personnage ne peut pas aller sur les cases occupées par les bois impénétrables (x=$int_x, y=$int_y).");
			}
		}
		return array($int_x, $int_y);		
	}

}
?>