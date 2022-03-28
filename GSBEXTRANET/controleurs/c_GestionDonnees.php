<?php



if(!isset($_GET['action'])){
	$_GET['action'] = 'gestionDonnees';
}
$action = $_GET['action'];
switch($action){
	
        case 'gestionDonnees':{
            
            include ("vues/v_gestionDonnees.php");
            
            break;
        }
        case 'suppArchMedecin':{
            
            
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
            
            if(isset($_POST["btnDelMedecin"])){
                $pdo->deleteMedecin($_POST["NomSelect"]);
            }
            else{
                if(isset($_POST["btnArchiveMedecin"])){
                    
                    //var_dump($_POST["NomSelect"]);
                    $pdo->archiMedecin($_POST["NomSelect"]);
                    $pdo->archiHistoriqueCo($_POST["NomSelect"]);
                    $pdo->archiVisio($_POST["NomSelect"]);
                    $pdo->archiProduit($_POST["NomSelect"]);
                    //$pdo->deleteMedecin($_POST["NomSelect"]);
                }
            }
                include("vues/v_sommaire.php");
                break;
            
            
        }
        
}
