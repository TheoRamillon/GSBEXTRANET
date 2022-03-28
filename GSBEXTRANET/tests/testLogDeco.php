<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");


$lePdo = PdoGsb::getPdoGsb();

$log = $lePdo->recupLastLog(2);




echo $log['max(dateDebutLog)'];

var_dump($lePdo->ajouteLogDeconnexion(2, $log['max(dateDebutLog)']));



