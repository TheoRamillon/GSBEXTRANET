<?php

/** 
 * Classe d'accÃ¨s aux donnÃ©es. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbextranet';   		
      	private static $user='GSBEXTRANET' ;    		
      	private static $mdp='Jus2Pomme!' ;	
	private static $monPdo;
	private static $monPdoGsb=null;
		
/**
 * Constructeur privÃ©, crÃ©e l'instance de PDO qui sera sollicitÃ©e
 * pour toutes les mÃ©thodes de la classe
 */				
	private function __construct(){
          
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crÃ©e l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * vÃ©rifie si le login et le mot de passe sont corrects
 * renvoie true si les 2 sont corrects
 * @param type $lePDO
 * @param type $login
 * @param type $pwd
 * @return bool
 * @throws Exception
 */
function checkUser($login,$pwd):bool {
    //AJOUTER TEST SUR TOKEN POUR ACTIVATION DU COMPTE
    $user=false;
    $pdo = PdoGsb::$monPdo;
    //$login = $this->hashMail($login);
    //var_dump($login);
    $monObjPdoStatement=$pdo->prepare("SELECT motDePasse FROM medecin WHERE mail= :login AND token IS NULL");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        //var_dump($unUser);
        //var_dump($pwdHash);
        if (is_array($unUser)){
            //var_dump(password_verify($unUser['motDePasse'], $pwdHash));
           if (password_verify($pwd, $unUser['motDePasse']))
               $user=true;
        }
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $user;   
}


	

function donneLeMedecinByMail($login) {
    
    $pdo = PdoGsb::$monPdo;
    $login = $this->hashMail($login);
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail, numGrade FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $unUser;   
}


public function tailleChampsMail(){
    

    
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS
WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
    $execution = $pdoStatement->execute();
$leResultat = $pdoStatement->fetch();
      
      return $leResultat[0];
    
       
       
}


public function creeMedecin($email, $mdp, $nom, $prenom, $dateNaissance)
{
    $lePdo = PdoGsb::getPdoGsb();
    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
    $email = $this->hashMail($email);
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id, nom, prenom ,mail, dateNaissance, motDePasse,dateCreation,dateConsentement, numGrade) "
            . "VALUES (null, :leNom, :lePrenom, :leMail, :dateNaissance, :leMdp, now(),now(), 2)");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $bv2 = $pdoStatement->bindValue(':leMdp', $mdpHash);
    $bv3 = $pdoStatement->bindValue(':leNom', $nom, PDO::PARAM_STR);
    $bv4 = $pdoStatement->bindValue(':lePrenom', $prenom, PDO::PARAM_STR);
    $bv4 = $pdoStatement->bindValue(':dateNaissance', $dateNaissance);
    var_dump($lePdo->testMail($email));
    var_dump($email);
    if($lePdo->testMail($email) === false){
        $execution = $pdoStatement->execute();
        return $execution;
    }
    else
        return false;

}


function testMail($email){
    $pdo = PdoGsb::$monPdo;
    //$email = $this->hashMail($email);
    $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $execution = $pdoStatement->execute();
    $resultatRequete = $pdoStatement->fetch();
    //var_dump($resultatRequete);
    if ($resultatRequete['nbMail']==0)
        $mailTrouve = false;
    else
        $mailTrouve=true;
    
    return $mailTrouve;
}




function connexionInitiale($mail){
     $pdo = PdoGsb::$monPdo;
    $medecin= $this->donneLeMedecinByMail($mail);
    $id = $medecin['id'];
    $this->ajouteConnexionInitiale($id);
    
}

function ajouteConnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), now())");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function donneinfosmedecin($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom, numGrade FROM medecin WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        return $unUser;
   
    }
    else
        throw new Exception("erreur");
           
    
}

function updateInfos($id, $prenom, $nom){
    
    $pdo = PdoGsb::$monPdo;
    
    $monObjPdoStatement=$pdo->prepare("update medecin set prenom = :prenom, nom = :nom WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2=$monObjPdoStatement->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $bvc3 = $monObjPdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $execute = $monObjPdoStatement->execute();
    return $execute;
       
}

function updateMdp($id, $mdp1){
    
    $pdo = PdoGsb::$monPdo;
    $pwdHash = password_hash($mdp1, PASSWORD_DEFAULT);
    var_dump($pwdHash);
        $monObjPdoStatement=$pdo->prepare("update medecin set motDePasse= :mdp WHERE id= :lId");
        $bvc1=$monObjPdoStatement->bindValue(':mdp',$pwdHash,PDO::PARAM_STR);
        $bvc2=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
        $execute = $monObjPdoStatement->execute();
        return $execute;        
}

function ajouteLogConnexion($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), null)");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}

function ajouteLogDeconnexion($id, $logConnexion){
    
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE historiqueconnexion "
            . "SET dateFinLog = now() WHERE idMedecin = :leMedecin AND dateDebutLog = :dateLog;");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $bv2 = $pdoStatement->bindValue(':dateLog', $logConnexion);
    $execution = $pdoStatement->execute();
    return $execution;
    
}

function recupLastLog($id){
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT max(dateDebutLog) "
             . "FROM historiqueConnexion WHERE idMedecin= :lId");
     $bv1 = $pdoStatement->bindValue(':lId', $id);
     
     if ($pdoStatement->execute()) {
        $monLog=$pdoStatement->fetch();
        return $monLog;
   
    }
    else
        throw new Exception("erreur");

}

function recupAllProduits(){
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM produit;");
    if ($pdoStatement->execute()) {
        $lesNoms=$pdoStatement->fetchAll();
        return $lesNoms;
   
    }
    else
        throw new Exception("erreur");
}

function recupProduitById($id){
    
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM produit WHERE id= :lId;");
    $bv1 = $pdoStatement->bindValue(':lId', $id);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");

}
function deleteProduit($idProduit){
    
    $pdoStatement = PdoGsb::$monPdo->prepare("DELETE FROM produit WHERE id= :lId;");
    $bv1 = $pdoStatement->bindValue(':lId', $idProduit);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");
    
}

function updateProduit($id, $nom, $objectif, $info, $effet){
    

    
    $pdoStatement = PdoGsb::$monPdo->prepare("update produit set nom = :nom,"
            . " objectif = :objectif, information = :information, effetIndesirable"
            . " = :effet WHERE id= :id");
//    $bvc1 = $pdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':information', $info, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':effet', $effet, PDO::PARAM_STR);
    $bvc6 = $pdoStatement->bindValue(':id',$id,PDO::PARAM_INT);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");
       
}

function createProduit($nom, $objectif, $info, $effet){
    

    
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO produit VALUES (null,"
            . ":nom, :objectif, :information ,:effet)");
//    $bvc1 = $pdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':information', $info, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':effet', $effet, PDO::PARAM_STR);
    $executeOk = $pdoStatement->execute();
    return $executeOk;
       
}

function deleteMedecin($id){
    
    
    $pdoStatement = PdoGsb::$monPdo->prepare("DELETE FROM medecin  WHERE id= :lId;");
    $bv1 = $pdoStatement->bindValue(':lId', $id);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");
    
    
}


function recupAllMedecins(){
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM medecin;");
    if ($pdoStatement->execute()) {
        $lesNoms=$pdoStatement->fetchAll();
        return $lesNoms;
   
    }
    else
        throw new Exception("erreur");
}

function archiMedecin($id){
    
    
    $dateInfoMedecin = PdoGsb::$monPdo->prepare("SELECT dateNaissance, dateCreation  FROM medecin  WHERE id= :lId;");
    $bv1 = $dateInfoMedecin->bindValue(':lId', $id);
    if ($dateInfoMedecin->execute()) {
        $infoMedecin=$dateInfoMedecin->fetch();
        //var_dump($infoMedecin);
        $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archmedecin (anneeNaiss, dateCreation, dateArchivage) "
                . "VALUES(:anneeNais, :dateCrea, now());");
        //var_dump($infoMedecin);
        $bv2 = $pdoStatement->bindValue(':anneeNais', $infoMedecin['dateNaissance']);
        $bv3 = $pdoStatement->bindValue(':dateCrea', $infoMedecin['dateCreation']);
        
        $execute = $pdoStatement->execute();
        return $execute;
        
        
    }
    else
        throw new Exception("erreur");
    
    
}

function archiHistoriqueCo($id){
    
    $i = 0;
    $idMedecin = PdoGsb::$monPdo->prepare("SELECT MAX(id) FROM archMedecin");
    if ($idMedecin->execute()) {
        $idMonMedecin=$idMedecin->fetch();
        
            //var_dump($idMonMedecin[0]);

        $dateInfoMedecin = PdoGsb::$monPdo->prepare("SELECT dateDebutLog, dateFinLog FROM historiqueConnexion "
                . "WHERE idMedecin= :lId;");
        $bv1 = $dateInfoMedecin->bindValue(':lId', $id);
        if ($dateInfoMedecin->execute()) {
            $infoMedecin=$dateInfoMedecin->fetchAll();


            $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archhistoriqueco ( "
                    . "VALUES(:idMedecin, :dateDebbutLogin, :dateFinLogin);");

            foreach ($infoMedecin as $unMedecin ){

                $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archhistoriqueco "
                    . "VALUES(:idMedecin, :dateDebbutLogin, :dateFinLogin);");
                //var_dump($unMedecin);
                $bv2 = $pdoStatement->bindValue(':idMedecin', $idMonMedecin[0]);
                $bv3 = $pdoStatement->bindValue(':dateDebbutLogin',$infoMedecin[$i]['dateDebutLog'] );
                //var_dump($infoMedecin[$i]['dateDebutLog']);
                $bv4 = $pdoStatement->bindValue(':dateFinLogin',$infoMedecin[$i]['dateFinLog'] );
                //var_dump($infoMedecin[$i]['dateFinLog']);
                $i++;
                //$execute = $pdoStatement->execute();
                if($pdoStatement->execute()){
                    return true;
                }
                else
                    throw new Exception ("erreur insert historique");

            }

            return true;
        
        
        }
        else
            throw new Exception("erreur");
    
    
    }
}

function archiVisio($id){
    
    $i = 0;
    $idMedecin = PdoGsb::$monPdo->prepare("SELECT MAX(id) FROM archMedecin");
    if ($idMedecin->execute()) {
        $idMonMedecin=$idMedecin->fetch();
        
        //var_dump($idMonMedecin[0]);

        $dateInfoMedecin = PdoGsb::$monPdo->prepare("SELECT idVisio, dateInscription  FROM medecinvisio "
                . "WHERE idMedecin= :lId;");
        $bv1 = $dateInfoMedecin->bindValue(':lId', $id);

            if ($dateInfoMedecin->execute()) {
                $infoMedecin=$dateInfoMedecin->fetchAll();



                foreach ($infoMedecin as $unMedecin ){

                    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archvisioconsulte "
                        . "VALUES(:idMedecin, :idVisio, :dateInscription);");
                    //var_dump($unMedecin);
                    $bv2 = $pdoStatement->bindValue(':idMedecin', $idMonMedecin[0]);
                    $bv3 = $pdoStatement->bindValue(':idVisio',$infoMedecin[$i]['idVisio'] );
                    //var_dump($infoMedecin[$i]['idVisio']);
                    $bv4 = $pdoStatement->bindValue(':dateInscription',$infoMedecin[$i]['dateInscription'] );
                    //var_dump($infoMedecin[$i]['dateInscription']);
                    $i++;
                    //$execute = $pdoStatement->execute();
                    if($pdoStatement->execute()){
                        return true;
                    }
                    else
                        throw new Exception ("erreur insert visio");

                }
         
                return true;
        
        
            }
            else
                throw new Exception("erreur");
    
    
    }
    else
        throw new Exception("erreur");
}




function archiProduit($id){
    
    $i = 0;
    $idMedecin = PdoGsb::$monPdo->prepare("SELECT MAX(id) FROM archMedecin");
    if ($idMedecin->execute()) {
        $idMonMedecin=$idMedecin->fetch();
        
        //var_dump($idMonMedecin[0]);

        $dateInfoMedecin = PdoGsb::$monPdo->prepare("SELECT idProduit, date, heure  FROM medecinproduit "
                . "WHERE idMedecin= :lId;");
        $bv1 = $dateInfoMedecin->bindValue(':lId', $id);

            if ($dateInfoMedecin->execute()) {
                $infoMedecin=$dateInfoMedecin->fetchAll();


                foreach ($infoMedecin as $unMedecin ){

                    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archproduit "
                        . "VALUES(:idMedecin, :idProduit, :date, :heure);");
                    //var_dump($unMedecin);
                    $bv2 = $pdoStatement->bindValue(':idMedecin', $idMonMedecin[0]);
                    $bv3 = $pdoStatement->bindValue(':idProduit',$infoMedecin[$i]['idProduit'] );
                    //var_dump($infoMedecin[$i]['idVisio']);
                    $bv4 = $pdoStatement->bindValue(':date',$infoMedecin[$i]['date'] );
                    //var_dump($infoMedecin[$i]['dateInscription']);
                    $bv5 = $pdoStatement->bindValue(':heure',$infoMedecin[$i]['heure'] );
                    $i++;
                    //$execute = $pdoStatement->execute();
                    if($pdoStatement->execute()){
                        return true;
                    }
                    else
                        throw new Exception ("erreur insert produit");

                }
         
                //return true;
        
        
            }
            else
                throw new Exception("erreur");
    
    
    }
    else
        throw new Exception("erreur");
}

function recupKey(){
    
    $file = file_get_contents('./fichier/key.txt', true);
    return $file;
}

function recupNonce(){
    
    $file = file_get_contents('./fichier/nonce.txt', true);
    return $file;
}

function hashMail($mail){
    
    $nonce = $this->recupNonce();
    $key = $this->recupKey();
    $texte_chiffre = sodium_crypto_secretbox($mail,$nonce ,$key );
    //$mailChiffree = bin2hex($texte_chiffre) . PHP_EOL;
    return $texte_chiffre;
}

function addProduitConsulte($id){
    $i = 0;
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT idProduit FROM medecinproduit WHERE idMedecin = :id;");
    $bv1 = $pdoStatement->bindValue(':id', $id);
    if ($pdoStatement->execute()) {
       $infoproduit = $pdoStatement->fetchAll();
       //var_dump($infoproduit);
       //return $infoproduit;
       $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archivageproduit (idMedArchivage, idProduitConsulte, dateArchivage)"."VALUES(:id, :idProduit, now());");
       foreach($infoproduit as $produit){
           $bv1 = $pdoStatement->bindValue(':id', $id);
           $bvc1 = $pdoStatement->bindValue(':idProduit', $infoproduit[$i]['idProduit']);
           $i = $i +1;
           $execution = $pdoStatement->execute();
       }
       return $execution;
       
    }
}
function addVisioConsulte($id){
    $i = 0;
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT idVisio FROM medecinvisio WHERE idMedecin = :id;");
    $bv1 = $pdoStatement->bindValue(':id', $id);
     if ($pdoStatement->execute()) {
       $infoVisio = $pdoStatement->fetchAll();
       //var_dump($infoVisio);
       
       $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archivagevisio (idMedecinArchivageConsulte,idVisioConsulte,DateArchivage)" . "VALUES(:id,:visio, now());");
        
        foreach($infoVisio as $il){
            $bv1 = $pdoStatement->bindValue(':id', $id);
            
            $bvc1 = $pdoStatement->bindValue(':visio',$infoVisio[$i]['idVisio']);
            $i = $i +1;
             $executeOk = $pdoStatement->execute();
             
        }
        return $executeOk;
}
}
function voirVisioById($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM visioconference WHERE id = :id;");
    $bv1 = $pdoStatement->bindValue(':id', $id);
    if($pdoStatement->execute()){
       $resultat = $pdoStatement->fetch();
       return $resultat;
    }
    
}
function voirAllVisio(){
    //Recupère l'ensemble des visios présent dans la bdd
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM visioconference;");
    if($pdoStatement->execute()){
       $resultat = $pdoStatement->fetchAll();
       return $resultat;
    }
}
function donneMaintenance(): bool {

    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT bascule FROM maintenance");
    if ($monObjPdoStatement->execute()) {
        $maintenance=$monObjPdoStatement->fetch();
    }
    else
        throw new Exception("erreur dans la requête");
return $maintenance['bascule'];
}
function addInscriptionVisio($idMedecin, $idVisio){
    //Fonction qui ajoute l'inscription à la bdd
    $pdo = PdoGsb::$monPdo;
    $requete = $pdo->prepare("INSERT INTO medecinvisio VALUES (:idMedecin, :idVisio, now());");
    $bv1 = $requete->bindValue(':idMedecin', $idMedecin, PDO::PARAM_INT);
    $bv2 = $requete->bindValue(':idVisio', $idVisio, pdo::PARAM_INT);
    
   return $requete->execute();
        
    
}
function updateVisio($idVisio, $nom, $objectif, $url, $dateVisio){
    

    
    $pdoStatement = PdoGsb::$monPdo->prepare("update visioconference set nomVisio = :nom,"
            . " objectif = :objectif, url = :url, dateVisio"
            . " = :dateVisio WHERE id= :id");
   $bvc1 = $pdoStatement->bindValue(':id',$idVisio,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':url', $url, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':dateVisio', $dateVisio, PDO::PARAM_STR);
    
    if ($pdoStatement->execute()) {
        $visio=$pdoStatement->fetch();
        return $visio;
    }
    else
        throw new Exception("erreur");
       
}
function deleteVisio($idVisio){
    
    $pdoStatement = PdoGsb::$monPdo->prepare("DELETE FROM visioconference WHERE id= :idVisio;");
    $bv1 = $pdoStatement->bindValue(':idVisio', $idVisio);
    if ($pdoStatement->execute()) {
        $visio=$pdoStatement->fetch();
        return $visio;
    }
    else
        throw new Exception("erreur");
    
}
function createVisio($nomVisio, $objectif, $url, $dateVisio){ 
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO visioconference VALUES (null,"
            . ":nomVisio, :objectif, :url ,:dateVisio)");
//    $bvc1 = $pdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nomVisio', $nomVisio, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':url', $url, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':dateVisio', $dateVisio, PDO::PARAM_STR);
    $executeOk = $pdoStatement->execute();
    return $executeOk;
       
}
function addHistoriqueConsultationProduit($idMedecin, $idProduit){
    //requete sql : INSERT INTO medecinproduit VALUES(23, 13, now(), time(now()));
    //time(now()) --> permet d'obtenir l'heure 
    $pdoStatement = PdoGsb::$monPdo->prepare('INSERT INTO medecinproduit VALUES(:idMedecin, :idProduit, now(), time(now()))');
    $bv1 = $pdoStatement->bindValue(':idMedecin', $idMedecin, PDO::PARAM_INT);
    $bv2 = $pdoStatement->bindValue(':idProduit', $idProduit, PDO::PARAM_INT);
    $executionIsok = $pdoStatement->execute();
    return $executionIsok;
}







}




?>