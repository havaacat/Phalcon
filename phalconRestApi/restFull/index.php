<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$loader = new Loader();
$loader->registerDirs(
	array(
		__DIR__ . '/models/'
	)
)->register();

$di = new FactoryDefault();

$di->set('db',function(){
	return new PdoMysql(
		array(
			"host" => "localhost",
			"username" => 'root',
			"password" => 'zxc',
			"dbname" => "test"
		)
	);
});
$app = new Micro($di);

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});

//Retrives all robots
$app->get('/api/robots', function() use ($app){
	$phql = "SELECT * FROM Robots ORDER BY name";
	$robots = $app->modelsManager->executeQuery($phql);

	$data = array();
	foreach($robots as $robot){
		$data[] = array(
			'id' => $robot->id,
			'name' => $robot->name
		);
	}
	echo json_encode($data);
});

//Searches for robots with $name in their name
$app->get('/api/robots/{name}',function($name){
	$phql = "SELECT * FROM Robots WHERE name LIKE :name: ORDER BY name";
	$robots = $app->modelsManager->executeQuery(
		$phql,
		array(
			'name' => '%'.$name.'%'
		);
	);
	$data =array();
	foreach($robots as $robot){
		$data[] = array(
			'id'   => $robot->id;
			'name' => $robot->name;
		);
	}
	echo json_encode($data);
});

//Retrives robots based on primary key
$app->get('/api/robots/{id:[0-9]+}',function($id){
	$phql = "SELECT * FROM Robots WHERE id = :id:";
	$robot = $app->modelManager->executeQuery($phql, array(
		'id' => $id
	))->getFirst;
	$responese = new Response();
	if($response == false){
		$reponse->setJsonContent(
			array(
				'status' => 'NOT-FOUND'
			)
		);
	}else{
		$reponse->setJsonContent(
			array(
				'status' => 'FOUND',
				'data'   => array(
					'id'   => $robot->id,
					'name' => $robot->name
				)
			)
		);
	}
	return $response;
});

//Adds a new robot
$app->post('/api/robots',function(){

});

//Updates robots based on a primary key
$app->put('/api/robots/{id:[0-9]+}', function(){

});

//Deletes robots based on primary key
$app->delete('/api/robots/{id:[0-9]+}', function(){

});

$app->handle();

