<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
            
            setcookie("logTime", microtime(true));
            if(!isset($_COOKIE['cookieLog']) || $_COOKIE['cookieLog']!= trim($_POST['login']))
                setcookie('cookieLog', trim($_POST['login']), time()+15811200);
                
            
                
            
                $login = $_POST['login'];
                $mdp = $_POST['mdp'];
            
		
		$connexionOk = $pdo->checkUser($login,$mdp);
		if(!$connexionOk){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else {
                    
                    if(isset($_COOKIE['logConscentement'])){
                    
                        $infosMedecin = $pdo->donneLeMedecinByMail($login);
			$id = $infosMedecin['id'];
			$nom =  $infosMedecin['nom'];
			$prenom = $infosMedecin['prenom'];
			connecter($id,$nom,$prenom);
                        
                        //Log connexion
            
                        
                        $pdo->ajouteLogConnexion($id);
                        
                        $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
                        $gradeMedecin = $infoMedecin['numGrade'];
                       
			include("vues/v_sommaire.php");
                    }
                    else{
                        $cookieVide = "Veuillez accepter ou refuser les cookies";
                        include("vues/v_connexion.php");
                    }
		}

			break;	
	}
       
        
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>