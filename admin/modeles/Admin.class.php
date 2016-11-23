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
class Admin extends TemplateBase
{
	protected function getPrimaryKey()
	{
		return "nomUsagerAdmin";
	}
	
	protected function getTable()
	{
		return "Administrateurs";
	}
	
	public function deconnectionAdmin()
	{
		unset($_SESSION['authentifie']);
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

	public function verificationAutentificationAdmin()
	{
		if((isset($_POST["usager"]) && isset($_POST["pass"]))&& isset($_SESSION["grainDeSel"]))
		{
			$motDePasseMD5 = $this->ObtenirMotDePasseAdmin($_POST["usager"]);
			$motDePasseGrainSel = md5($motDePasseMD5 . $_SESSION["grainDeSel"]);
		
			if($motDePasseGrainSel == $_POST["pass"])
			{
				$_SESSION["authentifie"] = $_POST["usager"];
				//header("Location: index.php?requete=accueil");
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function ObtenirMotDePasseAdmin($usager)
	{
		try
		{
			$stmt = $this->connexion->prepare('SELECT motPasseAdmin FROM Administrateurs WHERE nomUsagerAdmin = :usager');
			$stmt->bindParam(":usager", $usager);
			$stmt->execute();
			$resulta = $stmt->fetch();
			return $resulta['motPasseAdmin'];
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
}

?>