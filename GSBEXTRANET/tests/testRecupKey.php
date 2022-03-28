<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");


$lePdo = PdoGsb::getPdoGsb();



//file_put_contents('../fichier/key.txt', random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES));
var_dump($lePdo->recupKey());
var_dump(random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES));




//file_put_contents('../fichier/nonce.txt', random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES));
var_dump($lePdo->recupNonce());
var_dump(random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES));
