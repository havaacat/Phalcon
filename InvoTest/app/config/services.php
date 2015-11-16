<?php

use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;


$di = new FactoryDefault();

$di->set('dispatcher', function () use ($di){
	$eventsManager = new EventsManager;
	$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
	$eventsManager->attach('dispatch:beforeExcetion',new NotFoundPlugin);
	$dispatcher = new Dispatcher;
	$dispatcher->setEventsManager($eventsManager);
	return $dispatcher;
});

/**
 * The URL component is used to generate all kind of URLs in the application
 */
$di->set('url',function () use ($config) {
	$url = new UrlProvider();

	$url->setBaseUri($config->application->baseUri);

	return $url;
});

$di->set('view', function () use ($config) {
	$view = new View();
	$view->setViewsDir(APP_PATH . $config->application->viewsDir);
	$view->registerEngines(array(
		".volt" => 'volt'
	));

	return $view;
});

$di->set('volt', function($view, $di){
	$volt = new VoltEngine($view, $di);
	$volt->setOptions(array(
		"compiledPath" => APP_PATH . "cache/volt"
	));

	$compiler = $volt->getCompiler();
	$compiler->addFunction('is_a', 'is_a');
	return $volt;
}, true);

$di->set('db', function () use ($config){
	$dbclass = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
	return new $dbclass(array(
		"host"	   => $config->database->host,
		"username" => $config->database->username,
		"password" => $config->database->password,
		"dbname"   => $config->database->dbname
	));
});

$di->set('modelsMetadata', function () {
	return MetaData();
});

$di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

$di->set('flash', function() {
	return new FlashSession(array(
		'error'   => 'alert alert-danger',
		'success' => 'alert alert-success',
		'notice'  => 'alert alert-info',
	));
});

$di->set('elements', function () {
	return new Elements();
});

?>