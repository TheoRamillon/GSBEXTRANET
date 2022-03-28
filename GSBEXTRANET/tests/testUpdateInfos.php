<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$lePdo = PdoGsb::getPdoGsb();

//var_dump($lePdo->updateInfos(2,"Didier"));
var_dump($lePdo->updateMdp(4,"Didier"));
