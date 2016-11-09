<?php
/**
 * Class Modele
 * Modèle de classe modèle. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
class Oeuvres extends TemplateBase {
	
    
	/*function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}*/
	
		
	/**
	 * @access public
	 * @return Array
	 */
	 
	public function getTable()
	{
		return "Oeuvres";
	}
	
	public function obtenirOeuvre($noInterne)
	{		
		try
		{	
			
			$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where noInterne = :noInterne");
			$stmt->bindParam(":noInterne", $noInterne);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function insererOeuvre($oeuvre)
	{		
		//traitement des donnes d'oeuvre (ojo...para evitar tanta conexion lo que se puede hacer meter los datos a los cuales no toca hacerle tratamiento en una consulta y despues los otros)
		
		// no se puede dato a dato con insert, porque se crea una celda con cada insert...toca insertar los datos que mas se puedan y despues mirar el tratamiento de los datos especiales
		//echo $oeuvre->Titre;
		//echo "<br>";
		//$insertion = $this->insererDonne("Titre",$oeuvre->Titre);//insertion de Titre
		
		//echo $oeuvre->TitreVariante;
		//echo "<br>";
		//$insertion = $this->insererDonne("TitreVariante",$oeuvre->TitreVariante);//insertion de TitreVariante
		
		//echo $oeuvre->TitreVariante;
		//echo "<br>";
		
		
		/*echo $oeuvre->TitreVariante;
		echo "<br>";
		$insertion = this->insererDonne("Titre",$oeuvre->Titre);//insertion de TitreVariante*/
		
		/*	Source: stackoverflow.com
			Url: http://stackoverflow.com/questions/16749778/php-date-format-date1365004652303-0500
			Auteur: Farkie
			Conversion de date en format UNIX to Y-m-d
		*/
		
		
		
		/*var_dump(date('Y-m-d H:i:s', '1365004652303'/1000));
		$str = '/Date(1365004652303-0500)/';
		
		$match = preg_match('/\/Date\((\d+)([-+])(\d+)\)\//', $str, $date);
		
		$timestamp = $date[1]/1000;
		$operator = $date[2];
		$hours = $date[3]*36; // Get the seconds
		
		$datetime = new DateTime();
		
		$datetime->setTimestamp($timestamp);
		$datetime->modify($operator . $hours . ' seconds');
		var_dump($datetime->format('Y-m-d H:i:s'));*/
		
		/*	Source: stackoverflow.com
			Url: http://stackoverflow.com/questions/16749778/php-date-format-date1365004652303-0500
			Auteur: hjpotter92
			Conversion de date en format UNIX to Y-m-d
		*/
		
		echo $oeuvre->DateFinProduction;
		
		$str = $oeuvre->DateFinProduction;
		preg_match( "#/Date\((\d{10})\d{3}(.*?)\)/#", $str, $match );
		//echo date( "r", $match[1] );
		echo $match[1];
		
		//echo $oeuvre->DateFinProduction;
		echo "<br>";
		
		echo "<br>";
		
		return 0;
		
		/*try
		{	
			
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (noInterne,nomArtiste,prenomArtiste,collectif) values(:noInterne, :nom, :prenom, :collectif)");
			$stmt->bindParam(":noInterne", $nointerne);
			$stmt->bindParam(":nom", $nom);
			$stmt->bindParam(":prenom", $prenom);
			$stmt->bindParam(":collectif", $collectif);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}*/
	}
	
	public function insererDonne($nomCologne,$donnee){
		
		try
		{	
			
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (".$nomCologne.") values(:donnee)");
			$stmt->bindParam(":donnee", $donnee);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
		
	}
	
	
	
	
}




?>