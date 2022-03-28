<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'voirVisio';
}
$action = $_GET['action'];
switch($action){
    case'selectionVisio':
     $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
     $gradeMedecin = $infoMedecin['numGrade'];
      include ("vues/v_visioConference.php");
        break;
    
    
    case'voirVisio':
            $idVisio = $_POST['visio'];
            $visioChoisi = $pdo->voirVisioById($idVisio);
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            
            $gradeMedecin = $infoMedecin['numGrade'];
            
            if(isset ($_POST['btnVoirVisio'])){
                
                include("vues/v_ficheVisio.php");
            }
            else{
                if(isset($_POST['btnInscriptionVisio'])){
                   $idVisioInscription = $_POST['visio'];
                    $visioInscription = $pdo->voirVisioById($idVisio);
                    $pdo->addInscriptionVisio($_SESSION['id'], $idVisioInscription);
                    include("vues/v_inscriptionVisio.php");
                }
            }
         
                if(isset($_POST['deleteVisio'])){
                    $pdo->deleteVisio($idVisio);
                    include("vues/v_visioConference.php");
                }
                else{
                    if(isset($_POST['createVisio'])){
                      
                        include("vues/v_createVisio.php");
                    }
                    else{
                        if(isset($_POST['btnRetour'])){
                            
                            include('vues/v_sommaire.php');
                        }
                             
                    }
                }
            
            break;
            
        
        case 'modifVisio':
            
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
                if (isset($_POST['btnModif'])) {
            

                    $nomVisio = $_POST['nom'];
                    $objectifVisio = $_POST['objectif'];
                    $url = $_POST['url'];
                    $dateVisio = $_POST['dateVisio'];
            
            
                    $pdo->updateVisio($_GET['id'], $nomVisio, $objectifVisio, $url, $dateVisio);
                    include("vues/v_visioConference.php");
                }
                else{
                    if(isset($_POST['btnRetour'])){
                        include("vues/v_VisioConference.php");
                    }
                }
                break;
        
        
        case 'createVisio':
            if(isset($_POST['btnCreateVisio'])){
                 $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
            
            $nomVisioCreation = $_POST['nomVisio'];
            $objectifVisioCreation = $_POST['objectif'];
            $urlCreation = $_POST['url'];
            $dateVisioCreation = $_POST['dateVisio'];
            $pdo->createVisio($nomVisioCreation, $objectifVisioCreation, $urlCreation, $dateVisioCreation);
            include("vues/v_visioConference.php");
            }      
          if(isset($_POST['btnRetourVisio'])){
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
            include("vues/v_visioConference.php");
            }
  
            break;
    

        case 'retourSommaire':
            
            include ("vues/v_sommaire.php");
            break;
        
       
        break;
    
}