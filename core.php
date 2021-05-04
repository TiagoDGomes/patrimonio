<?php


include_once 'config.php';


$db = new mysqli($db_host, $db_user, $db_pass, $db_name)  ;

if($db->connect_errno){
    die('Falha na conexao com banco.');
}


session_start();

require 'core/login.inc.php';
require 'core/nome.inc.php';
//require 'core/setor.inc.php';
require 'core/registro.inc.php';
require 'core/baixar.inc.php';


