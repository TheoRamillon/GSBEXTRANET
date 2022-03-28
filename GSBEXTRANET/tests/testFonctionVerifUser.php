<?php

//on insère le fichier qui contient les fonctions
require_once ("../include/class.pdogsb.inc.php");

//appel de la fonction qui permet de se connecter à la base de données

$pdo= PdoGsb::getPdoGsb();


/***** cas TRUE *******************/
//$mail="testserveurto5@gmail.com";
//$pwd="123456";
//$maValeur = 'Þ Ôk­‚>œ‘‡¾ãû÷>ak«7aÐ­ÎŽib3;†æþOµË';
//$lavaleur = $pdo->hashMail('testserveurto5@gmail.com');
//var_dump($pdo->checkUser($mail,$pwd));
//
//
///***** cas FALSE *******************/
//$mail="y@gmail.com";
//$pwd="password";
//
//var_dump($pdo->checkUser($mail,$pwd));
//
///***** cas FALSE *******************/
//$mail="bidule@gmail.fr";
//$pwd="YJhd4gR#9UAR2pGA";
//
//var_dump($pdo->checkUser($mail,$pwd));


echo "hash :";

$lavaleur = $pdo->hashMail('testserveurto66@gmail.com');
echo $lavaleur;
$pwd = 'azertyuiop';
var_dump($pdo->checkUser('testserveurto@gmail.com',$pwd));



