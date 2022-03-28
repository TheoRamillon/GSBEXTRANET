<?php



if(!isset($_GET['action'])){
	$_GET['action'] = 'deconnexion';
}
$action = $_GET['action'];
switch($action){
	
	case 'deconnexion':{
            
            
            $logConnexion = $pdo->recupLastLog($_SESSION['id']);
            $pdo->ajouteLogDeconnexion($_SESSION['id'], $logConnexion['max(dateDebutLog)']);
            if(isset($_COOKIE['logTime'])){
                $debutTime = $_COOKIE['logTime']; 
            setcookie("logTime");
            $finTime = microtime(true);
            $duration = $finTime - $debutTime;
            
            $hours = (int)($duration/60/60);
            $minutes = (int)($duration/60)-$hours*60;
            $seconds = (int)$duration-$hours*60*60-$minutes*60;
            $var = $seconds;        
            //var_dump($var);
            }
            
            include("vues/v_connexion.php");
            
            
            break;
            
        }
}

