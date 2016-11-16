<?php
/**
 * Class Admin
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
class Admin extends TemplateBase{
	
    
	function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}
	
	/**
	 * @access public
	 * @return Array
	 */
	public function getDonnees() 
	{
		$aDonnees = array('');
		
		return $aDonnees;
	}
	/*
	
	private function autentificationAdmin()
	{
		$admins = $this->obtenirTous();
		$retour = false;
		foreach($admin in $admins)
		{
			if($admin['nomUsagerAdmin'] === $_GET['usagerAdmin'])
			{
				if($admin['motPasseAdmin'] === $_GET['passAdmin'])
				{
					$_SESSION["idAdmin"] = $admin['idAdmin'];
					$retour = true;
				}
				else
				{
					break;
				}
			}
		}
		return $retour;
		
	}
	*/
	
	public function deconnectionAdmin()
	{
		
	}
	public function test()
	{

	}
	
	public function verifFormAutentifiAdmin()
	{
		if($_GET['usagerAdmin'] != '' && $_GET['passAdmin'] != '')
		{
			$this->autentificationAdmin();
		}
		else
		{
			return false;
		}
	}
	
	private function getPrimaryKey()
	{
		return "idAdmin";
	}
	
	private function getTable()
	{
		return "Administrateurs";
	}


///// APPEL A LA BASE DE DONNEES ///////////////////////////////////

	public function verificationAutentificationAdmin()
	{
		if((isset($_POST["usager"]) && isset($_POST["pass"]))&& isset($_SESSION["grainDeSel"]))
		{
			$motDePasseMD5 = $this->ObtenirMotDePasseAdmin($_POST["usager"]);
			$motDePasseGrainSel = md5($motDePasseMD5 . $_SESSION["grainDeSel"]);
		
			if($motDePasseGrainSel == $_POST["pass"])
			{
				$_SESSION["authentifie"] = $_POST["usager"];
				echo $_SESSION["authentifie"];
				$location = "register";
				$_SESSION["requete"] = "register";
				//header("Location: index.php?requete=accueilAdmin");
				//echo "SESSION['authentifie']";
				return true;
			}
			else
			{
				return false;
				//$message = "Mauvaise combinaison usager/pass";
			}
		}
	}
	/*
	public function AutentificationAdmin($usager, $pass)
	{
		try
		{
			$stmt = $this->connexion->prepare('SELECT motPasseAdmin FROM Administrateurs WHERE nomUsagerAdmin = :usager');
			$stmt->bindParam(":usager", $usager);
			$stmt->execute();
			$stmt->fetch();
			return $stmt['motPasseAdmin'];
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	*/
	
	
	public function ObtenirMotDePasseAdmin($usager)
	{
		try
		{
			$stmt = $this->connexion->prepare('SELECT motPasseAdmin FROM Administrateurs WHERE nomUsagerAdmin = :usager');
			$stmt->bindParam(":usager", $usager);
			$stmt->execute();
			$stmt->fetch();
			return $stmt['motPasseAdmin'];
		}
		catch(Exception $exc)
		{
			return false;
		}
		
		/*
		global $connexion;
		$requete = "SELECT motPasseAdmin FROM Administrateurs WHERE nomUsagerAdmin = :usager";
		echo  mysqli_real_escape_string($connexion, $username);
		$resultat = ExecuteRequete($requete);
		$motDePasse = mysqli_fetch_assoc($resultat)["pass"];
		return $motDePasse;
		*/
	}




///// NOEMI LEGAULT  * TRAVAIL NON TERMINER EN EN ATTENTE //////////
/*
	private function obtenirTousAdminsNomsUsagers()
	{
		try
		{	
			$stmt = $this->connexion->prepare("select * from " . $this->getTable());
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
*/
////////////////////////////////////////////////////////////////////



}

?>