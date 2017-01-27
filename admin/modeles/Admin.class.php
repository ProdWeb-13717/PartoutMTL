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
	
	public function innitialisationPasse($nomUsagerAdmin)
	{
		$pass = $_SESSION['MotDePasseDefault'];
		$stmt = $this->connexion->prepare('UPDATE Administrateurs SET motPasseAdmin = :pass WHERE nomUsagerAdmin = :usager');
		$stmt->bindParam(":usager", $nomUsagerAdmin);
		$stmt->bindParam(":pass", $pass);
		$stmt->execute();
		return true;

	}
	
	public function changementPasse($usager, $pass)
	{
		$pass = $_POST['pass'];
		$stmt = $this->connexion->prepare('UPDATE Administrateurs SET motPasseAdmin = :pass WHERE nomUsagerAdmin = :usager');
		$stmt->bindParam(":usager", $usager);
		$stmt->bindParam(":pass", $pass);
		$stmt->execute();
		$_SESSION["authentifie"] = $_POST["usager"];
		$_SESSION["niveauAdmin"] = $this->ObtenirNiveauAdmin($_POST["usager"]);
		header('Location: index.php');
	}
	
	public function modifieNiveauAdmin($nomUsagerAdmin, $niveau)
	{
		if($niveau == 1)
		{
			$stmt = $this->connexion->prepare('UPDATE Administrateurs SET niveauAdmin = "2" WHERE nomUsagerAdmin = :usager');
		}
		else
		{
			$stmt = $this->connexion->prepare('UPDATE Administrateurs SET niveauAdmin = "1" WHERE nomUsagerAdmin = :usager');
		}
		$stmt->bindParam(":usager", $nomUsagerAdmin);
		$stmt->execute();
		return true;
	}

	public function verificationAutentificationAdmin()
	{
		if((isset($_POST["usager"]) && isset($_POST["pass"]))&& isset($_SESSION["grainDeSel"]))
		{
			$motDePasseMD5 = $this->ObtenirMotDePasseAdmin($_POST["usager"]);
			$motDePasseGrainSel = md5($motDePasseMD5 . $_SESSION["grainDeSel"]);
		
			if($motDePasseGrainSel == $_POST["pass"])
			{
				$defaultMDP = $this->verificationMotDePasseDefault($motDePasseMD5);
				if($defaultMDP)
				{
					return 1;
				}
				else
				{
					$_SESSION["authentifie"] = $_POST["usager"];
					$_SESSION["niveauAdmin"] = $this->ObtenirNiveauAdmin($_POST["usager"]);
					return 2;
				}
			}
		}
		return 0;
	}
	
	public function verificationMotDePasseDefault($pass)
	{
		if($pass == $_SESSION['MotDePasseDefault'])
		{
			return true;
		}
		return false;
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
	
	public function ObtenirNiveauAdmin($usager)
	{
		try
		{
			$stmt = $this->connexion->prepare('SELECT niveauAdmin FROM Administrateurs WHERE nomUsagerAdmin = :usager');
			$stmt->bindParam(":usager", $usager);
			$stmt->execute();
			$resulta = $stmt->fetch();
			return $resulta['niveauAdmin'];
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function ajoutAdministrateur($data)
	{
			
			$pass = MD5($data['motPasseAdmin']);
			$usager = $data['nomUsagerAdmin'];
			$courriel = $data['courrielAdmin'];
			$niveau = $data['niveauAdmin'];
			$nom =  $data['nomAdmin'];
			$prenom =  $data['prenomAdmin'];
			
			$stmt = $this->connexion->prepare('
			INSERT INTO Administrateurs (nomUsagerAdmin, motPasseAdmin, courrielAdmin, niveauAdmin, nomAdmin, prenomAdmin) 	
								VALUES (:nomUsagerAdmin, :motPasseAdmin, :courrielAdmin, :niveauAdmin, :nomAdmin, :prenomAdmin)');
			
			$stmt->bindParam(":nomUsagerAdmin", $usager);
			$stmt->bindParam(":motPasseAdmin", $pass);
			$stmt->bindParam(":courrielAdmin", $courriel);
			$stmt->bindParam(":niveauAdmin", $niveau);
			$stmt->bindParam(":nomAdmin", $nom);
			$stmt->bindParam(":prenomAdmin", $prenom);
			
			$stmt->execute();
			$resulta = $stmt->fetch();
			
		
	}
}

?>