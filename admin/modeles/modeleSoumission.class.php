<?php
/**
 * Class FormulaireOeuvre
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

class modeleSoumission extends TemplateBase {
			
	/**
	 * @access public
	 * @return Array
	 */
    
    protected function getTable()
    {
        return "Oeuvres";
    }
    
    protected function getPrimaryKey()
    {
        return "idOeuvre";
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      SELECT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    
    public function obtenirCategories()
    {
        $stmt = $this->connexion->prepare("select * from Categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function obtenirArrondissements()
    {
        $stmt = $this->connexion->prepare("select * from Arrondissements");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function obtenirDernierIdArtiste()
    {  
        try
        {
            // source : http://www.w3schools.com/sql/sql_func_last.asp
            $stmt = $this->connexion->prepare("SELECT idArtiste
                                               FROM Artistes
                                               ORDER BY idArtiste 
                                               DESC LIMIT 1");   
            $stmt->execute();
            $data = $stmt->fetch();
            return $data['idArtiste'];

        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    public function obtenirDernierIdOeuvre()
    {
        try
        {
            $stmt = $this->connexion->prepare("SELECT idOeuvre
                                               FROM Oeuvres
                                               ORDER BY idOeuvre 
                                               DESC LIMIT 1");   
            $stmt->execute();
            $data = $stmt->fetch();
            return $data['idOeuvre'];

        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function insererSoumissionOeuvre($param)
    {
        try
        {
            $stmt = $this->connexion->prepare("INSERT INTO Oeuvres (titre, 
                                                                    titreVariante,
                                                                    idCategorie,
                                                                    idArrondissement) 
                                                            VALUES (:titre, 
                                                                    :titreVariante,
                                                                    :idCategorie,
                                                                    :idArrondissement)");
            
            //référence : http://php.net/manual/en/function.extract.php
            extract($param);
            
            $stmt->execute(array(":titre"             => $titre, 
                                 ":titreVariante"     => $titreVariante,
                                 ":idCategorie"       => $idCategorie,
                                 "idArrondissement"   => $idArrondissement));
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    public function insererUrlPhoto($param, $idOeuvre = null)
    {
        try
        {
            if($idOeuvre == null)
				{
					$idOeuvre = $this->obtenirDernierIdOeuvre();
				}
            
            $stmt = $this->connexion->prepare("INSERT INTO Photos (urlPhoto, idOeuvre) 
                                                            VALUES (:urlPhoto, :idOeuvre)");
            
            extract($param);
            $stmt->execute(array(":urlPhoto" => $urlPhoto,
                                 ":idOeuvre" => $idOeuvre));
            
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }

    public function insererSoumissionArtiste($param)
    {
        try
        {
            $stmt = $this->connexion->prepare("INSERT INTO Artistes (prenomArtiste,
                                                                     nomArtiste,
                                                                     collectif)
                                                              VALUE (:prenomArtiste,
                                                                     :nomArtiste, 
                                                                     :collectif)");
            extract($param);
            $stmt->execute(array(":prenomArtiste" => $prenomArtiste,
                                 ":nomArtiste"    => $nomArtiste,
                                 ":collectif"     => $collectif));
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    public function insererSoumissionArtisteOeuvres($idArtiste = null, $idOeuvre = null)
    {
        try
        {
            if($idArtiste == null)
				{
					$idArtiste = $this->obtenirDernierIdArtiste();
				}
            
            if($idOeuvre == null)
				{
					$idOeuvre = $this->obtenirDernierIdOeuvre();
				}
            
            $stmt = $this->connexion->prepare("INSERT INTO ArtistesOeuvres  (idArtiste, idOeuvre) 
                                                                     VALUES (:idArtiste, :idOeuvre)");
            
            $stmt->execute(array(":idArtiste" => $idArtiste,
                                 ":idOeuvre"  => $idOeuvre));
            
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
}

?>