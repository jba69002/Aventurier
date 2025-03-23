<?php
/*********************************************************************************
* nom : Game
* descriptif : Classe permettant de gérer l'enchaînement des déplacements
*              d'un personnage sur une carte.
* créée le 22/03/2025 par Jean-Baptiste AILLET
* modifications :
*********************************************************************************/
class Map
{
   //répertoire et nom du fichier
   private $str_fullname = "";
   //liste des positions sur la carte
   private $arr_positions = array();

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
   public function __construct($str_path, $str_filename) {
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
         throw new Exception("Le fichier carte $str_filename n\'existe pas.");
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
      $arr_lines = file($this->str_fullname);
      foreach ($arr_lines as $str_line) {
         $this->arr_positions[]=str_split($str_line);
      }
   }

	/*********************************************************************************
	* nom : getPosition
	* descriptif : Fonction appelée pour récupérer la valeur d'une position
	* paramètres :
	*	$int_x : position initiale du personnage
	*	$int_y : liste des déplacements
	* retour :
	*	valeur d'une position (espace et #)
	* créée le 22/03/2025 par Jean-Baptiste AILLET
	* modifications :
	*********************************************************************************/
   public function getPosition($int_x, $int_y) {
	   if (!is_int($int_x) || !is_int($int_y) || $int_x<0 || $int_y<0)
		   throw new Exception("Les coordonnées doivent être des entiers supérieures ou égales à 0.");
	   if ($int_y>array_key_last($this->arr_positions))
		   throw new Exception("L\'ordonnée $int_y est supérieure au nombre de lignes de la carte.");
       if ($int_x>array_key_last($this->arr_positions[$int_y]))
		   throw new Exception("L\'abcisse $int_x est supérieur au nombre d élément de la ligne $int_y.");
	   return $this->arr_positions[$int_y][$int_x];
   }
}
?>