<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'selectionProduit';
}
$action = $_GET['action'];
switch($action){
	
        case 'selectionProduit':{
            
            
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
            include ("vues/v_produits.php");
            
            break;
        }
        case 'voirProduit':{
            
            $idProduit = $_POST['produit'];
            $produitChoisis = $pdo->recupProduitById($idProduit);
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
            
            if(isset ($_POST['btnVoirProduit'])){
                $pdo->addHistoriqueConsultationProduit($_SESSION['id'], $idProduit);
                include("vues/v_ficheProduit.php");
            }
            else{
                if(isset ($_POST['deleteProduit'])){
                    $pdo->deleteProduit($idProduit);
                    include("vues/v_produits.php");
                }
                else{
                    if(isset($_POST['createProduit'])){
                        include("vues/v_createProduit.php");
                    }
                }
            }
            break;
            
        }
        case 'modifProduit':{
            
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
                if (isset($_POST['btnModif'])) {
            

                    $nomProduit = $_POST['nom'];
                    $objectifProduit = $_POST['objectif'];
                    $infoProduit = $_POST['information'];
                    $effetProduit = $_POST['effet'];
            
            
                    $pdo->updateProduit($_GET['id'], $nomProduit, $objectifProduit, $infoProduit, $effetProduit);
                    include("vues/v_produits.php");
                }
                else{
                    if(isset($_POST['btnRetour'])){
                        include("vues/v_produits.php");
                    }
                }
                break;
        }
        
        case 'createProduit':{
            
            //Pour afficher v_produits
            $infoMedecin = $pdo->donneinfosmedecin($_SESSION['id']);
            $gradeMedecin = $infoMedecin['numGrade'];
            
            $nomProduit = $_POST['nom'];
            $objectifProduit = $_POST['objectif'];
            $infoProduit = $_POST['information'];
            $effetProduit = $_POST['effet'];
            $pdo->createProduit($nomProduit, $objectifProduit, $infoProduit, $effetProduit);
            include("vues/v_produits.php");
            break;
        }
        
        case 'retourSommaire':{
            
            include ("vues/v_sommaire.php");
            break;
        }

        
            

        
}
