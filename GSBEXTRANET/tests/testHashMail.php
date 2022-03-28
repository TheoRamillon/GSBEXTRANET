<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");


$lePdo = PdoGsb::getPdoGsb();

var_dump($lePdo->hashMail('testserveurto@gmail.com'));
//file_put_contents('../fichier/recup.txt', $lePdo->hashMail('testserveurto@gmail.com'));
