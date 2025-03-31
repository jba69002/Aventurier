<?php
/*********************************************************************************
* nom : Map
* descriptif : Classe permettant de gérer un déplacement
*              du personnage sur une carte.
* créé le 22/03/2025 par Jean-Baptiste AILLET
* modifié le 26/03/2025 par Jean-Baptiste AILLET : Typage
*********************************************************************************/
declare(strict_types=1);

class Map
{
	//répertoire et nom du fichier
	private string $str_fullname = "";
	//liste des positions sur la carte
	private array $arr_positions = array();
	// liste des valeurs autorisées pour les déplacements
	private const array AUTHORIZED_VALUES = array(' ','#');

	/*********************************************************************************
	* nom : constructeur
	* descriptif : Fonction appelée pour créer la carte
	* paramètres :
	*	$str_path: chemin d'accès au fichier
	*	$str_filename : nom du fichier
	* retour :
	* créée le 22/03/2025 par Jean-Baptiste AILLET
	* modifications :
	*********************************************************************************/
	public function __construct(string $str_path, string $str_filename) {
		$this->str_fullname = $str_path.'\\'.$str_filename;
		$this->test();
		$this->load();
	}

	/*********************************************************************************
	* nom : test
	* descriptif : Fonction appelée pour tester l'existence du fichier
	* paramètres :
	* retour :
	* créée le 22/03/2025 par Jean-Baptiste AILLET
	* modifications :
	*********************************************************************************/
	private function test() {
		// test de l'existence du fichier
		if (!file_exists($this->str_fullname))
			throw new Exception("Le fichier carte $str_filename n'existe pas.");
   }

	/*********************************************************************************
	* nom : load
	* descriptif : Fonction appelée pour charger la liste des positions à partir du fichier
	* paramètres :
	* retour :
	* créée le 22/03/2025 par Jean-Baptiste AILLET
	* modifications :
	*********************************************************************************/
	private function load() {
		// chargement du tableau des lignes de la carte
		$arr_lines = file($this->str_fullname, FILE_IGNORE_NEW_LINES);
		foreach ($arr_lines as $str_line) {
			$arr_line = str_split($str_line);
			if (!empty(array_diff(array_unique($arr_line),self::AUTHORIZED_VALUES)))
				throw new Exception("La carte ne peut contenir que des espaces et des caractères '#'.");
			$this->arr_positions[] = $arr_line;
		}
	}

	/*********************************************************************************
	* nom : getPosition
	* descriptif : Fonction appelée pour récupérer la valeur d'une position
	* paramètres :
	*	$int_x : abscisse
	*	$int_y : ordonnée
	* retour :
	*	valeur d'une position (espace et #)
	* créée le 22/03/2025 par Jean-Baptiste AILLET
	* modifications :
	*********************************************************************************/
	public function getPosition(int $int_x, int $int_y) {
		if (!is_int($int_x) || !is_int($int_y) || $int_x<0 || $int_y<0)
			throw new Exception("Les coordonnées doivent être des entiers supérieurs ou égaux à 0.");
		if ($int_y>array_key_last($this->arr_positions))
			throw new Exception("L'ordonnée $int_y est supérieure au nombre de lignes de la carte.");
		if ($int_x>array_key_last($this->arr_positions[$int_y]))
			throw new Exception("L'abcisse $int_x est supérieur au nombre d'éléments de la ligne $int_y.");
		return $this->arr_positions[$int_y][$int_x];
	}
}
?>