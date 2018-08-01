<?php

require_once 'vendor/autoload.php';

echo "Hello World!";
/*
$sql = new App\DB\Sql();


$usuarios = $sql->select("SELECT * FROM usuarios");

echo json_encode($usuarios);
 */
 $root = new App\Teste\Usuario();
 $root->loadById(1);
 echo $root;
 
echo "<hr>";
 