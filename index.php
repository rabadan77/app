<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$sql = new \Agaerre\DB\Sql();
        
        $results = $sql->select("SELECT * FROM usuarios");
        
        echo json_encode($results);

});

$app->run();

 ?>