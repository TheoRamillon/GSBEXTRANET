<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$lePdo = PdoGsb::getPdoGsb();
$medecin = $lePdo->donneinfosmedecin(1);

var_dump($medecin['numGrade']);

